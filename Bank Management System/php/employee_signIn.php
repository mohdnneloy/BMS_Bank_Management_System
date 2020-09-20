<?php

require('connect.php'); // Adding connect file for database connection

// Checking if email values are set or not
 if(empty($_POST["employee_id"]) && empty($_POST["password"])){
   echo '<script>alert("Please enter your details!")</script>';
   echo '<script>window.location= "../employee_signIn.html";</script>';
   exit();
 }

 // Checking if email values are set or not
 else if(empty($_POST["employee_id"])){
    echo '<script>alert("Please enter your Employee ID!")</script>';
    echo '<script>window.location= "../employee_signIn.html";</script>';
    exit();
  }

// Checking if password values are set or not
  else if(empty($_POST["password"])){
    echo '<script>alert("Please enter your password!")</script>';
    echo '<script>window.location= "../employee_signIn.html";</script>';
    exit();
  }

  // Checking if all the values are set or not
  else if(!empty($_POST["employee_id"]) && !empty($_POST["password"])) {

      // Now storing data in variables

      $employee_id = $_POST["employee_id"];
      $password = $_POST["password"];


      // Fetching Data from database
      $sql0 = "Select count(*) as Count From Employee;";
      $result0 = mysqli_query($conn, $sql0);
      $sql1 = "Select Employee_id From employee Where employee_id = '$employee_id';";
      $result1 = mysqli_query($conn, $sql1);
      $sqle = "Select Password From employee Where password = md5('$password');";
      $resulte = mysqli_query($conn, $sqle);

      while($row = mysqli_fetch_array($result0)) {
        $check = $row['Count'];
      }

      if($check == 0){ //Checking if the database is emmpty or not
        echo '<script>alert("Database is Empty!")</script>';
        echo '<script>window.location= "../employee_signIn.html";</script>';

      }

      else{

        while($row = mysqli_fetch_array($result1)) {
          $employee_idcheck = $row['Employee_id'];
        }

        while($row = mysqli_fetch_array($resulte)) {
          $passwordcheck = $row['Password'];
        }

        if (empty($employee_idcheck)){

         echo '<script>alert("No Records Found!")</script>';
         echo '<script>window.location= "../employee_signIn.html";</script>';
         exit();
        }

        else if (empty($passwordcheck)){

          echo '<script>alert("Wrong Password!")</script>';
          echo '<script>window.location= "../employee_signIn.html";</script>';
          exit();
        }

        else if (!empty($employee_idcheck) && !empty($passwordcheck)){

          echo '<script>alert("Signed In!")</script>';
          echo '<script>window.location= "../customer_signIn.html";</script>';
          exit();
        }

      }

  }

  else{
    echo '<script>alert("Please enter all the details!")</script>';
    echo'<script>window.location= "../customer_signIn.html";</script>';
  }

 ?>
