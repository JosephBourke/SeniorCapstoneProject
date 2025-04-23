<!DOCTYPE html>

<html>

<head>
	<title>Student Home</title>
	<link href="../css/stylesheet.css" type="text/css" rel="stylesheet" />
	<style>
		
	</style>
</head>

<body>
	<header>
		<strong>Student Home</strong>
	</header>
	<?php
	session_start();
	$userid = $_SESSION["userid"];

	$isworking = $_SESSION["userid"];

	echo "<p>".$isworking."</p>";
	
	$host = "127.0.0.1";
	$port = 3306;
	$user = "faculty";
	$password = "P@ssw0rd";
	$dbname = "MariaSQL";
	?>
	<div class="side" id="available">
		<h2>Available Equipment</h2>
		<table style="width:80%" class="center">
			<tr>

				<?php
				# this is currently actually equipment that is not available
				$con = new mysqli($host, $user, $password, $dbname, $port)
					or die('Could not connect to the database server' . mysqli_connect_error());

				# $query = "SELECT e.id, e.name from equipment e, checkout c where e.id = c.equipment_id and c.checkintim e is null";
				# $query = "SELECT e.id, e.name from equipment e, checkout c where e.id = c.equipment_id;";
				$query = "SELECT name, id FROM equipment;";
				
				# This will take the name from each piece of avalable equipment seen in the database and display them accordingly.
				# There are also option selections that will take you to the new request page when clicked.
				if ($stmt = $con->prepare($query)) {
					$stmt->execute();
					$stmt->bind_result($name,$id);
					while ($stmt->fetch()) {
						echo "<tr><td><a href=" . "./new_request.php" . ">" . $name . "</option>";
					}
					$stmt->close();
				}



				?>
		</table>
	</div>
	<div class="side" id="checkedout">
		<h2>Checked Out Equipment</h2>
		<?php
		# if (isset($equipment)) {
		?>
		<!-- This displays each piece of equipment from the database along with a button for each that takes you to the view request details page. -->
		<table>
			<tr>
				<th>Equipment</th>
				<th>Status</th>
			</tr>
			<tr>
				<td><a href="view_request_details/index.html"><?php echo $equipment; ?></a></td>
				<td>Pending</td>
			</tr>
			<tr></tr>
		</table>
		<?php
		# }
		
		?>
	</div>
</body>



<?php


# $equipment_id = $_POST["equipment"];
# $user_id = 123456789;
# $date = date('YmdHis');
# $description = $_POST["returnDate"];

# $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die('Could not connect to the database server' . mysqli_connect_error());

# # This exists to so that the new request can be inserted into the database
# if(isset($_POST["equipment"]))
# {
# 	$query = "INSERT INTO request (description, create_time, user_id, equipment_id) VALUES (\"$description\", $date ,$user_id, $equipment_id);";
# 	if ($stmt = $con->prepare($query)) {
# 		$stmt->execute();
# 	}
# 	echo "<script>alert('Request Successfully Submitted!');</script>";

# }


?>

</html>