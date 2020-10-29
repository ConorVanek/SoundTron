<?php
    session_start();
    require_once('../config.php');
    require_once('../functions.php');
    $username = isloggedin()? $_SESSION["username"] : "";
?>

<!doctype html>

<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function(){
            $("audio").on("play", function() {
                $("audio").not(this).each(function(index, audio) {
                    audio.pause();
                });
            });
        });
    </script>
    <meta name="generator" content="Hugo 0.75.1" />
    <title>/rock</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#000084" />
    <link rel="icon" href="../favicon.ico">
    <link rel="canonical" href="http://example.com">
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
                                <?php if(isloggedin()){echo("<a href=\"../" . $_SESSION["alt_url"] . "\"> <span>" . $username . "</span></a>");} ?>
                            </li>
                        
                            <li>
                                <a href=<?php if(!isloggedin()){echo("\"../login.php\"");} else {echo("\"../account.php\"");}?>>
                                    <span><?php if(!isloggedin()){echo("Sign In/Create Account");} else {echo("Account Settings");}?></span>
                                </a>
                            </li>
                        
                            <li>
                                <?php if(isloggedin()){echo("<a href=\"../upload.php\"> <span>Upload</span></a>");} ?>
                            </li>
                        
                            <li>
                                <?php if(isloggedin()){echo("<a href=\"../logout.php\"> <span>Sign Out</span></a>");} ?>
                            </li>

                    
                </ul>
            </div>
        </div>
    </div>
</nav>

<div id="content" class="container">

<div class="row-fluid navmargin">
    <div class="page-header">
        <p style="font-size:64px; padding:10px; color: #000000">/rock</p>
    </div>
</div>


<div class="row-fluid">
    <div class="span9 bs-docs-sidebar">

<?php
$sql = "SELECT username, title, filename FROM songs WHERE category='rock'";
$result = mysqli_query($link, $sql);

?>

<table>
<?php
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $user = $row["username"];
    $url = GetAltUrl($user, $link);
//    echo ("<ul class=\"nav nav-list bs-docs-sidenav\"><li><h1 style=\"color:black;\">" . $row["title"] . "</h1><a href=\"../" . $url . "\"><h4 style=\"color: #b417b4;\">" . $row["username"] . "</h4></a><br> <audio controls controlsList=\"nodownload\">". "<source src=\"./" . $row["filename"] . "\" type=\"audio/mpeg\"></audio></li></ul><br>");
    $userpath = "../" . $url;
    $songpath = "./" . $row["filename"]; 
    getPlayer($row["title"], $row["username"], $userpath, $songpath);


}} else {
  echo "0 results";
}

mysqli_close($link);
?>

</table>
</div>
</div>
</div>

<link rel="stylesheet" href="../css/bootstrap-grid-min.css">

</body>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap-responsive.css">
<link rel="stylesheet" href="../css/style.css">

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap-386.js"></script>
<script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-alert.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-dropdown.js"></script>
<script src="../js/bootstrap-scrollspy.js"></script>
<script src="../js/bootstrap-tab.js"></script>
<script src="../js/bootstrap-tooltip.js"></script>
<script src="../js/bootstrap-popover.js"></script>
<script src="../js/bootstrap-button.js"></script>
<script src="../js/bootstrap-collapse.js"></script>
<script src="../js/bootstrap-carousel.js"></script>
<script src="../js/bootstrap-typeahead.js"></script>
<script src="../js/bootstrap-affix.js"></script>
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
