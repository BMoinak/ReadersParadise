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

	// variable declaration
	
	$username = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db1 = mysqli_connect('localhost', 'root', 'moinak', 'dbms_project');
		if (isset($_POST['diary_entry'])) {
		$title = mysqli_real_escape_string($db1, $_POST['title']);
		$diary = mysqli_real_escape_string($db1, $_POST['diary']);
		$genre = mysqli_real_escape_string($db1, $_POST['genre']);
		$visible = "public";
			$username = $_SESSION['username'];$date = date('Y-m-d', time());
			$query = "INSERT INTO writer ( username) 
					  VALUES( '$username')";
			mysqli_query($db1, $query);
			if (isset($_POST['tag_1'])) {

				$visible = "private";    // Checkbox is selected
			}
			$post_id = generate_uuid();
			$query1 = "INSERT INTO post (post_id, username, genre, dop, visiblity)
					  VALUES('$post_id','$username', '$genre' , '$date', '$visible')";
			if (mysqli_query($db1, $query1)) {
    		$last_id = mysqli_insert_id($db1);
    		
    	}
			$query = "INSERT INTO readers_paradise ( title, diary, post_id) 
					  VALUES( '$title' , '$diary', '$post_id')";
			mysqli_query($db1, $query);
			//header('location: post.php');
	}

	// ... 
function generate_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0C2f ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
    );

}
?>