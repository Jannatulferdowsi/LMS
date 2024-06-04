<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Book Request</title>

  <style type="text/css">
    .srch {
      padding-left: 750px;
    }
    body {
      background-image: url("images/aa.jpg");
      background-repeat: no-repeat;
      font-family: "Lato", sans-serif;
      transition: background-color .5s;
    }

    .sidenav {
      height: 100%;
      margin-top: 50px;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #222;
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
      .sidenav { padding-top: 15px; }
      .sidenav a { font-size: 18px; }
    }

    .img-circle {
      margin-left: 0px;
    }

    .h:hover {
      color: white;
      width: 300px;
      height: 50px;
      background-color: #0a6605;
    }
  </style>
</head>
<body>
  <!--------------------------sidenav------------------------------------->

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <div style="color: white; margin-left: 90px; font-size: 20px;">
      <?php
      if (isset($_SESSION['login_user'])) {
        echo "<img class='img-circle profile_img' height=120 width=120 src='images/" . $_SESSION['pic'] . "'>";
        echo "</br>";
        echo "Welcome " . $_SESSION['login_user'];
      }
      ?>
    </div>
    <div class="h"> <a href="add.php">Add Books</a> </div>
  <div class="h"> <a href="request.php">Book Request</a></div>
  <div class="h"> <a href="issue_info.php">Issued Books</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
  </div>

  <div id="main">
    <span style="font-size:30px; cursor:pointer" onclick="openNav()">&#9776; open</span>

    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
        document.getElementById("main").style.marginLeft = "300px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.body.style.backgroundColor = "white";
      }
    </script>
    <div class="container">
      <h3 style="text-align: center;">Information of Borrowed Books</h3>
      <?php
      $c=0;
      if (isset($_SESSION['login_user'])) {
        $sql = "SELECT student.username, roll, books.bid, name, authors, edition, issue, issue_book.`return`
                FROM student
                INNER JOIN issue_book ON student.username = issue_book.username
                INNER JOIN books ON issue_book.bid = books.bid
                WHERE issue_book.approve = 'Yes'
                ORDER BY issue_book.`return` ASC";

        $res = mysqli_query($db, $sql);
        echo "<table class='table table-bordered table-hover'>";

        echo "<tr style='background-color: #6db6b9e6;'>";
        // Table header
        echo "<th>Username</th>";
        echo "<th>Roll No</th>";
        echo "<th>BID</th>";
        echo "<th>Book-Name</th>";
        echo "<th>Authors Name</th>";
        echo "<th>Edition</th>";
        echo "<th>Issue Date</th>";
        echo "<th>Return Date</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($res)) {

          $d = date("Y-m-d");
      if ($d > $row['return']) {
    $c= $c + 1;
    $var='<p style="color:yellow; background-color:red;"> EXPIRED</p>';

    // Construct the SQL query correctly
    $query = "UPDATE issue_book SET approve='$var' WHERE `return`='$row[return]' AND approve='Yes' LIMIT $c;";
    mysqli_query($db, $query);

    echo $d . "</br>";
}


          echo "<tr>";
          echo "<td>" . $row['username'] . "</td>";
          echo "<td>" . $row['roll'] . "</td>";
          echo "<td>" . $row['bid'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['authors'] . "</td>";
          echo "<td>" . $row['edition'] . "</td>";
          echo "<td>" . $row['issue'] . "</td>";
          echo "<td>" . $row['return'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }
      ?>
    </div>
  </div>
</body>
</html>
