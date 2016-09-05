<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
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
                <td></td>
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
            TeamName
        </h1>
    </body>
</html>