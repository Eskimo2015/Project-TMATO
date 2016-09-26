<!DOCTYPE html>
<?php
session_start();
session_destroy();
unset($_SESSION );
?>
<html>
    <head>
        <title>Logout</title>
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <meta charset="UTF-8">
        <meta name="description" content="Team manager and tournament organiser">
        <meta name="keywords" content="Tournament,Organiser,Tmato,Manager">
        <meta name="author" content="Dion Rabone">
        <meta name="co-author" content="Noah Nathan">
        <!--Acknowledgements-->
        <!--Graphical consultant: Giscarde Rousseau-->
        <!--Background image provided by: http://subtlepatterns.com/page/2/?s=light-->
        <!--Logo font provided by: http://www.dafont.com/chavelite.font-->
        <!--endOf-->
    </head>
    <body>
        <!--Banner-->
        <div class="nonScroll">
                <table class="table_header">
                    <tr>
                        <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                        <td>
                        </td>
                        <td  class="td_settings">
                        <?php
                            echo "<a href='login.php' class='cleanLink'>Login</a> / <a href='registration.php' class='cleanLink'>Register</a>";
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
                        </td>
                        <td>
                     	</td> 
                    </tr>
                </table>
            <div class="pageBreak"></div>
            <div>
                <table class="table_nav">
                    <tr class="banner">
                        <td><a href ="user.php">User</a></td>
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
        <h1>
            Logout
        </h1>
        <div class="headingBreak"></div>
        <p >You were successfully Logged out!  Return to  <a href = "homepage.php">homepage</a></p>
        </div>
    </body>
</html>