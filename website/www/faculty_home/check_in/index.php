<!DOCTYPE html>

<html>

<head>
  <title>Check In</title>
  <style>
    .side {
      width: 50%;
      float: left;
    }

    h2,
    ul {
      text-align: center;
    }

    table,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    table.center {
      margin-left: auto;
      margin-right: auto;
    }

    body {
      background: rgb(244, 243, 243);
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    header {
      background-color: rgb(148, 13, 13);
      color: #fff;
      padding: 30px;
      text-align: center;
      font-size: 30px;
    }

    section {
      padding: 20px;
    }

  </style>
</head>

<center>

  <body>
    <header>
      <strong>Check In</strong>
    </header>

    <div class="search-wrapper">
      <form>

        <!-- <h2>Check In</h2> -->
        <section>

          <table style="width:80%" class="center">
            <tr>
              <?php
              $host = "127.0.0.1";
              $port = 3306;
              $socket = "";
              $user = "faculty";
              $password = "P@ssw0rd";
              $dbname = "mydb";
              // this is currently actually equipment that is not available
              $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
                or die('Could not connect to the database server' . mysqli_connect_error());

              $query = "SELECT e.id, e.name from equipment e, checkout c where e.id = c.equipment_id and c.checkintime is null";
              if ($stmt = $con->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($id, $name);
                while ($stmt->fetch()) {
                  echo "<tr><td><a>" . $name . "</option>";
                  ?>
                  <td><button class="close-icon" type="reset">Check-In</button><?php
                }
                $stmt->close();
              }
              ?>
          </table>
        </section>


        <!-- <input type="text" name="focus" required class="search-box" placeholder="Enter the Equipment ID" /> -->
        <!-- <button class="close-icon" type="reset">Check-In</button> -->
      </form>
    </div>
  </body>
</center>

</html>