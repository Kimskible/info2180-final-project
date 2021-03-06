<?php

  $issueId = $_GET["id"];
  $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');
  $stmt = $connect->query("SELECT * FROM issues WHERE id = $issueId");
  $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="style1.css">
  <script type="text/javascript" href = "app.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>BugMe Issue Tracker</title>
</head>

<body>

  <div class="header">
    <h1><i class="material-icons"> bug_report</i>BugMe Issue Tracker</h1>
  </div>

  <div class="sidebar">
    <ul class="">
      <li><a class ="home-page" href="home.php"> Home</a></li>
      <li><a class ="add-u-page" href="createuser.html"> Add User</a></li>
      <li><a class ="new-issue-page" href="newissue.php"> New Issue</a></li>
      <li><a class ="logout-page" href="logout.php"> Logout</a></li>
    </ul>
  </div>

  <div class="mainbar">
        <h1><?=$results[0]['title']?></h1>
        <h4>Issue #<?=$results[0]["id"]?></h4><br>
        <p><?=$results[0]["description"]?></p><br>
        <p>Issue created on <?=$results[0]["created"]?> by <?= $results[0]["created_by"]?></p>
        <p>Last updated on <?=$results[0]["updated"]?></p>
    </div>
  </div>


</body>

</html>