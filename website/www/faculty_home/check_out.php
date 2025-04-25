<!DOCTYPE HTML>

<html lang="en">

<head>
    <title>Check Out</title>
    <link href="../css/stylesheet.css" type="text/css" rel="stylesheet" />

    <style>
        div.checkOut {
            position: relative;
            top: 50px;
            z-index: 1;
            background: #FFFFFF;
            max-width: 250px;
            margin: 0 auto 100px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        div.checkOutContainer {
            padding: 8px;
        }
    </style>

    <?php
    # These are variables that are filled with the associating data input into the text inputs below
    $studentname = $_POST["studentname"];
    $barcode = $_POST["barcode"];
    $duedate = $_POST["duedate"];
    ?>
</head>

<body>
    <header>
        <strong>Check Out</strong>
    </header>
    <div class="checkOut">

        <!-- These are the text inputs that are put in the variables above when submit is pressed -->
        <form action="check_out.php" method="post">
            <div class="checkOutContainer">
                Student Name<br><input type="text" name="studentname"><br>
            </div>
            <div class="checkOutContainer">
                Barcode<br><input type="text" name="barcode"><br>
            </div>
            <div class="checkOutContainer">
                Due Date<br><input type="date" name="duedate"><br>
            </div>
            <div class="checkOutContainer">
                <input type="submit">
            </div>
        </form>
    </div>
    <?php
    # $servername = "192.168.56.101"; # (Placeholder)
    $username = "faculty";
    $password = "P@ssw0rd";
    $db = "MariaSQL";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # With this code, if Student ID, Equipment ID and Due Date is set, it changes the date format to a typical specific calander date and time format.
    # After that is done, the checkout date, due date, equipment ID, and user ID variables are inserted into their respective spots on the SQL checkout table.
    # And then, it will produce an alert that says "Submission is successful".
    if (isset($studentname) && isset($barcode) && isset($duedate)) {
        $date = date("y-m-d H:i:s");
        $result = $conn->query("INSERT INTO checkout (checkoutdate, duedate, barcode, studentname) VALUES ('$date', '$duedate " . date("H:i:s") . "', $barcode, $studentname)");
        if ($result) {
            echo "<script>alert(\"Submission was successful.\");</script>";
        }
    }
    ?>
</body>

</html>