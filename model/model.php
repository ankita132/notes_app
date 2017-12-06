<?php
class connection
{
	public function connect()
	{
		$con = new mysqli('localhost','notes_app','notes_app@123','registration');
		return $con;
	}

}
$connection=new connection;
$con_link=$connection->connect();

class model
{

	public function insert($con_link,$table,$data)
	{
	$dkey=array_keys($data);
	$dvalue=array_values($data);
	$key=implode("`,`",$dkey);
	$value=implode("','",$dvalue);
	$ins="insert into $table (`$key`) values ('$value')";

									if($con_link->query($ins))
											{
												$error = "You are successfully registered";
												echo $error;
												header("Location: login.php");

											}
										else
											{
												$error = "Problem in registration";
												echo $error;
												header("Location: index.php");
											}

									mysqli_close($con_link);

	}
}

?>