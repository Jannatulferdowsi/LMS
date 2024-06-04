<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .srch
        {
            padding-left: 800px;
        }
        body {
      background-color:  #064622;
  font-family: "Lato", sans-serif;
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
.book{
  width: 400px;
  margin: 0px auto;
}
.form-control{
  background-color: #080707;
  color: white;
  height: 35px;
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
 
  <span style="font-size:30px;cursor:pointer; color: white;" onclick="openNav()">&#9776; open</span>
  <div class="container" style="text-align: center;">
    <h2 style="color:white; font-family: lucida console; text-align: center;"><b>Add New Books</b></h2>
  <form class="book" action="" method="post">

    <input type="text" name="bid" class="form-control" placeholder="Book id" required=""><br>
    <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
    <input type="text" name="authors" class="form-control" placeholder="Authors Name" required=""><br>
    <input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
    <input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
    <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
    <input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
   
    <button style="text-align: center;" class="btn btn-default" type="submit" name="Submit">ADD</button>
  </form>
  </div>
  <?php 
if(isset($_POST['Submit'])) {
    if(isset($_SESSION['login_user'])) {
        $bid = $_POST['bid'];
        $name = $_POST['name'];
        $authors = $_POST['authors'];
        $edition = $_POST['edition'];
        $status = $_POST['status'];
        $quantity = $_POST['quantity'];
        $department = $_POST['department'];

        // Check if the book ID already exists in the books table
        $check_query = "SELECT * FROM books WHERE bid='$bid'";
        $check_result = mysqli_query($db, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // Book already exists, update the quantity
            $row = mysqli_fetch_assoc($check_result);
            $new_quantity = $row['quantity'] + $quantity;
            $update_query = "UPDATE books SET quantity=$new_quantity WHERE bid='$bid'";
            mysqli_query($db, $update_query);

            ?>
            <script type="text/javascript">
                alert("Book quantity updated successfully.");
            </script>
            <?php
        } else {
            // Book doesn't exist, insert a new record
            $insert_query = "INSERT INTO books VALUES('$bid', '$name', '$authors', '$edition', '$status', '$quantity', '$department')";
            mysqli_query($db, $insert_query);

            ?>
            <script type="text/javascript">
                alert("Book added successfully.");
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("You need to log in first.");
        </script>
        <?php
    }
}
?>

</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor="#064622";
}
</script>
</body>
</html>
