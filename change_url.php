<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$user = $_SESSION["username"];

// Include config file
require_once('config.php');
require_once('functions.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $new_url = $_POST["new_url"];
    update_url($user, $new_url, $link);
    session_destroy();
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change URL</title>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Change URL</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                soundtron/<input type="text" id = "new_url" name="new_url">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="index.php">Cancel</a>
        </form>
        <h3>note: you will be logged out of your session when you change your URL.</h3>
    </div>    
</body>
</html>