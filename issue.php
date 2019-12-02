<?php   
    session_start();
    $title = $_POST['title'];
    $description = $_POST['descrip'];
    $assignedTo = $_POST['assigned'];
    $typeOf = $_POST['typeof'];
    $priority = $_POST['pri'];
    $assignedToID;
    $time = $_SERVER['REQUEST_TIME'];
    $success = 0;
    $def = 'open';

    $my_Id =$_SESSION['logged_in'];
    if(ctype_alnum ($title) && ctype_alnum ($description) && ctype_alnum ($typeOf)  && ctype_alnum ($priority)){
        $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');

        $stmt = $connect->query("SELECT * FROM users");
        $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
        foreach ($results as $row){
            if($assignedTo == ($row['firstname']." ".$row['lastname'])){
                $assignedToID = $row['id'];
            }
        }
        $connect = null;
        $stmt = null;
        $results = null;
        $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');
        $insertData = "INSERT INTO issues(title,description,type,priority,status,assigned_to,created_by,created,updated)
        VALUES ('$title','$description','$typeOf','$priority','$def','$assignedToID','$my_Id',$time,$time)";
        $stmt = $connect->query($insertData);
        ?>
        <p><?=$title, $description, $typeOf, $priority, $def, $assignedToID, $my_Id, $time, $time?></p>
        <?php
        $stmt = $connect->query("SELECT * FROM issues");
        $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
        $success = 1;
    }


    if($success == 1){
        echo "Issue submitted!";
    }else{
        echo "Failed to submit issue.";
    }
?>


    <p><a href="home.php"> Click here to go home.</a></p>