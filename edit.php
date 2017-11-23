<?php
include ("connect.php");
include("functions.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE id='$id'") or die ("Unable to query notes");
$res = mysqli_fetch_array($sqlresult);
$note = $res['note'];

echo '<div class="wrap">
<input id="new-note" type="text" placeholder="Enter note here" name="note" class="add" value="'.$note.'"><br/><br/>
<div class="bg"></div>
</div>
<input id="note-id" hidden value="'.$id.'">
<input id="add-note" type="submit"  class="btn"  name="submit" value="edit-note" />';


?>