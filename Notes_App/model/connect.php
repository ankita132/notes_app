<?php
class connection
{
	public function connect()
	{
		$con = new mysqli('localhost','root','','registration');
		return $con;
	}

}
$connection=new connection;
$con_link=$connection->connect();
session_start();
?>