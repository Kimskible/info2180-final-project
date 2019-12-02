<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>BugMe Issue Tracker</title>
</head>
  <?php
      $connect = new PDO('mysql:host=localhost;dbname=bugme;', 'root', '');

      $stmt = $connect->query("SELECT * FROM users");
      $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
  ?>
<body>

  <div class="header">
    <h1><i class="material-icons"> bug_report</i>BugMe Issue Tracker</h1>
  </div>

  <div class="sidebar">
    <ul class="">
      <li><a href="home.html"> Home</a></li>
      <li><a href="createuser.html"> Add User</a></li>
      <li><a href="newissue.html"> New Issue</a></li>
      <li><a href="login.html"> Logout</a></li>
    </ul>
  </div>


  <div class="mainbar">
    <div class="formdiv">

      <h1> Create Issue </h1>

      <form action = "home.html">
        <label for="title">Title</label>
        <input type="text" id="title" name="title">
        
        <label for="descrip">Description</label>
        <textarea id="descrip" name="descrip"></textarea>

        <label for="assignedto"> Assigned To </label>
        <select id="assigned" name="assigned">
          <?php foreach ($results as $row): ?>
            <option><?=$row['firstname'].$row['lastname']?></option>
          <?php endforeach; ?>
        </select>

        <label for="typeofissue"> Type </label>
        <select id="typeof" name="typeof">
          <option value="1"> Bug </option>
          <option value="2">  </option>
          <option value="3">  </option>
        </select>

        <label for="priority"> Priority </label>
        <select id="pri" name="pri">
          <option value="1"> Minor </option>
          <option value="2"> Major </option>
          <option value="3"> Critical </option>
        </select>

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>


</body>

</html>