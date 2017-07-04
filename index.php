<?php
	include("connect.php");
	include("functions.php");

	if(logged_in())
	{
		header("location:profile.php");
		exit();
	}

	$error = "";

	if(isset($_POST['submit']))
	{
		  $firstName = mysqli_real_escape_string($con, $_POST['fname']);
		  $lastName = mysqli_real_escape_string($con, $_POST['lname']);
	   	  $email = mysqli_real_escape_string($con, $_POST['email']);
		  $userName = mysqli_real_escape_string($con, $_POST['username']);
	          $password = $_POST['password'];
	          $passwordConfirm = $_POST['passwordConfirm'];
		  $conditions = isset($_POST['conditions']);
		  $date = date("F, d Y");

		if(strlen($firstName) < 3)
		{
			$error = "First name is too short";
		}

		else if(strlen($lastName) < 3)
		{
			$error = "Last name is too short";
		}

		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error = "Please enter valid email address";
		}

		else if(email_exists($email, $con))
		{
			$error = "Someone is already registered with this email";
		}

		else if(strlen($password) < 8)
		{
			$error = "Password must be greater than 8 characters";
		}

		else if($password !== $passwordConfirm)
		{
			$error = "Password does not match";
		}

		else if(!$conditions)
		{
			$error = "You must be agree with the terms and conditions";
		}

		else
		{
				$password = password_hash($password, PASSWORD_DEFAULT);
				$insertQuery = "INSERT INTO usersinfo(firstName, lastName, userName, email, password, date) VALUES ('$firstName','$lastName','$userName','$email','$password','$date')";
					if(mysqli_query($con, $insertQuery))
					{
							$error = "You are successfully registered";
					}
				else
				{
					$error = "Problem in registration";
				}
		}
	}
?>

<!doctype html>
<html>
	<head>
	<title>Notes App- Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="index.css" />
	<link rel="icon" href="icon.png" />
	</head>
	<body>
		<nav class="navbar navbar-inverse">
		<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><img src="icon.png"  style="position:relative; top:-20%; width:25pt; height:25pt;"></a>
		</div>
		<ul class="nav navbar-nav navbar-left">
		<li><a href="#" style="font-size:15pt;"> Notes-App</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
		</ul>
		</div>
	</nav>

		<div id="error" style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> "><?php echo $error; ?></div>
		<form method="POST" action="index.php">
	   <input id="input-1" type="text" placeholder="At least 3 characters" name="fname" required autofocus />
	  <label for="input-1">
	    <span class="label-text">First name</span>
	    <span class="nav-dot"></span>
	    <div class="signup-button-trigger">Sign Up</div>
	  </label>
	  <input id="input-2" type="text" placeholder="At least 3 characters" name="lname" required />
	  <label for="input-2">
	    <span class="label-text">Last Name</span>
	    <span class="nav-dot"></span>
	  </label>
	  <input id="input-3" type="text" placeholder="crazy32" name="username" required />
	  <label for="input-3">
	    <span class="label-text">Username</span>
	    <span class="nav-dot"></span>
	  </label>
	  <input id="input-4" type="email" placeholder="email@address.com" name="email" required />
	  <label for="input-4">
	    <span class="label-text">Email</span>
	    <span class="nav-dot"></span>
	  </label>
	  <input id="input-5" type="text" placeholder="At least 8 characters" name="password" required />
	  <label for="input-5">
	    <span class="label-text">Password</span>
	    <span class="nav-dot"></span>
	  </label>
	  <input id="input-6" type="text" placeholder="At least 8 characters" name="passwordConfirm" required />
	  <label for="input-6">
	    <span class="label-text">Confirm Password</span>
	    <span class="nav-dot"></span>
	  </label>
	  <input id="input-7" type="checkbox" name="conditions"/>
	  <label for="input-7">
	    <span class="label-text" style="text-align:center;">I agree to the terms and conditions</span>
	    <span class="nav-dot"></span>
	  </label>
	  <button type="submit" name="submit">Create Your Account</button>
	  <p class="tip">Press Tab</p>
	  <div class="signup-button">Sign Up</div>
	</form>
		</body>
</html>
