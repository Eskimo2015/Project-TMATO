<!DOCTYPE html>
<?php 
include 'session.php';
include 'handlers/registration_handler.php';
?>
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
        <script>
			function resetForm() {
			    document.getElementById("regForm").reset();
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
            Registration
        </h1>
        <div class="headingBreak"></div>
        <div class="setBodyMargin">
            <form id="regForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <table class="tb1">
                    <tr><td class="td1">First Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder="John" name="firstname" value="<?PHP if(isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname']); ?>"></td>
                    	<td><span class="error">* <?php echo $fnameErr;?></span></td></tr>
                    <tr><td class="td1">Last Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder="Doe" name="lastname" value="<?PHP if(isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname']); ?>"></td>
                    	<td><span class="error">* <?php echo $lnameErr;?></span></td></tr>
                    <tr><td class="td1">Date Of Birth:</td><td></td><td><input class="input_reg_form" type="text" placeholder="yyyy-mm-dd" name="dob" value="<?PHP if(isset($_POST['dob'])) echo htmlspecialchars($_POST['dob']); ?>"></td>
                    	<td><span class="error">* <?php echo $dobErr;?></span></td></tr>
                    <tr><td class="td1">Email Address:</td><td></td><td><input class="input_reg_form" type="text" placeholder="john_doe@lost.com" name="email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>"></td>
                    	<td><span class="error">* <?php echo $emailErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1">Username:</td><td></td><td><input class="input_reg_form" type="text" placeholder="User" name="username" value="<?PHP if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>"></td>
                    	<td><span class="error">* <?php echo $unameErr;?></span></td></tr>
                    <tr><td class="td1">Password:</td><td></td><td><input class="input_reg_form" type="password" placeholder="GuessWhat123" name="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>"></td>
                    	<td><span class="error">* <?php echo $pwordErr;?></span></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr><td class="td1" colspan="3"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Register"></td></tr>
                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset" onclick="resetForm()"></td></tr>
                    <tr>
                        <td class="reg_success_msg" colspan="3">
                            <?php echo $regSuccess; ?>
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
                        <th class="th_user">Account Created</th> 
                    </tr>
                    <?php
                    include 'handlers/db_conn.php';
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
                                    <td class='td_user'>$output[8]</td>
                                </tr>
                            ";
                    }

                    mysqli_close($connection);
                    ?>
                </table>
            </div>
        </div>
        </div>
    </body>
</html>
