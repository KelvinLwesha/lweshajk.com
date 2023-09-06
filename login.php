<?php
session_start();
include 'dbbase.php';
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8" content="device-width, initial-scale=1.0">
</head>
<style type="text/css">
	.menu-link4{
		background-color: black;
		color: white;
	}
</style>
<body>
	<div class="lwesha-contro-form">
<div class="header">
	<h1>LweshaJk <span class="text">The</span> <span class="text1">FreeLencer</span></h1>
</div>
<div class="menulink">
	<nav class="menu">
		<ul><li><a class="menu-link1" href="home.php">Home</a></li></ul>
		<ul><li><a class="menu-link2" href="index.php">About me</a></li></ul>
		<ul><li><a class="menu-link3" href="Contact.php">Contacts</a></li></ul>
		<ul><li><a class="menu-link4" href="login.php">Login</a></li></ul>
	</nav>
	</div>
</div>
<div class="user-login-form">
	<div class="form-login">
		<form class="formlogin" action="login.php" method="POST">
			<div class="headerlogin">
				<h2>Freelencer login</h2>
			</div>
			<div class="input-user">
				<label for="user">USERNAME</label>
				<input class="input" type="email" name="email" id="user" required title="username is required, please">
			</div>
			<div class="input-user">
				<label for="password">PASSWORD</label>
				<input class="input" type="password" name="password" id="password"  required title="Password is required">
			</div>
			<div class="input-button">
				<input type="submit" name="login" class="loginbutton" value="LOGIN">
			</div>
			<?php
		     if (isset($_POST['login'])) {
                //sanitinizing inputs from our user.
		     	$username = mysqli_real_escape_string($conn,$_POST["email"]);
		     	$password = mysqli_real_escape_string($conn,$_POST["password"]);

		     	//writing query to select user's credentials from the database

		     	$query    = mysqli_query($conn,"SELECT * FROM tbluserinfo WHERE username = '$username' AND password = '$password'");

		     	if (mysqli_num_rows($query)>0) {
		     		while ($row = mysqli_fetch_assoc($query)) {
		     			// fetching user data from the table row
		     			  $user = $row["username"];
		     			  $user_role = $row["user_role"]; 

		     			// create php session to store user-input for future use
		     			  $_SESSION['username'] = $user;
		     			  $_SESSION['user_role'] = $user_role;

		     			// redirecting users to their respective pages according to their roles.

		     			  if ($user_role == "jklwesha") {
		     			  	echo header("location:lweshafolder/index.php");
		     			  }elseif ($user_role == "customer") {
		     			  	echo header("location:customerfolder/index.php");
		     			  }
		     		} 
		     	}else{
                      echo "<script>alert('Wrong username/password!')</script>";		     	}
		     }
			?>
			</div>	
			</div>
		</form>
	</div>
</div>
</body>
</html>