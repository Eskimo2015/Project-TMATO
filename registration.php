<!DOCTYPE html>
<!--

-->
<html>
    <head>
        <title>Registration</title>
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
    </head>
    <body>
        <!--Banner-->
        <div class="nonScroll">
            <table width="100%" >
                <tr>
                    <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>	
                </tr>
                <tr>
                    <td><div class="spacerMedium"></div></td>
                </tr>
            </table>
            <div class="pageBreak"></div>
            <div class="divAlignLeft">
                <table width="100%">
                    <tr class="banner">
                        <td><a href ="user_account.php">User</a></td>
                        <td><a href ="team.php">Team</a></td>
                        <td><a href ="tournament.php">Tournament</a></td>
                        <td><a href ="organisation.php">Organisation</td>
                        <td class="hideElement"></td>
                    </tr> 
                </table>	
            </div>
        </div>

        <!--ContentBody-->
        <div class="spacerLarge"></div>
        <div class="pageBreak"></div>
        <h1>
            Registration
            <div class="headingBreak"></div>
        </h1>
        <div class="setBodyMargin">
            <form method="POST" action="php/register_user.php">
                <table class="tb1">
                    <tr><td class="td1">First Name:</td><td></td><td><input type="text" name="firstname"></td></tr>
                    <tr><td class="td1">Last Name:</td><td></td><td><input type="text" name="lastname"></td></tr>
                    <tr><td class="td1">Date Of Birth:</td><td></td><td><input type="text" name="dob"></td></tr>
                    <tr><td class="td1">Email Address:</td><td></td><td><input type="text" name="email"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1">Username:</td><td></td><td><input type="text" name="username"></td></tr>
                    <tr><td class="td1">Password:</td><td></td><td><input type="text" name="password"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Register"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset"></td></tr>
                    <tr>
                        <td class="reg_msg" colspan="3">
                            <?php
                            if (!empty($_GET['reg_msg'])) {
                                $message = $_GET['reg_msg'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div>
            <br><br>
            <div class="div_user">
                <table class="tbl_user">
                    <tr>
                        <th class="th_user">User ID</th>   
                        <th class="th_user">First Name</th>
                        <th class="th_user">Last Name</th>
                        <th class="th_user">DOB</th>
                        <th class="th_user">Email</th>
                        <th class="th_user">Username</th>
                        <th class="th_user">Password</th>
                        <th class="th_user">A/C Created</th> 
                    </tr>
                    <?php
                    $connection = mysqli_connect("localhost:3306", "root", "", "tmato");
                    $result = mysqli_query($connection, "SELECT * FROM user;");

                    while ($output = mysqli_fetch_row($result)) {
                        echo"
                                <tr>
                                    <td class='td_user'>$output[0]</td>
                                    <td class='td_user'>$output[1]</td>
                                    <td class='td_user'>$output[2]</td>
                                    <td class='td_user'>$output[3]</td>
                                    <td class='td_user'>$output[4]</td>
                                    <td class='td_user'>$output[5]</td>
                                    <td class='td_user'>$output[6]</td>
                                    <td class='td_user'>$output[7]</td>
                                </tr>
                            ";
                    }

                    mysqli_close($connection);
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
