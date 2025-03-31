<!DOCTYPE html>
<html><body>
<center>
<header>Request List</header>
</center>

<table>

<?php
    $host="127.0.0.1";
    $port=3306;
    $socket="";
    $user="faculty";
    $password="P@ssw0rd";
    $dbname="mydb";
    $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die ('Could not connect to the database server' . mysqli_connect_error());


    //In this code, if "accept" is set and the accept variable is equal to 1, the accepted part in request is set to 1 (true).
    //Or else, it is set to 0 (false).
    if(isset($_POST["accept"]))
    {
        $id = $_POST["rid"];
        $accept = $_POST["accept"];
        
        if ($accept == 1) {
            //update request set accepted=1 where id=$id
            $query = "UPDATE request SET accepted=1 WHERE id=$id";
        }else {
            $query = "UPDATE request SET accepted=0 WHERE id=$id";
        }
        
        
        if ($stmt = $con->prepare($query)) {
            $stmt->execute();
        }    
    }
    

    // $query = "Select q.name, r.id, r.description from equipment q, request r where q.id = r.equipment_id AND r.accepted IS NULL";
	$query = "Select q.name, r.id, r.description from equipment q, request r where q.id = r.equipment_id;";

    //Here, it displays the name and description for each equipment in the database along with a view button which takes you to the approve/deny request page.
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($name, $id, $description);
        while ($stmt->fetch()) {
            // printf("%s, %s, %s\n", $name, $id, $description);
            echo "<tr><form action=\"./approve_deny_request/\" method=\"POST\"><td>".$name."</td><td>". $description."</td><td><input value=View type=submit></td><input type=hidden name=id id=id value=$id></form></tr>";
        }
        $stmt->close();
}
?>
</table>


