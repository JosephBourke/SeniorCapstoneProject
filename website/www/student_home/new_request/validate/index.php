<!DOCTYPE html>
<body>
    <center>
        <div>
<p> Request successfully submitted</p>
        </div>
    </center>
<?php
// Request Data
//Create Time
// Description
//User ID
//Equipment ID

$equipment_id = $_POST["equipment"];
$user_id = 1234567;
$date = date('YmdHis');
$description = $_POST["returnDate"];
// echo $equipment_id . "\n" . $user_id . "\n" . $date . "\n" . $description ;

$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "faculty";
$password = "P@ssw0rd";
$dbname = "mydb";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die('Could not connect to the database server' . mysqli_connect_error());


if(isset($_POST["equipment"]))
{

    $query = "INSERT INTO request (description, create_time, user_id, equipment_id) VALUES (\"$description\", $date ,$user_id, $equipment_id);";

    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
    }
}

?>
</body>
</html>