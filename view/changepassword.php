<?php

	include("connect.php");
	include("functions.php");

	$error = "";

	if(isset($_POST['savepass']))
	{
		$password = $_POST['password'];
		$confirmPassword = $_POST['passwordConfirm'];

		if(strlen($password) < 8)
		{
			$error = "Password must be greater than 8 characters";
		}
		else if($password !== $confirmPassword)
		{
			$error = "Password does not match";
		}
		else
		{
			$password = password_hash($password,PASSWORD_DEFAULT);

			$email = $_SESSION['email'];
			if(mysqli_query($con, "UPDATE usersinfo SET password='$password' WHERE email='$email'"))
			{
				$error = "Password changed successfully, <a href='profile.php'>click here</a> to go to the profile";
			}

		}
	}


	if(logged_in())
	{
	?>

		<?php echo $error; ?>
		<!doctype html>
		<html>
		<head>
			<title>Notes App - Change Password</title>
			<link rel="icon" href="icon.png" />
		</head>
		<style>
		body{
			margin:0;
			color:#ecf0f1;
			font:300 18px/18px Roboto;
			background: url("bkg.jpg") no-repeat center center fixed;
		  background-size:cover;
		}
		.fl{ float:left; }
.fr{ float: right; }
.group:before,
.group:after {
    content: "";
    display: table;
}
.group:after {
    clear: both;
}
.group {
    zoom: 1;
}
.form-container {
    width: 400px;
    margin: 100px auto;
    text-align: center;
    overflow: hidden;
    border-radius: 5px;
}
.form-header{
    background: #4d4d4d;
    color: #b8eae6;
    text-transform: uppercase;
}
.form-container .form-header {
    font-size: 1.2rem;
    padding: 1.30rem;
}
.form-container .form-content {
    background: linear-gradient(to bottom right, #5D1CD0, #A81FD0);
}
.form-content fieldset{
    padding: 1rem;
    border: none;
}
.form-content input[type="password"],.form-input-control,.form-content input[type="submit"],.form-input-submit{
    display: block;
    width: 90%;
    margin:0 auto;
		margin-bottom:1rem;
    border-radius: 0.125rem;
}
.form-content input[type="password"],.form-input-control{
    padding: 0.925rem;
    border: 1px solid #DBD1CE;
    background: #FFF3F0;
}
.form-content input[type="submit"],.form-input-submit{
    background: linear-gradient(to right, #8226D0, #C91CE7);
    padding: 0.925rem;
    margin-top: 0.925rem;
    color: #EDEAE7;
    text-transform: uppercase;
    font-size: 1rem;
    border: none;
    border-top: 1px solid #BC1FD0;
    border-bottom: 1px solid #BC1FD0;
  cursor:pointer;
}
		</style>
		<body>
    <div class="form-container">

        <h1 class="form-header heading-color">Change Password</h1>
        <form method="POST" action="changepassword.php" class="form-content">
            <fieldset>
                <input type="password" placeholder="New Password" class="form-input-control" name="password"/>
                <input type="password" placeholder="Re-enter Password" class="form-input-control" name="passwordConfirm">
                <input type="submit" value="Save" class="form-submit-control" name="savepass"/>
            </fieldset>
        </form>
    <div style="clear:both;"></div>
    </div>
</body>
</html>

	<?php
	}else
	{
		header("location: profile.php");
	}
?>
