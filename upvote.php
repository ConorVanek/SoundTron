<?php
session_start();

require_once("config.php");
require_once("functions.php");

if(isloggedin()) {

$userid = $_SESSION["id"];
$songid = $_POST["id"];

$sql = "SELECT id FROM votes WHERE song_id = " . $songid . " AND user_id = " . $userid;

if ($result=mysqli_query($link,$sql)) {
	$rowcount = mysqli_num_rows($result);
	if($rowcount == 0) {
		newUpvote($songid, $userid, $link);
	}
	else if($rowcount == 1) {
		upvote($songid, $userid, $link);
	}
	else if($rowcount > 1) {
		clearVotes($songid, $userid, $link);
		newUpvote($songid, $userid, $link);
	}
	
	
}

echo("user: " . $userid . "\nupvote: " . $songid);
}
else {
	echo("Login/Signup to vote.");
}

?>