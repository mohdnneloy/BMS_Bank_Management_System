<?php

  require('php/connect.php'); // Adding connect file for database connection
  session_start();

  $employee_id = $_SESSION['employeeId'];
  $sql0 = "Select * From Employee where employee_id = '$employee_id';";
  $result0 = mysqli_query($conn, $sql0);

  while($row = mysqli_fetch_array($result0)) {
    $fname = $row['Fname'];
    $lname = $row['LName'];
    $email = $row['Email'];
    $gender = $row['Gender'];

    if($gender == 'M'){
      $gender = 'Male';
    }

    else{
      $gender = 'Female';
    }

    $birth_date = $row['Birth_Date'];

    $birth_date = date("d M Y", strtotime($birth_date));

    $occupation = $row['Occupation'];
    $phone_no = $row['Phone_No'];
    $str_address = $row['Street_Add'];
    $city = $row['City'];
    $state = $row['State'];
    $country = $row['Country'];
  }
?>


<!DOCTYPE html>
<html lang='en'>

  <head>
    <meta charset="utf-8">
    <title>Employee Profile</title>
    <link rel="stylesheet" type="text/css" href="css/style_employee_profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;700&family=Quicksand:wght@300;700&display=swap" rel="stylesheet">
  </head>

  <body>

    <div class = "container">

      <section class = 'left'>

        <img class = "mainPage" src = "Pics/No Profile Icon White.png">
        <h1 class = "main"><?php echo $fname . " " . $lname;?></h1>
        </br>

        <div class = "navbar">
          <li class =" active" ><a class =" active" href="employee_profile.php">Profile</a></li>
          <li><a href="employee_work_details.php">Work Details</a></li>
          <li><a href="employee_work_tracker.php">Work Time Tracker </a></li>
          <li><a href="employee_signIn.html">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Profile</h1>
        <div class = "details">
          <h2>Employee ID - <span><?php echo "#" . $employee_id?></span></h2>
          <h2>Name - <span><?php echo $fname . " " . $lname?></span></h2>
          <h2>Email - <span><?php echo $email?></span></h2>
          <h2>Date Of Birth - <span><?php echo $birth_date ?></span></h2>
          <h2>Gender - <span><?php echo $gender ?></span></h2>
          <h2>Occupation - <span><?php echo $occupation ?></span></h2>
          <h2>Home Address - <span><?php echo $str_address . ", " . $city . ", " . $state . ", " . $country ?></span></h2>
          <h2>Contact number - <span><?php echo  $phone_no?></span></h2>
        </div>

      </section>


    </div>


  </body>
</html>
