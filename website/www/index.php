<html>  
  <head>
    <title>Login</title>
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
  .form button:hover,.form button:active,.form button:focus {
    background: #8D021F;
  }
  .form .message {
    margin: 15px 0 0;
    color: #b3b3b3;
    font-size: 12px;
  }
  .form .message a {
    color: rgb(175, 18, 50);
    text-decoration: none;
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
  .container:before, .container:after {
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
  .container .info span .fa {
    color: #EF3B3A;
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


   

      <div class="login-page">

        <div class="form">
            <form class="login-form" class="register-form", action="./", method="POST">

            <input type="text", id="myusername", name="myusername", placeholder="username"/>
            <input type="password", id="mypassword", name="mypassword", placeholder="password"/>
            <button type="submit">login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
          </form>

        </div>
      </div>

         <?php
      // echo "<script>alert(\"AHHHHHH\");<\script>";
      //Check if Data is sent, if so
      //Check if Password matches
      //If Password Matches Redirect
      //If Password Does not Match Reload 

      if(isset($_POST["mypassword"]))
      {
        echo "<p> Login Attempt </p>";
        // echo "<alert type=success>Login Attempt</alert>";
        $host="localhost";
        $port=3306;
        $dbuser="faculty";
        $dbpassword="P@ssw0rd";
        $dbname="mydb";

        $con = new mysqli($host, $dbuser, $dbpassword, $dbname, $port)
          or die ('Could not connect to the database server' . mysqli_connect_error());

        $myusername = $_POST["myusername"];
        $mypassword = $_POST["mypassword"];

        $query = "SELECT username, uid, password FROM user WHERE username = '$myusername' ;";
        

        if ($stmt = $con->prepare($query)) {
          echo "<p> SQL QUERY </p>";
          $stmt->execute();
          $stmt->bind_result($username, $uid, $password);
          $stmt->fetch();
          $stmt->close();
        }else{
          echo "<p> SQL ERROR</p>";
          echo "<script> alert('error logging in.');</script>";
        }

        echo "<p> $username, $uid, $password </p>";

        if(strcmp($mypassword, $password) == 0)
        {
          echo "<p> PASSWORD SUCCESSFUL </p>";
          //SUCCESSFUL LOGIN
          
          //Setup SESSION data
          session_start();
          $_SESSION["userid"] = $uid;
          //LOGIN REDIRECT TO STUDENT HOME FOR NOW
          header('Location: ./student_home');
          die();
        }else{
          echo "<p> password incorrect </p>";
          echo "<script>alert('Password or Username Incorrect');</script>";
        }
        


        $con->close();
      }
      
      ?>


      
      

</body>
