<?php
include ("connect.php");
include("functions.php");
if(!logged_in())("Location: login.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql="UPDATE notes
SET pin = CASE WHEN id='$id' and pin = 1 Then 0
WHEN id='$id' and pin = 0 Then 1
ELSE pin
END";

$result = mysqli_query($con, $sql) or die("Unable to pin the note.");
$name = $_SESSION['username'];
$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE name='$name' and pin=1") or die ("Unable to query notes");

								while($Row = mysqli_fetch_array($sqlresult)){
									$pin=$Row['pin'];
									$id = $Row['id'];
									echo "<div class='list-li clearfix'>
									<div class='info pull-left'>
									<div class='name'>".$Row['note']." TAGGED FOR :: ".$Row['date']."</div>
									</div><p class=text-primary><br>|| Last Moditfied on: ";
															echo $Row['modtime'];
          													echo '</p><div class="action pull-right"><a id="edit_note"  onclick="edit(\''.$Row['id'].'\')"><i class="fa fa-edit"></i></a>';
									echo '<a id="pinned_note" onclick="pinned(\''.$Row['id'].'\')"><i class="fa fa-star"></i></a>';
									echo '<a id="remove_note" onclick="remove(\''.$Row['id'].'\')"><i class="fa fa-trash-o"></i></a></div></div>';


								}
$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE name='$name' and pin=0") or die ("Unable to query notes");

								while($Row = mysqli_fetch_array($sqlresult)){
									$pin=$Row['pin'];
									$id = $Row['id'];
									echo "<div class='list-li clearfix'>
									<div class='info pull-left'>
									<div class='name'>".$Row['note']." TAGGED FOR :: ".$Row['date']."</div>
									</div><p class=text-primary><br>|| Last Moditfied on: ";
															echo $Row['modtime'];
          													echo '</p><div class="action pull-right"><a id="edit_note"  onclick="edit(\''.$Row['id'].'\')"><i class="fa fa-edit"></i></a>';
									echo '<a id="pinned_note" onclick="pinned(\''.$Row['id'].'\')"><i class="fa fa-star-o"></i></a>';
									echo '<a id="remove_note" onclick="remove(\''.$Row['id'].'\')"><i class="fa fa-trash-o"></i></a></div></div>';


								}

?>