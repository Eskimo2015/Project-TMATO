<!DOCTYPE html>
<?php
//Created by: 	Noah Nathan
//Date:			22/09/2016
//Purpose:  	User Login - First validates data entry into Login Form then, checks user exists and if TRUE loads account to SESSION.

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$_SESSION['loggedin'] = true;
} else {
	$_SESSION['loggedin'] = false;
}

//Step 1:  Define variables and set to empty values
$uname = $pword = "";
$unameErr = $pwordErr = ""; 

//Step 2:  If submission via POST method then validate...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
    	$unameErr = "Username is required!";
  	} else {
  		$uname = test_input($_POST["username"]);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^\w{3,16}$/",$uname)) {
  			$unameErr = "Must contain 3 to 16 characters - Must NOT contain white space or special characters except underscores (_).";
  		}
  	}
	if (empty($_POST["password"])) {
    	$pwordErr = "Password is required!";
  	} else {
  		$pword = test_input($_POST["password"]);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d_]{8,16}$/",$pword)) {
  			$pwordErr = "Must contain 8 to 16 characters - at least ONE Uppercase letter, ONE Lowercase letter and ONE Digit!  Must NOT contain white space or special characters except underscores (_).";
  		}	
  	}
  	if($unameErr == "" && $pwordErr == "") {
  		if(userDetailsCheck($_POST["username"], $_POST["password"])){
  			createSession($_POST["username"]);
  		} else {
  			loginFail();
  		}
  	}
}

//Trims and cleans input data/strings etc.
function test_input($data) {
	$data = trim($data);
	//$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Purpose:  Checks User is valid
function userDetailsCheck($urname, $pword) {
	//Connect to MySQL and select database in one statement
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
	//Find match for Username and Password
	$result = mysqli_query($connection, "SELECT * FROM user WHERE 
		User_UName LIKE '$urname' AND User_Password LIKE '$pword';");
	//If user exists return true
	if (mysqli_fetch_row($result)) {
		return true; 
  	} else { //otherwise return false
		return false;
  	}
  	//Close connection
  	mysqli_close($connection);
}

function createSession($urname) {
	session_start();
	$_SESSION["loggedin"] = true;
	$_SESSION["user"] = $urname;
	header("Location: user_account.php?welcome_msg=Welcome '" . $urname . "'");
}

function loginFail() {
	header("Location: login.php?login_fail_msg=Your login details were NOT recognised!"
			. "  Please re-enter your login details...");
}
?>
<html>
    <head>
        <title>Login</title>
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
			    document.getElementById("loginForm").reset();
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
                        <td align="right">
                        <p align="right">
                        <?php
                        if ($_SESSION['loggedin'] == true) {
                        	echo "<a href='handlers/logout_handler.php' class='cleanLink'>logout</a>";
                        } else {
                            echo "<a href='login.php' class='cleanLink'>Login</a> / <a href='registration.php' class='cleanLink'>Register</a>";
                        }
                        ?> 
                        </p>
                     	</td> 
                    </tr>
                    <tr>
                        <td><div class="spacerSmall"></div></td>
                    </tr>
                    <tr>
                    	<td>
                     	</td>
                        <td>
                            <?php
							if ($_SESSION['loggedin'] == true) {
                                echo "<p align='center'>You are currently logged in as " . $_SESSION['user'] . " !</p>"
                                ;
                            } else {
                            if (!empty($_GET['logout_msg'])) {
                                $message = $_GET['logout_msg'];
                                echo "<p class='logout_msg'>$message</p>";
                            }
                            }
                            ?>
                        </td>
                        <td>
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
            Login
        </h1>
        <div class="headingBreak"></div>
        <div class="setBodyMargin">
            <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <table class="tb1">
                    <tr><td class="td1">Username:</td><td></td><td><input class="input_reg_form" type="text" placeholder="User" name="username" value="<?PHP if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>"></td>
                    	<td><span class="error">* <?php echo $unameErr;?></span></td></tr>
                    <tr><td class="td1">Password:</td><td></td><td><input class="input_reg_form" type="password" placeholder="GuessWhat123" name="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>"></td>
                    	<td><span class="error">* <?php echo $pwordErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Login"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset" onclick="resetForm()"></td></tr>
                    <tr>
                        <td class="login_fail_msg" colspan="3">
                            <?php
                            if (!empty($_GET['login_fail_msg'])) {
                                $message = $_GET['login_fail_msg'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div> 
        </div>
    </body>
</html>
