<?php

require('connect.php'); // Adding connect file for database connection
session_destroy();
session_start();

// Checking if email values are set or not
 if(empty($_POST["email"]) && empty($_POST["password"])){
   echo '<script>alert("Please enter your details!")</script>';
   echo '<script>window.location= "../customer_signIn.html";</script>';
   exit();
 }

 // Checking if email values are set or not
 else if(empty($_POST["email"])){
    echo '<script>alert("Please enter your email!")</script>';
    echo '<script>window.location= "../customer_signIn.html";</script>';
    exit();
  }

// Checking if password values are set or not
  else if(empty($_POST["password"])){
    echo '<script>alert("Please enter your password!")</script>';
    echo '<script>window.location= "../customer_signIn.html";</script>';
    exit();
  }

  // Checking if all the values are set or not
  else if(!empty($_POST["email"]) && !empty($_POST["password"])) {


      // Now storing data in variables

      $email = $_POST["email"];
      $password = $_POST["password"];

      $_SESSION['email_id'] = $email; // Session created for further use

      // Fetching Data from database
      $sql0 = "Select count(*) as Count From Customer;";
      $result0 = mysqli_query($conn, $sql0);
      $sql1 = "Select Email From customer Where Email = '$email';";
      $result1 = mysqli_query($conn, $sql1);
      $sqle = "Select Password From customer Where Password = md5('$password') AND Email = '$email';";
      $resulte = mysqli_query($conn, $sqle);

      while($row = mysqli_fetch_array($result0)) {
        $check = $row['Count'];
      }

      if($check == 0){ //Checking if the database is emmpty or not
        echo '<script>alert("Database is Empty!")</script>';
        echo '<script>window.location= "../customer_signIn.html";</script>';

      }

      else{

        while($row = mysqli_fetch_array($result1)) {
          $emailcheck = $row['Email'];
        }

        while($row = mysqli_fetch_array($resulte)) {
          $passwordcheck = $row['Password'];
          $_SESSION['password_save'] = $passwordcheck; // Session created for further use
        }

        if (empty($emailcheck)){

         echo '<script>alert("No Records Found!")</script>';
         echo '<script>window.location= "../customer_signIn.html";</script>';
         exit();
       }

        else if (empty($passwordcheck)){

          echo '<script>alert("Wrong Password!")</script>';
          echo '<script>window.location= "../customer_signIn.html";</script>';
          exit();
        }

        else if (!empty($emailcheck) && !empty($passwordcheck)){

          echo '<script>alert("Signed In!")</script>';
          echo '<script>window.location= "../customer_profile.php";</script>';
          exit();
        }
      }
  }

  else{
    echo '<script>alert("Please enter all the details!")</script>';
    echo'<script>window.location= "../customer_signIn.html";</script>';
  }



 ?>
