<?php
include "connection.php";
include "navbar.php";

function isPasswordStrong($password) {
    // Password must be at least 8 characters long and include at least one number, one lowercase letter, one uppercase letter, and one special character
    return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/', $password);
}

function isEmailUnique($email) {
    global $db;
    $result = mysqli_query($db, "SELECT * FROM student WHERE email='$email'");
    return mysqli_num_rows($result) == 0;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title> Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <style type="text/css">
    section {
      margin-top: -20px;
    }

    .box2 {
      margin-left:350px;
    }

    .password-message {
      color: red;
    }
  </style>   
  <script>
    $(document).ready(function(){
      $('#password').on('input', function(){
        var password = $(this).val();
        var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;
        if (passwordRegex.test(password)) {
          $('.password-message').text('');
        } else {
          $('.password-message').text('Password must be at least 8 characters long and include at least one number, one lowercase letter, one uppercase letter, and one special character.');
        }
      });
    });
  </script>
</head>
<body>

<section>
  <div class="reg_img">
    <div class="box2">
      <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;"> &nbsp &nbsp &nbsp  Library Management System</h1>
      <h1 style="text-align: center; font-size: 25px;">User Registration Form</h1>
      <form name="Registration" action="" method="post">
        <div class="login">
          <input class="form-control" type="text" name="first" placeholder="First Name" required=""> <br>
          <input class="form-control" type="text" name="last" placeholder="Last Name" required=""> <br>
          <input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
          <input class="form-control" type="password" name="password" id="password" placeholder="Password" required=""> 
          <p class="password-message"></p>
          <input class="form-control" type="text" name="roll" placeholder="Roll" required=""><br>
          <input class="form-control" type="email" name="email" placeholder="Email" required=""><br>
          <input class="form-control" type="text" name="contact" placeholder="Phone No" required=""><br>
          <input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: 70px; height: 30px"> </div>
      </form>
    </div>
  </div>
</section>

<?php

if(isset($_POST['submit'])) {
  $count = 0;
  $sql = "SELECT username FROM student";
  $res = mysqli_query($db, $sql);

  while($row = mysqli_fetch_assoc($res)) {
    if($row['username'] == $_POST['username']) {
      $count++;
    }
  }

  if($count == 0 && isPasswordStrong($_POST['password']) && isEmailUnique($_POST['email'])) {
    $sql = "INSERT INTO student (first, last, username, password, roll, email, contact, pic) VALUES('$_POST[first]', '$_POST[last]', '$_POST[username]', '$_POST[password]', '$_POST[roll]', '$_POST[email]', '$_POST[contact]', 'user.jpg')";
    mysqli_query($db, $sql);
    ?>
    <script type="text/javascript">
      alert("Registration successful");
    </script>
    <?php
  } else {
    if ($count != 0) {
    ?>
      <script type="text/javascript">
        alert("The username already exists.");
      </script>
    <?php
    }
    if (!isPasswordStrong($_POST['password'])) {
    ?>
      <script type="text/javascript">
        alert("Password is not strong enough.");
      </script>
    <?php
    }
    if (!isEmailUnique($_POST['email'])) {
    ?>
      <script type="text/javascript">
        alert("The email is already in use.");
      </script>
    <?php
    }
  }
}
?>
</body>
</html>
