<?php
// Initialize the session
session_start();
require_once('functions.php');
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, alt_url FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $alt_url);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   
                            $_SESSION["alt_url"] = $alt_url;                         
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
 <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>


<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#000084" />
    <link rel="icon" href="https://example.com/favicon.ico">
    <link rel="canonical" href="https://soundtron">
    

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
                            </li> 
                </ul>
            </div>
        </div>
    </div>
</nav>

    <div id="content" class="wrapper">
        <br><br>
        <h3>Login</h3>
        <br>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
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