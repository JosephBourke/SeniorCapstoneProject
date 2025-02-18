<table>
<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="faculty";
$password="P@ssw0rd";
$dbname="mydb";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die ('Could not connect to the database server' . mysqli_connect_error());
$query = "SELECT id, create_time, description, accepted, user_id, equipment_id FROM request";

if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($id, $create_time, $description, $accepted, $user_id, $equipment_id);
    while ($stmt->fetch()) {
        //printf("%s, %s, %s, %s, %s, %s\n", $id, $create_time, $description, $accepted, $user_id, $equipment_id);
        echo "<tr><td>".$id."</td><td>". $create_time."</td><td>". $description."</td><td>". $accepted."</td><td>". $user_id."</td><td>". $equipment_id."</td></tr>";
    }
    $stmt->close();
}
$con->close();
?>
</table>