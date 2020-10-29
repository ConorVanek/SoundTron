<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en"><head>
	<meta name="generator" content="Hugo 0.75.1" />
    <title>HUGO.386</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#000084" />
    <link rel="icon" href="https://example.com/favicon.ico">
    <link rel="canonical" href="http://soundtron">
    


</head>
<body>

<?php

require_once('config.php');
require_once('functions.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_SESSION["username"];
 //   $id = strval($_SESSION["id"]);
    $title = $_POST["Title"];
    $category = $_POST["category"];
    $target_dir = './' . $category . '/';

    echo('<h1>'.$category.'</h1>');

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    //add to sql (see config.php)
    add_song($username, $title, $category, $filename, $link);
  
  
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
  
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
  
    // Allow certain file formats
    if($imageFileType != "mp3") {
      echo "Sorry, only mp3 files are allowed currently.";
      $uploadOk = 0;
    }
  
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
  
    }
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"></button>
            <a class="brand" href="http://soundtron">soundtron.com</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    
                    
                        
                            <li>
                                <a href="http://soundtron">
                                    
                                    <span>Home</span>
                                </a>
                            </li>
                        
                    
                </ul>
            </div>
        </div>
    </div>
</nav>

<div id="content" class="container">

<div class="row-fluid navmargin">
    <div class="page-header">
        <h1>Song Upload</h1>
    </div>
</div>

<div class="row-fluid">
    <div class="span9 bs-docs-sidebar">
        <p></p>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  Title:
  <input type="text" name="Title" id = "Title">
<label for="category">Category:</label>
<select id="category" name="category">
  <option value="rock">Rock</option>
  <option value="rap">Rap</option>
  <option value="electronic">Electronic</option>
</select> 
  <label>Select a file (We currently only support mp3):</label><br>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
</div>
</div>

</div>

</body>
<link rel="stylesheet" href="./css/bootstrap.css">
<link rel="stylesheet" href="./css/bootstrap-responsive.css">
<link rel="stylesheet" href="./css/style.css">


<script src="./js/jquery.js"></script>
<script>
    $('form').submit(function () {

    // Get the Login Name value and trim it
    var title = $.trim($('#Title').val());
    var file = $.trim($('#fileToUpload').val());

    // Check if empty of not
    if (title === '') {
    alert('Title is empty.');
    return false;
    }
    else if (file === '' || file === NULL) {
        alert('Please choose a file.');
        return false;
    }
    });
    </script>
    

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