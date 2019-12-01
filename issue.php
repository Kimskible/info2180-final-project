 <?php   
    $title = $_POST['title'];
    $description = $_POST['descrip'];
    $assignedTo = $_POST['assigned'];
    $typeOf = $_POST['typeof'];
    $priority = $_POST['pri'];
    $assignedToID;
    $time = $_SERVER['REQUEST_TIME'];



    if(ctype_alnum ($title) && ctype_alnum ($description) && ctype_alnum ($assignedTo) && ctype_alnum ($typeOf)  && ctype_alnum ($priority){
        $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'root', '');

        $stmt = $connect->query("SELECT id FROM users");
        $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
        foreach ($results as $row) {
            if($assignedTo == $row){
                $assignedToID = $row;
            }
        }

        $connect2 = new PDO('mysql:host=localhost;dbname=bugme;', 'root', '');
        $insertData = "INSERT INTO issues(title,description,type,priority,status,assigned_to,created_by,created,updated)
        VALUES ('$title','$description','$typeOf','$priority','Open','$assignedToID','$_SESSION["curr_Id"]','$time','$time')";

        $stmt = $connect2->query($insertData);

    }


