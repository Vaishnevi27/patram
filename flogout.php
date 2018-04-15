<?php
	include 'connectivity.php';

	if(isset($_POST['yes'])){
		session_destroy();
		header('Location:login.php');
	}
	if(isset($_POST['no'])){
		header('Location:facultyH.php');
	}	
	mysqli_close($con);
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <title>Logout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" align="center" height="100px">
	<h1>Patram</h1>      
</div>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li><a href="#">&#160;</a></li>
				<li><a href="#">&#160;</a></li>
				<li><a href="#">&#160;</a></li>
				<li><a href="#">&#160;</a></li>
				<li><a href="#">&#160;</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				
				<li><a href="#"></span>&#160;</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="well well-lg" align="center"><h2>Are you sure you want to log out?</h2></div>

</div>

<form action='flogout.php' method='POST' >	
	<div class="container" align="center">
		<button type="submit" name="yes" class="btn btn-success btn-lg">YES</button>
		<button type="submit" name="no" class="btn btn-danger btn-lg">NO</button>    
	</div>

</form>	
	
</body>
</html>

