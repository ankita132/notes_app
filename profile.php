<?php

	include("connect.php");
	include("functions.php");

        $name = $_SESSION['username'];

	if(isset($_POST['submit'])){
		 $note = mysqli_real_escape_string($con, $_POST['note']);
		 $insertQuery = "INSERT INTO notes(note, name) VALUES ('$note', '$name')";

		 if(mysqli_query($con, $insertQuery))
		 {
		 	$error = "Note added";
		 }
		 else
		 {
		 	$error = "Cannot add note!!";
		 }
	}

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
	   <form method="POST" action="profile.php">
			 <div class="wrap">
  <input type="text" placeholder="Enter note here" name="note" class="add"><br/><br/>
  <div class="bg"></div>
			</div>
	   <input type="submit"  class="btn"  name="submit" value="add-note" />
	 </form>
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
			<a href="#" class="search-tgl pull-left"><i class="fa fa-search"></i></a>
			<a href="#" class="option-tgl pull-left"><i class="fa fa-ellipsis-v"></i></a>
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
<?php
$name = $_SESSION['username'];
$sqlresult = mysqli_query($con, "SELECT * FROM notes WHERE name='$name'");

while($Row = mysqli_fetch_array($sqlresult)){
	$id = $Row['id'];
	echo "<div class='list-li clearfix'>
		<div class='info pull-left'>
			<div class='name'>".$Row['note']."</div>
		</div> ";
	echo '<div class="action pull-right"><a id="remove_note" href="remove.php?id='.$Row['id'].'"><i class="fa fa-trash-o"></i></a></div></div>';
}
 ?>
			</div>
		</div>
	</div>
</div>
</div>

</body>
</html>
