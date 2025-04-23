<html>

<head>
	<!-- All this is formatting stuff for the page -->
	<title>Login</title>
	<link href="../css/stylesheet.css" type="text/css" rel="stylesheet" />
	<style>
		.login-page {
			width: 360px;
			padding: 8% 0 0;
			margin: auto;
		}

		.form {
			position: relative;
			z-index: 1;
			background: #FFFFFF;
			max-width: 360px;
			margin: 0 auto 100px;
			padding: 45px;
			text-align: center;
			box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}

		.form input {
			font-family: "Roboto", sans-serif;
			outline: 0;
			background: #f2f2f2;
			width: 100%;
			border: 0;
			margin: 0 0 15px;
			padding: 15px;
			box-sizing: border-box;
			font-size: 14px;
		}

		.form button {
			font-family: "Roboto", sans-serif;
			text-transform: uppercase;
			outline: 0;
			background: rgb(175, 18, 50);
			width: 100%;
			border: 0;
			padding: 15px;
			color: #FFFFFF;
			font-size: 14px;
			-webkit-transition: all 0.3 ease;
			transition: all 0.3 ease;
			cursor: pointer;
		}

		.form .message {
			margin: 15px 0 0;
			color: #b3b3b3;
			font-size: 12px;
		}

		.form .message a {
			color: rgb(175, 18, 50);
			text-decoration: none;
		}

		.form .register-form {
			display: none;
		}
	</style>
</head>

<body>
	<!-- This includes a form that will take the next variables and put them in a form -->
	<!-- These variables are the username and password as well as a submit button. -->
	<div class="login-page">

		<div class="form">
			<form class="login-form" class="register-form" , action="./" , method="POST">

				<input type="text" , id="myusername" , name="myusername" , placeholder="username" />
				<input type="password" , id="mypassword" , name="mypassword" , placeholder="password" />
				<button type="submit">login</button>
				<p class="message">Not registered? <a href="#">Create an account</a></p>
			</form>

		</div>
	</div>

	<?php
	# Check if Data is sent, if so
	# Check if Password matches
	# If Password Matches Redirect
	# If Password Does not Match Reload 
	
	# In this code, it checks if the information the user submitted matches up with what is in 
	# the system by searching in an SQL database where all the usernames and passwords are stored.
	if (isset($_POST["mypassword"])) {
		echo "<p> Login Attempt </p>";
		# echo "<alert type=success>Login Attempt</alert>";
		$host = "localhost";
		$port = 3306;
		$dbuser = "faculty";
		$dbpassword = "P@ssw0rd";
		$dbname = "MariaSQL";

		$con = new mysqli($host, $dbuser, $dbpassword, $dbname, $port)
			or die('Could not connect to the database server' . mysqli_connect_error());

		$myusername = $_POST["myusername"];
		$mypassword = $_POST["mypassword"];

		$query = "SELECT username, uid, password FROM user WHERE username = '$myusername' ;";

		# What this does is prepare the SQL query and bind the results to the corresponding variables and displays an error message if it fails.
		if ($stmt = $con->prepare($query)) {
			echo "<p> SQL QUERY </p>";
			$stmt->execute();
			$stmt->bind_result($username, $uid, $password);
			$stmt->fetch();
			$stmt->close();
		} else {
			echo "<p> SQL ERROR</p>";
			echo "<script> alert('error logging in.');</script>";
		}

		# echo "<p> $username, $uid, $password </p>";
	
		# If these two password strings are the same, it will be a successful login and redirect the user to the appropriate screen.
		# Or else, it will display a message saying the username and/or password is incorrect.
		if (strcmp($mypassword, $password) == 0) {
			echo "<p> PASSWORD SUCCESSFUL </p>";
			# SUCCESSFUL LOGIN
	
			# Setup SESSION data
			session_start();
			$_SESSION["userid"] = $uid;

			# LOGIN REDIRECT TO STUDENT HOME FOR NOW
			header('Location: ./student_home');
			$con->close();
			die();
		
		} else {
			$con->close();
			echo "<p> password incorrect </p>";
			echo "<script>alert('Password or Username Incorrect');</script>";
			die();
		}

		
	}

	?>

</body>

</html>