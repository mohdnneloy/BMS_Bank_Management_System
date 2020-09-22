<?php

require('connect.php'); // Adding connect file for database connection
session_start();

// Checking if values are set or not
 if(empty($_POST["email_to"]) || empty($_POST["password2"]) || empty($_POST["amount"])){
   echo '<script>alert("Please all the details for the transaction!")</script>';
   echo '<script>window.location= "../customer_send_money.php";</script>';
   exit();
 }

 // Checking if email is same as the user or not
 else if($_POST["email_to"] == $_SESSION["email_id"]){
    echo '<script>alert("Please enter another email!")</script>';
    echo '<script>window.location= "../customer_send_money.php";</script>';
    exit();
  }

// Checking if password matched or not
  if(md5($_POST["password2"]) != $_SESSION["password_save"]){
    echo '<script>alert("Wrong Password!")</script>';
    echo '<script>window.location= "../customer_send_money.php";</script>';
    exit();
  }

  //Checking transaction limit

  $email = $_SESSION['email_id'];
  $amount = $_POST['amount'];

  $sql1 = "Select * From customer where Email = '$email';";
  $result1 = mysqli_query($conn, $sql1);

  while($row = mysqli_fetch_array($result1)) {
    $customer_id = $row['Customer_ID'];
  }

  $sql0 = "Select * From account where Customer_ID = '$customer_id';";
  $result0 = mysqli_query($conn, $sql0);

  while($row = mysqli_fetch_array($result0)) {
    $acc_no = $row['Acc_No'];
    $acc_bal = $row['Acc_Bal'];
    $trans_limit = $row['Trans_Limit'];
  }

  if($amount > $acc_bal){
    echo '<script>alert("Not Enough Balance In Account!")</script>';
    echo '<script>window.location= "../customer_send_money.php";</script>';
    exit();
  }

  else if($amount > $trans_limit){
    echo '<script>alert("Exceding Transaction Limit!")</script>';
    echo '<script>window.location= "../customer_send_money.php";</script>';
    exit();
  }

  // Retriving Information for Receiver

  $email_to = $_POST['email_to'];

  $sql2 = "Select * From customer where Email = '$email_to';";
  $result2 = mysqli_query($conn, $sql2);

  while($row = mysqli_fetch_array($result2)) {
    $customer_id_to = $row['Customer_ID'];
  }

  $sql3 = "Select * From account where Customer_ID = '$customer_id_to';";
  $result3 = mysqli_query($conn, $sql3);

  while($row = mysqli_fetch_array($result3)) {
    $acc_no_to = $row['Acc_No'];
    $acc_bal_to = $row['Acc_Bal'];
  }

  if(empty($acc_no_to)){
    echo '<script>alert("Email Not Found in Database!")</script>';
    echo '<script>window.location= "../customer_send_money.php";</script>';
    exit();
  }


  $date = date("y-m-d"); // Current Date

  // Generating Transaction ID

  $sql4 = "Select count(*) as Count From Transaction;";
  $result4 = mysqli_query($conn, $sql4);
  $sql5 = "Select Trans_ID from Transaction ORDER BY Trans_ID DESC LIMIT 1;";
  $result5 = mysqli_query($conn, $sql5);

  while($row = mysqli_fetch_array($result4)) {
    $check = $row['Count'];
  }

  while($row = mysqli_fetch_array($result5)) {
    $trans_ID = $row['Trans_ID'];
  }

  if($check == 0){
    $trans_ID = '100000000';
  }

  else{
    $trans_ID = $trans_ID + 1;
  }

  // Updating data in account for sender

  $acc_bal = $acc_bal - $amount;
  $acc_bal_to = $acc_bal_to + $amount;

  $sql6 = "Update account Set Acc_Bal = '$acc_bal' where Acc_No = '$acc_no';";
  $result6 = mysqli_query($conn, $sql6);

  $sql7 = "Update account Set Acc_Bal = '$acc_bal_to' where Acc_No = '$acc_no_to';";
  $result7 = mysqli_query($conn, $sql7);



  $sql0 = "Insert Into transaction (Trans_ID, Trans_From, Trans_To, Amount, Trans_Date)
          Values ('$trans_ID', '$acc_no', '$acc_no_to', '$amount', '$date');";
  $result0 = mysqli_query($conn, $sql0);


  echo '<script>alert("Transaction Successfull!")</script>';
  echo'<script>window.location= "../customer_transactions.php";</script>';


 ?>
