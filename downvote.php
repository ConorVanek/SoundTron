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
		newDownvote($songid, $userid, $link);
	}
	else if($rowcount == 1) {
		downvote($songid, $userid, $link);
	}
	else if($rowcount > 1) {
		clearVotes($songid, $userid, $link);
		newDownvote($songid, $userid, $link);
	}
	
	
}

echo("user: " . $userid . "\ndownvote: " . $songid);

}
else {
	echo("Login/Signup to vote.");
}

?>
