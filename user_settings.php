<!DOCTYPE html>
<html>
<?php 
include 'session.php'; 
include 'handlers/settings_handler.php';
?>
	<head>
<title>
        <?php
		if (isset ( $_SESSION ['loggedin'] ) && $_SESSION ['loggedin'] == true) {
			echo 'My Account settings';
		}
		?>
		</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
	<?php include "banner.php";
		echo "<h1>" . getName()  . "'s settings" . "</h1>";
	?>

	<!--ContentBody-->
		<div class="contentContainer">
	        <div class="pageBreak"></div>
	        <?php
		        include 'handlers/db_conn.php';
		        
		        if (!$connection) {
		        	echo "<p class='conn_err_msg'>Unable to connect to database!  No data to display.<p>";
		        	//$conn_err_msg = die('Connect Error: ' . mysqli_connect_error());
		        } else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		        	$result = mysqli_query($connection, "SELECT * FROM user where User_UName LIKE '{$_SESSION['user']}';");
		        }
		        else{
		        	echo "No active user";
		        }
	        ?>
	        <div class="setBodyMargin">
	            <form id="regForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	                <table class="tb1">
	                    <tr><td class="td1">First Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder=<?php echo getCurrData("1", $connection); ?> name="firstname" value="<?PHP if(isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname']); ?>"></td>
	                    	<td><span class="error">* <?php echo $fnameErr;?></span></td></tr>
	                    <tr><td class="td1">Last Name:</td><td></td><td><input class="input_reg_form" type="text" placeholder=<?php echo getCurrData("2", $connection); ?> name="lastname" value="<?PHP if(isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname']); ?>"></td>
	                    	<td><span class="error">* <?php echo $lnameErr;?></span></td></tr>
	                    <tr><td class="td1">Date Of Birth:</td><td></td><td><input class="input_reg_form" type="text" placeholder=<?php echo getCurrData("7", $connection); ?> name="dob" value="<?PHP if(isset($_POST['dob'])) echo htmlspecialchars($_POST['dob']); ?>"></td>
	                    	<td><span class="error">* <?php echo $dobErr;?></span></td></tr>
	                    <tr><td class="td1">Email Address:</td><td></td><td><input class="input_reg_form" type="text" placeholder=<?php echo getCurrData("6", $connection); ?> name="email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>"></td>
	                    	<td><span class="error">* <?php echo $emailErr;?></span></td></tr>
	                    <tr><td class="td1">Bio:</td><td></td><td><input class="input_reg_form" type="text" placeholder=<?php echo getCurrData("9", $connection); ?> name="bio" value="<?PHP if(isset($_POST['bio'])) echo htmlspecialchars($_POST['bio']); ?>"></td>
	                    	<td><span class="error">* <?php echo $bioErr;?></span></td></tr>
	                    <tr><td class="td1" colspan="3"></td></tr>
	                    <tr><td class="td1" colspan="3"></td></tr>
	                    <tr><td class="td1">Password:</td><td></td><td><input class="input_reg_form" type="password" placeholder="GuessWhat123" name="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>"></td>
	                    	<td><span class="error">* <?php echo $pwordErr;?></span></td></tr>
	                    <tr><td class="td1" colspan="3"></td></tr>
	                    <tr><td class="td1" colspan="3"></td></tr>
	                    <?php 
	                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	                    echo'
	                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="submit" name="submit" value="Submit"></td></tr>
	                    <tr class="tr1" style="text-align:center"><td class="td1" colspan="3"><input class="btn" type="reset" name="reset" value="Reset" onclick="resetForm()"></td></tr>
	                    ';
	                    }
	                    else{
	                    	echo "No valid logon";
	                    }?>
	                    <tr>
	                        <td class="reg_success_msg" colspan="3">
	                            <?php 
	                            	echo $regSuccess;
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

<?php 
function getCurrData($field, $connection)
{	
	$fieldData = NULL;
	if (!$connection) {
		return "Err";
	} else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$result = mysqli_query($connection, "SELECT * FROM user where User_UName LIKE '{$_SESSION['user']}';");
		 
		while ($output = mysqli_fetch_row($result)) {
			$fieldData = $output[$field];
		}
	}
	if ($fieldData) {
		return $fieldData;
	}
	else {
		if ($field == '1'){
			return "FirstName";
		}
		else if($field == '2'){
			return "LastName";
		}
		else if($field == '7'){
			Return "DOB";
		}
		else if($field == '6'){
			return "email";
		}
		else if($field == '9'){
			return "Bio";
		}
		else return "Err";
	}
}

function getName(){
	include 'handlers/db_conn.php';

	if (!$connection) {
		echo "<p class='conn_err_msg'>Unable to connect to database!  No data to display.<p>";
	} 
	else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$result = mysqli_query($connection, "SELECT User_UName FROM user where User_UName LIKE '{$_SESSION['user']}';");
		while ($data = mysqli_fetch_row($result)){
			return $data[0];
		}
	}
	else echo "Err no logon";
}
?>
