<!DOCTYPE html>

<html>

<head>
    <title>New Request</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

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

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #8D021F;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        body {
            background: #808080;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body>
    <div class="Request Equipment">
        <div class="form">
            <h1>New Request</h1>
            <form action="./" method="POST">
                <label>
                    Equipment:
                    <select name="equipment" id="equipment">
                        <option>Select a piece of Equipment</option>
                        <?php
                        $host = "127.0.0.1";
                        $port = 3306;
                        $socket = "";
                        $user = "faculty";
                        $password = "P@ssw0rd";
                        $dbname = "mydb";
                        $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
                            or die('Could not connect to the database server' . mysqli_connect_error());
                        

                        /// WARNING this is some of the most cursed scrambled 

                        $query = "SELECT id, name, description FROM equipment;";
                        if ($stmt = $con->prepare($query)) {
                            $stmt->execute();
                            $stmt->bind_result($id, $name, $description);
                            while ($stmt->fetch()) {
                                //printf("%s, %s, %s\n", $id, $name, $description);
                                echo "<option value=" . $id . ">" . $name . "</option>";
                                // echo "<li><a href=\"new_request/index.html\">".$name."</a></li>";
                            }
                            $stmt->close();
                        }
                        
                        
                        $con->close();
                        ?>
                    </select>
                </label>
                <br><br>
                <label>
                    Pickup Date:
                    <input type="date" name="pickupDate" id="pickupDate">
                </label>
                <label>
                    Comments:
                    <input type="text" name="returnDate" id="returnDate">
                </label>
                <input type="hidden" name="user" id="user" value="Student1">
                <input type="submit" value="Submit">
                <!-- <button>Submit</button> -->
            </form>
            <?php

$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "faculty";
$password = "P@ssw0rd";
$dbname = "mydb";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die('Could not connect to the database server' . mysqli_connect_error());


if (isset($_POST["equipment"])) {


	$equipment_id = $_POST["equipment"];
	$user_id = 123456789;
	$date = date('YmdHis');
	$description = $_POST["returnDate"];
    
    $query = "INSERT INTO request (description,user_id,equipment_id) VALUES ( '" . $description . "'," . $user_id . "," . $equipment_id . ");";
 
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
      
        $stmt->close();
    }

    echo "<script>alert('Request Successfully Submitted!');</script>";
    echo "<p>Success!</p>";
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
        </div>
    </div>
</body>

</html>