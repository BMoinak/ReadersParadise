<?php 
	session_start();

	// variable declaration
	$name = "";
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', 'moinak', 'dbms_project');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$date = date('Y-m-d', time());
			$query = "INSERT INTO user_data (name, username, email, password, doj) 
					  VALUES('$name','$username', '$email', '$password','$date')";
			mysqli_query($db, $query);
			$_SESSION['name'] = $name;
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: post.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM user_data WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			//$query = "SELECT name FROM user_data WHERE username='$username' AND password='$password'";
			//$result = mysqli_query($db, $query);
			//$name=$result[0];
			//if (mysqli_num_rows($result) == TRUE) {
			if (mysqli_num_rows($results) == TRUE) {
				$_SESSION['username'] = $username;
				//$_SESSION['name'] = $name;
				$_SESSION['success'] = "You are now logged in";
				header('location: post.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>