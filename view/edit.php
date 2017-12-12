<?php
include ("connect.php");
include("functions.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE id='$id'") or die ("Unable to query notes");
$res = mysqli_fetch_array($sqlresult);
$note = $res['note'];

echo '<div class="wrap">
<input id="new-note" type="text" placeholder="Enter note here" name="note" class="add" maxlength="255" value="'.$note.'"><br/><span id="remainingC"></span>
<div class="bg"></div>
</div>
<input id="note-id" hidden value="'.$id.'">
<input id="add-note" type="submit"  class="btn"  name="submit" value="edit-note" />';


?>

<script>
$(document).ready(function() {

    var len = document.getElementById('new-note').value.length;
    var maxchar = 255;

    $('#remainingC').html("Remaining characters: " + (maxchar - len));
    $('#new-note').keyup(function() {
        len = this.value.length
        if (len > maxchar) {
            return false;
        } else if (len > 0) {
            $("#remainingC").html("Remaining characters: " + (maxchar - len));
        } else {
            $("#remainingC").html("Remaining characters: " + (maxchar));
        }
    });

    function hello()
    {
    	console.log(this.value.length);
    }

});
</script>