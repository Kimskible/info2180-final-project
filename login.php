<?php
ob_start();
session_start();

require_once('./util/db.php');

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {

   $email 	= $_POST['email'];
  //$email 	= $_POST["user_email"];
  //$email ="admin@bugme.com";
  //$password = md5("password123");
   $password = md5($_POST["psw"]);
  
  $query  = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($connection,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
  $row     = mysqli_fetch_array($result);

  if( $num_row >=1 ) {

    echo "ok"; // log in

    $_SESSION['logged_in'] = $row['id'];

  }else {

    echo "error";
  
  }
    
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="login.css">
  <title>BugMe Issue Tracker</title>
</head>

<body>
  <div class="header">
  </div>
  <div class="login">
    <form  method="POST" action="login.php">
      <div class="imgcontainer">
        <img src="avatar.png" alt="Avatar" class="avatar">
      </div>
  
      <div class="container">
        <label for="email"><b> Email </b></label>
        <input type="email" placeholder="Enter your email" name="email" required>
    
        <label for="psw"><b> Password </b></label>
        <input type="password" placeholder="Enter your password" name="psw" required>
  
        <button type="submit">LOGIN</button>
      </div>
      
  
    </form>

  </div>
</body>

</html>


