<?php
require_once("config.php");
require_once("functions.php");

$songid = $_POST["song"];

addPlay($songid, $link);


?>