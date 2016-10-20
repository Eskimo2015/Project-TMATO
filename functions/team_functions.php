<?php 
/**
 * Included by 'team.php'.
 * @return string
 */

function getTeamAction(){
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
		$action = basename($action);
	}
	else{
		$action = "";
	}
	return $action;
}

function getTeamName(){
	$errMessage = "Team Not Found!";
	include 'handlers/db_conn.php';
	$action = getTeamAction();
	
	if (!$connection) {
		echo "<p class='conn_err_msg'>Unable to connect to database!  No data to display.<p>";
	} else {
		$result = mysqli_query($connection, "SELECT Team_Name FROM team where Team_Name LIKE '{$action}';");
	}
	
	if($action == null){
		return $errMessage;
	}
	else{
		while ($data = mysqli_fetch_row($result)){
			return $data[0];
		}
	}
}

function getTeamMembers(){
	include "handlers/db_conn.php";
	$teamID = getTeamID(); 
	
	$members = mysqli_query($connection, "SELECT User_ID FROM t_member_of WHERE Team_ID ='{$teamID}';");
	 
	while ($output = mysqli_fetch_row($members)) {
		echo"
		<h1>$output[0]</h1>";
	}
}

function getTeamID(){
	include "handlers/db_conn.php";
	$action = getTeamAction();
	
	$members = mysqli_query($connection, "SELECT Team_ID FROM team WHERE Team_Name ='{$action}';");
	while($output = mysqli_fetch_row($members)){
		return $output[0];
	}
}
?>