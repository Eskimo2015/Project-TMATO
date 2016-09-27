<?php
//Created by: 	Noah Nathan
//Date:			27/09/2016
//Purpose:  	Establishes DB connection'.  Edits to the DB 'Name', 'User'and 'Password' can be shared from here.

	//creates connection variable.  Include this file reference and use this variable in all scripts when making DB connection!
	$connection = mysqli_connect("localhost:3306", "root", "", "tmato");
?>