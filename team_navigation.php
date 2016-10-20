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
	        <?php
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					echo $_SESSION['user'] . '\'s Teams';
				} else {
					echo 'All Teams';
				}
			?> 
	        </h1>
	        <div class="headingBreak"></div>
        </div>
        <!-- Creating and displaying a list of all the teams -->
        <?php 
        	include "handlers/db_conn.php";
        	if (!$connection) {
				echo "<p class='conn_err_msg'>No data to display!</p>";
            } else {
                $result;
                
	        	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					$result = mysqli_query($connection, "SELECT * FROM team WHERE Team_ID IN (SELECT Team_ID FROM t_member_of WHERE User_ID LIKE '{$_SESSION['uID']}');");
	        	} else {
	        		$result = mysqli_query($connection, "SELECT * FROM team;");
	        	}
	
	        	while ($output = mysqli_fetch_row($result)) {
	        	
	        		$link = createURL($output[3]);
	        		echo"
	        		<a href=$link><h1>$output[3]</h1></a>
	        		<h3>$output[2]</h3><br/>
	        		<div class ='headingBreak'></div>";
	        	}
	        	
	        	mysqli_close($connection);
            }
        ?>
        <p>
        	Want to create a new team? <a href = team_registration.php>Click here</a>
        </p>
    </body>
</html>