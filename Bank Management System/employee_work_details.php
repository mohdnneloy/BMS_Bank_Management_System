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

  if(!empty($manager_id)){

  $sql1 = "Select * From Employee where employee_id = '$manager_id';";
  $result1 = mysqli_query($conn, $sql1);

  while($row = mysqli_fetch_array($result1)) {

    $manager_fname = $row['Fname'];
    $manager_lname = $row['LName'];
    $manager_contact = $row['Phone_No'];
  }
}

else{
    $manager_fname = "N/A";
    $manager_lname = " ";
    $manager_contact = "N/A";
}

    if(empty($salary)){
      $salary = 0;
    }

    if(empty($designation)){
      $designation = "N/A";
    }

    if(empty($work_limit)){
      $work_limit = 0;
    }

  $counter = 0;
  $max = 0; // For max number of rows

  $sql3 = "Select count(*) as Count From work_tracker where Employee_ID = '$employee_id';";
  $result3 = mysqli_query($conn, $sql3);

  while($row = mysqli_fetch_array($result3)) {
    $check = $row['Count'];
  }

  if($check >= 7){
    $max = 7;
  }

  else{
    $max = $check;
  }

  $sql2 = "Select * From work_tracker where Employee_ID = '$employee_id' Order By Work_Date DESC, SignIn_Time DESC;";
  $result2 = mysqli_query($conn, $sql2);
  $avg_work_hour = 0;

  while($row = mysqli_fetch_array($result2) ) {

    if($counter < $max){
      $avg_work_hour = $avg_work_hour + $row['Working_Hours'];
      $counter++;
    }
    else{
      break;
    }
  }

  $avg_work_hour = number_format($avg_work_hour/7 , 1);




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
          <li><a href="php/employee_signOut.php">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Work Details</h1>
        <div class = "details">
          <h2>Average Work Hours Per Week - <span><?php echo $avg_work_hour . " hrs"?></span> </h2>
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
