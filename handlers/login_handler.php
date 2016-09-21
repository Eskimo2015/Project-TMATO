<?php

//Created by: 	Noah Nathan
//Date:		01/09/2016
//Purpose:  	User Login - check user exists then load account to SESSION.

$urname = $_POST["username"];
$pword = $_POST["password"];

//Step #01:  Establish DB Connection
$connection = mysqli_connect("localhost:3306", "root", "", "tmato");

//Check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (!mysqli_query($connection, "SET a=1")) {
	printf("Errormessage: %s\n", mysqli_error($connection));
} else {
	
}

//Step #02:  Find match for Username and Password
$result = mysqli_query($connection, "SELECT * FROM user WHERE 
		User_UName LIKE '$urname' AND User_Password LIKE '$pword';");

//Step #03:  If user exists then start session else print error message
if (mysqli_fetch_row($result)) {
    session_start();

    $_SESSION["loggedin"] = true;
    $_SESSION["user"] = $urname;

    header("Location: ../user_account.php?welcome_msg=Welcome '" . $urname . "'");
} else {
    header("Location: ../homepage.php?login_fail_msg=Your login details were NOT recognised!"
            . "  Please re-enter your login details...");
}

//Step #04:  Close connection!
mysqli_close($connection);
?>