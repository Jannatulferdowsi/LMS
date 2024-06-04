<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style type="text/css">
        
        body {
            font-family: "Lato", sans-serif;
            overflow-x: hidden; /* Prevents horizontal scrolling */
        }

        
        .sidenav {
            height: 100%;
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
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
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

        .srch {
            padding-top: 20px;
            text-align: right;
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
            echo "<br>";
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
    }
    </script>

    <!-- Search Bar and Request Book -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class="srch">
                    <form class="navbar-form" method="post" name="form1">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Search books..." required>
                            <span class="input-group-btn">
                                <button style="background-color:#6db6b9e6;" type="submit" name="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="srch">
                    <form class="navbar-form" method="post" name="form1">
                        <div class="input-group">
                            <input class="form-control" type="text" name="bid" placeholder="Enter Book ID." required>
                            <span class="input-group-btn">
                                <button style="background-color:#6db6b9e6;" type="submit" name="submit1" class="btn btn-default">
                                    Request
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h2>List Of Books</h2>
    <?php
    if (isset($_POST['submit'])) {
        $q = mysqli_query($db, "SELECT * from books where name like '%$_POST[search]%' ");
        if (mysqli_num_rows($q) == 0) {
            echo "Sorry! No book found. Try searching again.";
        } else {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color:#70aeeb;'>";
            echo "<th>ID</th>";
            echo "<th>Book-Name</th>";
            echo "<th>Authors Name</th>";
            echo "<th>Edition</th>";
            echo "<th>Status</th>";
            echo "<th>Quantity</th>";
            echo "<th>Department</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($q)) {
                echo "<tr>";
                echo "<td>" . $row['bid'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['authors'] . "</td>";
                echo "<td>" . $row['edition'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        $res = mysqli_query($db, "SELECT * FROM `books` ORDER BY `books`.`name` ASC;");
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr style='background-color:#70aeeb;'>";
        echo "<th>ID</th>";
        echo "<th>Book-Name</th>";
        echo "<th>Authors Name</th>";
        echo "<th>Edition</th>";
        echo "<th>Status</th>";
        echo "<th>Quantity</th>";
        echo "<th>Department</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>" . $row['bid'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['authors'] . "</td>";
            echo "<td>" . $row['edition'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    if (isset($_POST['submit1'])) {
        if (isset($_SESSION['login_user'])) {
            mysqli_query($db, "INSERT INTO issue_book VALUES('$_SESSION[login_user]', '$_POST[bid]', '', '', '');");
            ?>
            <script type="text/javascript">
                window.location = "request.php";
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("You must login to request.");
            </script>
            <?php
        }
    }
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
