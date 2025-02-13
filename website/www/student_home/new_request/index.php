<!DOCTYPE html>

<html>
    <head>
        <title>New Request</title>
    </head>
    <body>
        <h1>New Request</h1>
        <form action="../index.php" method="POST">
            <label>
                Equipment:
                <select name="equipment" id="equipment">
                <option>Select a peice of Equipment</option>
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
                        echo "<option value=".$id.">".$name."</option>";
                        // echo "<li><a href=\"new_request/index.html\">".$name."</a></li>";
                    }
                    $stmt->close();
                }
                ?>
                </select>

            </label>
            <label>
                Pickup Date:
                <input type="date" name="pickupDate" id="pickupDate">
            </label>
            <label>
                Return Date:
                <input type="date" name="returnDate" id="returnDate">
            </label>
            <input type="hidden" name="user" id="user" value="Student1">
            <input type="submit" value="Submit">
        </form>
        <?php


        if (isset($_POST["equipment"])) {
            $query = "INSERT INTO request(id,create_time,description,accepted,user_id,equipment_id)VALUES( ".$id.",".$create_time.",".$description.",".$accepted.",".$user_id.",".$equipment_id.");";

            if ($stmt = $con->prepare($query)) {
                $stmt->execute();
                $stmt->close();
            }
        }



        ?>
        <table>
        <?php
        // $host="127.0.0.1";
        // $port=3306;
        // $socket="";
        // $user="faculty";
        // $password="";
        // $dbname="mydb";
        // $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
        //     or die ('Could not connect to the database server' . mysqli_connect_error());
        // $query = "SELECT id, create_time,description,accepted,user_id, equipment_id FROM request";

        // if ($stmt = $con->prepare($query)) {
        //     $stmt->execute();
        //     $stmt->bind_result($id, $create_time, $description, $accepted, $user_id, $equipment_id);
        //     while ($stmt->fetch()) {
        //         //printf("%s, %s, %s, %s, %s, %s\n", $id, $create_time, $description, $accepted, $user_id, $equipment_id);
        //         echo "<tr><td>".$id."</td><td>". $create_time."</td><td>". $description."</td><td>". $accepted."</td><td>". $user_id."</td><td>". $equipment_id."</td></tr>";
        //     }
        //     $stmt->close();
        // }
        // $con->close();
        ?>
        </table>
    </body>
</html>