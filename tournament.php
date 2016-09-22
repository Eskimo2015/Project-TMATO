<!DOCTYPE html>
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
        <title>Tournament</title>
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
                        <td  class="td_settings">
                        <?php
                        if ($_SESSION['loggedin'] == true) {
                        	echo "<a href='handlers/logout_handler.php' class='cleanLink'>logout</a>";
                        } else {
                            echo "<a href='login.php' class='cleanLink'>Login</a> / <a href='registration.php' class='cleanLink'>Register</a>";
                        }
                        ?>
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
            Tournament Name
        </h1>
        <div class="headingBreak"></div>
        </div>
    </body>
</html>

