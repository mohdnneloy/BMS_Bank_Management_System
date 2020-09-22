<?php

  require('php/connect.php'); // Adding connect file for database connection
  session_start();

  $email = $_SESSION['email_id'];

  $sql1 = "Select * From customer where Email = '$email';";
  $result1 = mysqli_query($conn, $sql1);

  while($row = mysqli_fetch_array($result1)) {
    $fname = $row['Fname'];
    $lname = $row['LName'];
    $customer_id = $row['Customer_ID'];
  }

  $sql0 = "Select * From account where Customer_ID = '$customer_id';";
  $result0 = mysqli_query($conn, $sql0);

  while($row = mysqli_fetch_array($result0)) {
    $acc_no = $row['Acc_No'];
    $acc_type = $row['Acc_Type'];
    $acc_bal = $row['Acc_Bal'];
    $trans_limit = $row['Trans_Limit'];
  }

?>


<!DOCTYPE html>
<html lang='en'>

  <head>
    <meta charset="utf-8">
    <title>Customer Account Details</title>
    <link rel="stylesheet" type="text/css" href="css/style_customer_account_details.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;700&family=Quicksand:wght@300;700&display=swap" rel="stylesheet">
  </head>

  <body>

    <div class = "container">

      <section class = 'left'>

        <img class = "mainPage" src = "Pics/No Profile Icon White.png">
        <h1 class = "main"><?php echo $fname . " " . $lname;?></h1>
        </br>

        <div class = "navbar">
          <li><a href="customer_profile.php">Profile</a></li>
          <li class =" active" ><a class =" active" href="customer_account_details.php">Account Details</a></li>
          <li><a href="customer_transactions.php">Transactions</a></li>
          <li><a href="customer_send_money.php">Send Money</a></li>
          <li><a href="customer_signIn.html">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Account Details</h1>
        <div class = "details">
          <h2>Account Number - <span><?php echo "#" . $acc_no?></span></h2>
          <h2>Customer ID - <span><?php echo "#" . $customer_id?></span></h2>
          <h2>Account Type - <span><?php echo $acc_type ?></span></h2>
          <h2>Transactions Limit - <span><?php echo "TK " . $trans_limit ?></span></h2>
          <h2>Account Balance - <span><?php echo "TK " . $acc_bal ?></span></h2>
        </div>

      </section>


    </div>


  </body>
</html>
