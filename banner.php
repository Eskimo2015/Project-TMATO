<!DOCTYPE html>
<!--
	Holds the page banner and nav bar for the website to be included into each page. 
-->
	<html>
        <div class="nonScroll">
                <table class="table_header">
                    <tr>
                        <td rowspan="3"><a href = "index.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                        <td></td>
                        <td class="td_settings">
                        <?php
						if (!empty($_GET['welcome_msg'])) {
                            $welcome = $_GET['welcome_msg'];
                            echo "<span class='welcome_msg'>$welcome </span>";
                        }
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        	//echo $welcomeMsg;
                        	echo "<span class='login_status'>logged in as " . $_SESSION['user'] . ":</span><a href='handlers/logout_handler.php' class='cleanLink'>logout</a> 
	                        <select name='settings' class='user_settings_drop_menu' onchange='location = this.value;'>
                        		<option value=''>Settings</option>
							   <option value='user_settings.php'>User Settings</option>
							   <option value='team_registration.php'>Add Team</option>
							   <option value='three'>Three</option>
							   <option value='four'>Four</option>
							</select> ";
                        } else {
                            echo "<a href='login.php' class='cleanLink'>Login</a> / <a href='registration.php' class='cleanLink'>Register</a>";
                        }
                        ?>
                     	</td> 
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td></td>
                    </tr>
                </table>
            <div class="pageBreak"></div>
            <div>
                <table class="table_nav">
                    <tr class="banner">
                        <td><a href ="user.php">User</a></td>
                        <td><a href ="team_navigation.php">Team</a></td>
                        <td><a href ="tournament.php">Tournament</a></td>
                        <td><a href ="organisation.php">Organisation</a></td>
                        <!---<td class="hideElement"></td>-->
                    </tr>
                </table>	
            </div>
        </div>
        <div class="spacerLarge"></div>
	</html>
	