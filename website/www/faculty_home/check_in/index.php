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
      /* background-image: url("./../BCImage.jpg"); */
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .searchDiv {
      text-align: center;
      height: 10px;
      padding: 30px;
      margin: 20px;
      margin-top: 200px;
      /* background-color: rgb(211, 211, 211); */
    }

    .table {
      /* background-color: lightgrey */
      border-collapse: collapse;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
    }

    .table td {
      border: 1px solid rgb(211, 211, 211);
      padding: 8px;
    }

    .table tr: nth-child(even) {
      background-color: #f2f2f2;
    }

    .table tr: nth-child(odd) {
      background-color: rgb(218, 209, 209);
    }

    .table th {
      /* this will not be staying green (obvi) */
      border: 1px solid rgb(211, 211, 211);
      background-color: rgb(211, 211, 211);
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      /* color: white; */
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

  <table style="width:80%" class="table" id="table">
    <?php
    $host = "127.0.0.1"; // change this to match the ip address for your virtual machine
    $port = 3306;
    $user = "faculty";
    $password = "P@ssw0rd";
    $dbname = "mydb";

    //this is currently actually equipment that is not available
    $con = new mysqli($host, $user, $password, $dbname, $port)
      or die('Could not connect to the database server' . mysqli_connect_error());


    if (isset($_POST["email"])) {

      $email = $_POST["email"];
      $query = "SELECT u.uid, u.username, c.equipmentid, c.checkoutdate, c.duedate, c.id, e.name FROM user u, checkout c, equipment e WHERE u.email = '$email' AND u.uid = c.studentid AND c.equipmentid = e.id AND c.checkindate IS NULL;";

      if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($uid, $username, $equipmentid, $checkoutdate, $duedate, $cid, $name);
        $iter = 0;
        while ($stmt->fetch()) {

          if ($iter === 0) {
            echo "<tr><th>$username</th><th>$uid</th><th></th><th></th></tr>";
          }
          echo "<tr><td>$name</td>
                  <td>Checked out: $checkoutdate</td>
                  <td>Due: $duedate</td>
                  <td><form name=\"checkin\" id=\"checkin\" action=\"index.php\" method=\"post\">
                  <input type=\"submit\" value=\"Check in\">
                  <input type=\"hidden\" value=\"$cid\" name=\"hidden\" id=\"hidden\">
                  </form></td></tr>";
          $iter++;
        }


      }
      $stmt->close();
    }

    if (isset($_POST["hidden"])) {
      $hidden = $_POST["hidden"];
      // UPDATE statement not working 
      $now = date("y-m-d H:i:s");
      $query = "UPDATE checkout SET checkindate = '$now' WHERE id = $hidden";
      $stmt = $con->prepare($query);
      $stmt->execute();

      echo "<script>alert(\"Submission was successful.\");</script>";
      $stmt->close();
    }
    ?>
  </table>

</body>

</html>