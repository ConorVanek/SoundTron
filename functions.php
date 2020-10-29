<?php

function add_song($username, $title, $category, $filename, $link) {
    $sql = "INSERT INTO songs (username, title, category, filename) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $username, $title, $category, $filename);
            if(mysqli_stmt_execute($stmt)) {
                echo "Song added to database!";
            } else {
                echo "Something went wrong adding to database.";
            }
        }
        mysqli_stmt_close($stmt);
}

function isloggedin() {
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        return false;
    } else {
        return true;
    }
}

function GetUserName($alt_url, $link) {
    $sql = "SELECT username FROM users WHERE alt_url = '" . $alt_url . "'";
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $user = $row["username"];
    }

    return $user;
}

function GetAltUrl($username, $link) {
    $sql = "SELECT alt_url FROM users WHERE username = '" . $username . "'";

    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $url = $row["alt_url"];
    }

    return $url;
}

function update_url($user, $url, $link) {
    $sql = "UPDATE users SET alt_url = ? WHERE username = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $url, $user);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Password updated successfully. Destroy the session, and redirect to login page
            echo("Success!");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

function isValidUrl($url, $link) {
    $sql = "SELECT COUNT(*) AS count FROM users WHERE alt_url = '" . $url . "'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
    if($row["count"] == 1) {
        return true;
    }
    else {
        return false;
    }
}
}

function getPlayer($title, $artist, $userpath, $songpath) { ?>

<div class="nav nav-list bs-docs-sidenav">
        <div class="row justify-content-start">
            <div class = "col-sm-9">
                <h1><?php echo($title); ?></h1>
                <a href="<?php echo($userpath); ?>"><h4 style="color: #b417b4;"><?php echo($artist); ?></h4></a>
                <audio style="100%" controls>
                    <source src="<?php echo($songpath); ?>" type="audio/mpeg">
                </audio>
            </div>
            <div class = "col-sm-3">
            <div class = "votes">
                <img id="upvote" src="http://soundtron/img/up-arrow.png"> <img id="downvote" src="http://soundtron/img/down-arrow.png"><br>
                <p style = "color:#9b3581; text-align:left; padding: 5px;">200</p>
            </div>
            </div>
        </div>
</div>
<br>


<?php
}

?>