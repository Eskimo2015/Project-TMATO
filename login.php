<!DOCTYPE html>
<?php 
include 'session.php';
include 'handlers/login_handler.php';
?>
<html>
    <head>
        <title>Login</title>
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
        <script>
			function resetForm() {
			    document.getElementById("loginForm").reset();
			}
		</script>
    </head>
    <body>
        <!--Banner-->
        <?php include 'banner.php'; ?>
        <!--ContentBody-->
        <div class="contentContainer">
        <div class="pageBreak"></div>
        <h1>
            Login
        </h1>
        <div class="headingBreak"></div>
        <div class="setBodyMargin">
            <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <table class="tb1">
                    <tr><td class="td1">Username:</td><td></td><td><input class="input_reg_form" type="text" placeholder="User" name="username" value="<?PHP if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>"></td>
                    	<td><span class="error">* <?php echo $unameErr;?></span></td></tr>
                    <tr><td class="td1">Password:</td><td></td><td><input class="input_reg_form" type="password" placeholder="GuessWhat123" name="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>"></td>
                    	<td><span class="error">* <?php echo $pwordErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Login"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset" onclick="resetForm()"></td></tr>
                    <tr>
                        <td class="login_fail_msg" colspan="3">
                            <?php 
                            	echo $loginFail;
								echo $conn_err_msg;
							?>
                        </td>
                    </tr>
                </table>
            </form>
        </div> 
        </div>
    </body>
</html>
