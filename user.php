<!DOCTYPE html>
<!--
Created by Noah Nathan 19 Aug 2016
Web site theme design by Dion Rabone

Dislays user account details.
-->
<?php 
	include 'session.php';
	include 'functions/user_functions.php';
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
        <?php include 'banner.php'; ?>
        <!--ContentBody-->
        <div class="contentContainer">
        <div class="pageBreak"></div>
        <h1>
        	<!--sets the user page title-->
            <?php
				include 'handlers/db_conn.php';
				if (!$connection) {
					echo 'Connection Error!';
				} else {
					echo getName();
				}
            ?>  
        </h1>
        <div class="headingBreak"></div>
        <div>
            <br><br>
            <div class="div_user">
            	<?php
				/*DB connect + output of needed fields
				* currently teams/orgs and bio are hard coded*/
                include 'handlers/db_conn.php';
                if (!$connection) {
                	echo "<p class='conn_err_msg'>Unable to connect to database!  No data to display.<p>";
                    } else {
                    $search = getAction();
	                $result = mysqli_query($connection, "SELECT * FROM user where User_UName LIKE '{$search}';");
	                
	                echo"<h1>About</h1><div class='headingBreak'></div>";
	                        
	                while ($output = mysqli_fetch_row($result)) {
	                	echo"
							<p>
								Name: $output[1] $output[2]
							</p>
							<p>
								Date of birth: $output[7]
							</p>
							<p>
								Email Address: $output[6]
							</p>
							<p>
								Account Created: $output[8]
							</p>
							<p>
								Bio: "; if ($output[9] ==null){
									echo "N/A";
                            	}
                            	else echo $output[9];
                            echo "			
							</p>		
								<div class='spacerSmall'></div>
							<h1>Teams</h1><div class='headingBreak'></div>
							<p>
								N/A
							</p>
									
							<h1>Organisations</h1><div class='headingBreak'></div>
								<p>
									N/A
								</p> ";
	                        } 
	                        mysqli_close($connection);
	                        
                        }
                    ?>
            </div>
        </div>
        </div>
    </body>
</html>