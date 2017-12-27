<?php
include ("connect.php");
include("functions.php");
if(!logged_in())("Location: login.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE id='$id'") or die ("Unable to query notes");
$res = mysqli_fetch_array($sqlresult);
$note = $res['note'];
$date = $res['date'];
echo '
        <input id="note-id" hidden value="'.$id.'">
                <select  id="genre" name="genre" class="form-control" style="background-color: #cbe07d">';
                    $name  = $_SESSION['username'];
                    $sqlresult = mysqli_query($con, "SELECT distinct(genre) FROM notes WHERE name = '$name'") or die ("Unable to query genre notes");
                    while($Row = mysqli_fetch_array($sqlresult)){
                        if($Row['genre'] == $res['genre'])
                            echo "<option selected='selected' value='".$Row['genre']."'>".$Row['genre']."</option>";
                        else
                            echo "<option value='".$Row['genre']."'>".$Row['genre']."</option>";
                    }
                    echo'
                    <option value="new-genre">Add New</option>
                </select>

                <div class="wrap">
                    <span id = "add-new-genre"></span>
                    <br/>
                    <input id="new-note" type="text" placeholder="Enter note here.." name="note" class="add" maxlength="255" value = "'.$note.'">
                    <span id="remainingC"></span>
                   <br/>
					<br/><input id="datepicker" type="text" placeholder="To be notified on.." value="'.$date.'" />
					<br/><!-- <div class="bg"></div> -->
                </div>
                <br>
                <input id="add-note" type="submit"  class="btn"  name="submit" value="edit-note" />

';

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
 $(document).ready(function() {
		    $("#datepicker").datepicker();
		  });
</script>