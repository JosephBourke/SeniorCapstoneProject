<!DOCTYPE html>

<html lang="en">

  <head>
    <title>Check In</title>
  </head>

  <body>

    <div class="search-wrapper">
      <h2>Check In</h2>

      <form name="search" id="search" action="index.php" method="post">
        Student email: <input type="text" name="email" id="email">
        <input type="submit" value="Search">
      </form>

      <table style="width:80%" class="center">
          <?php
          $email = $_POST["email"];
          $hidden = $_POST["hidden"];

          $host = "192.168.56.101"; // change this to match the ip address for your virtual machine
          $port = 3306;
          $socket = "";
          $user = "faculty";
          $password = "P@ssw0rd";
          $dbname = "mydb";

          // this is currently actually equipment that is not available
          $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());

          if (isset($hidden)) {
            // UPDATE statement not working 
            $now = date("y-m-d H:i:s");
            $query = "UPDATE checkout SET checkindate = '$now' WHERE id = $hidden";
            $stmt = $con->prepare($query);
            $stmt->execute();
          }

          $query = "SELECT u.uid, u.username, c.equipmentid, c.checkoutdate, c.duedate, c.id, e.name FROM user u, checkout c, equipment e WHERE u.email = '$email' AND u.uid = c.studentid AND c.equipmentid = e.id AND c.checkindate IS NULL";
          if ($stmt = $con->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($uid, $username, $equipmentid, $checkoutdate, $duedate, $cid, $name);
            $iter = 0;
            while ($stmt->fetch()) {
              if ($iter === 0) {
                echo "<tr><th>$username</th><th>$uid</th></tr>";
              }
              echo <<<END
              <tr><td>$name</td><td>Checked out: $checkoutdate</td><td>Due: $duedate</td><td>
              <form name="checkin" id="checkin" action="index.php" method="post">
                <input type="submit" value="Check in">
                <input type="hidden" value="<?php echo $cid;?>" name="hidden" id="hidden">
              </form></td></tr>
              END;
              $iter++;
            }

            
            $stmt->close();
          }
          ?>
      </table>

    </div>

  </body>

</html>