<!DOCTYPE html>
<?php
//Created by: 	Noah Nathan
//Date:			12/09/2016
//Purpose:  	Validate Registration Form - fields

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$_SESSION['loggedin'] = true;
} else {
	$_SESSION['loggedin'] = false;
}

//Step 1:  Define variables and set to empty values
$fname = $lname = $dob = $email = $uname = $pword = "";
$fnameErr = $lnameErr = $dobErr = $emailErr = $unameErr = $pwordErr = ""; 

//Step 2:  If submission via POST method then validate...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstname"])) {
    	$fnameErr = "First Name is required!";
  	} else {
  		$fname = test_input($_POST['firstname']);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^[a-zA-Z '-]*$/",$fname)) {
  			$fnameErr = "Only letters, hyphens(-), apostrophes (') and white space are permitted!";
  		} else if(!preg_match("/^[a-zA-Z '-]{0,32}$/",$fname)) {
  			$fnameErr = "First Name must NOT exceed 32 characters!";
  		}	
  	}
	if (empty($_POST["lastname"])) {
    	$lnameErr = "Last Name is required!";
  	} else {
  		$lname = test_input($_POST['lastname']);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^[a-zA-Z '-]*$/",$lname)) {
  			$lnameErr = "Only letters, hyphens(-), apostrophes (') and white space are permitted!";
  		} else if(!preg_match("/^[a-zA-Z '-]{0,32}$/",$lname)) {
  			$lnameErr = "Last Name must NOT exceed 32 characters!";
  		}	
  	}
	if (empty($_POST["dob"])) {
    	$dobErr = "DOB is required!";
  	} else {
  		$dob = test_input($_POST["dob"]);
  		// check if DOB is in correct format yyyy-mm-dd
  		if (!preg_match("/^(19|20)[0-9]{2}-((0(1|3|5|7|8)|1(0|2))-(0[1-9]|[1-2][0-9]|3[0-1])|(0(4|6|9)|11)-(0[1-9]|[1-2][0-9]|30)|02-(0[1-9]|1[0-9]|2[0-9]))$/",$dob)) {
  			$dobErr = "Date must be in correct format YYYY-MM-DD!  Must be between 1900-01-01 and 2099-12-31.  NOTE: *29 days in February!*";
  		}	
  	}
	if (empty($_POST["email"])) {
    	$emailErr = "Email is required!";
  	} else {
  		$email = test_input($_POST["email"]);
  		//Remove all illegal characters except a-zA-Z0-9!#$%&'*+-/=?^_`{|}~@.[]
  		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
  		// check if e-mail address is well-formed
  		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$emailErr = "Invalid email format!  Must be well formed e.g. contain only ONE '@' and end in '.com' etc.";
  		}
  	}
	if (empty($_POST["username"])) {
    	$unameErr = "Username is required!";
  	} else {
  		$uname = test_input($_POST["username"]);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?!.*[\W\x7B-\xFF]).{8,16}$/",$uname)) {
  			$unameErr = "Must contain 8 to 16 characters - at least ONE Uppercase letter, ONE Lowercase letter and ONE Digit!  Must NOT contain white space or special characters except underscores (_).";
  		} else {
  			$unameErr = userNameCheck($uname);
  		}
  	}
	if (empty($_POST["password"])) {
    	$pwordErr = "Password is required!";
  	} else {
  		$pword = test_input($_POST["password"]);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?!.*[\W\x7B-\xFF]).{8,16}$/",$pword)) {
  			$pwordErr = "Must contain 8 to 16 characters - at least ONE Uppercase letter, ONE Lowercase letter and ONE Digit!  Must NOT contain white space or special characters except underscores (_).";
  		}	
  	}
  	if($fnameErr == "" && $lnameErr == "" && $dobErr == "" && $emailErr == "" && $unameErr == "" && $pwordErr == "") {
  		insertUserData($fname, $lname, $dob, $email, $uname, $pword);
  	}
}

//Trims and cleans input data/strings etc.
function test_input($data) {
	$data = trim($data);
	//$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Purpose:  Checks for availability of Username
function userNameCheck($uname) {
	$data = "";
	//Step 1:  connect to MySQL and select database in one statement
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
	//Step 2:  Run query - check DB for existing account
	$result = mysqli_query ($connection , "SELECT User_UName FROM user WHERE
			User_UName LIKE '{$uname}';");
	//Step 3:  If username already exists then create error message
	if (mysqli_fetch_row($result)) {
	  			$data = "The selected USERNAME is unavailable!  Please choose another USERNAME to create an account."; 
  	}
	//Step 4:  return error message
	return $data;
	//Step 5:  Close connection
	mysqli_close($connection);
}

function insertUserData($fname, $lname, $dob, $email, $uname, $pword) {
	//Step 1:  connect to MySQL and select database in one statement
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
	
	//Step 2:  Insert user data to User table and print confirmation message
	mysqli_query($connection, "INSERT INTO user values(NULL,'{$fname}','{$lname}','{$dob}','{$email}',
	'{$uname}','{$pword}','',CURDATE(),NULL,'0','0')");
	header("Location: registration.php?reg_success_msg=Your account has been created successfully!");
	
	//Step 3:  Close connection
	mysqli_close($connection);
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
        <script>
			function resetForm() {
			    document.getElementById("regForm").reset();
			}
		</script>
    </head>
    <body>
        <!--Banner-->
        <div class="nonScroll">
            <form method="post" action="handlers/login_handler.php">
                <table class="table_header">
                    <tr>
                        <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                        <td>
                        <?php
							if (!empty($_GET['welcome_msg'])) {
                                $message = $_GET['welcome_msg'];
                                echo "<p class='welcome_msg'>$message</p>";
                            }
                        ?> 
                        </td>
                    </tr>
                    <tr>
                        <td><div class="spacerSmall"></div></td>
                    </tr>
                    <tr>
                    	<td>
                        <?php
                        if ($_SESSION['loggedin'] == false) {
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
							if ($_SESSION['loggedin'] == true) {
                                echo "<p align='center'>You are currently logged in as " . $_SESSION['user'] . " !</p>"
                                ;
                            } else {
                            if (!empty($_GET['login_fail_msg'])) {
                                $message = $_GET['login_fail_msg'];
                                echo "<p class='login_fail_msg'>$message</p>";
                            }
                            if (!empty($_GET['logout_msg'])) {
                                $message = $_GET['logout_msg'];
                                echo "<p class='logout_msg'>$message</p>";
                            }
                            }
                            ?>
                        </td>
                        <td align="right">
                        <p align="right">
                        <?php
                        if ($_SESSION['loggedin'] == true) {
                        	echo "<a href='handlers/logout_handler.php' class='cleanLink'>logout</a>";
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
            <form id="regForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <table class="tb1">
                    <tr><td class="td1">First Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder="John" name="firstname" value="<?PHP if(isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname']); ?>"></td>
                    	<td><span class="error">* <?php echo $fnameErr;?></span></td></tr>
                    <tr><td class="td1">Last Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder="Doe" name="lastname" value="<?PHP if(isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname']); ?>"></td>
                    	<td><span class="error">* <?php echo $lnameErr;?></span></td></tr>
                    <tr><td class="td1">Date Of Birth:</td><td></td><td><input class="input_reg_form" type="text" placeholder="yyyy-mm-dd" name="dob" value="<?PHP if(isset($_POST['dob'])) echo htmlspecialchars($_POST['dob']); ?>"></td>
                    	<td><span class="error">* <?php echo $dobErr;?></span></td></tr>
                    <tr><td class="td1">Email Address:</td><td></td><td><input class="input_reg_form" type="text" placeholder="john_doe@lost.com" name="email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>"></td>
                    	<td><span class="error">* <?php echo $emailErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1">Username:</td><td></td><td><input class="input_reg_form" type="text" placeholder="Username123!" name="username" value="<?PHP if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>"></td>
                    	<td><span class="error">* <?php echo $unameErr;?></span></td></tr>
                    <tr><td class="td1">Password:</td><td></td><td><input class="input_reg_form" type="password" placeholder="GuessWhat?" name="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>"></td>
                    	<td><span class="error">* <?php echo $pwordErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Register"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset" onclick="resetForm()"></td></tr>
                    <tr>
                        <td class="reg_success_msg" colspan="3">
                            <?php
                            if (!empty($_GET['reg_success_msg'])) {
                                $message = $_GET['reg_success_msg'];
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
                        <th class="th_user">Account Created</th> 
                    </tr>
                    <?php
                    $connection = mysqli_connect("localhost:3306", "root", "", "tmato");
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
