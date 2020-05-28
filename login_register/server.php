<?php
session_start();
$username = '';
$email = '';
$errors = array();

//connect to sql DB
$db = mysqlI_connect('localhost', 'root', 'root', 'tesla_registration');

//Register User
if(isset($_POST['register'])) {
	
	//get all input values from form
	$username = $_POST['register'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	//form validation: ensure that form is correctly filled in, if part of it is not, push that error into the array
	if (!isset($_POST['username'])) { 
		array_push($errors, "Username is required."); 
	}
	if (!isset($_POST['email'])) { 
		array_push($errors, "Email is required."); 
	}
	if (!isset($_POST['password'])) { 
		array_push($errors, "Password is required."); 
	}
	
	if ($password != $confirm_password) { 
		array_push($errors, "Passwords must match."); 
	}
	
	//check DB to make sure user does not already exist
	$check_user = 'SELECT * FROM users WHERE username="$username" OR email = "$email" LIMIT';
	$result = mysqli_query($db, $check_user);
	$user = mysqli_fetch_assoc($result);
	
	if($user) { 
		if($user['username'] === $username) {
			array_push($errors, 'Username already exists');
		}
		
		if($user['email'] === $email) {
			array_push($errors, 'Email already exists');
		}
	}
	
	//if the form contains no errors
	if(count($errors) == 0) {

	//encrypt the password before saving in the database
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
	
	$query = "INSERT INTO users (username, email, password) VALUES(     '$username', $email', $password')";
	
	mysqli_query($db, $query);
	$_SESSION['username'] = $username;
	$_SESSION['success'] = 'You are now logged in';
	header('location: index.php');
	}
}
?>