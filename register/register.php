<?php
	session_start();
?>

<html>

<head>
	<title> Register </title>


	<meta charset='utf-8'>
	<title>Tesla Picker</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="register_styles.css?v=<?php echo time(); ?>">		
	
</head>

<body>

</div>



<form method='post' action='register_form.php'>
		<h1> Register </h1>


	<div class='input-group'>
		<label> Username </label>
  	    <input type='text' name='username' placeholder='Username'>
	</div>
	
	<div class='input-group'>
		<label> Email </label>
		<input type='email' name='email' placeholder='Email'>
	</div>
	
	<div class='input-group'>
		<label> Password </label>
		<input type='password' name='password' placeholder='Password'/>
	</div>
	
	<div class='input-group'>
		<label> Confirm Password </label>
		<input type='password' name='confirm_password' placeholder='Confirm Password'>
	</div>
	<br>
	<div class='input-group'>
		<button type='submit' class='btn' name='register'> 
			Register 
		</button>
	</div>
	
	<p>
		Already a member? <a href='../login.php'> Sign In </a> 
	</p>
	
	<?php
if ( isset($_SESSION['error']) ) {
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);
}
?>

	
</form>
</body>

			<script type='text/javascript' src='../plugin.js?4'></script>
		<script type='text/javascript' src='register.js?4'></script>
</html>

		
		
	
	




	