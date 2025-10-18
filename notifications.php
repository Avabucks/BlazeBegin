<!DOCTYPE html>
<html>

<head>

  <title>Notifications - BlazeBegin</title>
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
    section > div:nth-child(2) {
      border-top: 1px solid var(--line-color);
      padding-top: 20px;
    }
    .not-read-label {
      display: none !important;
    }
    .tab .card > div:nth-child(1) {
        width: auto !important;
        font-size: 1.5em;
        opacity: .4;
    }
    .tab .card > div:nth-child(2) {
        width: 100% !important;
    }
    .tab .card > div:nth-child(2) a {
      color: var(--primary);
      transition: .3s;
      text-decoration: none;
      font-weight: 600;
      font-size: 1em;
      opacity: 1;
    }
    .tab .card > div:nth-child(2) a:hover {
      opacity: .7;
    }
    .tab .title {
      line-height: 1.6em !important;
    }
    .not-read-0 {
      outline: 2px solid var(--primary);
    }

  </style>

</head>

<body>

  <?php include 'config.php'; ?>

  <?php

      if (!isset($_COOKIE["login_user"])) {
        ?>
          <script>location.href="login"</script>
        <?php
      }

  ?>

  <?php include 'header.php'; ?>

  <section>

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Notifications</span>
        </div>
        <span>
          <i class='bx bxs-bell' ></i>
          <h1>Notifications</h1>
        </span>
        <div class="underline"></div>
      </div>
      <h2>This tab will display all relevant alerts and updates related to your account. You’ll be able to see recent activities, messages, and other important information. Don't miss out on any important information or updates by checking your notifications regularly.</h2>
    </div>

    <div>

      <div class="tab tab-dashboard">

    <?php

    $tabella = 'tbl_notifications';
    $count = 0;

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, has_read, message_type, name_startup, name_user FROM $tabella WHERE id_us = '" . $_COOKIE["login_user"] . "' ORDER BY has_read ASC, id DESC";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

        $count++;

        $id = $row["id"];
        $has_read = $row["has_read"];
        $message_type = $row["message_type"];
        $id = $row["name_startup"];
        $name_user = $row["name_user"];

        // get name startup
        $tabella = "tbl_startups";

        $mysqli_startups = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_startups->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_startups, "utf8");
        $query_startups = "SELECT title FROM $tabella WHERE id = '" . $id . "'";
        if ($result_startups = $mysqli_startups->query($query_startups)) {
            /* fetch associative array */
            while ($row = $result_startups->fetch_assoc()) {
                $name_startup = $row["title"];
            }
        }

        /* free result set */
        $result_startups->free();
        $mysqli_startups->close();

        if ($message_type == 0) {
          $title = "Great news! Your startup has received a like from someone.";
          $description = " has liked ";
        } else {
          $title = "Congratulations! Your startup has been officially published.";
          $description = " has been published on BlazeBegin. Check out the link and share it everywhere you can.";
        }

    ?>

          <?php if (isset($name_startup)) { ?>
          <div class="card not-read-<?php echo $has_read ?>" data-id="<?php echo $id ?>">

            <div>
              <?php if ($message_type == 0) { ?>
                <i class='bx bxs-heart'></i>
              <?php } else { ?>
                <i class='bx bx-world'></i>
              <?php } ?>
            </div>

            <div class="info-cont">
              <div class="text">
                <span class="title"><?php echo $title ?></span>
                <?php if ($message_type == 0 && isset($name_startup)) { ?>
                  <span class="description"><a href="profile/<?php echo strtolower(str_replace(" ", "-", $name_user)) ?>"><?php echo $name_user ?></a><?php echo $description ?><a href="startup/<?php echo $id ?>"><?php echo $name_startup ?></a></span>
                <?php } else if ($message_type == 1 && isset($name_startup)) { ?>
                  <span class="description"><a href="startup/<?php echo $id ?>"><?php echo $name_startup ?></a><?php echo $description ?></span>
                <?php } ?>
              </div>
            </div>

          </div>
          <?php } ?>

      <?php
        }
      }

      /* free result set */
      $result->free();
      $mysqli->close();

      ?>
        </div>
      <?php
      if ($count == 0) {
      ?>

      <div class="empty">
        <img alt="" src="assets/no-data.svg">
        <h3>No Notification Right Now</h3>
        <h4>There are no notifications at this moment.<br>Please check back later for any updates or alerts.</h4>
      </div>

      <?php
      }

      // read all notification
      $id_us = $_COOKIE["login_user"];
      $tabella_notifications = 'tbl_notifications';
      $mysqli_notifications = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
      $mysqli_notifications->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli_notifications,"utf8");

          $query_notifications="UPDATE $tabella_notifications SET has_read = 1 WHERE id_us = '$id_us' ";

        if (mysqli_query($mysqli_notifications, $query_notifications)) {

        }

        $mysqli_notifications->close();
      // end read all notification

      ?>
    </div>
  </section>

  <?php include 'footer.php'; ?>

</body>

</html>
