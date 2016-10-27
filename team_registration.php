<!DOCTYPE html>
<?php 
include 'session.php';
include 'handlers/team_reg_handler.php';
?>
<html>
    <head>
        <title>Team Registration</title>
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
        <?php include 'banner.php'; ?>
        <!--ContentBody-->
        <div class="contentContainer">
	        <div class="pageBreak"></div>
	        <h1>
	            Team Registration
        	</h1>
	        <div class="headingBreak"></div>
	        <div class="setBodyMargin">
	            <form id="regForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	                <table class="tb1">
	                    <tr><td class="td1">Team Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder="Hurricanes" name="team_name" value="<?PHP if(isset($_POST['team_name'])) echo htmlspecialchars($_POST['team_name']); ?>"></td>
	                    	<td><span class="error">* <?php echo $teamNameErr;?></span></td></tr>
	                    <tr><td class="td1">Team Sport:</td><td></td><td><input class="input_reg_form" type="text" placeholder="Rugby" name="team_sport" value="<?PHP if(isset($_POST['team_sport'])) echo htmlspecialchars($_POST['team_sport']); ?>"></td>
	                    	<td><span class="error">* <?php echo $teamSportErr;?></span></td></tr>
	                    <tr><td class="td1" colspan="3"></td></tr>
	                    <tr><td class="td1" colspan="3"></td></tr>
	                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Register Team"></td></tr>
	                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset" onclick="resetForm()"></td></tr>
	                    <tr>
	                        <td class="reg_success_msg" colspan="3">
	                            <?php 
	                            	echo $regSuccess;
									echo $conn_err_msg;
								?>
	                        </td>
	                    </tr>
	                </table>
	            </form>
	        </div>
	        <div>
	            <br><br>
	                    <?php
	                    include 'handlers/db_conn.php';
	                    if (!$connection) {
							echo "<p class='conn_err_msg'>No data to display!</p>";
	                    } else {
				            echo '<div class="div_user">
				                <table class="tbl_user">
				                    <tr>
				                        <th class="th_user">Team ID</th>   
				                        <th class="th_user">Org ID</th>
				                        <th class="th_user">Team Name</th>
				                        <th class="th_user">Team Sport</th>
				                        <th class="th_user">Bio</th>
				                    </tr>';
	                    
							$result = mysqli_query($connection, "SELECT * FROM team;");
							
		                    while ($output = mysqli_fetch_row($result)) {
		                        echo"
		                                <tr>
		                                    <td class='td_user'>$output[0]</td>
		                                    <td class='td_user'>$output[1]</td>
		                                    <td class='td_user'>$output[3]</td>
		                                    <td class='td_user'>$output[2]</td>
		                                    <td class='td_user'>$output[4]</td>
		                                </tr>
		                            ";
		                    }
		                    
	                		mysqli_close($connection);
	
	                		echo "</table>
	                		</div>";
	                    }
	                    ?>
	        </div>
	        <div>
	            <br><br>
	                    <?php
	                    include 'handlers/db_conn.php';
	                    if (!$connection) {
							echo "<p class='conn_err_msg'>No data to display!</p>";
	                    } else {
				            echo '<div class="div_user">
				                <table class="tbl_user">
				                    <tr>
				                        <th class="th_user">Team ID</th>   
				                        <th class="th_user">User</th>
				                    </tr>';
	                    
							$result = mysqli_query($connection, "SELECT * FROM t_member_of;");
							
		                    while ($output = mysqli_fetch_row($result)) {
		                    	$user_result = mysqli_query($connection, "SELECT User_UName FROM user WHERE User_ID=".$output[0].";");
		                    	$user_result = mysqli_fetch_row($user_result);
		                        echo"
		                                    <td class='td_user'>$output[1]</td>
		                                    <td class='td_user'>$user_result[0]</td>
		                                </tr>
		                            ";
		                    }
		                    
	                		mysqli_close($connection);
	
	                		echo "</table>
	                		</div>";
	                    }
	                    ?>
	        </div>
        </div>
    </body>
</html>
