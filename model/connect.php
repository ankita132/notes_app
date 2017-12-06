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
session_start();
?>