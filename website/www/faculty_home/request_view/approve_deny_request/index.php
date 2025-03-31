<!DOCTYPE html>
<body>
<center>
<header>Request View</header>
</center>


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
$id = $_POST["id"];
// echo $id;


$query = "select r.description, r.id, q.name, q.id, q.description, u.username, u.uid  from equipment q, request r, user u where r.id = $id AND r.equipment_id = q.id AND r.user_id = u.uid";


if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($description, $id, $name, $id1, $description1, $username, $uid);
    while ($stmt->fetch()) {
    //        printf("%s, %s, %s, %s, %s, %s, %s\n", $description, $id, $name, $id1, $description1, $username, $uid);
    }
    $stmt->close();
}

//In this code, the username of the user, the name of the corresponding equipment, and a comment with that equipment is displayed.
//There are also two buttons that say "Accept" and "Deny" that change the value of the equipment to whether it is accepted or not (true or false).
echo "<p>New Request From " .$username . "</p>";
echo "<p>Requesting Camera: " .$name;
echo "<p>Comments: " .$description;
?>
<table>
<tr>
<td><form action="../" method="POST"><input type=hidden value=<?php echo $id;?> id=rid name=rid><input type=hidden value=1 id=accept name=accept><input type=submit value=Accept></form></td>
<td><form action="../" method="POST"><input type=hidden value=<?php echo $id;?> id=rid name=rid><input type=hidden value=0 id=accept name=accept><input type=submit value=Deny></form></td>
</tr>
</table>
</body>



