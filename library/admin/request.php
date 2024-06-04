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
        /* Your CSS styles */

        .srch{
            padding-left:800px;
        }

        .form-control{
            
            height:40px;
           width:200px;
        }

        .container{
            width:1000px;
        }
        

.sidenav {
  height: 100%;
  margin-top:50px;
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

.img-circle{
    margin-left:0px;

}
.h:hover{
    color:white;
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

               <div style="color: white; margin-left:90px; font-size: 20px;">

                      <?php
                        if(isset($_SESSION['login_user']))
                      
                      { echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                      echo "</br>";
                        echo "    Welcome ".$_SESSION['login_user']; 
                      }
                      ?>
                    </div>
  <div class="h"> <a href="add.php">Add Books</a> </div>
  <div class="h"> <a href="request.php">Book Request</a></div>
  <div class="h"> <a href="issue_info.php">Issued Books</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
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
 
<div class="srch">
        <form  method="post" action="" name="form1">
            
                <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                

       
            
                <input class="form-control" type="text" name="bid" placeholder="BID" required=""><br>
                <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
                  Submit
                </button>
        </form>
    </div>


    <b><h1 style="text-align: center;">Request of Book</h1></b>
    <div class="container">
  
<?php
// Your PHP code

// Check if session variable is set
if (isset($_SESSION['login_user'])) {
   
    $sql = "SELECT student.username, roll, books.bid, name, authors, edition, status, quantity, department 
        FROM student 
        INNER JOIN issue_book ON student.username = issue_book.username 
        INNER JOIN books ON issue_book.bid = books.bid 
        WHERE issue_book.approve = ''";

    $res = mysqli_query($db, $sql);

    if ($res) {
        // Check if there are any rows in the result set
        if (mysqli_num_rows($res) == 0) {
            echo "<h2><center>There is no pending request</h2>";
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
            echo "<th>Status</th>";
            echo "<th>Quantity</th>";
            echo "<th>Department</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                 echo "<td>" . $row['username'] . "</td>";
                 echo "<td>" . $row['roll'] . "</td>";
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
    } 
    

    else {
        // Handle SQL query execution error
        echo "Error executing query: " . mysqli_error($db);
    }
} else {
    // Handle session not being set
    echo "<center> <h3><b>Please login first to see the request information";
}


      if(isset($_POST['submit']))
    {
        $_SESSION['name']=$_POST['username'];
        $_SESSION['bid']=$_POST['bid'];
        ?>
        <script type="text/javascript">
            window.location="approve.php"
        </script>
        <?php
    }

?>
</div>

</body>
</html>