<?php
/**
 * Included by 'team_navigation.php'.
 * @param unknown $team_name
 * @return string
 */
function createTeamURL($team_name) {
	$team_name = replaceWhiteSpace ( $team_name );
	// $link = ("http://localhost/project_tmato/team.php" . "?action=" . $team_name);
	$link = "team.php?action=" . $team_name;
	return $link;
}
function createTournamentURL($Tournament_ID) {
	$link = "tournament.php?id=" . $Tournament_ID;
	return $link;
}
function replaceWhiteSpace($string) {
	return $string = preg_replace ( '/\s+/', '_', $string );
}
?>