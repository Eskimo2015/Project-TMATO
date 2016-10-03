<?php
//Created by: 	Noah Nathan
//Date:			26/09/2016
//Purpose:  	Logout current User - destroy current 'session'.

	session_start();
	session_destroy();
	unset($_SESSION );
	header("location: ../logout.php");
?>