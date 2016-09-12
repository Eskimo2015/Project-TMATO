<!DOCTYPE html>
<!--
Created by Noah Nathan 19 Aug 2016
Web site theme design by Dion Rabone

Dislays user account details.
-->
<?php
session_start();
?>
<html>
    <head>
        <title>My Account</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <!--Banner-->
        <div class="nonScroll">
            <form method="post" action="php/login_handler.php">
                <table class="table_header">
                    <tr>
                        <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                        <td>
                        <?php
							if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
								if (!empty($_GET['login_msg'])) {
	                                $message = $_GET['login_msg'];
	                                echo "<p class='welcome_msg'>$message</p>";
	                            }
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
                            if (!empty($_GET['login_msg'])) {
                                $message = $_GET['login_msg'];
                                echo "<p class='login_fail_msg'>$message</p>";
                            }
                            if (!empty($_GET['logout_msg'])) {
                                $message = $_GET['logout_msg'];
                                echo "<p class='confirm_msg'>$message</p>";
                            }
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
        <div class="spacerLarge"></div>
        <div class="pageBreak"></div>
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
        <div class="headingBreak"></div>
        <div>
            <br><br>
            <div class="div_user">
                <table class="tbl_user">
                    <tr>
                        <th class="tbl_header" colspan="2">User Details:</th> 
                    </tr>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        $connection = mysqli_connect("localhost:3306", "root", "", "tmato_db");
                        $result = mysqli_query($connection, "SELECT * FROM user where User_UserName LIKE '{$_SESSION["user"]}';");

                        while ($output = mysqli_fetch_row($result)) {
                            echo"
                                <tr>
                                    <td class='th_user'>User ID</td><td class='td_user'>$output[0]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>First Name</td><td class='td_user'>$output[1]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Last Name</td><td class='td_user'>$output[2]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>DOB</td><td class='td_user'>$output[3]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Email</td><td class='td_user'>$output[4]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Username</td><td class='td_user'>$output[5]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Password</td><td class='td_user'>$output[6]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>A/C Created</td><td class='td_user'>$output[7]</td>
                                </tr>
                            ";
                        }

                        mysqli_close($connection);
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
