<?php

  require('connect.php'); // Adding connect file for database connection
  session_start();
  date_default_timezone_set('Asia/Dhaka');

  $employee_id = $_SESSION['employeeId'];
  $current_date = $_SESSION['current_date'] ;
  $signIn_time = $_SESSION['current_time'] ;
  $signOut_time = date("h:i:s", time());
  $signIn_hour = date("h", strtotime($signIn_time));
  $signIn_min = date("i", strtotime($signIn_time));
  $signOut_hour = date("h", strtotime($signOut_time));
  $signOut_min = date("i", strtotime($signOut_time));
  $working_hours = number_format(($signOut_hour - $signIn_hour), 1) + number_format(($signOut_min - $signIn_min)/60, 1); //Calculated hours worked

  $sql0 = "Insert Into work_tracker (Employee_ID, SignIn_Time, SignOut_Time, Work_Date, Working_Hours)
          Values ('$employee_id', '$signIn_time', '$signOut_time', '$current_date', '$working_hours');";
  $result0 = mysqli_query($conn, $sql0);


  echo '<script>alert("Signing Out!")</script>';
  echo'<script>window.location= "../employee_signIn.html";</script>';

?>
