<?php   
    session_start();
    $fName = $_POST['firstname'];
    $lName = $_POST['lastname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $time = $_SERVER['REQUEST_TIME'];
    $success = 0;
    
    $_SESSION['session_ID'] = session_id();
    $my_Id = $_SESSION['session_ID'];


    if(ctype_alnum ($fName) && ctype_alnum ($lName) && ctype_alnum ($pass)){

        $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');
        $insertData = "INSERT INTO users(firstname,lastname,email,password,date_joined)
        VALUES ('$fName','$lName','$email','$pass','$time')";

        $stmt = $connect->query($insertData);
        $success = 1;
    }


    if($success == 1){
        echo "New user made!";
    }else{
        echo "Failed to make new user.";
    }
?>


    <p><a href="home.html"> Click here to go home.</a></p>