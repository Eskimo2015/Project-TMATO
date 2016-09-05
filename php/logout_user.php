<?php
	session_start();
	session_destroy();
	header("location: ../homepage.php?logout_msg=You were successfully Logged out!");
?>