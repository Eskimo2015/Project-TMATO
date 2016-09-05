<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <meta charset="UTF-8">
        <meta name="description" content="Team manager and tournament organiser">
        <meta name="keywords" content="Tournament,Organiser,Tmato,Manager">
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
            <form method="post" action="php/login_user.php">
                <table width="80%">
                    <tr>
                        <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                        <td></td><td></td><td></td>
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
                    </tr>
                    <tr>
                        <td><div class="spacerSmall"></div></td>
                    </tr>
                    <tr>
                        <td class="login_fail_msg" colspan="3">
                            <?php
                            if (!empty($_GET['login_msg'])) {
                                $message = $_GET['login_msg'];
                                echo "<p>$message</p>";
                            }
                            if (!empty($_GET['logout_msg'])) {
                                $message = $_GET['logout_msg'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
                            echo "<td>
                            <label class='indent_01'>UserName:  </label>
                            <input class='indent_01' type='text' name='username'>
                            </td>
                            <td>
                            <label class='indent_01'>Password:  </label>
                            <input class='indent_01' type='password' name='password'>
                            </td>
                            <td>
                            <input class='indent_01' type='submit' value='Login'>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href='registration.php' class='cleanLink'>Register</a></td>";
                        }
                        ?>  
                    </tr>
                </table>
            </form>
            <div class="pageBreak"></div>
            <div>
                <table width="80%">
                    <tr class="banner">
                        <td><a href ="user_account.php">User</a></td>
                        <td><a href ="team.php">Team</a></td>
                        <td><a href ="tournament.php">Tournament</a></td>
                        <td><a href ="organisation.php">Organisation</td>
                        <!---td class="hideElement"></td>-->
                    </tr>
                </table>	
            </div>
        </div>

        <!--ContentBody-->
        <div class="spacerLarge"></div>
        <div class="pageBreak"></div>
        <h1>
            About
            <div class="headingBreak"></div>
        </h1>

        <p>
            Lorem ipsum dolor sit amet, cum ei quas dicit definitionem, agam inani facilisi no eam, nihil dicunt fuisset est in. Mel solet expetenda et, nonumes maluisset reformidans ut duo. Te amet error graecis sea, semper tacimates in ius. His semper facilisis evertitur no, vis fuisset assueverit efficiantur cu.
            Pri legendos adolescens dissentiet ex. Ne eos veniam feugiat deterruisset, eam in fierent evertitur. No est blandit iudicabit, ne vis solet delenit. Eam cu molestiae quaerendum, postea qualisque posidonium duo ei. Ut vel quodsi docendi corrumpit, percipit salutandi ad cum, causae voluptaria eam eu. Te cum facilisi partiendo consetetur.
            Paulo affert indoctum vis no, vel ut paulo docendi. Vel ea docendi recteque, qui singulis recteque abhorreant te, bonorum docendi pri eu. In pro nonumy epicuri molestie. Persequeris vituperatoribus usu ex, no cum vivendo epicurei, vim in nobis vivendum. In cum appetere erroribus ocurreret, errem feugait his an. In vidit movet platonem nam, eos tollit iracundia id. Vide qualisque concludaturque usu id, te usu rebum scripserit signiferumque, vim et legimus debitis efficiantur.
            Mei quas laoreet an, in probo iudico ubique eum. Ad nisl regione molestie est, noster copiosae temporibus ex vel. Ea recteque maluisset cotidieque usu, iusto adolescens id mei. Ei mei tota reprimique.
            Sed dicit deserunt corrumpit et, sit eu saperet similique pertinacia. Te qui molestie constituam, consul laoreet iracundia ius cu, dicant causae interesset te mea. Sea dolores vituperatoribus ea. Ea brute voluptua pri.
        </p>
        <p>
            Lorem ipsum dolor sit amet, cum ei quas dicit definitionem, agam inani facilisi no eam, nihil dicunt fuisset est in. Mel solet expetenda et, nonumes maluisset reformidans ut duo. Te amet error graecis sea, semper tacimates in ius. His semper facilisis evertitur no, vis fuisset assueverit efficiantur cu.
            Pri legendos adolescens dissentiet ex. Ne eos veniam feugiat deterruisset, eam in fierent evertitur. No est blandit iudicabit, ne vis solet delenit. Eam cu molestiae quaerendum, postea qualisque posidonium duo ei. Ut vel quodsi docendi corrumpit, percipit salutandi ad cum, causae voluptaria eam eu. Te cum facilisi partiendo consetetur.
            Paulo affert indoctum vis no, vel ut paulo docendi. Vel ea docendi recteque, qui singulis recteque abhorreant te, bonorum docendi pri eu. In pro nonumy epicuri molestie. Persequeris vituperatoribus usu ex, no cum vivendo epicurei, vim in nobis vivendum. In cum appetere erroribus ocurreret, errem feugait his an. In vidit movet platonem nam, eos tollit iracundia id. Vide qualisque concludaturque usu id, te usu rebum scripserit signiferumque, vim et legimus debitis efficiantur.
            Mei quas laoreet an, in probo iudico ubique eum. Ad nisl regione molestie est, noster copiosae temporibus ex vel. Ea recteque maluisset cotidieque usu, iusto adolescens id mei. Ei mei tota reprimique.
            Sed dicit deserunt corrumpit et, sit eu saperet similique pertinacia. Te qui molestie constituam, consul laoreet iracundia ius cu, dicant causae interesset te mea. Sea dolores vituperatoribus ea. Ea brute voluptua pri.
        </p>
        <div class"spacerMedium">&nbsp</div>
        <div class="pageBreak"></div>
        <h1>
            Features
            <div class="headingBreak"></div>
        </h1>

        <p>
            Lorem ipsum dolor sit amet, cum ei quas dicit definitionem, agam inani facilisi no eam, nihil dicunt fuisset est in. Mel solet expetenda et, nonumes maluisset reformidans ut duo. Te amet error graecis sea, semper tacimates in ius. His semper facilisis evertitur no, vis fuisset assueverit efficiantur cu.
            Pri legendos adolescens dissentiet ex. Ne eos veniam feugiat deterruisset, eam in fierent evertitur. No est blandit iudicabit, ne vis solet delenit. Eam cu molestiae quaerendum, postea qualisque posidonium duo ei. Ut vel quodsi docendi corrumpit, percipit salutandi ad cum, causae voluptaria eam eu. Te cum facilisi partiendo consetetur.
            Paulo affert indoctum vis no, vel ut paulo docendi. Vel ea docendi recteque, qui singulis recteque abhorreant te, bonorum docendi pri eu. In pro nonumy epicuri molestie. Persequeris vituperatoribus usu ex, no cum vivendo epicurei, vim in nobis vivendum. In cum appetere erroribus ocurreret, errem feugait his an. In vidit movet platonem nam, eos tollit iracundia id. Vide qualisque concludaturque usu id, te usu rebum scripserit signiferumque, vim et legimus debitis efficiantur.
            Mei quas laoreet an, in probo iudico ubique eum. Ad nisl regione molestie est, noster copiosae temporibus ex vel. Ea recteque maluisset cotidieque usu, iusto adolescens id mei. Ei mei tota reprimique.
            Sed dicit deserunt corrumpit et, sit eu saperet similique pertinacia. Te qui molestie constituam, consul laoreet iracundia ius cu, dicant causae interesset te mea. Sea dolores vituperatoribus ea. Ea brute voluptua pri.
        </p>
        <p>
            Lorem ipsum dolor sit amet, cum ei quas dicit definitionem, agam inani facilisi no eam, nihil dicunt fuisset est in. Mel solet expetenda et, nonumes maluisset reformidans ut duo. Te amet error graecis sea, semper tacimates in ius. His semper facilisis evertitur no, vis fuisset assueverit efficiantur cu.
            Pri legendos adolescens dissentiet ex. Ne eos veniam feugiat deterruisset, eam in fierent evertitur. No est blandit iudicabit, ne vis solet delenit. Eam cu molestiae quaerendum, postea qualisque posidonium duo ei. Ut vel quodsi docendi corrumpit, percipit salutandi ad cum, causae voluptaria eam eu. Te cum facilisi partiendo consetetur.
            Paulo affert indoctum vis no, vel ut paulo docendi. Vel ea docendi recteque, qui singulis recteque abhorreant te, bonorum docendi pri eu. In pro nonumy epicuri molestie. Persequeris vituperatoribus usu ex, no cum vivendo epicurei, vim in nobis vivendum. In cum appetere erroribus ocurreret, errem feugait his an. In vidit movet platonem nam, eos tollit iracundia id. Vide qualisque concludaturque usu id, te usu rebum scripserit signiferumque, vim et legimus debitis efficiantur.
            Mei quas laoreet an, in probo iudico ubique eum. Ad nisl regione molestie est, noster copiosae temporibus ex vel. Ea recteque maluisset cotidieque usu, iusto adolescens id mei. Ei mei tota reprimique.
            Sed dicit deserunt corrumpit et, sit eu saperet similique pertinacia. Te qui molestie constituam, consul laoreet iracundia ius cu, dicant causae interesset te mea. Sea dolores vituperatoribus ea. Ea brute voluptua pri.
        </p>
    </body>
</html>
