<?php
// Initialize the session
session_start();
require_once('config.php');
require_once('functions.php');
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>


    <title>Soundtron.com - My Profile</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#000084" />
    <link rel="icon" href="https://example.com/favicon.ico">
    <link rel="canonical" href="http://soundtron">
    
    

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"></button>
            <a class="brand" href="http://soundtron">soundtron.com</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    
                  
                            <li>
                                <?php if(isloggedin()){echo("<a href=\"./" . $_SESSION["alt_url"] . "\"> <span>" . $username . "</span></a>");} ?>
                            </li>
                        
                            <li>
                                <a href=<?php if(!isloggedin()){echo("\"login.php\"");} else {echo("\"./account.php\"");}?>>
                                    <span><?php if(!isloggedin()){echo("Sign In/Create Account");} else {echo("Account Settings");}?></span>
                                </a>
                            </li>
                        
                            <li>
                                <?php if(isloggedin()){echo("<a href=\"./upload.php\"> <span>Upload</span></a>");} ?>
                            </li>
                        
                            <li>
                                <?php if(isloggedin()){echo("<a href=\"./logout.php\"> <span>Sign Out</span></a>");} ?>
                            </li>

                    
                </ul>
            </div>
        </div>
    </div>
</nav>

    <div class="page-header">
        <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> Account Settings</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <p>
        <a href="profile.php?username=<?php echo($username);?>" class="btn btn-warning">View My Profile</a>
        <a href="upload.php" class="btn btn-danger">Upload mp3</a>
        <a href="change_url.php" class="btn btn-danger">Create a Custom URL</a>
    </p>
</body>

<link rel="stylesheet" href="./css/bootstrap.css">
<link rel="stylesheet" href="./css/bootstrap-responsive.css">
<link rel="stylesheet" href="./css/style.css">

<script src="./js/jquery.js"></script>
<script src="./js/bootstrap-386.js"></script>
<script src="./js/bootstrap-transition.js"></script>
<script src="./js/bootstrap-alert.js"></script>
<script src="./js/bootstrap-modal.js"></script>
<script src="./js/bootstrap-dropdown.js"></script>
<script src="./js/bootstrap-scrollspy.js"></script>
<script src="./js/bootstrap-tab.js"></script>
<script src="./js/bootstrap-tooltip.js"></script>
<script src="./js/bootstrap-popover.js"></script>
<script src="./js/bootstrap-button.js"></script>
<script src="./js/bootstrap-collapse.js"></script>
<script src="./js/bootstrap-carousel.js"></script>
<script src="./js/bootstrap-typeahead.js"></script>
<script src="./js/bootstrap-affix.js"></script>
<script>
    _386 = { 
        fastLoad: true ,
        onePass: false , 
        speedFactor: 1 
    };

    
    function ThisYear() {
        document.getElementById('thisyear').innerHTML = new Date().getFullYear();
    };
</script>

</html>