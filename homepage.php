<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$_SESSION['loggedin'] = true;
} else {
	$_SESSION['loggedin'] = false;
}
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
            <form method="post" action="handlers/login_handler.php">
                <table class="table_header">
                    <tr>
                        <td><a href = "homepage.php"><img src="resources\images\tmato.png" class="logo"></a></td>
                        <td>
                        <?php
							if (!empty($_GET['welcome_msg'])) {
                                $message = $_GET['welcome_msg'];
                                echo "<p class='welcome_msg'>$message</p>";
                            }
                        ?> 
                        </td>
                        <td align="right">
                        <p align="right">
                        <?php
                        if ($_SESSION['loggedin'] == true) {
                        	echo "<a href='handlers/logout_handler.php' class='cleanLink'>logout</a>";
                        } else {
                            echo "<a href='login.php' class='cleanLink'>Login</a> / <a href='registration.php' class='cleanLink'>Register</a>";
                        }
                        ?> 
                        </p>
                     	</td> 
                    </tr>
                    <tr>
                        <td><div class="spacerSmall"></div></td>
                    </tr>
                    <tr>
                    	<td>
                     	</td>
                        <td>
                            <?php
							if ($_SESSION['loggedin'] == true) {
                                echo "<p align='center'>You are currently logged in as " . $_SESSION['user'] . " !</p>"
                                ;
                            } else {
                            if (!empty($_GET['logout_msg'])) {
                                $message = $_GET['logout_msg'];
                                echo "<p class='logout_msg'>$message</p>";
                            }
                            }
                            ?>
                        </td>
                        <td>
                     	</td> 
                    </tr>
                </table>
            </form>
            <div class="pageBreak"></div>
            <div>
                <table class="table_nav">
                    <tr class="banner">
                        <td><a href ="user_account.php">User</a></td>
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
        <div class="pageBreak"></div>
        <h1>
            About
        </h1>
        <div class="headingBreak"></div>
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
        <br/>
        <br/>
<!--         <div class="spacerMedium">&nbsp</div> -->
        <div class="pageBreak"></div>
        <h1>
            Features
        </h1>
            <div class="headingBreak"></div>

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
        </div>
    </body>
</html>
