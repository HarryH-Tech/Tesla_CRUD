<?php
	require_once 'meekrodb.2.3.class.php';
	session_start();
	
	DB::$user = 'root';
	DB::$password = 'root';
	DB::$dbName = 'tesla_registration';
	
	if(isset($_POST['register'])) {
		
		if(strlen($_POST['username']) < 3 || strlen($_POST['email']) < 3) {
			$_SESSION['error'] = 'Please ensure that your username and email are both at least 3 characters long.';
			header("Location: register.php");
			return;
		}
		
		else if(mb_strlen($_POST['password']) < 5) {
			print($password);
			$_SESSION['error'] = 'Please ensure your password is at least 5 characters long.';
			header("Location: register.php");
			return;

					
		}
		else if($_POST['password'] != $_POST['confirm_password']) {
			$_SESSION['error'] = 'Please ensure that both the "Password" and "Confirm Password" fields match.';
			header("Location: register.php");
			return;
		}
		else {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hash = password_hash($password, PASSWORD_DEFAULT);
	
	DB::insert('users', array(
		'username' => $username,
		'email' => $email,
		'password' => $hash
	));
	
    header('Location: login.php');
	}
}
?>