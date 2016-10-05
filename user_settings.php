<!DOCTYPE html>
<html>
<?php include 'session.php'; ?>
<head>
<title>
        <?php
		if (isset ( $_SESSION ['loggedin'] ) && $_SESSION ['loggedin'] == true) {
			echo 'My Account settings';
		}
		?>
		</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/tmato_theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<?php
	include "banner.php";
	if (! empty ( $_GET ['action'] )) {
		$action = $_GET ['action'];
		$action = basename ( $action );
	}
	?>
<!--ContentBody-->
	<div class="contentContainer">
		<form id="regForm" method="POST"
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="pageBreak"></div>
			<h1>
			<?php
				echo $action . " Settings";
			?>
			</h1>
			<div class="headingBreak"></div>
			<h1>Bio</h1>
			<div class="headingBreak"></div>
			<h1>Email</h1>
			<div class="headingBreak"></div>
			<h1>Teams</h1>
			<div class="headingBreak"></div>
			<p>
				Team1: <br> Team2:
			</p>
		</form>

	</div>
</body>
</html>