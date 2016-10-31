<!DOCTYPE html>
<?php
include 'session.php';
include 'functions/create_url_function.php';
?>
<html>
    <head>
    	<title>
        <?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				echo 'My Tournaments';
			} else {
				echo 'Tournaments';
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
	        <?php
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					echo $_SESSION['user'] . '\'s Tournaments';
				} else {
					echo 'All Tournaments';
				}
			?> 
	        </h1>
	        <div class="headingBreak"></div>
        </div>
        <!-- Creating and displaying a list of all the tournaments -->
        <?php 
        	include "handlers/db_conn.php";
        	if (!$connection) {
				echo "<p class='conn_err_msg'>Unable to connect to the database!</p>";
            } else {
                $result;
                
	        	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					$result = mysqli_query($connection, "SELECT tournament.* FROM tournament, enroll_in, team, t_member_of WHERE t_member_of.Team_ID=".$_SESSION['uID']." AND team.Team_ID=t_member_of.Team_ID AND enroll_in.Team_ID=team.Team_ID AND tournament.Tour_ID=enroll_in.Tour_ID;");
	        	} else {
	        		$result = mysqli_query($connection, "SELECT * FROM tournament;");
	        	}
	
	        	$output = mysqli_fetch_row($result);
	        	if (is_null($output)) {
	        		echo"<h3>No tournaments found!</h3><br/>
	        			<div class ='headingBreak'></div>";
	        	} else {
	        		do {
	        			$link = createURL($output[3]);
	        			echo"
	        			<h1><a href=$link>$output[3]</a></h1>
	        			<h3>$output[2]</h3><br/>
	        			<div class ='headingBreak'></div>";
	        		} while ($output = mysqli_fetch_row($result));
	        	}
	        	
	        	mysqli_close($connection);
            }
			
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				echo '<p>Want to create a new tournament? <a href = tournament_registration.php>Click here</a></p>';
			}
        ?>
        
    </body>
</html>