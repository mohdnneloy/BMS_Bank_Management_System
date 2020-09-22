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
  }

  $sql2 = "Select * From transaction where Trans_From = '$acc_no' order by Trans_Date DESC, Trans_ID DESC;";
  $result2 = mysqli_query($conn, $sql2);


  $counter = 0; // Counter for rows
  $max = 0; // For max number of rows

  $sql5 = "Select count(*) as Count From transaction where Trans_From = '$acc_no';";
  $result5 = mysqli_query($conn, $sql5);

  while($row = mysqli_fetch_array($result5)) {
    $check = $row['Count'];
  }

  if($check >= 7){
    $max = 7;
  }

  else{
    $max = $check;
  }

?>

<!DOCTYPE html>
<html lang='en'>

  <head>
    <meta charset="utf-8">
    <title>Customer Transactions</title>
    <link rel="stylesheet" href="css/style_customer_transactions.css?v=<?php echo time(); ?>">
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
          <li  ><a  href="customer_account_details.php">Account Details</a></li>
          <li class =" active" ><a class =" active" href="customer_transactions.php">Transactions</a></li>
          <li><a href="customer_send_money.php">Send Money</a></li>
          <li><a href="customer_signIn.html">Sign Out</a></li>
        </div>
      </section>
      <section class = 'right'>

        <h1 class="detail_main">Transactions</h1>
        <div class = "details">

          <table class = "table_container">

            <thead>
                <th>Transaction ID</th>
                <th>Sent To</th>
                <th>Amount (TK)</th>
                <th>Date</th>
            </thead>

            <?php

            while($row = mysqli_fetch_array($result2)) {

              if($counter < $max){
              $transaction_id = $row['Trans_ID'];
              $sent_to = $row['Trans_To'];
              $amount = $row['Amount'];
              $transaction_date = $row['Trans_Date'];

              // Finding Receivers name

              $sql3 = "Select * From account where Acc_No = '$sent_to';";
              $result3 = mysqli_query($conn, $sql3);

              while($row = mysqli_fetch_array($result3)) {
                $customer_id_to = $row['Customer_ID'];
              }

              $sql4 = "Select * From customer where Customer_ID = '$customer_id_to';";
              $result4 = mysqli_query($conn, $sql4);

              while($row = mysqli_fetch_array($result4)) {
                $fname_to = $row['Fname'];
                $lname_to = $row['LName'];
              }

              echo  "<tr>";
              echo  "<td>". $transaction_id ."</td>";
              echo  "<td>" .$fname_to . " " . $lname_to ."</td>";
              echo  "<td>" . $amount . "</td>";
              echo  "<td>" . $transaction_date ."</td>";
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
