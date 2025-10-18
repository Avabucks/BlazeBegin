<?php

  $to = $email_us;
  $subject = "Your startup has been published on BlazeBegin";
  $txt = "

        <div class='cont' style='margin: 0 auto; width: 450px;'>
            <img style='border-radius: 50em; height: 35px; margin-top: 20px;' src='https://blazebegin.com/favicon.ico'>
            <hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'>
            <p style='margin-bottom: 20px; font-size: 16px;'>Hi,</p>
            <p style='margin-bottom: 20px; font-size: 16px;'>You have recently uploaded your startup on <b>BlazeBegin</b>. Your startup has been published!</p>
            <p style='margin-bottom: 20px; font-size: 16px;'>Your startup has been successfully uploaded and published on <b>BlazeBegin</b>! Check out our page to see a list of all the startups featured, including yours. We wish you the best of luck in growing your business and hope that our platform can help you reach a wider audience. Keep pushing forward and making your ideas a reality. Thank you for choosing <b>BlazeBegin</b> as a platform to showcase your startup.</p>
            <a style='margin-bottom: 20px; font-size: 16px;' href='https://blazebegin.com/startup/".$id."'>Visit your startup page</a>
            <hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'>
            <span style='font-size: 13px; opacity: .7;'>This message has been sent to $to, as requested by you.</span>
            <span style='font-size: 13px; opacity: .7;'>BlazeBegin By Avabucks</span>
        </div>
";

$headers = 'From: BlazeBegin Avabucks <info@blazebegin.com>' . "\n"; // blazebegin.com
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$returnpath = '-f info@blazebegin.com'; // blazebegin.com
$status = mail($to,$subject,$txt,$headers, $returnpath);

?>
