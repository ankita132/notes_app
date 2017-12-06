<?php
	
	$con = mysqli_connect("localhost","notes_app","notes_app@123","registration");
	
	if(mysqli_connect_errno())
	{
		echo "Error occured while connecting with database ".mysqli_connect_errno();
	}

	session_start();
?>
