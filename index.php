<!DOCTYPE html>
<html>

<head>

  <title>BlazeBegin - Promote Your Startup For Free</title>
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

    section {
      min-height: auto;
    }
    section.home {
      display: flex;
      align-items: center;
      flex-direction: row !important;
      width: var(--max-width);
      margin: 0 auto;
    }
    section.home > div {
      width: 50%;
    }

    .grid-category {
      display: flex;
      gap: 30px;
      width: 100%;
      flex-wrap: wrap;
    }
    .grid-category > a {
      display: flex;
      align-items: center;
      gap: 7px;
      padding: 10px 25px;
      border-radius: 10px;
      background-color: var(--line-color);
      border: 2px solid rgb(0, 0, 0, 0);
      color: var(--text-color);
      white-space: nowrap;
      text-decoration: none;
      transition: .3s;
    }
    .grid-category > a:hover {
      border: 2px solid var(--primary);
    }
    .grid-category > a i {
      font-size: 1.3em;
      opacity: .4;
    }

  </style>

</head>

<body>

  <div class="bg"></div>

  <?php

  if (isset($_GET['q']) && $_GET['q'] == "logout") {
    unset($_COOKIE['username']); 
    setcookie('username', null, -1, '/'); 

    unset($_COOKIE['login_user']); 
    setcookie('login_user', null, -1, '/'); 
  }

  ?>

  <?php include 'header.php'; ?>

  <script>
    document.querySelector(".floating-butt").classList.add("hidden");
    window.addEventListener('scroll',(event) => {
      if (window.scrollY > 200) {
        document.querySelector(".floating-butt").classList.remove("hidden");
      }
    });
    deleteQueryString();
  </script>

  <section class="home">
    <div>
      <h1>Discover and Share New Startups Every Day</h1>
      <h2>Connect with others who are sharing innovative products and ideas. Add your startup to our community by submitting it for free. Come join us and be a part of the cutting-edge future!</h2>
      <div class="cont-butt">
        <div class="ripple primary"><a href="submit"><i class='bx bx-plus'></i>Submit for free</a></div>
        <div class="ripple transparent"><a href="explore"><i class='bx bx-collection'></i>Explore</a></div>
      </div>
    </div>
    <div class="hide-on-mobile">
      <img src="assets/home.svg" />
    </div>
    <i class='bx bx-chevron-down' ></i>
  </section>

  <section>
  <div id="trending-tab">
    <div class="category-label">
      <b><i class='bx bxs-hot' ></i><span>Trending Featured</span></b>
      <div class="ripple">
        <a href="trending" class="more">
          <span>Explore more</span><i class='bx bx-right-arrow-alt'></i>
        </a>
      </div>
    </div>    

    <div class="grid-layout">

    <?php

    $tabella_startups = "tbl_startups";

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, images_path, category_id, author, id_us, likes FROM $tabella_startups WHERE status_bool = 2 ORDER BY boost_start DESC, likes DESC, views DESC LIMIT 0,24";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

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

    ?>

      <div class="hide-on-mobile"></div>
      <div class="hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>

    </div>

    </div>
  </section>

  <section>
  <div id="newest-tab">
    <div class="category-label">
      <b><i class='bx bxs-calendar' ></i><span>Last Startups</span></b>
      <div class="ripple">
        <a href="explore" class="more">
          <span>Explore more</span><i class='bx bx-right-arrow-alt'></i>
        </a>
      </div>
    </div>    

    <div class="grid-layout">

    <?php

    $tabella_startups = "tbl_startups";

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, images_path, category_id, author, id_us, likes FROM $tabella_startups WHERE status_bool = 2 ORDER BY date_added DESC, id DESC LIMIT 0,24";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

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

    ?>

      <div class="hide-on-mobile"></div>
      <div class="hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>

    </div>

    </div>
  </section>

  <section class="topics">
  <div id="topics-tab">
    <div class="category-label">
      <b><i class='bx bxs-label' ></i><span>Explore Topics</span></b>
      <div class="ripple">
        <a href="topics" class="more">
          <span>Explore more</span><i class='bx bx-right-arrow-alt'></i>
        </a>
      </div>
    </div>    

    <div class="grid-category">

    <?php

    $tabella_category = "tbl_category";

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, name_category FROM $tabella_category ORDER BY name_category ASC";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

        $name_category = $row["name_category"];
    ?>

        <a href="category/<?php echo strtolower(str_replace(" ", "-", str_replace("&", "and", $name_category))) ?>"><i class='bx bx-label' ></i><?php echo $name_category ?></a>

    <?php
        }
      }

      /* free result set */
      $result->free();
      $mysqli->close();

    ?>

    </div>

    </div>
  </section>

  <?php include 'footer.php'; ?>

</body>

</html>
