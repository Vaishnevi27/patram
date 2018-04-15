<?php
	include 'connectivity.php';
	session_start();
	$id = $_SESSION['id'];	
	
	if(isset($_POST['update'])){

		$title = $_POST['title'];
		$type = $_POST['type1'];
		$date_of_upload = date('Y-m-d H:i:s');
		$date_on_doc = $_POST['date'];
		$description = $_POST['description'];
		$filename = basename($_FILES["fileToUpload"]["name"]);

		$sql = "update uploads set title = '$title', type = '$type', date_on_doc = '$date_on_doc', date_of_upload = '$date_of_upload', location = '$filename' where id ='$id'";
		$result = mysqli_query($con, $sql);
		
		header('location:showUploads.php');	
		
	}

	$sql = "select * from uploads where id ='$id'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$title = $row['title'];
	$type = $row['type'];
	$date = $row['date_on_doc'];
	$description = $row['description'];
	$location = $row['location'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faculty Homepage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
<div class="container-fluid">    
	<div class="col-lg-2 well">
	</div>
	
	<div class="col-lg-8 well">
	    <h1 align="center" class="well">Update Upload</h1>
		<div class="row">
				<form action="updateUpload.php" method="post" enctype="multipart/form-data">
				<div class="col-sm-12">
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
									<label for="title">Title</label>    
									<input type="text" name="title" id="title" value="<?php echo $title; ?>">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
					
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<label for="date">Date :</label>    
								<input type="date" name="date" id="date" value="<?php echo $date; ?>">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
					
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<input type="radio" name="type1" value="paper" id="paper" <?php if($type=="paper"){echo 'checked="checked"';} ?>>
								<label for="paper"> paper</label><br>
								<input type="radio" name="type1" value="conference" id="conference" <?php if($type=="conference"){echo 'checked="checked"';} ?>>
								<label for="conference"> conference</label><br>
								<input type="radio" name="type1" value="visit" id="visit" <?php if($type=="visit"){echo 'checked="checked"';} ?>>
								<label for="visit"> visit</label>
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
					
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<label for="description">Description :</label>   
								<input type="text" name="description" id="description" value="<?php echo $description; ?>">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
				
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<label for="fileToUpload">Select file to upload :</label>   
								<input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $location; ?>">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
		     
					<div class="row">
							<div class="col-sm-4 form-group">
								<label> &#160; </label>
							</div>
							<div class="col-sm-2 form-group">
									<input type="submit" value="Update" name="update" style="float: left" class="btn btn-lg btn-info">					
							</div>
							<div class="col-sm-4 form-group">
								<label> &#160; </label>
							</div>
					</div>	
					<div class="row">
							<?php echo $status; ?>					
					</div>
				</div>
				</form>
		</div>
	</div>

	<div class="col-lg-2 well">
		<form action="showUploads.php" method="post">
				<button type="submit" class="btn btn-info">Back</button>  
		</form>
	</div>

</div>

</body>
</html>

