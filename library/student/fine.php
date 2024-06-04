<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fine Calculation</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap">
  <style type="text/css">
    .srch {
      padding-left: 600px;
    }
    body {
      font-family: "Lato", sans-serif;
      background-image: url("images/aa.jpg");
      background-repeat: no-repeat;
      transition: background-color .5s;
    }
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }
    .sidenav a:hover {
      color: #f1f1f1;
    }
    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
    #main {
      transition: margin-left .5s;
      padding: 16px;
    }
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
    .container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
    }
    table {
      background-color: white;
      color: black;
    }
    table th, table td {
      text-align: center;
    }
    
    }
  </style>
</head>
<body>
  <!--------------------------sidenav------------------------------------->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="color: white; margin-left:90px; font-size: 20px;">
      <?php
      if (isset($_SESSION['login_user'])) {
        echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
        echo "</br></br>";
        echo "Welcome " . $_SESSION['login_user'];
      }
      ?>
    </div>
    
    
  <div class="h"> <a href="request.php"> Requested Books</a></div>
  <div class="h"> <a href="issue_info.php">Issued Books</a></div>
  <div class="h"> <a href="expired.php">Expired Books</a></div>
  </div>
  <div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
        document.getElementById("main").style.marginLeft = "300px";
      }
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor="white";
      }
    </script>
    <!--__________________________search bar________________________-->
    <div class="container mt-5">
    <h2 style="color:white; text-align:center;">Fine Information</h2>
    <?php
    $res = mysqli_query($db, "SELECT * FROM `fine` WHERE username='$_SESSION[login_user]';");

    if (mysqli_num_rows($res) == 0) {
      echo "<h3 style='text-align: center;color:white;'>No fine needs to be paid</h3>";
    } else {
      echo "<table class='table table-bordered table-hover'>";
      echo "<tr style='background-color: #6db6b9e6;'>";
      echo "<th>Username</th>";
      echo "<th>Bid</th>";
      echo "<th>Returned</th>";
      echo "<th>Days</th>";
      echo "<th>Fines in $</th>";
      echo "<th>Status</th>";
      echo "</tr>";

      while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['bid'] . "</td>";
        echo "<td>" . $row['returned'] . "</td>";
        echo "<td>" . $row['day'] . "</td>";
        echo "<td>" . $row['fine'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    ?>
    
    </div>
  </div>
</div>
</body>
</html>
