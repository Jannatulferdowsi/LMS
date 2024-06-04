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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap">

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
    
    <div class="h"> <a href="request.php">Requested Books</a></div>
    <div class="h"> <a href="issue_info.php">Issued Books</a></div>
    <div class="h"> <a href="expired.php">Expired Books</a></div>
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
    <div class="container mt-5">
      <h3 style="text-align: center; color:white;">Information of Borrowed Books</h3>
      <?php
      $c = 0;
      if (isset($_SESSION['login_user'])) {
        $login_user = $_SESSION['login_user'];
        $sql = "SELECT student.username, roll, books.bid, name, authors, edition, issue, issue_book.`return`
                FROM student
                INNER JOIN issue_book ON student.username = issue_book.username
                INNER JOIN books ON issue_book.bid = books.bid
                WHERE issue_book.approve = 'Yes' AND student.username = '$login_user'
                ORDER BY issue_book.`return` ASC";

        $res = mysqli_query($db, $sql);

        if (mysqli_num_rows($res) == 0) {
          echo "<h4 style='text-align: center;color:white;'>You have not borrowed any books</h4>";
        } else {
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
              $c = $c + 1;
              $var = '<p style="color:yellow; background-color:red;"> EXPIRED</p>';

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
      }
      ?>

      <!-- Return Book Form -->
      <h3 style="text-align: center; color:white;">Return a Book</h3>
      <form method="post" action="">
        <div class="form-group">
          <input type="text" name="return_book_id" class="form-control" placeholder="Enter Book ID" required>
        </div>
        <button type="submit" name="return_book" class="btn btn-primary">Return Book</button>
      </form>

      <?php
      if (isset($_POST['return_book'])) {
        $bid = $_POST['return_book_id'];

        // Check if the book is issued to the current user
        $check_sql = "SELECT * FROM issue_book WHERE username='$login_user' AND bid='$bid' AND approve='Yes'";
        $check_res = mysqli_query($db, $check_sql);

        if (mysqli_num_rows($check_res) > 0) {
          // Update the books table
          $update_book_sql = "UPDATE books SET quantity = quantity + 1 WHERE bid='$bid'";
          mysqli_query($db, $update_book_sql);

          // Delete the record from issue_book table
          $delete_issue_sql = "DELETE FROM issue_book WHERE username='$login_user' AND bid='$bid'";
          mysqli_query($db, $delete_issue_sql);

          echo "<script>alert('Book returned successfully!');</script>";
        } else {
          echo "<script>alert('This book is not issued to you or has already been returned.');</script>";
        }
      }
      ?>
    </div>
  </div>
</body>
</html>
