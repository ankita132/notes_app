<?php
include ("connect.php");
include("functions.php");

$name = $_SESSION['username'];

if(isset($_POST['note'])){

    $note = mysqli_real_escape_string($con, $_POST['note']);
    $insertQuery = "INSERT INTO notes(note, name) VALUES ('$note', '$name')";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $insertQuery = "UPDATE notes SET note ='$note' WHERE id = '$id'";
    }
    if(mysqli_query($con, $insertQuery))
    {
        $error = "Note added";
    }
    else
    {
        $error = "Cannot add note!!";
    }
}
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