<?php
//Created by: 	Noah Nathan
//Date:		00/08/2016
//Purpose:  	Register new user and store account details to DB

//Create database from MySQL first
//Step 1:  Read from inputs on Registration page
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$uname = $_POST['username'];
$pword = $_POST['password'];

//Step 2:  connect to MySQL and select database in one statement
$connection = mysqli_connect("localhost:3306", "root", "", "tmato");

//Step 3:  Run query - check DB for existing account
$result = mysqli_query ($connection , "SELECT u_name FROM user WHERE 
        u_name LIKE '{$uname}';");
        
if (mysqli_fetch_row($result)) {    //Step 4a:  If username already exists then abort registration and print message
    header("Location: ../registration.php?reg_msg=Your chosen USERNAME is already in use!"
        . "  Please enter another USERNAME to create a new account...");
} else { //Step 4b:  Run query - insert form data into user table and print confirmation message
    mysqli_query($connection, "INSERT INTO user values(NULL,'{$fname}','{$lname}','{$dob}','{$email}','{$uname}','{$pword}',CURTIME())");
    header("Location: ../registration.php?reg_msg=Your account has been created successfully!");
}

//Step 5:  Close connection
mysqli_close($connection);
?>