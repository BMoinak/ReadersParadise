<?php 
	session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {   
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
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
	<div class="header1">
		<h2>Stories</h2>
	</div>
<?php 
    
     $title=$_SESSION['title'];
       
     ?>  
     <form class="read" action="" method="POST">
    	<?php
    	
    	echo "<p class='tit'>".$title."</p>";
    	 $db=mysqli_connect('localhost','root','moinak', 'dbms_project');
    	 $query= "SELECT diary FROM readers_paradise where title='$title'; ";
        $result=mysqli_query($db,$query);
    	$res = mysqli_fetch_assoc($result);
 	 echo "<p  class='dia' > </br>".$res['diary']."</p>"; 
 
    	?>



		<p></br> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
	</form>

</body>
</html>