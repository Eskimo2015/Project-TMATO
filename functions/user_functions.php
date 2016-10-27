<?php 
/**
 * Included by 'user.php'.
 * @return string|unknown
 */
function getAction(){
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
		$action = basename($action);
	}
	else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				$action = $_SESSION["user"];
	}
	else{
		$action = "";
	}
	return $action;
}

function getName(){
	$errMessage = "User Not Found!";
	include 'handlers/db_conn.php';
	$action = getAction();
	
	$result = mysqli_query($connection, "SELECT User_UName FROM user WHERE User_UName LIKE '{$action}';");
	
	if($output = mysqli_fetch_row($result)){
		return $output[0];
	} else {
		return $errMessage;
	}
}
?>