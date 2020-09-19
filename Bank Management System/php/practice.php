<?php

if(isset($_POST["email"]) && isset($_POST["password"])){

  $email = $_POST["email"];
  $password = $_POST["password"];

  if($email == 'neloy1998@gmail.com' && $password == '11A'){
  //echo 'done';
  header("location: ../employee_signIn.html");
    exit();
  }

  else{
    echo 'wrong password';
  }

}

else{
  echo 'not possible';
}

?>
