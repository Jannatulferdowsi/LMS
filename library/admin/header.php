<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style>
        .logo {
            height: 70px;
            width: 95px;
            margin-left: -20px;
            margin-top:5px;
        }
        .navbar {
            min-height: 80px; /* Increase the height of the navbar */
        }
        .navbar-brand {
            font-size: 24px; /* Increase the font size of the brand */
            line-height: 40px; /* Center the brand text vertically */
        }
        .navbar-nav > li > a {
            padding-top: 30px; /* Increase the padding for the nav links */
            padding-bottom: 30px; /* Increase the padding for the nav links */
            font-size: 18px; /* Increase the font size of the nav links */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <img class="logo" src="images/9.png">
                <a class="navbar-brand active">&nbspLIBRARY MANAGEMENT SYSTEM</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">HOME</a></li>
                <li><a href="books.php">BOOKS</a></li>
                <li><a href="feedback.php">FEEDBACK</a></li>
                <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGNUP</span></a></li>
            </ul>
        </div>
    </nav>
</body>
</html>
