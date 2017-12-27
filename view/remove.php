<?php
include ("connect.php");
include("functions.php");
if(!logged_in())("Location: login.php");

  if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql="DELETE FROM notes WHERE id='$id'";
    $result = mysqli_query($con, $sql) or die("Unable to delete database entry.");
  }

  $name = $_SESSION['username'];
  $query = "SELECT * FROM notes WHERE name='$name' and pin=1 ORDER BY note";
  if(isset($_POST['genre']) && $_POST['genre']!='All'){
    $genre = $_POST['genre'];
    $query = "SELECT * FROM notes WHERE name='$name' and genre = '$genre' and pin=1 ORDER BY note";
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
   	echo '<a id="pinned_note" onclick="pinned(\''.$Row['id'].'\')"><i class="fa fa-star"></i></a>';
   echo '<a id="remove_note" onclick="remove(\''.$Row['id'].'\')"><i class="fa fa-trash-o"></i></a>
   </div>
   </div>';
 }

   $query = "SELECT * FROM notes WHERE name='$name' and pin=0 ORDER BY note";
   if(isset($_POST['genre']) && $_POST['genre']!='All'){
     $genre = $_POST['genre'];
     $query = "SELECT * FROM notes WHERE name='$name' and genre = '$genre' and pin=0 ORDER BY note";
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
  	echo '<a id="pinned_note" onclick="pinned(\''.$Row['id'].'\')"><i class="fa fa-star-o"></i></a>';
 echo '<a id="remove_note" onclick="remove(\''.$Row['id'].'\')"><i class="fa fa-trash-o"></i></a>
    </div>
    </div>';
  }


 ?>
