<?php
ob_start();
session_start();

require_once('./util/db.php');

 if(true)
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