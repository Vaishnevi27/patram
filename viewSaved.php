<?php

	include 'connectivity.php';
	session_start();
	$_SESSION['ids'] = array();

	if(sizeof($_SESSION['saved']) == 0){
		echo "Nothing";
	}
	else{
		echo '<form action="download.php" method="post" enctype="multipart/form-data">';
		echo "<table id='abc' class='x' border-collapse: collapse'>";
		echo	"<tr>
			<th>id</th>
			<th>mis</th>
			<th>title</th>
			<th>type</th>
			<th>date_on_doc</th>
			<th>date_of_upload</th>
			<th>location</th>
			</tr>";
		foreach($_SESSION['saved'] as $id){

			$sql = "select * from uploads where id = $id";
			$result = mysqli_query($con,$sql);	
			$row = mysqli_fetch_array($result);
				echo "<tr>";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['mis'] . "</td>";
				echo "<td>" . $row['title'] . "</td>";
				echo "<td>" . $row['type'] . "</td>";
				echo "<td>" . $row['date_on_doc'] . "</td>";
				echo "<td>" . $row['date_of_upload'] . "</td>";
				echo "<td>" . $row['location'] . "</td>";
				echo "<tr>";
			
		}
		echo "</table>";
		echo '<input type="submit" value="addMore" name="add">';
		echo '<input type="submit" value="DownloadAll" name="download">';
		echo '</form>';
	}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_view_emp.css">
</head>
</html>
