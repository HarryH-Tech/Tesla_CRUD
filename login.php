<?php


session_start();


require_once 'pdo.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
	    

		
		$username    = $_POST['username'];
		$password = $_POST['password'];


		$stmt = $pdo->prepare('SELECT password FROM users WHERE username = :username LIMIT 1');
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_OBJ);

		$isPasswordCorrect = password_verify($password, $row->password);

			if ($isPasswordCorrect == true) {
				header ('Location: app/app.php');
				$user_id = $_POST['username'];
				$user_password = $_POST['password'];
				return;
			} else {
					$_SESSION['error'] = "Login failed. Please try again, double check your username and password.";
					header("Location: login.php");
					return;
					}
				
				}
			
			

		
		
?>


<html>

<head>
	<meta charset='utf-8'>
	<title>Tesla Picker</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="login_styles.css?v=<?php echo time(); ?>">


</head>

<body>



	<form method='post' >
		<div class='container'>
				<h2> Login or Register </h2>

		
		
		
			<label for='username'> <b>Username: </b> </label>
			<input name='username' type='text' placeholder='username' required/> <br>
			
			 <label for='password'> <b>Password: </b> </label>

			 <input name='password' type='password' placeholder='password' required/> <br>
			
			<?php
if ( isset($_SESSION['error']) ) {
  echo('<p class="error">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);
}
?>

			
			<button  type='submit' class="btn-primary ">Login</button>
			
			
		
  
			<a href='register/register.php'> Not Yet A Member? <b> Sign Up Here </b> </a><br>
			
			<label>
			
			<input type="checkbox" checked="checked" name="remember" > Remember me
			</label><br>
			
			
				<span class="psw">Forgot <a href="forgot_password.php">password?</a></span>
  
  			</div>
</div>
		</form>

</div>
	
</body>

			
			
		


	<script>
	/*
	<?php


	session_start();
	ob_start();
	
	require_once'meekrodb.2.3.class.php';
	
if ( isset($_POST['username']) && isset($_POST['password'])) {
        DB::$user = 'root';
        DB::$password = 'root';
        DB::$dbName = 'crypto_database';
		
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = DB::queryFirstRow("SELECT * FROM credentials where username = %s", $username);
        $hash = $result['password'];

        if (password_verify($password, $hash)) {
                $_SESSION['loggedin'] = 1;
                header('Location: http://localhost/crypto_image/crypto_index.php');
        } else {
                echo "Login failed";
        }
}

 
?></script>
