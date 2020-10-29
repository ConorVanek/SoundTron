<?php

function add_song($username, $title, $category, $filename, $link) {
    $sql = "INSERT INTO songs (username, title, category, filename, plays) VALUES (?, ?, ?, ?, 0)";
         
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

function addPlay($songid, $link) {
	$sql = "UPDATE songs SET plays = plays + 1 WHERE id = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $songid);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Votes updated successfully.
            echo("AddPlay Success!");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
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

function getPlayer($id, $title, $artist, $userpath, $songpath, $plays, $link) { ?>

<div class="nav nav-list bs-docs-sidenav">
        <div class="row justify-content-start">
            <div class = "col-sm-9">
                <h1><?php echo($title); ?></h1>
                <a href="<?php echo($userpath); ?>"><h4 style="color: #b417b4;"><?php echo($artist); ?></h4></a>
                <audio id="<?php echo($id); ?>" style="width: 100%;" controls>
                    <source src="<?php echo($songpath); ?>" type="audio/mpeg">
                </audio>
				<h1>Plays: <?php echo($plays); ?></h1>
            </div>
            <div class = "col-sm-3">
            <div class = "votes">
                <img id="upvote-<?php echo($id); ?>" class="upvote" src="http://soundtron/img/up-arrow.png"> <img id="downvote-<?php echo($id); ?>" class="downvote" src="http://soundtron/img/down-arrow.png"><br>
                <p style = "color:#9b3581; text-align:left; padding: 5px;"><?php echo(getVotes($id, $link)); ?></p>
            </div>
            </div>
        </div>
</div>

<script>
$(<?php echo("\"#upvote-" . $id . "\""); ?>).on("click", function() {
	console.log("upvote");
	$.post("http://soundtron/upvote.php", {id: <?php echo($id); ?>}, function(data) {
		alert(data);
	});
});

$(<?php echo("\"#downvote-" . $id . "\""); ?>).on("click", function() {
	console.log("downvote");
	$.post("http://soundtron/downvote.php", {id: <?php echo($id); ?>}, function(data) {
		alert(data);
	});
});
</script>

<br>


<?php
}

function newUpvote($songid, $userid, $link) {
	    $sql = "INSERT INTO votes (song_id, user_id, vote) VALUES (?, ?, 1)";

		if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $songid, $userid);
            if(mysqli_stmt_execute($stmt)) {
                echo "Upvote added to database!";
            } else {
                echo "Something went wrong adding to database.";
            }
        }
        mysqli_stmt_close($stmt);
		
}

function newDownvote($songid, $userid, $link) {
	    $sql = "INSERT INTO votes (song_id, user_id, vote) VALUES (?, ?, -1)";

		if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $songid, $userid);
            if(mysqli_stmt_execute($stmt)) {
                echo "Downvote added to database!";
            } else {
                echo "Something went wrong adding to database.";
            }
        }
        mysqli_stmt_close($stmt);
		
}

function upvote($songid, $userid, $link) {
	$sql = "UPDATE votes SET vote = 1 WHERE song_id = ? AND user_id = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $songid, $userid);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Votes updated successfully.
            echo("Upvote Success!");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

function downvote($songid, $userid, $link) {
	$sql = "UPDATE votes SET vote = -1 WHERE song_id = ? AND user_id = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $songid, $userid);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Votes updated successfully.
            echo("Downvote Success!");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

function clearVotes($songid, $userid, $link) {
	$sql = "DELETE FROM votes WHERE song_id = ? AND user_id = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $songid, $userid);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Votes updated successfully.
            echo("Success!");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

function getVotes($songid, $link) {
	$sql = "SELECT SUM(vote) as sumvotes FROM votes WHERE song_id = " . $songid;
	
	$result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
    $votes = $row["sumvotes"];
	}
	return $votes;
}

?>