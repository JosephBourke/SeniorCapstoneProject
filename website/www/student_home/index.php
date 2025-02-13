<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<style>
		.side {
			width: 50%;
			float: left;
		}

		h2, ul {
			text-align: center;
		}
	</style>
</head>

<body>
	<?php
	// $pickupDate = $_POST['pickupDate'];
	// $returnDate = $_POST['returnDate'];
	// $user = $_POST['user'];
	// $equipment = $_POST['equipment'];
	
	
	
	
	
	
	?>




<div class="side" id="available">
		<h2>Available Equipment</h2>
		<ul>
		<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="faculty";
$password="P@ssw0rd";
$dbname="mydb";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die ('Could not connect to the database server' . mysqli_connect_error());
//$con->close();
$query = "SELECT id, name, description FROM equipment";
if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($id, $name, $description);
    while ($stmt->fetch()) {
        //printf("%s, %s, %s\n", $id, $name, $description);
        // echo "<option value=".$id.">".$name."</option>";
		echo "<li><a href=\"new_request/index.html\">".$name."</a></li>";
    }
    $stmt->close();
}
?>



</ul>
	</div>
	<div class="side" id="checkedout">
		<h2>Checked Out Equipment</h2>
		<?php
		// if (isset($equipment)) {
		// 	?>
		// 	<table>
		// 		<tr><th>Equipment</th><td><a href="view_request_details/index.html"><?php echo $equipment; ?></a></td></tr>
		// 		<tr><th>Status</th><td>Pending</td></tr>
		// 		<tr></tr>
		// 	</table>
		// 	<?php
		// }
		?>
	</div>
</body>

</html>