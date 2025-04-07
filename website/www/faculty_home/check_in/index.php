<!DOCTYPE html>

<html lang="en">

<head>
  <title>Check In</title>
  <style>
    header {
      background-color: rgb(148, 13, 13);
      color: #fff;
      padding: 30px;
      text-align: center;
      font-size: 50px;
    }

    body {
      /* background-image: url("BCImage.jpg"); */
      background-image: url("./../BCImage.jpg");
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }


    .searchDiv {
      /* background-color: lightgrey; */
      /* margin: auto; */
      text-align: center;
      /* width: auto; */
      height: 10px;
      /* border: 15px tomato; */
      padding: 20px;
      margin: 20px;
    }
  </style>

</head>

<body>
  <header>
    <strong>Check In</strong>
  </header>

  <div class="searchDiv">

    <form name="search" id="search" action="index.php" method="post">
      <strong>Student email: </strong><input type="text" name="email" id="email">
      <input type="submit" value="Search">
    </form>
  </div>

  <div class="search-wrapper">
    <table style="width:80%" class="center">
      <?php


      $host = "127.0.0.1"; // change this to match the ip address for your virtual machine
      $port = 3306;
      $user = "faculty";
      $password = "P@ssw0rd";
      $dbname = "mydb";

      //this is currently actually equipment that is not available
      $con = new mysqli($host, $user, $password, $dbname, $port)
        or die('Could not connect to the database server' . mysqli_connect_error());

      //If the email part is set, it will collect a bunch of information related to that email.
      if (isset($_POST["email"])) {

        $email = $_POST["email"];
        $query = "SELECT u.uid, u.username, c.equipmentid, c.checkoutdate, c.duedate, c.id, e.name FROM user u, checkout c, equipment e WHERE u.email = '$email' AND u.uid = c.studentid AND c.equipmentid = e.id AND c.checkindate IS NULL;";

        if ($stmt = $con->prepare($query)) {
          $stmt->execute();
          $stmt->bind_result($uid, $username, $equipmentid, $checkoutdate, $duedate, $cid, $name);
          $iter = 0;
          while ($stmt->fetch()) {

            //If the iter variable is 0, your username and user ID will print out.
            //Afterwards, it willl print out name, checkout date, and due date along with a submit button and a hidden cid value.
            if ($iter === 0) {
              echo "<tr><th>$username</th><th>$uid</th></tr>";
            }
            echo "
                <tr><td>$name</td><td>Checked out: $checkoutdate</td><td>Due: $duedate</td><td>
                <form name=\"checkin\" id=\"checkin\" action=\"index.php\" method=\"post\">
                  <input type=\"submit\" value=\"Check in\">
                  <input type=\"hidden\" value=\"$cid\" name=\"hidden\" id=\"hidden\">
                </form></td></tr>";
            $iter++;
          }


        }
        $stmt->close();
      }




      //If hidden is set, the checkin date on the checkout table will be updated to what is now where id is equal to the hidden variable.
      if (isset($_POST["hidden"])) {
        $hidden = $_POST["hidden"];
        // UPDATE statement not working 
        $now = date("y-m-d H:i:s");
        $query = "UPDATE checkout SET checkindate = '$now' WHERE id = $hidden";
        $stmt = $con->prepare($query);
        $stmt->execute();

        //After that, an alert is printed.
        echo "<script>alert(\"Submission was successful.\");</script>";
        $stmt->close();
      }
      ?>
    </table>

  </div>

</body>

</html>