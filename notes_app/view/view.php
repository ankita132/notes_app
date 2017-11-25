<?php
include('../controller/controller.php');
?>

<!doctype html>
<html>
<script language="JavaScript">

 function getKey(e)
      {
        if (window.event)
           return window.event.keyCode;
        else if (e)
           return e.which;
        else
           return null;
      }

 function restrictChars(e, obj)
      {
        var validList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var key, keyChar;
        key = getKey(e);
        if (key == null)
        	return true;
        if ( key==0 || key==8 || key==9 || key==13 || key==27 )
           return true;
        keyChar = String.fromCharCode(key);

        if (validList.indexOf(keyChar) != -1)
                return true;
        return false;
      }
</script>

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
			<li><a href="view.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
		</ul>
		</div>
	</nav>

		<div id="error" style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> "><?php echo $error; ?></div>
		<form method="POST" action="view.php">
	   <input id="input-1" type="text" placeholder="At least 3 characters" name="fname" onKeyPress="return restrictChars(event, this)" required autofocus />
	  <label for="input-1">
	    <span class="label-text">First name</span>
	    <span class="nav-dot"></span>
	    <div class="signup-button-trigger">Sign Up</div>
	  </label>
	  <input id="input-2" type="text" placeholder="At least 3 characters" name="lname" onKeyPress="return restrictChars(event, this)" required />
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
