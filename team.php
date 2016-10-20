<!DOCTYPE html>
<?php
	include 'session.php'; 
	include 'functions/team_functions.php';
?>
<html>
    <head>
        <title>Team</title>
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <!--Banner-->
        <?php include 'banner.php'; ?>
        <!--ContentBody-->
        <div class="contentContainer">
        <div class="pageBreak"></div>
        <h1>
            <?php echo getTeamName() ?>
        </h1>
        <div class="headingBreak"></div>
        
        <?php
				/*DB connect + output of needed fields
				* currently teams/orgs and bio are hard coded*/
                include 'handlers/db_conn.php';
                if (!$connection) {
                	echo "<p class='conn_err_msg'>Unable to connect to database!  No data to display.<p>";
                    } else {
                    $search = getTeamAction();
	                $result = mysqli_query($connection, "SELECT * FROM team where Team_Name LIKE '{$search}';");
                    }
	                        
	                while ($output = mysqli_fetch_row($result)) {
	                	echo "
                		<h1>Bio</h1><div class='headingBreak'></div>
                			$output[4]
                		<h1>Members</h1><div class='headingBreak'></div>
                			<p>
	                			PlaceHolderIcon - N/A
	                			";
	                	echo getTeamMembers();
                    		echo"</p>";
                    }
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    	echo '<p>Back To Teams <a href = team_navigation.php>Click here</a></p>';
                    }
        ?>
        </div>
    </body>
</html>