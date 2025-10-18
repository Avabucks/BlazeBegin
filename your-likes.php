<!DOCTYPE html>
<html>

<head>

  <title>Your Likes - BlazeBegin</title>
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
    .grid-layout {
      border-top: 1px solid var(--line-color);
      padding-top: 20px;
    }
  </style>

</head>

<body>

  <?php

      if (!isset($_COOKIE["login_user"])) {
        ?>
          <script>location.href="login"</script>
        <?php
      }

  ?>

  <?php include 'header.php'; ?>

  <section class="trending">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Your Likes</span>
        </div>
        <span>
          <i class='bx bxs-heart' ></i>
          <h1>Your Likes</h1>
        </span>
        <div class="underline"></div>
      </div>
      <h2>Go ahead and check out your saved startups, review their profiles, and invest in the ones that you think hold the most potential. And don't forget to spread the word to your friends!</h2>
    </div>

    <div>

    <div class="grid-layout">

    <?php

    $count = 0;
    $tabella = 'tbl_likes';

    $mysqli_date = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli_date->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli_date, "utf8");
    $query_date = "SELECT id_startup FROM $tabella WHERE id_us = '" . $_COOKIE['login_user'] . "' AND isLike = 1 ORDER BY id DESC";
    if ($result_date = $mysqli_date->query($query_date)) {
      /* fetch associative array */
      while ($row_date = $result_date->fetch_assoc()) {

        $count++;
        $id_startup = $row_date["id_startup"];

    ?>

    <?php

    $tabella_startups = 'tbl_startups';
    $count = 0;

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, images_path, category_id, author, id_us FROM $tabella_startups WHERE status_bool = 2 AND id = $id_startup ORDER BY date_added DESC, id DESC";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

        $count++;

        $id = $row["id"];
        $title = $row["title"];
        $description_c = $row["description_c"];
        $id_us = $row["id_us"];
        $author = $row["author"];

        $image_src = 'uploads/' . explode(";", $row["images_path"])[0];

        $category_id = $row["category_id"];

        $tabella_category = "tbl_category";

        $mysqli_category = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_category->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_category, "utf8");
        $query_category = "SELECT name_category FROM $tabella_category WHERE id = '" . $category_id . "'";
        if ($result_category = $mysqli_category->query($query_category)) {
        /* fetch associative array */
        while ($row = $result_category->fetch_assoc()) {
            $name_category = $row["name_category"];
        }
        }
        /* free result set */
        $result_category->free();
        $mysqli_category->close();

        $exist = "";
        if (isset($_COOKIE["login_user"])) {

          $tabella_likes = "tbl_likes";

          $mysqli_likes = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
          $mysqli_likes->select_db($db_name) or die("Unable to select database");
          mysqli_set_charset($mysqli_likes, "utf8");
          $query_likes = "SELECT id FROM $tabella_likes WHERE id_us = '" . $_COOKIE["login_user"] . "' AND id_startup = '" . $id . "' AND isLike = 1";
          if ($result_likes = $mysqli_likes->query($query_likes)) {
          /* fetch associative array */
          while ($row = $result_likes->fetch_assoc()) {
              $exist = $row["id"];
          }
          }
          /* free result set */
          $result_likes->free();
          $mysqli_likes->close();
          
        }

        $class_like = "bx-heart";
        if ($exist != "") {
          $class_like = "bxs-heart";
        }

    ?>

      <div class="card" onclick="location.href='startup/<?php echo $id ?>'">
        <img src="<?php echo $image_src ?>">
        <div class="blurred-details">
          <div onclick="putLike(event);" class="ripple transparent like"><a data-id=<?php echo $id ?>><i class='bx <?php echo $class_like ?>'></i></a></div>
          <div class="info">
            <b><?php echo $title ?></b>
            <span class="category"><i class='bx bxs-label' ></i><a href="category/<?php echo strtolower(str_replace(" ", "-", str_replace("&", "and", $name_category))) ?>"><?php echo $name_category ?></a></span>
            <span><?php echo $description_c ?></span>
            <span class="author"><span><i class='bx bxs-user' ></i>by</span> <a href="profile/<?php echo strtolower(str_replace(" ", "-", $author)) ?>"><?php echo $author ?></a></span>
          </div>
          <div class="more">
            <span>See more<i class='bx bx-right-arrow-alt'></i></span>
          </div>
        </div>
      </div>

    <?php

        }
      }

      /* free result set */
      $result->free();
      $mysqli->close();

      if ($count == 0) {
        ?>
        <div class="card empty-category">
          <span>No Startups Available in this topic</span>
        </div>
        <?php
      }

        }
      }

      /* free result set */
      $result_date->free();
      $mysqli_date->close();

    ?>

      <div class="hide-on-mobile"></div>
      <div class="hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
    </div>

      <?php
      if ($count == 0) {
      ?>

      <div class="empty">
        <img alt="" src="assets/no-data.svg">
        <h3>No Likes Available</h3>
        <h4>You have not liked any startups yet.</h4>
      </div>

      <?php
      }
      ?>


    </div>

  </section>

  <?php include 'footer.php'; ?>

</body>

</html>