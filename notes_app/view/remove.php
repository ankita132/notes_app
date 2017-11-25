<?php
include ("connect.php");
include("functions.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql="DELETE FROM notes WHERE id='$id'";
$result = mysqli_query($con, $sql) or die("Unable to delete database entry.");

$name = $_SESSION['username'];
$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE name='$name'") or die ("Unable to query notes");

while($Row = mysqli_fetch_array($sqlresult)){
	$id = $Row['id'];
	echo "<div class='list-li clearfix'>
          <div class='info pull-left'>
            <div class='name'>".$Row['note']."</div>
          </div> ";
          echo '<div class="action pull-right">
            <a id="edit_note" onclick="edit(\''.$Row['id'].'\')"><i class="fa fa-edit"></i></a>';
          echo '<a id="remove_note" onclick="remove(\''.$Row['id'].'\')"><i class="fa fa-trash-o"></i></a>
          </div>
  </div>';
}

?>
