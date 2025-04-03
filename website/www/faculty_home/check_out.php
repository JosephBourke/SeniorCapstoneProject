<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Check out</title>
        <?php
        //These are variables that are filled with the associating data input into the text inputs below
        $studentname = $_POST["studentname"];
        $studentemail = $_POST["studentemail"];
        $studentID = $_POST["studentID"];
        $equipmentname = $_POST["equipmentname"];
        $equipmentID = $_POST["equipmentID"];
        $duedate = $_POST["duedate"];
        ?>
    </head>
    <body>
        <!-- These are the text inputs that are put in the variables above when submit is pressed -->
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
        //$servername = "192.168.56.101"; (Placeholder)
        $username = "faculty";
        $password = "P@ssw0rd";
        $db = "mydb";

        $conn = mysqli_connect($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //With this code, if Student ID, Equipment ID and Due Date is set, it changes the date format to a typical specific calander date and time format.
        //After that is done, the checkout date, due date, equipment ID, and user ID variables are inserted into their respective spots on the SQL checkout table.
        //And then, it will produce an alert that says "Submission is successful".
        if (isset($studentID) && isset($equipmentID) && isset($duedate)) {
            $date = date("y-m-d H:i:s");
            $result = $conn->query("INSERT INTO checkout (checkoutdate, duedate, equipmentid, studentid) VALUES ('$date', '$duedate " . date("H:i:s") . "', $equipmentID, $studentID)");
            if ($result) {
                echo "<script>alert(\"Submission was successful.\");</script>";
            }
        }
        ?>
    </body>
</html>