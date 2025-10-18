<!DOCTYPE html>
<html>

<head>

  <title>Thanks For Submitting - BlazeBegin</title>
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
    .thanks {
      display: flex;
      flex-direction: column;
      gap: 30px;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 80vh;
    }
    .thanks .empty {
      height: auto;
    }
    .thanks h1 {
      font-size: 4em;
      font-weight: 700;
      margin-top: -30px;
    }
    .thanks h2 {
      font-size: 1.1em;
      font-weight: 400;
      opacity: .7;
      width: 70%;
      margin-top: -20px;
    }
    .thanks .butt-thanks {
      margin-top: 20px;
      display: flex;
      gap: 30px;
    }

    #confetti-canvas {
      top: 105px !important;
      z-index: -1 !important;
    }

  </style>

</head>

<body>

  <script src="js/confetti.js"></script>
  <script>

        const start = () => {
            setTimeout(function() {
                confetti.start()
            }, 500);
        };

        const stop = () => {
            setTimeout(function() {
                confetti.stop()
            }, 30000);
        };

        start();
        stop();

  </script>

  <?php

      if (!isset($_COOKIE["login_user"])) {
        ?>
          <script>location.href="login"</script>
        <?php
      }

  ?>

  <?php include 'header.php'; ?>

  <section>

    <div class="thanks">
      <div class="empty">
        <img alt="" src="assets/search.svg">
      </div>
      <h1>THANK YOU!</h1>
      <h2>Thank you for submitting your startup to BlazeBegin! We're thrilled to inform you that your submission has been accepted within just 24 hours. We're looking forward to showcasing your venture.</h2>
      <div class="butt-thanks">
        <button class="ripple primary"><a href="dashboard"><i class='bx bx-table'></i>Go To Dashboard</a></button>
        <div class="ripple outline"><a href="https://twitter.com/blaze_begin" target="blank"><i class='bx bxl-twitter'></i>Follow us on Twitter</a></div>
      </div>
    </div>

  </section>

  <?php include 'footer.php'; ?>

</body>

</html>
