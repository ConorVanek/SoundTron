<!doctype html>

<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

<h1>Test site</h1>

<p><button>press</button></p>

 <audio controls>
  <source src="zombie.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio> 

 <audio controls>
  <source src="zombie2.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio> 

<div class"container" style ="padding:25px">
	<div class="row justify-content-start">
		<div class="col-9">
			player
		</div>
		<div class="col-3">
			<p>up</p><br>
			<p>down</p>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
var i = 0;
var players = [];

function getFileName(url) {
	var filename = url.substring(url.lastIndexOf('/')+1);
	return filename;
}

$("button").click(function() {
	i++;
	console.log("button pressed " + i + " times.\n");
});

$("audio").on("play", function() {
	
});

$("audio").on("loadedmetadata", function() {
	player = getFileName(this.currentSrc);
	console.log(player);
	players[player]=0;
});

$("audio").on("pause", function() {
	player = getFileName(this.currentSrc);
	console.log(players[player]);
});

$("audio").on("timeupdate", function(){
			play_counter = (this.duration*0.6);
			player = getFileName(this.currentSrc);
			players[player]+=(this.currentTime-(this.currentTime-0.28));
			console.log(players[player] + " seconds");	
			
			if(players[player]>play_counter) {
				players[player] = 0;
				console.log("reset");
			}
});
</script>
</body>


</html>