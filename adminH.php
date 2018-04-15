<?php
	include 'connectivity.php';
	session_start();
	$status = "";

	$sql = "select * from requested where status = 0";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);


	if(isset($_POST['download'])){
		$id = $_POST['id'];
		
		$sql = "select * from uploads where id = '$id'";
		$result = mysqli_query($con,$sql);	

		$row = mysqli_fetch_array($result);
		$file_name = $row['location'];

		$source = "uploads/".$file_name;
		$target = "downloads/".$file_name;


		if (file_exists($target)) {
			$status = "<h3 class='bg-danger'>Sorry, file already exists.</h3>";
		}
		else{	
			copy($source,$target);
			$status = "<h3 class='bg-success'> ".$file_name."  downloaded to downloads folder</h3>";
		}
	}


		$sql = "select * from uploads as u,faculty as f where u.mis = f.mis";
		$result = mysqli_query($con,$sql);	
		if($result){
			$table = '<div class="table">';
			$table .= "<table id='abc' class='table table-striped'>";
			$table .=	"<tr>
				<th>ID</th>
				<th>Teachaer</th>
				<th>Title of Doc</th>
				<th>Type of Doc</th>
				<th>Date on Doc</th>
				<th>Date of Upload</th>
				<th>Document</th>
				<th>Download</th>
				</tr>";
			while($row = mysqli_fetch_array($result)){				
				$table .= '<form action="adminH.php" method="post" enctype="multipart/form-data">';
					$table .= "<tr>";
					$table .= "<td>" . $row['id'] . "</td>";
					$table .= "<td>" . $row['fname']." ".$row['lname'] . "</td>";
					$table .= "<td>" . $row['title'] . "</td>";
					$table .= "<td>" . $row['type'] . "</td>";
					$table .= "<td>" . $row['date_on_doc'] . "</td>";
					$table .= "<td>" . $row['date_of_upload'] . "</td>";
					$table .= "<td>" . $row['location'] . "</td>";
					$table .= '<td><input type="hidden" name="id" value='.$row["id"].'/><input type="submit" value="download" name="download"></td>';
					$table .= "<tr>";				
				$table .= '</form>';					
			}
			
			$table .= '</div>';
			$table .= "</table>";
			$table .= '<div>';
		}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Homepage</title>
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
				<li class="active"><a href="#">Home</a></li>
				<li><a href="download.php">Sort and Download</a></li>
				<li><a href="showAllTeachers.php">Show All Teachers</a></li>
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
		<?php echo $status; ?>
	</div>	
	<div class="col-lg-12">
		<h3 align="center" class="well">Documents</h3>
		<div class="row">
				<?php echo $table; ?>
		</div>
</div>

</body>
</html>


