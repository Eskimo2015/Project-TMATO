<?php
//Created by: 	Noah Nathan
//Date:			15/08/2016
//Purpose:  	Validate Registration Form - fields

//Step 1:  Define variables and set to empty values
$fname = $lname = $dob = $email = $uname = $pword = "";
$fnameErr = $lnameErr = $dobErr = $emailErr = $unameErr = $pwordErr = ""; 

//Step 2:  If submission via POST method then validate...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstname"])) {
    	$fnameErr = "First Name is required!";
  	} else {
  		$fname = test_input($_POST['firstname']);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^[a-zA-Z '-]*$/",$fname)) {
  			$fnameErr = "Only letters, hyphens(-), apostrophes (') and white space are permitted!";
  		} else if(!preg_match("/^[a-zA-Z '-]{0,32}$/",$fname)) {
  			$fnameErr = "First Name must NOT exceed 32 characters!";
  		}	
  	}
	if (empty($_POST["lastname"])) {
    	$lnameErr = "Last Name is required!";
  	} else {
  		$lname = test_input($_POST['lastname']);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^[a-zA-Z '-]*$/",$lname)) {
  			$lnameErr = "Only letters, hyphens(-), apostrophes (') and white space are permitted!";
  		} else if(!preg_match("/^[a-zA-Z '-]{0,32}$/",$lname)) {
  			$lnameErr = "Last Name must NOT exceed 32 characters!";
  		}	
  	}
	if (empty($_POST["dob"])) {
    	$dobErr = "DOB is required!";
  	} else {
  		$dob = test_input($_POST["dob"]);
  		// check if DOB is in correct format yyyy-mm-dd
  		if (!preg_match("/^(19|20)[0-9]{2}-((0(1|3|5|7|8)|1(0|2))-(0[1-9]|[1-2][0-9]|3[0-1])|(0(4|6|9)|11)-(0[1-9]|[1-2][0-9]|30)|02-(0[1-9]|1[0-9]|2[0-9]))$/",$dob)) {
  			$dobErr = "Date must be in correct format YYYY-MM-DD!  Must be between 1900-01-01 and 2099-12-31.  NOTE: *29 days in February!*";
  		}	
  	}
	if (empty($_POST["email"])) {
    	$emailErr = "Email is required!";
  	} else {
  		$email = test_input($_POST["email"]);
  		//Remove all illegal characters except a-zA-Z0-9!#$%&'*+-/=?^_`{|}~@.[]
  		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
  		// check if e-mail address is well-formed
  		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$emailErr = "Invalid email format!  Must be well formed e.g. contain only ONE '@' and end in '.com' etc.";
  		}
  	}
	if (empty($_POST["username"])) {
    	$unameErr = "Username is required!";
  	} else {
  		$uname = test_input($_POST["username"]);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^\w{3,16}$/",$uname)) {
  			$unameErr = "Must contain 3 to 16 characters - Must NOT contain white space or special characters except underscores (_).";
  		} else {
  			$unameErr = userNameCheck($uname);
  		}
  	}
	if (empty($_POST["password"])) {
    	$pwordErr = "Password is required!";
  	} else {
  		$pword = test_input($_POST["password"]);
  		// check if name only contains letters and whitespace
  		if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d_]{8,16}$/",$pword)) {
  			$pwordErr = "Must contain 8 to 16 characters - at least ONE Uppercase letter, ONE Lowercase letter and ONE Digit!  Must NOT contain white space or special characters except underscores (_).";
  		}	
  	}
  	if($fnameErr == "" && $lnameErr == "" && $dobErr == "" && $emailErr == "" && $unameErr == "" && $pwordErr == "") {
  		insertUserData($fname, $lname, $dob, $email, $uname, $pword);
  	}
}

//Trims and cleans input data/strings etc.
function test_input($data) {
	$data = trim($data);
	//$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Purpose:  Checks for availability of Username
function userNameCheck($uname) {
	$data = "";
	//Step 1:  connect to MySQL and select database in one statement
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
	//Step 2:  Run query - check DB for existing account
	$result = mysqli_query ($connection , "SELECT User_UName FROM user WHERE
			User_UName LIKE '{$uname}';");
	//Step 3:  If username already exists then create error message
	if (mysqli_fetch_row($result)) {
	  			$data = "The selected USERNAME is unavailable!  Please choose another USERNAME to create an account."; 
  	}
	//Step 4:  return error message
	return $data;
	//Step 5:  Close connection
	mysqli_close($connection);
}

function insertUserData($fname, $lname, $dob, $email, $uname, $pword) {
	//Step 1:  connect to MySQL and select database in one statement
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
	
	//Step 2:  Insert user data to User table and print confirmation message
	mysqli_query($connection, "INSERT INTO user values(NULL,'{$fname}','{$lname}','{$dob}','{$email}',
	'{$uname}','{$pword}','',CURDATE(),NULL,'0','0')");
	header("Location: registration.php?reg_success_msg=Your account has been created successfully!");
	
	//Step 3:  Close connection
	mysqli_close($connection);
}
?>