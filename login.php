<?php
ob_start();
session_start();

require_once('./util/db.php');


if(isset($_SESSION['logged_in']))
{
    header("Location: home.php");
    exit;
 }

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {

   $email 	= $_POST["email"];
   $password = md5($_POST["psw"]);
  
  $query  = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($connection,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
  $row     = mysqli_fetch_array($result);

  if( $num_row >=1 ) {
	$_SESSION['logged_in'] = $row['id'];
	$_SESSION['role'] = 2;
    header("location: createUser.php"); // log in

    

  }else {

    echo "Login Failed";
  
  }
    
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
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


