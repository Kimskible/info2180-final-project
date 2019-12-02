<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" href = "app.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>BugMe Issue Tracker</title>
</head>
  <?php
      $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'bugmeapp', 'password');

      $stmt = $connect->query("SELECT * FROM users");
      $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
  ?>
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
    <div class="formdiv">

      <h1> Create Issue </h1>

      <form method="post" action = "issue.php" >
        <label for="title">Title</label>
        <input type="text" id="title" name="title">
        
        <label for="descrip">Description</label>
        <textarea id="descrip" name="descrip"></textarea>

        <label for="assignedto"> Assigned To </label>
        <select id="assigned" name="assigned">
          <?php foreach ($results as $row): ?>
            <option><?=$row['firstname']." ".$row['lastname']?></option>
          <?php endforeach; ?>
        </select>

        <label for="typeofissue"> Type </label>
        <select id="typeof" name="typeof">
          <option value="bug"> Bug </option>
          <option value="proposal"> Proposal </option>
          <option value="task"> Task </option>
        </select>

        <label for="priority"> Priority </label>
        <select id="pri" name="pri">
          <option value="minor"> Minor </option>
          <option value="major"> Major </option>
          <option value="critical"> Critical </option>
        </select>

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>


</body>

</html>