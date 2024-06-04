<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style>
        /* Your existing CSS styles */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #333;
            color: #fff;
            padding: 1rem;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 0.5rem;
        }

        .navbar .logo span {
            font-size: 1.5rem;
            color: #ddd;
        }

        .navbar .nav-links {
            list-style: none;
            display: flex;
        }

        .navbar .nav-links li {
            margin-left: 1rem;
        }

        .navbar .nav-links a {
            color: #ddd;
            text-decoration: none;
        }

        .navbar .nav-links a:hover {
            color: #fff;
        }

        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .content {
            flex: 1;
            padding: 2rem;
            text-align: center;
            background: url('images/3.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box1 {
            background-color: rgba(0, 0, 0, 0.9); /* Black background with some transparency */
            color: white;
            padding: 5px;
            border-radius: 10px;
            background-color: black;
    
            opacity: .7;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
            max-width: 450px;
            height:450px;
            width: 100%;
            text-align: center;
        }

        .box1 h1 {
            font-size: 21px;
          
            margin-top:5px;
        }

        .box1 h1:nth-of-type(2) {
            font-size: 15px;
            margin-bottom: 30px;
        }

        .login {
            display: flex;
            flex-direction: column;
        }

        .form-control {
            margin-bottom: 10px;
            border-radius: 5px;
            padding: 5px;
            font-size: 1.0rem; /* Increased font size */
        }


input
{ margin-left:5px;
    height: 40px;
    width: 300px;

}
        .btn {
            background-color: #f8f9fa;
            color: black;
            border: none;
            width:40px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.2rem; /* Increased font size */
        }

        .btn:hover {
            background-color: #ddd;
        }

        .box1 p {
            margin-top: 30px;
        }

        .box1 p a {
            color: white;
            text-decoration: underline;
        }
form .login
{
    margin: auto 50px;
}

        .alert {
            width: 80%;
            margin: 20px auto;
            text-align: center;
            background-color: #de1313;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }

        @media (max-width: 768px) {
            .navbar .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
            }

            .navbar .nav-links.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar">
            <div class="logo">
                <img src="images/9.png" alt="Logo">
                <span>LIBRARY MANAGEMENT SYSTEM</span>
            </div>
            <ul class="nav-links">
                <?php
                if (isset($_SESSION['login_user'])) {
                    echo '
                    <li><a href="index.php"><span>HOME</span></a></li>
                    <li><a href="books.php"><span>BOOKS</span></a></li>
                    <li><a href="logout.php"><span>LOGOUT</span></a></li>
                    <li><a href="feedback.php"><span>FEEDBACK</span></a></li>';
                } else {
                    echo '
                    <li><a href="index.php"><span>HOME</span></a></li>
                    <li><a href="books.php"><span>BOOKS</span></a></li>
                    <li><a href="feedback.php"><span>FEEDBACK</span></a></li>
                    
                    <li><a href="registration.php"><span>SIGNUP</span></a></li>';
                }
                ?>
            </ul>
            <div class="menu-toggle">☰</div>
        </nav>

        <section class="content">
            <div class="box1">
                <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;">Library Management System</h1>
                <h1 style="text-align: center; font-size: 25px;">User Login Form</h1>
                <form name="login" action="" method="post">
                    <div class="login">
                        <input class="form-control" type="text" name="username" placeholder="Username" required="">
                        <input class="form-control" type="password" name="password" placeholder="Password" required="">
                        <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 25%; height: 35px"> 
                    </div>
                    <p style="color: white; padding-left: 15px;">
                        <a style="color:white;" href="update_password.php">Forgot password?</a> &nbsp &nbsp &nbsp &nbsp
                        New to this website? <a style="color: white;" href="registration.php">Sign Up</a>
                    </p>
                </form>
            </div>
        </section>

        <?php
        if (isset($_POST['submit'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            $query = "SELECT * FROM `admin` WHERE username='$username' AND password='$password'";
            $res = mysqli_query($db, $query);

            if (!$res) {
                die("Query failed: " . mysqli_error($db));
            }

            $count = mysqli_num_rows($res);

            if ($count == 0) {
                echo "<div class='alert alert-danger' style='display: block;'><strong>The username and password don't match.</strong></div>";
            } else {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['login_user'] = $username;
                $_SESSION['pic'] = $row['pic'];
                echo "<script type='text/javascript'>window.location = 'index.php';</script>";
            }
        }
        ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            menuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
