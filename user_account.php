<!DOCTYPE html>
<!--
Created by Noah Nathan 19 Aug 2016
Web site theme design by Dion Rabone

Dislays user account details.
-->
<?php
session_start();
?>
<html>
    <head>
        <title>My Account</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <table  width = 100%>
            <tr>
                <td><a href = "homepage.php"><img src="resources/images/tmato.png" width="150" height="80"></a></td>
                <!--<td class="homeLogin">Login area</td>-->
                <td></td>
                <td></td>
                <td class="login_msg">
                    <?php
                    if (!empty($_GET['login_msg'])) {
                        $message = $_GET['login_msg'];
                        echo "<p>$message</p>";
                    }
                    ?>
                </td>
                <td></td>
                <td>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo "You are currently logged in as " . $_SESSION['user'] . " !"
                        . "<td><a href='php/logout_user.php' class='cleanLink'>logout</a></td>";
                    } else {
                        $_SESSION['loggedin'] = false;
                    }
                    ?>    
                </td>
                <td></td>
            </tr>
        </table>
        <div class="pageBreak"></div>
        <table  width = 100%>
            <tr class="banner">
                <td><a href ="user_account.php" class="cleanLink">User</a></td>
                <td><a href ="team.php" class="cleanLink">Team</a></td>
                <td><a href ="tournament.php" class="cleanLink">Tournament</a></td>
                <td><a href ="organisation.php" class="cleanLink">Organisation</td>
                <td></td>
            </tr>
        </table> 
        <h1>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo $_SESSION['user'];
            } else {
                $_SESSION['loggedin'] = false;
                echo "UserName";
            }
            ?>  
        </h1>
        <div>
            <br><br>
            <div class="div_user">
                <table class="tbl_user">
                    <tr>
                        <th class="tbl_header" colspan="2">User Details:</th> 
                    </tr>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        $connection = mysqli_connect("localhost:3306", "root", "", "tmato_db");
                        $result = mysqli_query($connection, "SELECT * FROM user where User_UserName LIKE '{$_SESSION["user"]}';");

                        while ($output = mysqli_fetch_row($result)) {
                            echo"
                                <tr>
                                    <td class='th_user'>User ID</td><td class='td_user'>$output[0]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>First Name</td><td class='td_user'>$output[1]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Last Name</td><td class='td_user'>$output[2]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>DOB</td><td class='td_user'>$output[3]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Email</td><td class='td_user'>$output[4]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Username</td><td class='td_user'>$output[5]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>Password</td><td class='td_user'>$output[6]</td>
                                </tr>
                                <tr>
                                    <td class='th_user'>A/C Created</td><td class='td_user'>$output[7]</td>
                                </tr>
                            ";
                        }

                        mysqli_close($connection);
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
