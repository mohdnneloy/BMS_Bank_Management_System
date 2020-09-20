<?php

  require('php/connect.php'); // Adding connect file for database connection
  session_start();

  $employee_id = $_SESSION['employeeId'];
  $sql0 = "Select * From Employee where employee_id = '$employee_id';";
  $result0 = mysqli_query($conn, $sql0);

  while($row = mysqli_fetch_array($result0)) {
    $fname = $row['Fname'];
    $lname = $row['LName'];
    $designation = $row['Designation'];
    $salary= $row['Salary'];
    $work_limit = $row['Work_Limit'];
    $manager_id = $row['Manager_ID'];
  }

  $sql1 = "Select * From Employee where employee_id = '$manager_id';";
  $result1 = mysqli_query($conn, $sql1);

  while($row = mysqli_fetch_array($result1)) {

    $manager_fname = $row['Fname'];
    $manager_lname = $row['LName'];
    $manager_contact = $row['Phone_No'];
  }

?>

<!DOCTYPE html>
<html lang='en'>

  <head>
    <meta charset="utf-8">
    <title>Employee Work Details</title>
    <link rel="stylesheet" type="text/css" href="css/style_employee_work_details.css">
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;700&family=Quicksand:wght@300;700&display=swap" rel="stylesheet">
  </head>

  <body>

    <div class = "container">

      <section class = 'left'>

        <img class = "mainPage" src = "Pics/No Profile Icon White.png">
        <h1 class = "main"><?php echo $fname . " " . $lname;?></h1>
        </br>

        <div class = "navbar">
          <li><a href="employee_profile.php">Profile</a></li>
          <li class =" active" ><a class =" active" href="employee_work_details.php">Work Details</a></li>
          <li><a href="employee_work_tracker.php">Work Time Tracker </a></li>
          <li><a href="employee_signIn.html">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Work Details</h1>
        <div class = "details">
          <h2>Average Work Hours Per Week - </h2>
          <h2>Work Hours Per Week Limit - <span><?php echo $work_limit . " hrs"?></span></h2>
          <h2>Salary - <span><?php echo "TK " . $salary?></span></h2>
          <h2>Designation - <span><?php echo $designation?></span></h2>
          <h2>Manager Name - <span><?php echo $manager_fname . " " . $manager_lname?></span></h2>
          <h2>Manager Contact Number - <span><?php echo $manager_contact?></span></h2>
        </div>

      </section>


    </div>


  </body>
</html>
