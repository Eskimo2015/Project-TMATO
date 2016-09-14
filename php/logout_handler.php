<?php
	session_start();
	session_destroy();
	unset($_SESSION );
	header("location: ../homepage.php?logout_msg=You were successfully Logged out!");
?>