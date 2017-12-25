<?php

include("connect.php");
include("functions.php");

if(!logged_in())
{
	header("location:login.php");
	exit();
}
function profile_image_show(){
	$filesearch = $_SESSION['username'];
	$files = glob("img/*".$filesearch."*");
	if(count($files)>0) {
		foreach($files as $kk){return($kk);}
	}
	else return "pro.jpg";
}
?>
<!doctype html>
<html>
<head>
	<title>Notes App - Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link rel="icon" href="icon.png" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			// $('#genre').on("change",function (event){
			$(document).on('click','#genre',function(){
				var genre = $('#genre').val();
				// console.log(genre);
				if(genre == 'new-genre'){
					$('#add-new-genre').html('<input id="new-genre" type="text" placeholder="Enter genre here.." name="genre" class="add" maxlength="255" ><br>');
				}
				else{
					$('#add-new-genre').html('');
				}
			});
		});
		$(document).ready(function() {
			var len = 0;
			var maxchar = 255;
			$( "#remainingC" ).html( "Remaining characters: " +"255" );
			$( '#new-note' ).keyup(function(){
				len = this.value.length
				if(len > maxchar){
					return false;
				}
				else if (len > 0) {
					$( "#remainingC" ).html( "Remaining characters: " +( maxchar - len ) );
				}
				else {
					$( "#remainingC" ).html( "Remaining characters: " +( maxchar ) );
				}
			})
		});

		function remove(id){
			$.ajax({
				type:'GET',
				url : 'remove.php',
				data :{'id':id},
				success : function(data){
					$("#show-notes").html(data);
				}
			});
		}
		function edit(id){
			// console.log(document.getElementById('genre'));
			$.ajax({
				type:'GET',
				url : 'edit.php',
				data :{'id':id},
				success : function(data){
					$("#add-edit").html(data);
				}
			});
		}

		function mySearch(){
			var text = $('#search-box').val();
			if(text!='')
			{
				$.ajax({
					type:'GET',
					url : 'search.php',
					data :{'search':text},
					success : function(data){
						$("#show-notes").html(data);
					}
				});
				$("#search-box").val('');
			}
		}

		function resetSearch(){
			$.ajax({
				type:'GET',
				url : 'search.php',
				data :{},
				success : function(data){
					$("#show-notes").html(data);
				}
			});
		}

		$(document).ready(function(){
			$(document).on('click','#add-note',function(){
				var note = $('#new-note').val();
				var genre = $('#genre').val();
				if(genre == 'new-genre'){
					genre = $('#new-genre').val();
						if(genre == ''){
							genre = 'general';
							// console.log('Please add a genre');
							window.alert('Please add a genre');
							// return;
						}
						// $('#genre').append('<option selected="selected" value='+genre+'>'+genre+'</option>');
						// $('#add-new-genre').html('');
				}
				var options = document.getElementById('genre').getElementsByTagName('option');
				var i;
			 	var flag = true;
				for (i = 0; i < options.length; i++) {
		    			// console.log(options[i].getAttribute('value'));
		    			if(options[i].getAttribute('value') == genre){
		    				//options[i].setAttribute('selected', 'selected');
		    				$('#genre').val(genre);
		    				flag = false;
		    			}
					}
				
				if(flag){
					$('#genre').append('<option selected="selected" value='+genre+'>'+genre+'</option>');
				}
				$('#add-new-genre').html('');
				var id  = $('#note-id').val();
				// console.log(note+' '+genre+' '+id);
				if(note!=''){
					if(id!=''){
						$.ajax({
							type:'POST',
							url : 'add.php',
							data :{'note':note,'id':id,'genre':genre},
							success : function(data){
								$("#show-notes").html(data);
							}
						});
					}
					else{
						$.ajax({
							type:'POST',
							url : 'add.php',
							data :{'note':note,'genre':genre},
							success : function(data){
								$("#show-notes").html(data);
							}
						});
					}
				}
				else{
					window.alert("Seems like you are trying to add an EMPTY note !!!!!!");
				}
				$("#new-note").val('');
				$("#note-id").val('');
				$("#add-note").val('add-note');
			});
		});
		$(document).ready(function(){
			$('#images').on("change",function (event){
				var form = document.querySelector('form');
				var formdata =new FormData(form);
				var file = event.target.files[0];
				
				if(!file.type.match('image/.*')){
					window.alert( "Only Image formats are allowed.");
					return;
				}
				if(file.size >= 2*1024*1024){
					window.alert("Seems like you are trying to upload a very BIG file. ("+parseInt(file.size/1024/1024)+" mb)(File Limit : 2 mb)");
					return;					
				}
				
				if (formdata) {	
					$.ajax({
						url: "upload.php",
						type: "POST",
						data: formdata,
						processData: false,
						contentType: false,
						success: function (res) {
							document.getElementById("profile-image").innerHTML = res; 
						}
					});
				}
			});
		});

		
	</script>
</head>
<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><img src="icon.png"  style="position:relative; top:-20%; width:25pt; height:25pt;"></a>
			</div>
			<ul class="nav navbar-nav navbar-left">
				<li><a href="#" style="font-size:15pt;"> Notes-App</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="changepassword.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
			</ul>
		</div>
	</nav>

	<div class="window">
		<div class="overlay"></div>
		<div class="box header">
			<form action="" method="post" enctype="multipart/form-data">
				<input class = "hidden"  id = "images" name = "images" type="file" accept="image/*|.jpg|.png|.jpeg|.gif">
				<div id="profile-image">
					<img src="<?php echo profile_image_show();
					?>" alt="" onclick = "$('#images').click();"} />
				</div>		
			</form>

			<h2><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h2>
			<h4><?php echo  "@".$_SESSION['username']; ?></h4>
		</div>
		<div class="box footer">
			<div id="add-edit">	
				<input id="note-id" hidden value="">	
				<select  id='genre' name="genre" class='form-control'>		
					<?php
					$name  = $_SESSION['username'];
					$sqlresult = mysqli_query($con, "SELECT distinct(genre) FROM notes WHERE name = '$name'") or die ("Unable to query genre notes");
					while($Row = mysqli_fetch_array($sqlresult)){
						echo "<option value='".$Row['genre']."'>".$Row['genre']."</option>";	
					}
					?>
					<option value='new-genre'>Add New</option>
				</select>

				<div class="wrap">
					<span id = 'add-new-genre'></span>
					<br/>
					<input id="new-note" type="text" placeholder="Enter note here.." name="note" class="add" maxlength="255" >
					<span id='remainingC'></span>
					<br/>
					<!-- <div class="bg"></div> -->
				</div>
				<br>
				<input id="add-note" type="submit"  class="btn"  name="submit" value="add-note" />
			</div>
		</div>
	</div>


	<div class="material-wrap">
		<div class="material clearfix">
			<div class="top-bar">
				<div class="pull-left">
					<a href="#" class="menu-tgl pull-left"><i class="fa fa-bars"></i></a>
				</div>
				<span class="title">Notes</span>
				<div class="pull-right">
					<input type="text" placeholder="Search Notes..." class="col-md-8" id="search-box">
					<a href="#" class="search-tgl" onclick="mySearch()"><i class="fa fa-search"></i></a>
					<a href="#" onclick="resetSearch()" class="option-tgl"><i class="fa fa-refresh"></i></a>
				</div>
			</div>
			<div class="profile">
				<div class="cover">
					<span class="vec vec_a"></span>
					<span class="vec vec_b"></span>
					<span class="vec vec_c"></span>
					<span class="vec vec_d"></span>
					<span class="vec vec_e"></span>
				</div>
			</div>
			<div class="tabs clearfix">
				<a href="#">Your Notes</a>
			</div>
			<div class="tabs-content">
				<div class="friend-list">
					<div class="list-ul">
						<div id="show-notes">
							<?php
							$name = $_SESSION['username'];
							$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE name='$name'");

							while($Row = mysqli_fetch_array($sqlresult)){
								$id = $Row['id'];
								echo "<div class='list-li clearfix'>
								<div class='info pull-left'>
								<div class='name'>".$Row['note']."</div>
								</div> ";
								echo '<div class="action pull-right"><a id="edit_note"  onclick="edit(\''.$Row['id'].'\')"><i class="fa fa-edit"></i></a>';
								echo '<a id="remove_note" onclick="remove(\''.$Row['id'].'\')"><i class="fa fa-trash-o"></i></a></div></div>';

							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
