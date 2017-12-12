<?php

	include("connect.php");
	include("functions.php");

	if(!logged_in())
	{
		header("location:login.php");
		exit();
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
			var id  = $('#note-id').val();

			if(note!=''){
				if(id!=''){
					$.ajax({
						type:'POST',
						url : 'add.php',
						data :{'note':note,'id':id},
						success : function(data){
							$("#show-notes").html(data);
						}
					});
				}
				else{
					$.ajax({
						type:'POST',
						url : 'add.php',
						data :{'note':note},
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
	    	<img src="pro.jpg" alt="" />
	    	<h2><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h2>
	    	<h4><?php echo  "@".$_SESSION['username']; ?></h4>
	  	</div>
	  	<div class="box footer">
	   		<!-- <form method="POST" action="add.php"> -->
			<div id="add-edit">
				<div class="wrap">
  					<input id="new-note" type="text" placeholder="Enter note here.." name="note" class="add" maxlength="255" ><span id='remainingC'></span>
  					<br/><br/>
  					<div class="bg"></div>
				</div>
				<input id="note-id" hidden value="">
	   			<input id="add-note" type="submit"  class="btn"  name="submit" value="add-note" />
	  		</div>
	  		<!-- </form> -->
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
