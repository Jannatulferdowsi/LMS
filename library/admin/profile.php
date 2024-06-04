<?php
   

    include "connection.php";
    include "navbar.php";
?>  

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style type="text/css">
        .wrapper
        {
            width: 500px;
            margin: 0 auto;
            color: white;
        }
    </style>
</head>
<body style="background-color: #064622;">
    <div class="container">
        <form action="" method="post">
            <button class="btn btn-default" style="float: right; width: 70px;" name="submit1">Edit</button>
        </form>
        <div class="wrapper">
            <?php
                if(isset($_SESSION['login_user'])) { // Check if user is logged in
                    $username = $_SESSION['login_user'];
                    $q = mysqli_query($db, "SELECT * FROM student WHERE username='$username'");
                    if($q && mysqli_num_rows($q) > 0) {
                        $row = mysqli_fetch_assoc($q);
            ?>
            <h2 style="text-align: center;">My Profile</h2>
            <div style="text-align: center;">
                <img class="img-circle profile-img" height="110" width="120" src="images/<?php echo $_SESSION['pic']; ?>">
            </div>
            <div style="text-align: center;"><b>Welcome </b>
                <h4><?php echo $_SESSION['login_user']; ?></h4>
            </div>
            <?php 
                echo "<table class='table table-bordered'>";
                echo "<tr><td><b> First Name:  </b></td><td>".$row['first']."</td></tr>";
                echo "<tr><td><b> Last Name:  </b></td><td>".$row['last']."</td></tr>";
                echo "<tr><td><b> Username:  </b></td><td>".$row['username']."</td></tr>";
                echo "<tr><td><b> Password:  </b></td><td>".$row['password']."</td></tr>";
                echo "<tr><td><b> Email:  </b></td><td>".$row['email']."</td></tr>";
                echo "<tr><td><b> Contact:  </b></td><td>".$row['contact']."</td></tr>";
                echo "</table>";

                mysqli_free_result($q); // Free the result set
                }
            } else {
                // Redirect to login page or display an error message
                echo "<p>Please log in.</p>";
            }
            ?>
        </div>      
    </div>  
</body>
</html>
