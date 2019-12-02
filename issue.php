<?php   
    session_start();
    $title = $_POST['title'];
    $description = $_POST['descrip'];
    $assignedTo = $_POST['assigned'];
    $typeOf = $_POST['typeof'];
    $priority = $_POST['pri'];
    $assignedToID = "1";
    $time = $_SERVER['REQUEST_TIME'];
    $success = 0;
    $def = "Open";
    
    $_SESSION['session_ID'] = session_id();
    $my_Id = $_SESSION['session_ID'];


    if(ctype_alnum ($title) && ctype_alnum ($description) && ctype_alnum ($assignedTo) && ctype_alnum ($typeOf)  && ctype_alnum ($priority)){
        $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');

        $stmt = $connect->query("SELECT * FROM users");
        $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
        foreach ($results as $row){
            if($assignedTo == ($row['firstname'].$row['lastname'])){
                $assignedToID = $row['id'];
            }
        }

        $connect2 = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');
        $insertData = "INSERT INTO issues(title,description,type,priority,status,assigned_to,created_by,created,updated)
        VALUES ('$title','$description','$typeOf','$priority','$def','$assignedToID','$my_Id','$time','$time')";

        $stmt = $connect2->query($insertData);
        $success = 1;
    }


    if($success == 1){
        echo "Issue submitted!";
    }else{
        echo "Failed to submit issue.";
    }
?>


    <p><a href="home.html"> Click here to go home.</a></p>