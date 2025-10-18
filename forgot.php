<!DOCTYPE html>
<html lang="en">

<head>

  <title>Forgot Password - BlazeBegin</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <meta charset="utf-8" />
  <meta name="author" content="Avabucks">
  <meta name="keywords" content="BlazeBegin, promote, startup, instagram, faceboook, tiktok, brand, influencer, free">
  <meta name="description" content="BlazeBegin is a community where makers and early adopters can share new products and ideas. It's a place to discover and get early access to exciting startups.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <!-- Include FILES -->
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./responsive.css">
  <script src="./js/script.js"></script>

  <!-- ===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <!-- ===== ADS ===== -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5682947198534776" crossorigin="anonymous"></script>

  <!-- ===== Analytics ===== -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P28Q8QPLC4"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-P28Q8QPLC4');
  </script>
  

<style>
    .breadcrumb {
      justify-content: center;
    }

    .forgot > div {
      width: 450px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }
    .forgot .ripple,
    .forgot .ripple > a {
      width: 100%;
    }

    .title {
      align-items: center !important;
      padding-bottom: 30px !important;
    }

    .agree-privacy {
      font-size: 1em;
      opacity: .9;
      text-align: center;
    }
    .agree-privacy > a {
      color: var(--primary);
    }

  </style>

</head>

<body>

  <div class="bg"></div>

  <?php include 'config.php'; ?>

  <div class="popup error hidden">
    <div id="error">
      <div class="header-popup"><i class='bx bx-error-circle'></i>Error</div>
      <div class="text"></div>
      <div class="butt-cont">
        <button class="butt butt-black close-popup">Got It!</button>
      </div>
    </div>
  </div>

  <?php

  if (isset($_COOKIE["login_user"])) {
          ?>
            <script>location.href="dashboard"</script>
          <?php      
  }

  ?>

  <?php include 'header.php'; ?>

  <section class="forgot">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Forgot Password</span>
        </div>
        <h1>Forgot Password</h1>
        <div class="underline"></div>
      </div>
    </div>

    <div data-aos="fade-in" data-aos-anchor-placement="top">

      <?php if($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        
          <div class="change-form input-cont-css">

            <div class="input-cont">
              <input class="input" type="password" name="new_pass" id="new_pass" placeholder="New Password" required>
              <label for="new_pass">New Password</label>
            </div>
            <div class="input-cont">
              <input class="input" type="password" name="repeat_pass" id="repeat_pass" placeholder="Repeat Password" required>
              <label for="repeat_pass">Repeat Password</label>
            </div>

            <div class="ripple primary" id="change_password"><a><i class='bx bx-check'></i>Done</a></div>

          </div>

      <?php } else { ?>
        <form method="post" enctype="multipart/form-data">
          <div class="forgot-form input-cont-css">

            <div class="input-cont">
              <input class="input" type="text" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
            </div>

            <div class="ripple transparent" id="forgot_verify"><a><i class='bx bx-key'></i>Send Verification Code</a></div>

          </div>

            <div class="verification input-cont-css hidden">
              <div class="input-cont">
                <input class="input" type="text" name="verify" id="verify" placeholder="Verification Code" required>
                <label for="verify">Verification Code (Check your email)</label>
              </div>
              <button class="ripple transparent" name="signup" type="submit"><a><i class='bx bx-key'></i>Change Password</a></button>
            </div>

        </form>
      <?php } ?>

    </div>
  </section>

    <?php include 'footer.php'; ?>

  <script>

    // SIGN UP
    var send_mail = false;

    if (document.querySelector("#forgot_verify")) {
    document.querySelector("#forgot_verify").addEventListener("click", function (e) {

        var error_text = "";

        var email = document.querySelector("#email").value;

        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) error_text = "This email is not valid.";
        if (email == "") error_text = "You must fill all the fields.";

        if (error_text != "") {
            showTimerAlert(error_text);
            return;
        }

        $.ajax({
            url: 'check_exist',
            type: 'POST',
            data: {
                email_check: email
            },

            success: function (data) {
                if (data == "0") {
                    showTimerAlert("This email is not associated with any account.");
                    return;
                }
                        if (email != "" && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
                            document.querySelectorAll(".verification")[0].classList.remove("hidden");
                            document.querySelectorAll(".forgot-form")[0].classList.add("hidden");

                            <?php $temp_code = rand(10000,99999); ?>

                            $.ajax({
                                url: "sendMail",
                                type: 'POST',

                                data: {
                                    temp_code: <?php echo $temp_code ?>,
                                    email: email,
                                    subject: "Forgot password on BlazeBegin",
                                    txt: "<div class='cont' style='margin: 0 auto; width: 450px;'><img style='border-radius: 50em; height: 35px; margin-top: 20px;' src='https://blazebegin.com/favicon.ico'><hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'><p style='margin-bottom: 20px; font-size: 16px;'>Hi,</p><p style='margin-bottom: 20px; font-size: 16px;'>Verificate your email on <b>BlazeBegin</b>! To change your password, please enter the verification code sent to your email address. This code is necessary to ensure the security of your account and prevent unauthorized access. Once you've received the code, enter it into the appropriate field on the password reset page and create a new unique password. Remember to keep your password safe and secure to protect your account. If you did not request this change or did not receive a code, please contact our support team immediately to investigate.</p><p style='margin-bottom: 20px; font-size: 16px;'>Enter the following code to confirm your mail:</p><div class='code' style='font-size: 20px; text-align: center; margin: 40px 0; padding: 15px; background-color: rgb(195, 47, 39, .1); border: 2px solid rgb(195, 47, 39, .8); border-radius: 9px; width: 90px; font-weight: 700; color: rgb(10, 10, 10, .9);'><?php echo $temp_code ?></div><hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'><span style='font-size: 13px; opacity: .7;'>This message has been sent to " + email + ", as requested by you.</span><span style='font-size: 13px; opacity: .7;'> BlazeBegin By Avabucks</span></div>"
                                },

                                success: function (data) {
                                    send_mail = true;
                                    showTimerAlert("A temporary code has been sent to your email address.");
                                }

                            });

                        }
                      }

                });

              });
    }

    $('form').submit(function (e) {

        if (!send_mail) return;

        var verify = document.querySelector("#verify").value;

        if (verify != <?php echo $temp_code ?>) {
            e.preventDefault();
            showTimerAlert("The verification code is wrong.");
        }
    });

    document.querySelector("#change_password").addEventListener("click", function (e) {
      var new_pass = document.querySelector("#new_pass").value;
      var repeat_pass = document.querySelector("#repeat_pass").value;

      var error_text = "";

      if (new_pass != repeat_pass) error_text = "The two passwords do not match.";
      if (new_pass.length < 8) error_text = "The password must contain at least 8 characters.";
      if (new_pass == "" || repeat_pass == "") error_text = "You must fill all the fields.";

      if (error_text != "") {
          showTimerAlert(error_text);
          return;
      }

      $.ajax({
          url: "change_password",
          type: 'POST',

          data: {
              email: "<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['email'] ?>",
              new_pass: new_pass,
              repeat_pass: repeat_pass
          },

          success: function (data) {
              showTimerAlert("The password has been restored.");
              setTimeout(function () {
                location.href = "login";
              }, 2000);
          }

      });

    });

  </script>

</body>

</html>
