<?php

require('connect.php'); // Adding connect file for database connection

 // Checking if email values are set or not
  if(empty($_POST["eemail"])){
    echo '<script>alert("Please enter your email!")</script>';
    exit();
  }

  // Checking if all the values are set or not
  if(!empty($_POST["efname"]) && !empty($_POST["elname"]) && !empty($_POST["eemail"]) && !empty($_POST["epassword"]) && !empty($_POST["econfirm_password"])
            && !empty($_POST["egender"]) && !empty($_POST["eBirth_Date"]) && !empty($_POST["eOccupation"]) && !empty($_POST["eStr_Address"]) && !empty($_POST["eCity"])
            && !empty($_POST["eState"]) && !empty($_POST["eCountry"]) && !empty($_POST["eContact_Number"])){


      //Confirming Password

      if($_POST["epassword"]!=$_POST["econfirm_password"]){
        echo '<script>alert("Passwords do not match!")</script>';
        exit();
      }

      // Now storing data in variables

      $fname = $_POST["efname"];
      $lname = $_POST["elname"];
      $email = $_POST["eemail"];
      $password = $_POST["epassword"];
      $gender = $_POST["egender"];
      $birth_date = $_POST["eBirth_Date"];
      $occupation = $_POST["eOccupation"];
      $str_address = $_POST["eStr_Address"];
      $city = $_POST["eCity"];
      $state = $_POST["eState"];
      $country = $_POST["eCountry"];
      $contact = $_POST["eContact_Number"];

      // Fetching Data from database
      $sql0 = "Select count(*) as Count From Employee;";
      $result0 = mysqli_query($conn, $sql0);
      $sqle = "Select Employee_ID from employee ORDER BY Employee_ID DESC LIMIT 1;";
      $resulte = mysqli_query($conn, $sqle);


      while($row = mysqli_fetch_array($result0)) {
        $check = $row['Count'];
      }

      while($row = mysqli_fetch_array($resulte)) {
        $employee_ID1 = $row['Employee_ID'];
      }

      //Checking if the database is empty or not
      if($check == 0){
        $employee_ID = date('Y') . '000000';
      }
      else{
        $employee_ID = $employee_ID1 + 1; //Incrementing ID for new employees
      }



      $sql1 = "Insert Into employee (Employee_ID, Fname, LName, email, Password, Gender, Birth_Date, Occupation, Phone_No, Street_Add, City, State, Country)
              Value ('$employee_ID', '$fname', '$lname', '$email', md5('$password'), '$gender', '$birth_date', '$occupation', '$contact', '$str_address', '$city', '$state', '$country');";
      mysqli_query($conn, $sql1);

      echo '<script>alert("Details updated to database!")</script>';
      echo'<script>window.location= "../employee_signIn.html";</script>';

  }

  else{
    echo '<script>alert("Please enter all the details!")</script>';
    echo'<script>window.location= "../signUp.html";</script>';
  }



 ?>
