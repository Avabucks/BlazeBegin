<?php

  $to = $email_us;
  $subject = "Your startup has been declined - BlazeBegin";
  $txt = "

        <div class='cont' style='margin: 0 auto; width: 450px;'>
            <img style='border-radius: 50em; height: 35px; margin-top: 20px;' src='https://blazebegin.com/favicon.ico'>
            <hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'>
            <p style='margin-bottom: 20px; font-size: 16px;'>Hi,</p>
            <p style='margin-bottom: 20px; font-size: 16px;'>You have recently uploaded your startup on <b>BlazeBegin</b>. Your startup has been declined!</p>
            <p style='margin-bottom: 20px; font-size: 16px;'>Unfortunately, we received news that our startup was declined after being uploaded on <b>BlazeBegin</b>. While this is disappointing news, it's important to remember that setbacks are a natural part of the entrepreneurial journey. We'll take this as an opportunity to reassess and improve our product or service. We believe in our mission and will continue to work hard to bring it to fruition. Thank you to <b>BlazeBegin</b> for considering our startup, and we look forward to future opportunities to showcase our ideas.</p>
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
