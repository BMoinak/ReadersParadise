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
		<h2>My Diary</h2>
	</div>
<?php 
$username = $_SESSION['username'];
     $db=mysqli_connect('localhost','root','moinak', 'dbms_project');
        $query="SELECT DISTINCT  genre FROM post where username='$username'";
        $result=mysqli_query($db,$query);
     ?>  
     <form class="read" action="" method="POST">
     <select name="option_chosen">
        <option>-- Select Genre --</option>
        <?php
            while(list($genre)=mysqli_fetch_row($result)) {
            echo "<option value=\"".$genre."\">".$genre."</option>";
        }
       ?>

        </select>

        <input type="submit" class="btn" value="Submit" />
	    </br></br>

<?php 
	$option_chosen = "Hello";
    
	if($_SERVER['REQUEST_METHOD'] =='POST'){
     
     $option_chosen=$_POST['option_chosen'];
     if($option_chosen!='-- Select Genre --')
     $query="SELECT title FROM readers_paradise where post_id in (select post_id from post where genre='$option_chosen' and username = '$username')";
 else
 		$query="SELECT title FROM readers_paradise where post_id in (select post_id from post where username = '$username')";
 }

 	else
 		$query="SELECT title FROM readers_paradise where post_id in (select post_id from post where username = '$username')";

 	$result= mysqli_query($db, $query);
 	while($res = mysqli_fetch_assoc($result))
 	{
 		
		$_SESSION['title'] = $res['title'];//Create new session variable 'name'.
 	 echo '</br><li><a href="?del='.$res['title'].'">'.$res['title'].'</a></li>'; 
    }
/*
 		unset($_SESSION['title']);//remove $_SESSION['name']
		session_regenerate_id();//Copies all other session variables on to new id*/
        if(isset($_GET['del'])){

        $_SESSION['title'] = $_GET['del'];
        header('location: reading_diary.php');
 
 }
 
 
?>



		<p> </br><a href="index.php?logout='1'" style="color: red;">logout</a> </p>
	</form>

</body>
</html>