<!DOCTYPE html>
<?php include 'session.php'; ?>
<html>
    <head>
    	<title>
        <?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				echo 'My Teams';
			} else {
				echo 'Teams';
			}
		?>
		</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
    <?php include 'banner.php'; ?>
    	<div class="contentContainer">
        <div class="pageBreak"></div>
	        <h1>
	        	Team's 
	        </h1>
	        <div class="headingBreak"></div>
        </div>
        <!-- Creating and displaying a list of all the teams -->
        <?php 
        	include "handlers/db_conn.php";
        	
        	$tName = mysqli_query($connection, "SELECT Team_Name FROM team;");
        	$tSport = mysqli_query($connection, "SELECT Team_Sport FROM team;");
        	
        	$i=0;
        	while (($sportOutput = mysqli_fetch_row($tSport)) && ($nameOutput = mysqli_fetch_row($tName))) {
        		echo"
        		<h1>$nameOutput[$i]</h1>
        		<h3>$sportOutput[$i]</h3>";
        		
        		$link = createURL($nameOutput[$i]);
        		
        		echo"
        		<a href=$link>Click here</a>
        		<div class='headingBreak'></div>";
        	$i+1;
			}
        ?>
        <p>
        	Want to create a new team? <a href = team_registration.php>Click here</a>
        </p>
    </body>
</html>

<?php 
function createURL($team_name){
	$link = ("http://localhost/project_tmato/team.php" . "?action=" . $team_name);
	return $link;
}
?>