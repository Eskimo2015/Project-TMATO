<!DOCTYPE html>
<!--
Created by Noah Nathan 19 Aug 2016
Web site theme design by Dion Rabone

Dislays user account details.
-->
<?php include 'session.php'; ?>
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
            /*gets the user being searched from the url*/
            if (!empty($_GET['action'])) {
            	$action = $_GET['action'];
            	$action = basename($action);
            }
            /*if there is no user entered default to the logged in user*/
            else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            	$action = $_SESSION['user'];
            }
            /*if the user is not logged in display a blank userpage*/
            else{
            	$action = "User Page";	
            }
            /*display userpage name*/
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo $action;
            } else {
                $_SESSION['loggedin'] = false;
                echo $action;
            }
            ?>  
        </h1>
        <div class="headingBreak"></div>
        <div>
            <br><br>
            <div class="div_user">
                <table class="tbl_user">
                    <?php
                    /*gets the user being searched from the url*/
                    if (!empty($_GET['action'])) {
                    	$action = $_GET['action'];
                    	$action = basename($action);
                    }
                    /*if there is no user entered default to the logged in user*/
					else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		            	$action = $_SESSION['user'];	
		            }
		            /*display userpage name throws error without this line*/
		            else{
		            	$action = "User Page";	
		            }
					/*DB connect + output of needed fields
					 * currently teams/orgs and bio are hard coded*/
                        include 'handlers/db_conn.php';
                        $result = mysqli_query($connection, "SELECT * FROM user where User_UName LIKE '{$action}';");
                        
                    
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
                            mysqli_close($connection);
                        }
                    ?>
                </table>
            </div>
        </div>
        </div>
    </body>
</html>
