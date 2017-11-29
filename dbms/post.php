<?php include('diary_input.php') ?>
<?php 
	//session_start(); 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Reader's Paradise- Post</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="Head">
		<h1>
		Reader's Paradise	</h1>
	</div>	 
	<div id="mySidenav" class="sidenav">
  <a href="post.php" id="Post">Post</a>
  <a href="read.php" id="Read">Read</a>
   <a href="mydiary.php" id="myd">My Diary</a>
</div>
	<div class="header">
		<h2>Write A Post</h2>
	</div>
	
	<form method="post" action="post.php">

		<?php //include('errors.php'); ?>
		<div class="input-group">
			<label>Genre</label>
			<input type="text" name="genre" >
		</div>
		<div class="input-group">
			<label>Title</label>
			<input type="text" name="title" >
		</div>
		<div class="input-group">
			<label>Diary</label>
			<textarea name="diary" cols="40" rows="5" style="resize: none"></textarea>
		</div>
		<div class="input-group1">
			<input type="checkbox" name="tag_1" value="yes"> 
			<label>Private</label>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="diary_entry">Submit</button>
		</div>
		<p></br> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>

	</form>

</body>
</html>