<!DOCTYPE html>

<html lang="en">

<head>
	<title>Check In</title>
	<link href="../css/stylesheet.css" type="text/css" rel="stylesheet" />

	<style>
		div.search {
			position: relative;
			top: 150px;
			z-index: 1;
			background: lightgrey;
			max-width: 350px;
			margin: 0 auto 100px;
			padding: 20px;
			/* padding-bottom: 25px; */
			text-align: center;
		}
	</style>
</head>

<body>
	<header>
		<strong>Check In</strong>
	</header>

	<div class="search">
		<form name="search" id="search" action="check_in.php" method="post">
			<strong>Scan Barcode: </strong><input type="text" name="barcode" id="barcode">
			<input type="submit" value="Search">
		</form>
	</div>

	<table style="width:80%" class="center">
		<?php
		$host = "127.0.0.1"; # change this to match the ip address for your virtual machine
		$port = 3306;
		$user = "faculty";
		$password = "P@ssw0rd";
		$dbname = "MariaSQL";

		# this is currently actually equipment that is not available
		$con = new mysqli($host, $user, $password, $dbname, $port)
			or die('Could not connect to the database server' . mysqli_connect_error());

		# If the barcode part is set, it will collect a bunch of information related to that barcode.
		if (isset($_POST["barcode"])) {

			$barcode = $_POST["barcode"];
			$query = <<<MySQL_Query
						SELECT u.uid, u.username, c.equipmentid, c.checkoutdate, c.duedate, c.id, e.name 
						FROM user u, checkout c, equipment e 
						WHERE e.barcode = $barcode AND c.equipmentid = e.id AND u.uid = c.studentid AND c.checkindate IS NULL
						MySQL_Query;
			if ($stmt = $con->prepare($query)) {
				$stmt->execute();
				$stmt->bind_result($uid, $username, $equipmentid, $checkoutdate, $duedate, $cid, $name);
				$iter = 0;
				while ($stmt->fetch()) {

					# If the iter variable is 0, your username and user ID will print out.
					# Afterwards, it willl print out name, checkout date, and due date along with a submit button and a hidden cid value.
					if ($iter === 0) {
						echo "<tr><th>$username</th><th>$uid</th><th></th><th></th></tr>";
					}
					echo <<<STR
						<tr><td>$name</td><td>Checked out: $checkoutdate</td><td>Due: $duedate</td><td>
						<form name="checkin" id="checkin" action="check_in.php" method="post">
						<input type="submit" value="Check in">
						<input type="hidden" value="$cid" name="hidden" id="hidden">
						</form></td></tr>
						STR;
					$iter++;
				}

			}
			$stmt->close();
		}

		# If hidden is set, the checkin date on the checkout table will be updated to what is now where id is equal to the hidden variable.
		if (isset($_POST["hidden"])) {
			$hidden = $_POST["hidden"];
			# UPDATE statement not working 
			$now = date("y-m-d H:i:s");
			$query = "UPDATE checkout SET checkindate = '$now' WHERE id = $hidden";
			$stmt = $con->prepare($query);
			$stmt->execute();

			echo "<script>alert(\"Submission was successful.\");</script>";
			$stmt->close();
		}
		?>
	</table>
</body>

</html>