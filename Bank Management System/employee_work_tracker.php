<?php

  require('php/connect.php'); // Adding connect file for database connection
  session_start();

  $employee_id = $_SESSION['employeeId'];
  $sql0 = "Select * From work_tracker where Employee_ID = '$employee_id' Order By Work_Date DESC, SignIn_Time DESC;";
  $result0 = mysqli_query($conn, $sql0);
  $counter = 0; // Counter for rows
  $max = 0; // For max number of rows

  $sql1 = "Select count(*) as Count From work_tracker where Employee_ID = '$employee_id';";
  $result1 = mysqli_query($conn, $sql1);

  while($row = mysqli_fetch_array($result1)) {
    $check = $row['Count'];
  }

  if($check >= 7){
    $max = 7;
  }

  else{
    $max = $check;
  }

  $sql2 = "Select * From Employee where employee_id = '$employee_id';";
  $result2 = mysqli_query($conn, $sql2);

  while($row = mysqli_fetch_array($result2)) {
    $fname = $row['Fname'];
    $lname = $row['LName'];
  }

?>

<!DOCTYPE html>
<html lang='en'>

  <head>
    <meta charset="utf-8">
    <title>Employee Work Tracker</title>
    <link rel="stylesheet" href="css/style_employee_work_tracker.css?v=<?php echo time(); ?>">
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
          <li><a  href="employee_work_details.php">Work Details</a></li>
          <li class =" active"><a class =" active" href="employee_work_tracker.php">Work Time Tracker </a></li>
          <li><a href="php/employee_signOut.php">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Work Time Tracker</h1>
        <div class = "details">

          <table class = "table_container">

            <thead>
                <th>Date</th>
                <th>Sign In Time</th>
                <th>Sign Out Time</th>
                <th>Working Hours</th>
            </thead>

            <?php

            while($row = mysqli_fetch_array($result0) ) {

              if($counter < $max){
                echo  "<tr>";
                echo  "<td>{$row['Work_Date']}</td>";
                echo  "<td>{$row['SignIn_Time']}</td>";
                echo  "<td>{$row['SignOut_Time']}</td>";
                echo  "<td>{$row['Working_Hours']}</td>";
                echo  "</tr>";
                $counter++;
              }
              else{
                break;
              }
            }
            ?>

          </table>

        </div>

      </section>


    </div>


  </body>
</html>
