<!DOCTYPE html>
<!--
Created by Noah Nathan 19 Aug 2016
Web site theme design by Dion Rabone

Dislays user account details.
-->
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$_SESSION['loggedin'] = true;
} else {
	$_SESSION['loggedin'] = false;
}
?>
<html>
    <head>
    	<title>
        <?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				echo 'My Account';
			} else {
				echo 'User Account';
			}
		?>
		</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
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
                        <td class="td_settings">
                        <?php
                        if ($_SESSION['loggedin'] == true) {
                        	echo "<a href='handlers/logout_handler.php' class='cleanLink'>logout</a>";
                        } else {
                            echo "<a href='login.php' class='cleanLink'>Login</a> / <a href='registration.php' class='cleanLink'>Register</a>";
                        }
                        ?> 
                        <select name="settings" class="user_settings_drop_menu">
						   <option value="one">One</option>
						   <option value="two">Two</option>
						   <option value="three">Three</option>
						   <option value="four">Four</option>
						</select> 
                     	</td> 
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
                        <td><a href ="user.php">User</a></td>
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
        <h1>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo $_SESSION['user'];
            } else {
                $_SESSION['loggedin'] = false;
                echo "User Name";
            }
            ?>  
        </h1>
        <div class="pageBreak"></div>
        <div>
            <br><br>
            <div class="div_user">
                <table class="tbl_user">
                    <?php
                    
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        $connection = mysqli_connect("localhost:3306", "root", "", "tmato");
                        $result = mysqli_query($connection, "SELECT * FROM user where User_UName LIKE '{$_SESSION["user"]}';");
                        
                        echo"<h1>About</h1><div class='headingBreak'></div>";
                        
                        while ($output = mysqli_fetch_row($result)) {
                            echo"
								<p>
									Name: $output[1] $output[2]
								</p>
								<p>
									Date of birth: $output[3]
								</p>
								<p>
									Email Address: $output[4]
								</p>
								<p>
									Account Created: $output[8]
								</p>
								<p>
									Bio: N/A
								</p>
								
								<div class='spacerSmall'></div>
								<h1>Teams</h1><div class='headingBreak'></div>
								<p>
									N/A
								</p>
								
								<h1>Organisations</h1><div class='headingBreak'></div>
								<p>
									N/A
								</p>
                            ";
                        }

                        mysqli_close($connection);
                    }
                    ?>
                </table>
            </div>
        </div>
        </div>
    </body>
</html>
