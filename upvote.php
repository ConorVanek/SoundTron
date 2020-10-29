<?php
session_start();

require_once("config.php");
require_once("functions.php");


$userid = $_SESSION["id"];
$songid = $_POST["id"];

echo("user: " . $userid . "\nupvote: " . $songid);


?>