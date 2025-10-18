<!DOCTYPE html>
<html>

<head>

  <title>Topics - BlazeBegin</title>
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
  

</head>

<body>

  <?php include 'header.php'; ?>

  <section class="topics">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Topics</span>
        </div>
        <h1>Browse startups by topics</h1>
        <div class="underline"></div>
      </div>
      <h2>Search from the startups behind many topics and choose the category you prefer. You can explore the category by browsing the reference page.</h2>
    </div>

    <div>

    <?php

    $tabella = 'tbl_category';

    $mysqli_date = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli_date->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli_date, "utf8");
    $query_date = "SELECT id, name_category FROM $tabella ORDER BY name_category";
    if ($result_date = $mysqli_date->query($query_date)) {
      /* fetch associative array */
      while ($row_date = $result_date->fetch_assoc()) {

        $id_category_label = $row_date["id"];
        $name_category_label = $row_date["name_category"];


    ?>

    <div class="category-label">
      <b><i class='bx bxs-label' ></i><span><?php echo $name_category_label ?></span></b>
      <div class="ripple">
        <a href="category/<?php echo strtolower(str_replace(" ", "-", str_replace("&", "and", $name_category_label))) ?>" class="more">
          <span>Explore more</span><i class='bx bx-right-arrow-alt'></i>
        </a>
      </div>
    </div>

    <div class="grid-layout">
        
    <?php

    $tabella_startups = 'tbl_startups';
    $count = 0;

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, images_path, category_id, author, id_us FROM $tabella_startups WHERE status_bool = 2 AND category_id = $id_category_label ORDER BY boost_start DESC, views DESC";
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

        if ($count < 13) {

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
        } // end if count

        }
      }

      /* free result set */
      $result->free();
      $mysqli->close();

      if ($count == 0) {
        ?>
        <div class="card empty-category">
          <span>No Startups Available in this Topic</span>
        </div>
        <?php
      }

    ?>
    
      <div class="hide-on-mobile"></div>
      <div class="hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
    </div>

    <?php
        }
      }

      /* free result set */
      $result_date->free();
      $mysqli_date->close();

    ?>

    </div>

  </section>

  <?php include 'footer.php'; ?>

</body>

</html>
