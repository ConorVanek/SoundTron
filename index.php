<?php
    session_start();
    require_once('config.php');
    require_once('functions.php');
    $welcome_message = isloggedin() ? 'Welcome, ' . $_SESSION["username"] : 'Welcome, Guest';
    $username = isloggedin() ? $_SESSION["username"] : "";
    $alt_url = isloggedin() ? $_SESSION["alt_url"] : "";
?>

<!DOCTYPE html>
<html lang="en"><head>
	<meta name="generator" content="Hugo 0.75.1" />
    <title>Soundtron.com - the worst music website of all time</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#000084" />
    <link rel="icon" href="http://soundtron/favicon.ico">
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
                                <?php if(isloggedin()){echo("<a href=\"./" . $alt_url . "\"> <span>" . $username . "</span></a>");} ?>
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

<div id="content" class="container">

<div class="row-fluid navmargin">
    <div class="page-header">
        <h1><?php echo($welcome_message); ?></h1>
    </div>
</div>

<div class="row-fluid">
    <div class="span9 bs-docs-sidebar">
        <p class="lead"> Soundtron is a public place for sharing music!</p>
        <p></p>
        <p>Simply put, this is a place where sound recordings of all kinds can be uploaded and shared around the world.</p>
        <p></p>
        <hr class="soften">
        <p></p>
        <h1>Featured:</h1>
        <ul>
            
            <li><a href="https://example.com/post/emoji-support/">2019-03-05 | Emoji Support</a></li>
            
        </ul>
    </div>

    <div class="span3 bs-docs-sidebar">
        <h1>Categories</h1>
        <ul class="nav nav-list bs-docs-sidenav">
            
        <li>
            <a href="./rock/">Rock</a>
        </li>

        <li>
            <a href="./rap/">Rap</a>
        </li>

        <li>
            <a href="./electronic/">Electronic</a>
        </li>

        </ul>
        <p></p>
        <h1>Search:</h1>
        <ul class="nav nav-list bs-docs-sidenav">
            
<li>
<form action="./search-results.php" method="get">
  <p style="color:#000000;">Artist</p>
  <input type="text" id="artist" name="artist" style="width:100%;"><br><br>
  <p style="color:#000000;">Song</p>
  <input type="text" id="song" name="song" style="width:100%;"><br><br>
  <input type="submit" value="Search">
</form> 
</li>
        </ul>
    </div>
</div>
<br>

        </div><footer class="container">
    <hr class="soften">
    <p>

    <a href="https://gitlab.com/maxlefou/hugo.386">hugo.386 theme by Max le Fou</a> | 

&copy; 
<a href="http://jmf-portfolio.netlify.com" target="_blank">
    JM Fergeau
</a>
<span id="thisyear">2020</span>

    | soundtron


        | Built on <a href="//gohugo.io" target="_blank">Hugo</a>
</p>
    <p class="text-center">
        <a href="https://facebook.com">Facebook</a> 
        <a href="https://twitter.com">Twitter</a> 
        <a href="https://linkedin.com">Linkedin</a> 
        <a href="https://github.com">GitHub</a> 
        <a href="https://gitlab.com">GitLab</a>
    </p>
</footer>

</body><link rel="stylesheet" href="./css/bootstrap.css">
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
</script></html>
