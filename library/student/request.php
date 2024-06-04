<?php
  include "connection.php";
  include "navbar.php";
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap">
  <style type="text/css">
  <title> Book Request</title>

  <style type="text/css">
    .srch
    {
      padding-left: 750px;
    }
    body {
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

</head>
<body>
  </style > 
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
 <div class="container mt-5">

<?php
   if(isset($_SESSION['login_user']))
{
   $q=mysqli_query($db,"SELECT * from issue_book where username ='$_SESSION[login_user]' and approve='';");
   if(mysqli_num_rows($q)==0)
   {
   echo "<h3 style='text-align:center;color:white;'><br>There is no pending request.</br><br></h3>";
   }
   else
   {
    echo "<table class='table table-bordered table-hover' >";
      echo "<tr style='background-color:#70aeeb;'>";
        //Table header
        echo "<th>"; echo "Book-ID"; echo "</th>";
        echo "<th>"; echo "Approve Status";  echo "</th>";
        echo "<th>"; echo "Issue-Date";  echo "</th>";
        echo "<th>"; echo "Return-Date";  echo "</th>";
        
      echo "</tr>"; 
    while($row=mysqli_fetch_assoc($q))
      {
        echo "<tr>";
        echo "<td>"; echo $row['bid']; echo "</td>";
        echo "<td>"; echo $row['approve']; echo "</td>";
        echo "<td>"; echo $row['issue']; echo "</td>";
        echo "<td>"; echo $row['return']; echo "</td>";
        

        echo "</tr>";
      }
    echo "</table>";
   }


}

else
{ 
  echo "</br>";
  echo "<center><h2 style='color:white;'><b>";
  echo "Please login first to see the request information";
  echo "</h2></br>";
}
?></div>
</body>
</html>