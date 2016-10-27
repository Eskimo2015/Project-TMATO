<!DOCTYPE html>
<?php include 'session.php'; ?>
<html>
    <head>
        <title>Team</title>
        <link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <!--Banner-->
        <?php include 'banner.php'; ?>
        <!--ContentBody-->
        <div class="contentContainer">
        <div class="pageBreak"></div>
        <h1>
            <?php echo getName() ?>
        </h1>
        <div class="headingBreak"></div>
        
        <?php
				/*DB connect + output of needed fields
				* currently teams/orgs and bio are hard coded*/
                include 'handlers/db_conn.php';
                if (!$connection) {
                	echo "<p class='conn_err_msg'>Unable to connect to database!  No data to display.<p>";
                    } else {
                    $search = getAction();
	                $result = mysqli_query($connection, "SELECT * FROM team where Team_Name LIKE '{$search}';");
                    }
	                        
	                while ($output = mysqli_fetch_row($result)) {
	                	echo "
                		<h1>Bio</h1><div class='headingBreak'></div>
                			$output[4]
                		<h1>Members</h1><div class='headingBreak'></div>
                			<p>";
	                	 getmembers();
                    		echo"</p>";
                    }
        ?>
        </div>
    </body>
</html>

<?php 
function getAction(){
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
		$action = basename($action);
	}
	else{
		$action = "";
	}
	return $action;
}

function getName(){
	$errMessage = "No team found";
	include 'handlers/db_conn.php';
	$action = getAction();
	
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

function getMembers(){
	include "handlers/db_conn.php";
	$teamID = getTeamID(); 
	

	$members = mysqli_query($connection, "SELECT User_ID FROM t_member_of WHERE Team_ID ='{$teamID}';");
	 
	while ($output = mysqli_fetch_row($members)) {
		$uName = getUserByID($output[0]);
		if (getTeamRole($output[0])==1){
			echo"<h3> * " . " $uName</h3>";
			echo getTeamRole($uName);
		}
		else{
			echo"<h3>  " . " $uName</h3>";
			echo getTeamRole("Hai12345");
		}
	}
}

function getTeamID(){
	include "handlers/db_conn.php";
	$action = getAction();
	
	$members = mysqli_query($connection, "SELECT Team_ID FROM team WHERE Team_Name ='{$action}';");
	while($output = mysqli_fetch_row($members)){
		return $output[0];
	}
}

function getUserByID($userID){
	include "handlers/db_conn.php";
	$members = mysqli_query($connection, "SELECT User_UName FROM user WHERE User_ID ='{$userID}';");
	
	while($output = mysqli_fetch_row($members)){
		return $output[0];
	}
}

function getTeamRole($userID){
	include "handlers/db_conn.php";
	$members = mysqli_query($connection, "SELECT Role_ID FROM t_member_of WHERE User_ID ='{$userID}';");
	
	while($output = mysqli_fetch_row($members)){
		return $output[0];
	}
}
?>