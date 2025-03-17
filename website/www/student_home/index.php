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

		table, td {
			border: 1px solid black;
			border-collapse: collapse;
		}

		table.center {
			margin-left: auto;
			margin-right: auto;
		}

		body {
			background: rgb(244, 243, 243);
			font-family: "Roboto", sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
	</style>
</head>

<body>
	<?php
	$pickupDate = $_POST['pickupDate'];
	$returnDate = $_POSt['returnDate'];
	$user = $_POST['user'];
	$equipment = $_POST['equipment'];

	$host = "127.0.0.1";
	$port = 3306;
	$socket = "";
	$user = "faculty";
	$password = "P@ssw0rd";
	$dbname = "mydb";
	?>
	<div class="side" id="available">
		<h2>Available Equipment</h2>
		<table style="width:80%" class="center"><tr>
		<?php
		$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
			or die('Could not connect to the database server' . mysqli_connect_error());
		
		$query = "SELECT e.id, e.name from equipment e, checkout c where e.id = c.equipment_id and c.checkintime is null";
		if ($stmt = $con->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($id, $name);
			while ($stmt->fetch()) {
				echo "<tr><td><a href=". "new_request/index.php" .">" . $name . "</option>";
			}
			$stmt->close();
		}
		?>
		</table>
	</div>
	<div class="side" id="checkedout">
		<h2>Checked Out Equipment</h2>
		<?php
		//if (isset($equipment)) {
		?>
		<table>
			<tr>
				<th>Equipment</th>
				<td><a href="view_request_details/index.html"><?php echo $equipment; ?></a></td>
				<th>Status</th>
			</tr>
			<tr>
				<td>Pending</td>
			</tr>
			<tr></tr>
		</table>
		<?php
		//}
		
		?>
	</div>
</body>



<?php


$equipment_id = $_POST["equipment"];
$user_id = 1234567;
$date = date('YmdHis');
$description = $_POST["returnDate"];

// $host = "127.0.0.1";
// $port = 3306;
// $socket = "";
// $user = "faculty";
// $password = "P@ssw0rd";
// $dbname = "mydb";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die('Could not connect to the database server' . mysqli_connect_error());


if(isset($_POST["equipment"]))
{

	$query = "INSERT INTO request (description, create_time, user_id, equipment_id) VALUES (\"$description\", $date ,$user_id, $equipment_id);";

	if ($stmt = $con->prepare($query)) {
		$stmt->execute();
	}
}
?>

</html>