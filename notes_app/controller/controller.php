<?php
include('../model/model.php');
include("connect.php");
include("functions.php");
$model=new model;

if(isset($_POST['submit']))
	{

		$firstname = mysqli_real_escape_string($con, $_POST['fname']);
		$lastname = mysqli_real_escape_string($con, $_POST['lname']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];
		$conditions = isset($_POST['conditions']);
		$date = date("Y-m-d");

		if(strlen($firstname) < 3)
			{
				$error= "First name is too short";
			}

			else if(strlen($lastname) < 3)
			{
				$error= "Last name is too short";
			}

			else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$error= "Please enter valid email address";
			}

			else if(email_exists($email, $con))
			{
				$error= "Someone is already registered with this email";
			}

			else if(strlen($password) < 8)
			{
				$error= "Password must be greater than 8 characters";
			}

			else if($password !== $passwordConfirm)
			{
				$error= "Password does not match";
			}

			else if(!$conditions)
			{
				$error= "You must agree with the terms and conditions";
			}

			else
			{


					$password = password_hash($password, PASSWORD_DEFAULT);
					$data=array("firstname"=>$firstname, "lastname"=>$lastname, "username"=>$username, "email"=>$email, "password"=>$password, "date"=>$date);
		 		    $log=$model->insert($con_link,'usersinfo',$data);


			}
	}



?>