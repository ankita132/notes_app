<?php
include ("connect.php");
include("functions.php");

 $id = isset($_GET['id']) ? $_GET['id'] : '';
$sql="DELETE FROM notes WHERE id='$id'";
$result = mysqli_query($con, $sql) or die("Unable to delete database entry.");

if(logged_in())
{
  header("location:profile.php");
  exit();
}
?>
