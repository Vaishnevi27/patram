<?php
    session_start();
	include 'connectivity.php';
	$table = "";
	$status = "";

	$sql = "select * from requested where status = 0";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	
	$sql="SELECT * FROM requested WHERE status = 0";
	$result = mysqli_query($con,$sql);

	$table .= "<table id='abc' class='table table-striped''>";
	$table .= " <thead>";
	$table .=	"<tr>
			<th>MIS</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Approval</th>
			<th>Disapproval</th>
			</tr>";
	 
	while($row = mysqli_fetch_array($result))
	{
		$table .= "<form action = 'confirm_faculty.php' method = 'POST'>";
		$table .= "<tr>";
		$table .= "<td>" . $row['mis'] . "</td>";
		$table .= "<td>" . $row['fname'] . "</td>";
		$table .= "<td>" . $row['lname'] . "</td>";
		$table .= "<td>" . $row['email'] . "</td>";
		$table .= "<td>" . $row['mobile'] . "</td>";

		$table .= "<td><input type='hidden' name='app' value='".$row["mis"]."'/><input type='submit' name='approve' value='Approve' /></td>";
		$table .= "<td><input type='hidden' name='disapp' value='".$row["mis"]."'/><input type='submit' name='disapprove' value='Disapprove' /></td>";

		$table .= "</tr>";
		$table .= "</form>";
			
	}
	$table .= "</tbody>";
	$table .= "</table>";
	
	if(isset($_POST['disapprove'])){
		$mis = $_POST['disapp'];
		$sql = "delete from  requested where mis = '$mis' ;";
		$result = mysqli_query($con,$sql);

		header('Location:confirm_faculty.php');	
	}

	if(isset($_POST['approve'])){
		$mis = $_POST['app'];
		$sql1 = "select fname, lname, email, mobile, password from requested where mis = '$mis' ;";
		$result = mysqli_query($con,$sql1);
		$row = mysqli_fetch_array($result);
		$fn = $row['fname'];
		$ln = $row['lname'];
		$email = $row['email'];
		$mob = $row['mobile'];
		$paw = $row['password'];

		$sql2 = "INSERT INTO faculty (mis, fname, lname, email, mobile) VALUES ('$mis', '$fn', '$ln', '$email', '$mob')";
		$sql3 = "INSERT INTO login (mis, password) VALUES ('$mis', '$paw')";
		$sql4 = "delete from  requested where mis = '$mis' ;";
		$result1 = mysqli_query($con,$sql2);
		$result2 = mysqli_query($con,$sql3);
		$result3 = mysqli_query($con,$sql4);
		
		header('Location:confirm_faculty.php');		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Confirm Account Requests</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="css/template.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.navbar {
			margin-bottom: 0;
			border-radius: 0;
		}

		.row.content {height: 450px}

		.sidenav {
			padding-top: 20px;
			background-color: #f1f1f1;
			height: 100%;
		}

		/* Set black background color, white text and some padding */
		footer {
			background-color: #555;
			color: white;
			padding: 15px;
		}

		/* On small screens, set height to 'auto' for sidenav and grid */
		@media screen and (max-width: 767px) {
			.sidenav {
				height: auto;
				padding: 15px;
			}
			.row.content {height:auto;} 
		}


	</style>
</head>
<body>

<div class="container" align="center" height="100px">
	<h1>Patram</h1>      
</div>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li><a href="adminH.php">Home</a></li>
				<li><a href="download.php">Sort and Download</a></li>
				<li><a href="showAllTeachers.php">Show All Teachers</a></li>
				<li class="active"><a href="confirm_faculty.php">Account Requests&#160;<span class="badge"><?php echo $count; ?></span></a></li>
				<li><a href="AdminchangePassword.php">Change Password</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>You are logged in as <i><b>Admin</b></i></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="col-lg-12">
		<?php echo $status; ?>
	</div>	
	<div class="col-lg-12">
		<h3 align="center" class="well">Requests to Approve</h3>
		<div class="row">
				<?php echo $table; ?>
		</div>
</div>

</body>
</html>

