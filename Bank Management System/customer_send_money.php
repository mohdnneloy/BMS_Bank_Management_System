<?php

  require('php/connect.php'); // Adding connect file for database connection
  session_start();

  $email = $_SESSION['email_id'];
  $sql0 = "Select * From customer where Email = '$email';";
  $result0 = mysqli_query($conn, $sql0);

  while($row = mysqli_fetch_array($result0)) {
    $fname = $row['Fname'];
    $lname = $row['LName'];
  }
?>


<!DOCTYPE html>
<html lang='en'>

  <head>
    <meta charset="utf-8">
    <title>Customer Send Money</title>
    <link rel="stylesheet" type="text/css" href="css/style_customer_send_money.css">
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
          <li><a href="customer_account_details.php">Account Details</a></li>
          <li><a href="customer_transactions.php">Transactions</a></li>
          <li class =" active"><a class =" active" href="customer_send_money.php">Send Money</a></li>
          <li><a href="customer_signIn.html">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Send Money</h1>
        <div class = "details">
          <form action = "php/customer_send_money_process.php" method = "POST">
            <label>Receiver's Email</label>
            <input class= "email_to" type="text" name = "email_to" >
            </br>
            <label>Amount TK</label>
            <input class = "amount" type="number" name = "amount" >
            </br>
            <label>Password</label>
            <input class = "password" type="password" name = "password2">
            </br>
            <input type= "submit" class = "bttn" value="Send">
          </form>

        </section>
        </div>

      </section>


    </div>


  </body>
</html>
