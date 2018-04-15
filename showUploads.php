<?php
	session_start();
	include 'connectivity.php';
	$mis = $_SESSION['mis'];
    $status = "";

	$sql = "select * from messages where mis ='$mis'";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);

	if(isset($_POST['update'])){
		$_SESSION['id'] = $_POST['upId'];
		header('location:updateUpload.php');
	}
	if(isset($_POST['delete'])){
		$id = $_POST['delId'];
		$sql = "delete from uploads where id ='$id'";
		$result = mysqli_query($con, $sql);
		$status = "<h3 class='bg-success'>Deleted successfully </h3>";		
	}
	
	$sql = "select * from uploads as u,faculty as f where u.mis = f.mis and f.mis = '$mis' order by date_on_doc";
	$result = mysqli_query($con,$sql);	
	if($result){
		$table = '<div class="table">';
		$table .= "<table id='abc' class='table table-striped'>";
		$table .=	"<tr>
			<th>ID</th>
			<th>Title of Doc</th>
			<th>Type of Doc</th>
			<th>Date on Doc</th>
			<th>Date of Upload</th>
			<th>Description</th>
			<th>Document</th>
			</tr>";
		while($row = mysqli_fetch_array($result)){
			$_SESSION['ids'][] = $row['id'];
			$table .= '<form action="showUploads.php" method="post" enctype="multipart/form-data">';
				$table .= "<tr>";
				$table .= "<td>" . $row['id'] . "</td>";
				$table .= "<td>" . $row['title'] . "</td>";
				$table .= "<td>" . $row['type'] . "</td>";
				$table .= "<td>" . $row['date_on_doc'] . "</td>";
				$table .= "<td>" . $row['date_of_upload'] . "</td>";
				$table .= "<td>" . $row['description'] . "</td>";
				$table .= "<td>" . $row['location'] . "</td>";

		 		$table .= "<td><input type='hidden' name='upId' value='".$row["id"]."'/><input type='submit' name='update' value='Update' /></td>";
				$table .= "<td><input type='hidden' name='delId' value='".$row["id"]."'/><input type='submit' name='delete' value='Delete' /></td>";
				$table .= "<tr>";
			$table .= '</form>';
		}
		$table .= "</table>";
		$table .= '<div>';
		$table .= '<div class="row" align="center">
						<input type="submit" value="DownloadAll" name="download" class="btn btn-lg btn-info">';					
		$table .= '</div>'	;
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
				<li><a href="facultyH.php">Home</a></li>
				<li class="active"><a href="#">My Uploads</a></li>
				<li><a href="showDrafts.php">Drafts</a></li>
				<li><a href="update_pers1.php">Update Personal info</a></li>
				<li><a href="showMessages.php">Admin Messages&#160;<span class="badge"><?php echo $count; ?></span></a></li>
				<li><a href="changePassword.php">Change Password</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>You are logged in as <i><b>Faculty</b></i></a></li>
				<li><a href="flogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
	<div class="col-lg-12">
		<h1 align="center" class="well">My uploads</h1>
		<div class="row">
				<?php echo $table; ?>
		</div>
	</div>
	
	<div class="col-lg-9 well" align="center">
		<?php echo $status; ?>
	</div>
</div>

</body>
</html>
