<?php
 include "connection.php";
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style>
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
            background: url('images/1.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content .box {
            padding: 2rem;
            border: 1px solid #ccc;
            background-color: rgba(3, 0, 2, 0.8);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            color: white;
            opacity: 0.7;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
        }

        .content .box h1 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .content .box p {
            margin-bottom: 0.5rem;
        }

        .footer {
            background: #333;
            color: #fff;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            padding: 0 1rem;
        }

        .footer .footer-content p {
            margin: 0;
        }

        .footer .footer-content .social-media {
            display: flex;
        }

        .footer .footer-content .social-media a {
            margin: 0 0.5rem;
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .footer .footer-content .social-media a:hover {
            color: #ddd;
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

            .footer .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer .footer-content .social-media {
                margin-top: 0.5rem;
            }
        }

        .navbar .logo span:hover,
        .navbar .nav-links a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
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
                    <li><a href="admin_login.php"><span>LOGIN</span></a></li>
                    <li><a href="feedback.php"><span>FEEDBACK</span></a></li>';
                }
                ?>
            </ul>
            <div class="menu-toggle">☰</div>
        </nav>

        <section class="content">
            <div class="box">
                <h1>Welcome to the Library</h1>
                <p>Opens at: 9:00 AM</p>
                <p>Closes at: 5:00 PM</p>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2024 Library. All rights reserved.</p>
                <div class="social-media">
                    <a href="https://www.facebook.com" target="_blank">Facebook</a>
                    <a href="https://www.twitter.com" target="_blank">Twitter</a>
                    <a href="https://www.instagram.com" target="_blank">Instagram</a>
                </div>
            </div>
        </footer>
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
