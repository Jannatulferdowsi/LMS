<?php
include "connection.php";
include "navbar.php";

if(isset($_POST['submit'])) {
    // Sanitize user input
    $approve = mysqli_real_escape_string($db, $_POST['approve']);
    $issue = mysqli_real_escape_string($db, $_POST['issue']);
    $return = mysqli_real_escape_string($db, $_POST['return']);

    // Prepare and bind parameters
    $stmt = $db->prepare("UPDATE `issue_book` SET `approve`=?, `issue`=?, `return`=? WHERE `username`=? AND `bid`=?");
    $stmt->bind_param("sssss", $approve, $issue, $return, $_SESSION['name'], $_SESSION['bid']);

    // Execute the statement
    if ($stmt->execute()) {
        // Update books table
        mysqli_query($db, "UPDATE `books` SET `quantity`=`quantity`-1 WHERE `bid`='$_SESSION[bid]'");

        // Check if quantity becomes zero after update
        $res = mysqli_query($db, "SELECT `quantity` FROM `books` WHERE `bid`='$_SESSION[bid]'");
        $row = mysqli_fetch_assoc($res);
        $quantity = $row['quantity'];

        if ($quantity == 0) {
            // Update status if quantity becomes zero
            mysqli_query($db, "UPDATE `books` SET `status`='Not-available' WHERE `bid`='$_SESSION[bid]'");
        }

        // Redirect after successful update
        ?>
        <script type="text/javascript">
            alert("Updated Successfully.");
            window.location="request.php";
        </script>
        <?php
    } else {
        // Handle SQL error
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt

?>
    <script type="text/javascript">
        alert("Updated Successfully.");
        window.location="request.php";
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /* Your CSS styles */
    </style>
</head>
<body>

    <!--------------------------sidenav------------------------------------->

    <div id="mySidenav" class="sidenav">
        <!-- Your sidenav content -->
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

        <div class="container">
            <b><h3 style="text-align: center;">Approve Request</h3></b><br><br>
            <form class="Approve" action="" method="post">
                <input class="form-control" type="text" name="approve" placeholder="Approve or Not" required="">
                <br>
                <input class="form-control" type="text" name="issue" placeholder="Issue Date yyyy-mm-dd" required="">
                <input class="form-control" type="text" name="return" placeholder="Return Date yyyy-mm-dd" required="">
                <br>
                <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>

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

</body>
</html>
