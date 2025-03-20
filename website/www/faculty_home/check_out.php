<!DOCTYPE HTML>
<html>
    <head>
        <title>Check out</title>
        <?php
        $studentname = $_POST["studentname"];
        $studentemail = $_POST["studentemail"];
        $studentID = $_POST["studentID"];
        $equipmentname = $_POST["equipmentname"];
        $equipmentID = $_POST["equipmentID"];
        $duedate = $_POST["duedate"];
        ?>
    </head>
    <body>
        <form action="check_out.php" method="post">
            Student Name:   <input type="text" name="studentname"><br>
            Student Email:  <input type="text" name="studentemail"><br>
            Student ID:     <input type="number" name="studentID"><br>
            Equipment Name: <input type="text" name="equipmentname"><br>
            Equipment ID:   <input type="number" name="equipmentID"><br>
            Due Date:       <input type="date" name="duedate"><br>
            <input type="submit">
        </form>
        <?php
        $servername = "192.168.56.101";
        $username = "faculty";
        $password = "P@ssw0rd";
        $db = "mydb";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($studentID) && isset($equipmentID) && isset($duedate)) {
            $date = date("YmdHis");
            $statement = $conn->prepare("INSERT INTO checkout (checkouttime, duedate, equipment_id, user_id) VALUES ($date, $duedate, $equipmentID, $studnetID)");
            $statement->execute();
        }
        ?>
    </body>
</html>