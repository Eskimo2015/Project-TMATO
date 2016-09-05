<?php

//Created by: 	Noah Nathan
//Date:		01/09/2016
//Purpose:  	User Login - check user exists then load account to SESSION.

$urname = $_POST["username"];
$pword = $_POST["password"];

//Step #01:  Establish DB Connection
$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
//Step #02:  Find match for Username and Password
$result = mysqli_query($connection, "SELECT * FROM user WHERE 
		u_name LIKE '$urname' AND u_pword LIKE '$pword';");

//Step #03:  If user exists then start session else print error message
if (mysqli_fetch_row($result)) {
    session_start();

    $_SESSION["loggedin"] = true;
    $_SESSION["user"] = $urname;

    header("Location: ../user_account.php?login_msg=Welcome '" . $urname . "'");
} else {
    header("Location: ../homepage.php?login_msg=Your login details were NOT recognised!"
            . "  Please re-enter your login details...");
}

//Step #04:  Close connection!
mysqli_close($connection);
?>