<?php

	function email_exists($email, $con)
	{
		$result = mysqli_query($con,"SELECT * FROM usersinfo WHERE email='$email'");
		$row = mysqli_fetch_array($result);

		if(mysqli_num_rows($result) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	function logged_in()
	{
			if(isset($_SESSION['email']) || isset($_COOKIE['email']))
			{
				return true;
			}
			else
			{
				return false;
			}
	}

?>
