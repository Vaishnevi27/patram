<?php
	session_start();
	include 'connectivity.php';
	$table = "";
	$page = "";	
	$status = "";
	$mis = "";
	$types = -1;
	$type = "";
	$start_date = date("Y-m-d", mktime(0,0,0,1,1,1950));
	$end_date = date("Y-m-d", mktime(0,0,0,1,1,2050));

	$sql = "select * from requested where status = 0";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);

	$sql = "select * from faculty";
	$result1 = mysqli_query($con,$sql);	
	
	if(isset($_POST['save']) || isset($_POST['add'])){
		foreach($_SESSION['ids'] as $id){
			$_SESSION['saved'][] = $id;
		}
		$_SESSION['saved'] = array_unique($_SESSION['saved']);
	}
	if(isset($_POST['saved'])){
		$_SESSION['ids'] = array();
		$page = "Saved";
		if(sizeof($_SESSION['saved']) == 0){
			$table = "Nothing";
		}
		else{
			$table = '<div class="table">';
			$table .= '<form action="download.php" method="post" enctype="multipart/form-data">';
			$table .= "<table id='abc' class='table table-striped'>";
			$table .=	"<tr>
				<th>ID</th>
				<th>Teachaer</th>
				<th>Title of Doc</th>
				<th>Type of Doc</th>
				<th>Date on Doc</th>
				<th>Date of Upload</th>
				<th>Document</th>
				</tr>";
			foreach($_SESSION['saved'] as $id){

				$sql = "select * from uploads as u,faculty as f where u.mis = f.mis and id = $id";
				$result = mysqli_query($con,$sql);	
				$row = mysqli_fetch_array($result);
				$table .= "<tr>";
				$table .= "<td>" . $row['id'] . "</td>";
				$table .= "<td>" . $row['fname']." " .$row['lname'] . "</td>";
				$table .= "<td>" . $row['title'] . "</td>";
				$table .= "<td>" . $row['type'] . "</td>";
				$table .= "<td>" . $row['date_on_doc'] . "</td>";
				$table .= "<td>" . $row['date_of_upload'] . "</td>";
				$table .= "<td>" . $row['location'] . "</td>";
				$table .= "<tr>";				
			}
			
			$table .= '</div>';
			$table .= "</table>";
			$table .= '<div>';
			$table .= '<div class="row">
						<div class="col-sm-1 form-group">
							<label> &#160; </label>
						</div>
						<div class="col-sm-5 form-group">
							<input type="submit" value="addMore" name="add" style="float: right" class="btn btn-lg btn-info">
						</div>
						<div class="col-sm-4 form-group">
							<input type="submit" value="DownloadAll" name="download" style="float: left" class="btn btn-lg btn-info">					
						</div>
						<div class="col-sm-2 form-group">
							<label> &#160; </label>
						</div>
				</form>
				</div>'	;					

		}
	}
	if(isset($_POST['download'])){
		$_SESSION['saved'] = array();
		$folder_name = date('Y-m-d H:i:s');
		$path = "downloads/".$folder_name;
		mkdir($path, 0777, true);
		$source_path = "uploads/"; 
		$target_path = $path."/";
		
		foreach($_SESSION['ids'] as $id){
			$sql = "select * from uploads where id = $id";
			$result = mysqli_query($con,$sql);	
			$row = mysqli_fetch_array($result);
			$file_name = $row['location'];

			$source = $source_path.$file_name;
			$target = $target_path.$file_name;
			copy($source,$target);

		}		
		if (file_exists($target)) {
			$status .= "<h3 class='bg-success'>files downloaded to  \" ".$target_path." \"   folder </h3>";
		}
		else {
				$status .= "<h3 class='bg-danger'>Something went wrong </h3>";
		}
		
	}

	if(isset($_POST['filter'])){
		$page = "Filtered Documents";
		$_SESSION['ids'] = array();

		//teacher_filter
		$teacher = $_POST['teacher'];
		$teacher_filter = "true";
		if($teacher != "0"){
			$teacher_filter = "fname = '$teacher'";;
		}

		//date_filter
		if(isset($_POST['start'])){
			$start_date = $_POST['start'];
		}
		if(isset($_POST['end'])){
			$end_date = $_POST['end'];
		}
		$date_filter = "date_on_doc > '$start_date' and date_on_doc < '$end_date'";

		//type_filter
		$types = sizeof($_POST['type_list']);
		if($types == 0){
			$type_filter = "type = 'paper' || type = 'conference' || type = 'visit'";
		}
		else{
			foreach($_POST['type_list'] as $selected){
				if($types == 1){
					$type_filter .= "type = '$selected'";
					$types--;
				}
				else{
					$type_filter .= "type = '$selected' || ";
					$types--;
				}
			}
		}

		$sql = "select * from uploads as u,faculty as f where u.mis = f.mis and (".$date_filter.") and (".$type_filter.") and (".$teacher_filter.")  order by date_on_doc";
		$result = mysqli_query($con,$sql);	
		if($result){
			$table = '<div class="table">';
			$table .= '<form action="download.php" method="post" enctype="multipart/form-data">';
			$table .= "<table id='abc' class='table table-striped'>";
			$table .=	"<tr>
				<th>ID</th>
				<th>Teachaer</th>
				<th>Title of Doc</th>
				<th>Type of Doc</th>
				<th>Date on Doc</th>
				<th>Date of Upload</th>
				<th>Document</th>
				</tr>";
			while($row = mysqli_fetch_array($result)){
				$_SESSION['ids'][] = $row['id'];
				$table .= "<tr>";
				$table .= "<td>" . $row['id'] . "</td>";
				$table .= "<td>" . $row['fname']." ".$row['lname'] . "</td>";
				$table .= "<td>" . $row['title'] . "</td>";
				$table .= "<td>" . $row['type'] . "</td>";
				$table .= "<td>" . $row['date_on_doc'] . "</td>";
				$table .= "<td>" . $row['date_of_upload'] . "</td>";
				$table .= "<td>" . $row['location'] . "</td>";
				$table .= "<tr>";
			}
			$table .= "</table>";
			$table .= '<div>';
			$table .= '<div class="row">
						<div class="col-sm-1 form-group">
							<label> &#160; </label>
						</div>
						<div class="col-sm-5 form-group">
							<input type="submit" value="save" name="save" style="float: right" class="btn btn-lg btn-info">
						</div>
						<div class="col-sm-4 form-group">
							<input type="submit" value="DownloadAll" name="download" style="float: left" class="btn btn-lg btn-info">					
						</div>
						<div class="col-sm-2 form-group">
							<label> &#160; </label>
						</div>
				</form>
				</div>'	;					

		}
		else{
			$err .= "No entry";	
		}
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
				<li class="active"><a href="download.php">Sort and Download</a></li>
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
	<div class="col-lg-3 well">
    <h1 align="center" class="well">Filters</h1>
	<div class="row">
			<form action="download.php" method="post" enctype="multipart/form-data">
			<div class="col-sm-12">
				<div class="row">
						<div class="col-sm-12 form-group">
								<label for="teacher">Teacher ( optional ) :</label>    
								<select name="teacher" id="teacher">	
									<option value="0">Please Select a teacher</option>
									<?php
										while($row1 = mysqli_fetch_array($result1)):;?>
										<option><?php echo $row1['fname'];?></option>
									<?php endwhile;?>									
								</select>
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-6 form-group">
							<label for="start">Start :</label> <br/>   
							<input type="date" name="start" id="start" min="1950-01-01" max="2050-01-01" value="<?php echo $start_date; ?>">
						</div>
						<div class="col-sm-6 form-group">
							<label for="end">End :</label>   <br/> 
							<input type="date" name="end" id="end" min="1950-01-01" max="2050-01-01" value="<?php echo $end_date; ?>">
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-4 form-group">
							<input type="checkbox" name="type_list[]" value="paper" id="paper" >
							<label for="paper"> paper</label>
						</div>
						<div class="col-sm-4 form-group">
							<input type="checkbox" name="type_list[]" value="conference" id="conference" >
							<label for="conference"> conference</label>
						</div>
						<div class="col-sm-4 form-group">
							<input type="checkbox" name="type_list[]" value="visit" id="visit">
							<label for="visit"> visit</label>
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-1 form-group">
							<label> &#160; </label>
						</div>
						<div class="col-sm-5 form-group">
							<input type="submit" name="filter" value="Filter" style="float: left" class="btn btn-lg btn-info">					
						</div>
						<div class="col-sm-4 form-group">
							<input type="submit" name="saved" value="Show saved" style="float: right" class="btn btn-lg btn-info">					
						</div>
						<div class="col-sm-2 form-group">
							<label> &#160; </label>
						</div>
				</div>						
			</div>
			</form>
	</div>
	</div>

	<div class="col-lg-9 well">
		<?php echo $status; ?>
		<h1 align="center" class="well"><?php echo $page; ?></h1>
		<div class="row">
				<?php echo $table; ?>
		</div>
	</div>
</div>
</body>
</html>

