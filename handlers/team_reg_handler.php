<?php
//Created by: 	Noah Nathan
//Date:			05/10/2016
//Purpose:  	Validate Team Registration Form - fields.  Register New Team.

include 'handlers/db_conn.php';

//Step 1:  Define variables and set to empty values
$teamName = $teamSport = "";
$teamNameErr = $teamSportErr = ""; 

$regSuccess = "";
$conn_err_msg = "";

$nameMatchExp = "/^[a-zA-Z '-]*$/";
$nameRangeExp = "/^[a-zA-Z '-]{0,32}$/";

//DB Connection Check!  If conection problems exist, print error on page.
if (mysqli_connect_errno()) {
	$conn_err_msg = "Unable to connect to database!  " . mysqli_connect_error();
    //$conn_err_msg = die('Connect Error: ' . mysqli_connect_error());
} else {
	//Step 2:  If submission via POST method then validate...
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["team_name"])) {
	    	$teamNameErr = "Team Name is required!";
	  	} else {
	  		$teamName = clean_input($_POST['team_name']);
	  		// check if Team Name only contains letters and whitespace
	  		if (!preg_match($nameMatchExp,$teamName)) {
	  			$teamNameErr = "Only letters, hyphens(-), apostrophes (') and white space are permitted!";
	  			// check if Team Name exceeds 32 characters
	  		} else if(!preg_match($nameRangeExp,$teamName)) {
	  			$teamNameErr = "Team Name must NOT exceed 32 characters!";
	  		} else {
	  			$teamNameErr = teamNameCheck($teamName);
	  		}	
	  	}
		if (empty($_POST["team_sport"])) {
	    	$teamSportErr = "Team Sport is required!";
	  	} else {
	  		$teamSport = clean_input($_POST['team_sport']);
	  		// check if Team Sport only contains letters and whitespace
	  		if (!preg_match($nameMatchExp,$teamSport)) {
	  			$teamSportErr = "Only letters, hyphens(-), apostrophes (') and white space are permitted!";
	  			// check if Team Sport exceeds 32 characters
	  		} else if(!preg_match($nameRangeExp,$teamSport)) {
	  			$teamSportErr = "Team Sport must NOT exceed 32 characters!";
	  		}	
	  	}
	  	if($teamNameErr == "" && $teamSportErr == "") {
	  		$regSuccess = insertUserData($teamName, $teamSport);
	  	}
	}
}

//Trims and cleans input data/strings etc.
function clean_input($data) {
	$data = trim($data);
	//$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Purpose:  Checks for availability of Team Name
function teamNameCheck($teamName) {
	$data = "";
	//Step 1:  connect to MySQL and select database
	include 'handlers/db_conn.php';
	//Step 2:  Run query - check DB for existing Team
	$result = mysqli_query ($connection , "SELECT Team_Name FROM team WHERE
			Team_Name LIKE '{$teamName}';");
	//Step 3:  If Team Name already exists then create error message
	if (mysqli_fetch_row($result)) {
	  			$data = "The selected Team Name is unavailable!  Please choose another TEAM NAME."; 
  	} else {
  		$data = mysqli_error($connection);
  	}
	//Step 4:  return error message
	return $data;
	//Step 5:  Close connection
	mysqli_close($connection);
}

function insertUserData($teamName, $teamSport) {
	$data = "";
	//Step 1:  connect to MySQL and select database
	include 'handlers/db_conn.php';
	
	//Step 2:  Insert user data to User table and print confirmation message
	if (mysqli_query($connection, "INSERT INTO team (Team_Name, Team_Sport) values('{$teamName}','{$teamSport}')")) {
		resetFields();
		$data = "Your Team has been created successfully!";
	} else {
		$data = "There was an issue creating your Team!  " . mysqli_error($connection);
	}
	return $data;
	
	//Step 3:  Close connection
	mysqli_close($connection);
}
function resetFields(){
	$_POST["team_name"] = $_POST["team_sport"] = "";
}
?>