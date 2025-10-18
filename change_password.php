<?php
    include 'config.php';

  $tabella = 'tbl_user';

  $email_us = $_POST['email'];
  $new_pass = md5($_POST['new_pass']);

  $tabella_user = 'tbl_user';
  $mysqli_password = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
  $mysqli_password->select_db($db_name) or die( "Unable to select database");
    mysqli_set_charset($mysqli_password,"utf8");

      $query_password="UPDATE $tabella_user SET password_us = '$new_pass' WHERE email_us = '$email_us' ";

    if (mysqli_query($mysqli_password, $query_password)) {

    }

    $mysqli_password->close();


?>