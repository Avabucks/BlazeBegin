<!DOCTYPE html>
<html lang="en">

<head>

  <title>SignUp - BlazeBegin</title>
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

    .signup > div {
      width: 450px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }
    .signup .ripple,
    .signup .ripple > a {
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

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $username = $_POST['username'];
  $mail = $_POST['email'];
  $password = md5($_POST['password']);

  $id_univoco = md5(round(microtime(true) * 1000) + rand(0, 150000));

  $tabella = 'tbl_user';


    // Connessione al db
    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
    $mysqli->select_db($db_name) or die( "Unable to select database");
      mysqli_set_charset($mysqli,"utf8");

      $query="INSERT INTO $tabella (username_us, email_us, password_us, id_us, diamonds) VALUES ('$username', '$mail', '$password', '$id_univoco', '50') ";

      if (mysqli_query($mysqli, $query)) {

        ?>
            <script>
              var expiration_date = new Date();
              var cookie_string = '';
              expiration_date.setFullYear(expiration_date.getFullYear() + 10);
              cookie_string = "username=<?php echo $username ?>; path=/; expires=" + expiration_date.toUTCString();
              document.cookie = cookie_string;
              cookie_string = "login_user=<?php echo $id_univoco ?>; path=/; expires=" + expiration_date.toUTCString();
              document.cookie = cookie_string;
              location.href="dashboard";
            </script>
          <?php      
      }
      $mysqli->close();

  }

  ?>

  <?php include 'header.php'; ?>

  <section class="signup">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Sign Up</span>
        </div>
        <h1>Sign Up</h1>
        <div class="underline"></div>
      </div>
    </div>

    <div data-aos="fade-in" data-aos-anchor-placement="top">

      <form method="post" enctype="multipart/form-data">
        <div class="signup-form input-cont-css">

          <div class="input-cont">
            <input class="input" type="text" name="username" id="username" placeholder="Username" required>
            <label for="username">Username</label>
          </div>
          <div class="input-cont">
            <input class="input" type="text" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
          </div>
          <div class="input-cont">
            <input class="input" type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <p class="agree-privacy">By selecting "Agree and Continue" below, you agree to BlazeBegin's <a href="privacy">Privacy Policy</a>.</p>

          <div class="ripple transparent" id="signup_verify"><a><i class='bx bx-user-plus'></i>Agree and Continue</a></div>

        </div>

          <div class="verification input-cont-css hidden">
            <div class="input-cont">
              <input class="input" type="text" name="verify" id="verify" placeholder="Verification Code" required>
              <label for="verify">Verification Code (Check your email)</label>
            </div>
            <button class="ripple primary" name="signup" type="submit"><a><i class='bx bx-user-plus'></i>Sign Up</a></button>
          </div>

      </form>

      <div class="cool-divider">
        <span>OR</span>
      </div>

      <div class="ripple transparent"><a href="<?php echo $folder ?>/login" class="butt butt-white" name="login"><i class='bx bx-user'></i>Log In</a></div>

    </div>
  </section>

    <?php include 'footer.php'; ?>

  <script>

    function containsSpecialChars(str) {
      const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
      return specialChars.test(str);
    }

    // SIGN UP
    var send_mail = false;

    document.querySelector("#signup_verify").addEventListener("click", function (e) {

        var error_text = "";

        var username = document.querySelector("#username").value;
        var email = document.querySelector("#email").value;
        var password = document.querySelector("#password").value;

        if (password.length < 8) error_text = "The password must contain at least 8 characters.";
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) error_text = "This email is not valid.";
        if (containsSpecialChars(username)) error_text = "The username cannot contain special characters.";
        if (username == "" || email == "" || password == "") error_text = "You must fill all the fields.";

        if (error_text != "") {
            showTimerAlert(error_text);
            return;
        }

        $.ajax({
            url: 'check_username',
            type: 'POST',
            data: {
                username_us: username
            },

            success: function (data) {
                if (data == "1") {
                    showTimerAlert("This username already exists.");
                    return;
                }
                $.ajax({
                    url: 'check_exist',
                    type: 'POST',
                    data: {
                        email_check: email
                    },

                    success: function (data) {
                        if (data == "1") {
                            showTimerAlert("This email already exists.");
                            return;
                        }
                        if (username != "" && email != "" && password != "" && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) && password.length >= 8) {
                            document.querySelectorAll(".verification")[0].classList.remove("hidden");
                            document.querySelectorAll(".signup-form")[0].classList.add("hidden");

                            <?php $temp_code = rand(10000,99999); ?>

                            $.ajax({
                                url: "sendMail",
                                type: 'POST',

                                data: {
                                    subject: "<?php echo $temp_code ?> - Verification Code BlazeBegin",
                                    temp_code: <?php echo $temp_code ?>,
                                    email: email,
                                    txt: "<div class='cont' style='margin: 0 auto; width: 450px;'><img style='border-radius: 50em; height: 35px; margin-top: 20px;' src='https://blazebegin.com/favicon.ico'><hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'><p style='margin-bottom: 20px; font-size: 16px;'>Hi,</p><p style='margin-bottom: 20px; font-size: 16px;'>Congratulations on signing up for <b>BlazeBegin</b>! Please enter this code in the appropriate field on our website. Once you’ve entered the code, your account will be fully verified and you will be able to access all the features on our platform. Thank you for choosing our service and we look forward to helping you in the future! Thank you for joining <b>BlazeBegin</b>, we look forward to helping you save money on your favorite products and services.</p><p style='margin-bottom: 20px; font-size: 16px;'>To complete your account verification, please find below the code you will need to enter:</p><div class='code' style='font-size: 20px; text-align: center; margin: 40px 0; padding: 15px; background-color: rgb(195, 47, 39, .1); border: 2px solid rgb(195, 47, 39, .8); border-radius: 9px; width: 90px; font-weight: 700; color: rgb(10, 10, 10, .9);'><?php echo $temp_code ?></div><hr style='border: none; border-top: 1px solid rgb(0, 0, 0, .1); margin: 20px 0;'><span style='font-size: 13px; opacity: .7;'>This message has been sent to " + email + ", as requested by you.</span><span style='font-size: 13px; opacity: .7;'> BlazeBegin By Avabucks</span></div>"
                                },

                                success: function (data) {
                                  console.log(data);
                                    send_mail = true;
                                    showTimerAlert("A temporary code has been sent to your email address.");
                                }

                            });

                        }

                    }

                });

            }
        });

    });

    $('form').submit(function (e) {

        if (!send_mail) return;

        var verify = document.querySelector("#verify").value;

        if (verify != <?php echo $temp_code ?>) {
            e.preventDefault();
            showTimerAlert("The verification code is wrong.");
        }
    });

  </script>

</body>

</html>
