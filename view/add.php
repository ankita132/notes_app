<?php
include ("connect.php");
include("functions.php");
if(!logged_in())("Location: login.php");

$name = $_SESSION['username'];

if(isset($_POST['note']) && isset($_POST['genre'])){

    $note = mysqli_real_escape_string($con, $_POST['note']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $insertQuery = "INSERT INTO notes(note, name,genre) VALUES ('$note', '$name','$genre')";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $insertQuery = "UPDATE notes SET note ='$note',genre = '$genre' WHERE id = '$id'";
    }
    if(mysqli_query($con, $insertQuery)){
        $error = "Note added";
    }
    else{
        $error = "Cannot add note!!";
    }
}

$query = "SELECT * FROM notes WHERE name='$name' ORDER BY note";

if(isset($_POST['sortby']) && $_POST['sortby']!='All'){
  $sortby = mysqli_real_escape_string($con, $_POST['sortby']);
  $query = "SELECT * FROM notes WHERE name='$name' and genre = '$sortby' ORDER BY note";

}
$sqlresult = mysqli_query($con, $query) or die ("Unable to query notes");

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