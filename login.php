<!DOCTYPE html>
<html lang="en">

<head>

  <title>LogIn - BlazeBegin</title>
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

    .login > div {
      width: 450px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }
    .login .ripple,
    .login .ripple > a {
      width: 100%;
    }

    .title {
      align-items: center !important;
      padding-bottom: 30px !important;
    }

    a.forgot {
      width: 100%;
      text-align: right;
      margin-top: -15px;
      color: var(--primary);
    }

  </style>

</head>

<body>

  <div class="bg"></div>

  <?php include 'config.php'; ?>

  <?php

  if (isset($_COOKIE["login_user"])) {
          ?>
            <script>location.href="dashboard"</script>
          <?php      
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mail = $_POST['email'];
    $password = md5($_POST['password']);
    $return_arr = array();

    $tabella = 'tbl_user';

          // Connessione al db
            $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
    $mysqli->select_db($db_name) or die( "Unable to select database");
      mysqli_set_charset($mysqli,"utf8");

      $query="SELECT username_us, email_us, password_us, id_us FROM $tabella";
      if ($result = $mysqli->query($query)) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                  if ($row["email_us"] == $mail && $row["password_us"] == $password) {

          ?>
            <script>
              var expiration_date = new Date();
              var cookie_string = '';
              expiration_date.setFullYear(expiration_date.getFullYear() + 1);
              cookie_string = "username=<?php echo $row["username_us"] ?>; path=/; expires=" + expiration_date.toUTCString();
              document.cookie = cookie_string;
              cookie_string = "login_user=<?php echo $row["id_us"] ?>; path=/; expires=" + expiration_date.toUTCString();
              document.cookie = cookie_string;
              location.href="dashboard";
            </script>
          <?php      

                  }
              }

            }

        /* free result set */
              $result->free();
        $mysqli->close();
   
  }

  ?>

  <?php include 'header.php'; ?>

  <?php
  
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        ?>
          <script>
            showTimerAlert("Please check your username and password and try again.");
          </script>
        <?php
      }

  ?>

  <section class="login">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Log In</span>
        </div>
        <h1>Log In</h1>
        <div class="underline"></div>
      </div>
    </div>

    <div data-aos="fade-in" data-aos-anchor-placement="top">

      <form method="post" enctype="multipart/form-data">
        <div class="input-cont-css">

          <div class="input-cont">
            <input class="input" type="text" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
          </div>
          <div class="input-cont">
            <input class="input" type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <a class="forgot" href="forgot">Forgot your password?</a>

          <button class="ripple primary" name="login" type="submit"><a><i class='bx bx-user'></i>Log In</a></button>
        </div>

      </form>

      <div class="cool-divider">
        <span>OR</span>
      </div>

      <div class="ripple transparent"><a href="signup" class="butt butt-white" name="signup"><i class='bx bx-user-plus'></i>Sign Up</a></div>

    </div>
  </section>

    <?php include 'footer.php'; ?>

</body>

</html>
