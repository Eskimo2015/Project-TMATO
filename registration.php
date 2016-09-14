<!DOCTYPE html>
<?php
session_start();
//Created by: 	Noah Nathan
//Date:			12/09/2016
//Purpose:  	Validate Registration Form - fields

//Step 1:  Define variables and set to empty values
$fname = $lname = $dob = $email = $uname = $pword = "";
$fnameErr = $lnameErr = $dobErr = $emailErr = $unameErr = $pwordErr = ""; 

//Step 2:  If submission via POST method then validate...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstname"])) {
    	$fnameErr = "First Name is required";
  	} else {
  		$fname = test_input($_POST['firstname']);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  			$nameErr = "Only letters and white space allowed";
  		}	
  	}
	if (empty($_POST["lastname"])) {
    	$lnameErr = "Last Name is required";
  	} else {
  		$lname = test_input($_POST['lastname']);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  			$nameErr = "Only letters and white space allowed";
  		}	
  	}
	if (empty($_POST["dob"])) {
    	$dobErr = "DOB is required";
  	} else {
  		$dob = test_input($_POST["dob"]);
  	}
	if (empty($_POST["email"])) {
    	$emailErr = "Email is required";
  	} else {
  		$email = test_input($_POST["email"]);
  		//Remove all illegal characters except a-zA-Z0-9!#$%&'*+-/=?^_`{|}~@.[]
  		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
  		// check if e-mail address is well-formed
  		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$emailErr = "Invalid email format";
  		}
  	}
	if (empty($_POST["username"])) {
    	$unameErr = "Username is required";
  	} else {
  		$uname = test_input($_POST["username"]);
  	}
	if (empty($_POST["password"])) {
    	$pwordErr = "Password is required";
  	} else {
  		$pword = test_input($_POST["password"]);
  	}
}

if($fnameErr = $lnameErr = $dobErr = $emailErr = $unameErr = $pwordErr = "") {
	//Step 2:  connect to MySQL and select database in one statement
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato_db");

	//Step 3:  Run query - check DB for existing account
	$result = mysqli_query ($connection , "SELECT User_UName FROM user WHERE
			User_UName LIKE '{$uname}';");

	//Step 4a:  If username already exists then abort registration and print message
	if (mysqli_fetch_row($result)) {
		header("Location: ../registration.php?reg_msg=Your chosen USERNAME is already in use!"
				. "  Please enter another USERNAME to create a new account...");
		//Step 4b:  Run query - insert form data into user table and print confirmation message
	} else {
		mysqli_query($connection, "INSERT INTO user values(NULL,'{$fname}','{$lname}','{$dob}','{$email}',
		'{$uname}','{$pword}','',CURDATE(),NULL,'0','0')");
		header("Location: ../registration.php?reg_msg=Your account has been created successfully!");
	}

	//Step 5:  Close connection
	mysqli_close($connection);
}

//Trims and cleans input data/strings etc.
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <meta charset="UTF-8">
        <meta name="description" content="Team manager and tournament organiser">
        <meta name="keywords" content="Tournament,Organiser,Tmato,Manager">
        <meta name="author" content="Noah Nathan">
        <meta name="author" content="Dion Rabone">
        <!--Acknowledgements-->
        <!--Graphical consultant: Giscarde Rousseau-->
        <link rel="Background image provided by:" href="http://subtlepatterns.com/page/2/?s=light">
        <link rel="Logo font provided by:" href="http://www.dafont.com/chavelite.font ">
        <!--endOf-->
    </head>
    <body>
        <!--Banner-->
        <div class="nonScroll">
            <form method="post" action="php/login_handler.php">
                <table class="table_header">
                    <tr>
                        <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                    </tr>
                    <tr>
                        <td><div class="spacerSmall"></div></td>
                            <?php
                            
                            ?> 
                    </tr>
                    <tr>
                    	<td>
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        	$_SESSION['loggedin'] = true;
                        } else {
                        	echo "
	                            <label class='indent_01'>UserName:  </label>
	                            <input class='indent_01' type='text' name='username'>
	                            <label class='indent_01'>Password:  </label>
	                            <input class='indent_01' type='password' name='password'>
	                            <input class='indent_01' type='submit' value='Login'>
                        	";
                        }
                        ?>  
                     	</td>
                        <td>
                            <?php
							if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo "<p align='center'>You are currently logged in as " . $_SESSION['user'] . " !</p>"
                                ;
                            } else {
                                $_SESSION['loggedin'] = false;
                            }
                            if (!empty($_GET['login_msg'])) {
                                $message = $_GET['login_msg'];
                                echo "<p class='login_fail_msg'>$message</p>";
                            }
                            if (!empty($_GET['logout_msg'])) {
                                $message = $_GET['logout_msg'];
                                echo "<p class='confirm_msg'>$message</p>";
                            }
                            ?>
                        </td>
                        <td align="right">
                        <p align="right">
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        	echo "<a href='php/logout_handler.php' class='cleanLink'>logout</a>";
                        } else {
                            echo "<a href='registration.php' class='cleanLink'>Register</a>";
                        }
                        ?> 
                        </p>
                     	</td> 
                    </tr>
                </table>
            </form>
            <div class="pageBreak"></div>
            <div>
                <table class="table_nav">
                    <tr class="banner">
                        <td><a href ="user_account.php">User</a></td>
                        <td><a href ="team.php">Team</a></td>
                        <td><a href ="tournament.php">Tournament</a></td>
                        <td><a href ="organisation.php">Organisation</a></td>
                        <!---<td class="hideElement"></td>-->
                    </tr>
                </table>	
            </div>
        </div>
        <!--ContentBody-->
        <div class="contentContainer">
        <div class="spacerLarge"></div>
        <div class="pageBreak"></div>
        <h1>
            Registration
        </h1>
        <div class="headingBreak"></div>
        <div class="setBodyMargin">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <table class="tb1">
                    <tr><td class="td1">First Name:</td><td></td><td><input type="text" placeholder="John" name="firstname" value="<?PHP if(isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname']); ?>">
                    	<span class="error">* <?php echo $fnameErr;?></span></td></tr>
                    <tr><td class="td1">Last Name:</td><td></td><td><input type="text" placeholder="Doe" name="lastname" value="<?PHP if(isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname']); ?>">
                    	<span class="error">* <?php echo $lnameErr;?></span></td></tr>
                    <tr><td class="td1">Date Of Birth:</td><td></td><td><input type="text" placeholder="yyyy-mm-dd (e.g. 1995-10-07)" name="dob" value="<?PHP if(isset($_POST['dob'])) echo htmlspecialchars($_POST['dob']); ?>">
                    	<span class="error">* <?php echo $dobErr;?></span></td></tr>
                    <tr><td class="td1">Email Address:</td><td></td><td><input type="text" placeholder="john_doe@lost.com" name="email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
                    	<span class="error">* <?php echo $emailErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1">Username:</td><td></td><td><input type="text" placeholder="Unknown123!" name="username" value="<?PHP if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>">
                    	<span class="error">* <?php echo $unameErr;?></span></td></tr>
                    <tr><td class="td1">Password:</td><td></td><td><input type="password" placeholder="GuessWhat?" name="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>">
                    	<span class="error">* <?php echo $pwordErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Register"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset"></td></tr>
                    <tr>
                        <td class="reg_msg" colspan="3">
                            <?php
                            if (!empty($_GET['reg_msg'])) {
                                $message = $_GET['reg_msg'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div>
            <br><br>
            <div class="div_user">
                <table class="tbl_user">
                    <tr>
                        <th class="th_user">User ID</th>   
                        <th class="th_user">First Name</th>
                        <th class="th_user">Last Name</th>
                        <th class="th_user">DOB</th>
                        <th class="th_user">Email</th>
                        <th class="th_user">Username</th>
                        <th class="th_user">Password</th>
                        <th class="th_user">A/C Created</th> 
                    </tr>
                    <?php
                    $connection = mysqli_connect("localhost:3306", "root", "", "tmato_db");
                    $result = mysqli_query($connection, "SELECT * FROM user;");

                    while ($output = mysqli_fetch_row($result)) {
                        echo"
                                <tr>
                                    <td class='td_user'>$output[0]</td>
                                    <td class='td_user'>$output[1]</td>
                                    <td class='td_user'>$output[2]</td>
                                    <td class='td_user'>$output[3]</td>
                                    <td class='td_user'>$output[4]</td>
                                    <td class='td_user'>$output[5]</td>
                                    <td class='td_user'>$output[6]</td>
                                    <td class='td_user'>$output[8]</td>
                                </tr>
                            ";
                    }

                    mysqli_close($connection);
                    ?>
                </table>
            </div>
        </div>
        </div>
    </body>
</html>
