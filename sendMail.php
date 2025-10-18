<?php
  $temp_code = $_POST['temp_code'];
  $email = $_POST['email'];

  $to = $email;
  $subject = $_POST['subject'];
  $txt = $_POST['txt'];

$headers = 'From: BlazeBegin Avabucks <info@blazebegin.com>' . "\n"; // blazebegin.com
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$returnpath = '-f info@blazebegin.com'; // blazebegin.com
$status = mail($to,$subject,$txt,$headers, $returnpath);

?>
