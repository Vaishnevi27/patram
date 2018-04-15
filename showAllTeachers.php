<?php

	include 'connectivity.php';
	$sql = "select * from requested where status = 0";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	
	$sql = "select * from faculty";
	$result = mysqli_query($con,$sql);	
	if($result){
	
		$table = '<div class="table">';
		$table .= '<form action="showAllTeachers.php" method="post" enctype="multipart/form-data">';
		$table .= "<table id='abc' class='table table-striped'>";
		$table .=	"<tr>
			<th>MIS</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>No_of_papers</th>
			<th>No_of_conferences</th>
			<th>No_of_visits</th>
			<th>Message</th>
			<th>Details</th>
			<th>
			</tr>";
		while($row = mysqli_fetch_array($result)){
			$mis = $row['mis'];
			
			$r1 = mysqli_query($con, "select count(mis) as count from uploads where (mis='$mis' and type = 'paper')");
			$r2 = mysqli_query($con, "select count(mis) as count from uploads where (mis='$mis' and type = 'conference')");
			$r3 = mysqli_query($con, "select count(mis) as count from uploads where (mis='$mis' and type = 'visit')");
			
			$no_of_papers = mysqli_fetch_array($r1);
			$no_of_conferences = mysqli_fetch_array($r2);
			$no_of_visits = mysqli_fetch_array($r3);
			
			$table .= "<tr>";
			$table .= "<td>" . $row['mis'] . "</td>";
			$table .= "<td>" . $row['fname'] . "</td>";
			$table .= "<td>" . $row['lname'] . "</td>";
			$table .= "<td>" . $row['email'] . "</td>";
			$table .= "<td>" . $row['mobile'] . "</td>";
			$table .= "<td>" . $no_of_papers['count'] . "</td>";
			$table .= "<td>" . $no_of_conferences['count'] . "</td>";
			$table .= "<td>" . $no_of_visits['count'] . "</td>";
			$table .= '<td><input type="submit" value="message" name="message"></td>';
			$table .= '<td><input type="submit" value="ShowDetails" name="showDetails"></td>';
			$table .= "<tr>";
			$table .= '</form>';
		}
		$table .= "</table>";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
				<li class="active"><a href="showAllTeachers.php">Show All Teachers</a></li>
				<li><a href="confirm_faculty.php">Account Requests&#160;<span class="badge"><?php echo $count; ?></span></a></li>
				<li><a href="AdminchangePassword.php">Change Password</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>You are logged in as <i><b>Admin</b></i></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
	<div class="col-lg-12">
		<h3 align="center" class="well">All Teachers</h3>
		<div class="row">
				<?php echo $table; ?>
		</div>
	</div>
</div>
