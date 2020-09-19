<?php

require('connect.php'); // Adding connect file for database connection

 // Checking if email values are set or not
  if(empty($_POST["email"])){
    echo '<script>alert("Please enter your email!")</script>';
    exit();
  }

  // Checking if all the values are set or not
  if(!empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])
            && !empty($_POST["gender"]) && !empty($_POST["Birth_Date"]) && !empty($_POST["Occupation"]) && !empty($_POST["Str_Address"]) && !empty($_POST["City"])
            && !empty($_POST["State"]) && !empty($_POST["Country"]) && !empty($_POST["Contact_Number"]) && !empty($_POST["Account_Type"])){


      //Confirming Password

      if($_POST["password"]!=$_POST["confirm_password"]){
        echo '<script>alert("Passwords do not match!")</script>';
        exit();
      }

      // Now storing data in variables

      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $gender = $_POST["gender"];
      $birth_date = $_POST["Birth_Date"];
      $occupation = $_POST["Occupation"];
      $str_address = $_POST["Str_Address"];
      $city = $_POST["City"];
      $state = $_POST["State"];
      $country = $_POST["Country"];
      $contact = $_POST["Contact_Number"];
      $acc_type = $_POST["Account_Type"];

      // Fetching Data from database
      $sql0 = "Select count(*) as Count From Customer;";
      $result0 = mysqli_query($conn, $sql0);
      $sqle = "Select Customer_ID from customer ORDER BY Customer_ID DESC LIMIT 1;";
      $resulte = mysqli_query($conn, $sqle);
      $sqla = "Select Acc_No from account ORDER BY Acc_No DESC LIMIT 1;";
      $resulta = mysqli_query($conn, $sqla);

      while($row = mysqli_fetch_array($result0)) {
        $check = $row['Count'];
      }

      while($row = mysqli_fetch_array($resulte)) {
        $customer_ID1 = $row['Customer_ID'];
      }

      while($row = mysqli_fetch_array($resulta)) {
        $account_no1 = $row['Acc_No'];
      }

      //Checking if the database is empty or not
      if($check == 0){
        $customer_ID = '20000001';
        $account_no = date('Y') . '00000000';
      }
      else{
        $customer_ID = $customer_ID1 + 1; //Incrementing ID for new employees
        $account_no = $account_no1 + 1;
      }



      $sql1 = "Insert Into customer (Customer_ID, Fname, Lname, Email,Password, Gender, Birth_Date, Occupation, Phone_No, Street_Add, City, State, Country)
              Value ('$customer_ID', '$fname', '$lname', '$email', md5('$password'), '$gender', '$birth_date', '$occupation', '$contact', '$str_address', '$city', '$state', '$country');";
      mysqli_query($conn, $sql1);

      $sql2 = "Insert Into account (Acc_No, Customer_ID, Acc_Type)
              Value ('$account_no', '$customer_ID', '$acc_type');";
      mysqli_query($conn, $sql2);

      echo '<script>alert("Details updated to database!")</script>';

  }

  else{
    echo '<script>alert("Please enter all the details!")</script>';
  }



 ?>
