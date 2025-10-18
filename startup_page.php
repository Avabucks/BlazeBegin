    <?php

    include 'config.php';

    $tabella = 'tbl_startups';
    $id = $_GET['id'];

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, subtitle, description_c, images_path, category_id, author, link, instagram_link, tiktok_link, facebook_link, twitter_link, id_us, status_bool, views, date_added FROM $tabella WHERE id = $id";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

        $id = $row["id"];
        $title = $row["title"];
        $subtitle = $row["subtitle"];
        $description_c = $row["description_c"];
        $author = $row["author"];
        $images_path = $row["images_path"];
        
        $link = $row["link"];
        $link = "https://" . str_replace("www.", "", str_replace("https://", "", $link));

        $instagram_link = $row["instagram_link"];
        $tiktok_link = $row["tiktok_link"];
        $facebook_link = $row["facebook_link"];
        $twitter_link = $row["twitter_link"];
        $id_us = $row["id_us"];
        $status_bool = $row["status_bool"];
        $views = $row["views"];

        // get date
        $date_added = $row["date_added"];
        $day = explode("-", $date_added)[2];
        $month = explode("-", $date_added)[1];
        $year = explode("-", $date_added)[0];
        $date_string = $day . " " . date('F', strtotime($date_added)) . " " . $year;

        // get category

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

        // end get category

        // get like

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

        // end get like

        }
      }

      /* free result set */
      $result->free();
      $mysqli->close();

      if (!isset($title)) {
        ?>
          <script>location.href="../index";</script>
        <?php
      }

    include 'views.php';

    ?>

<!DOCTYPE html>
<html>

<head>

  <title><?php echo $title ?> - BlazeBegin</title>
  <link rel="icon" type="image/x-icon" href="../favicon.ico">

  <meta charset="utf-8" />
  <meta name="author" content="Avabucks">
  <meta name="keywords" content="BlazeBegin, promote, startup, instagram, faceboook, tiktok, brand, influencer, free">
  <meta name="description" content="BlazeBegin is a community where makers and early adopters can share new products and ideas. It's a place to discover and get early access to exciting startups.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
    $first_image = explode(";", $images_path)[0];
  ?>

  <meta name="twitter:account_id" content="1676193472452100097">
  <meta name="twitter:domain" content="Blazebegin.com">
  <meta name="twitter:site" content="@blaze_begin" />
  <meta name="twitter:creator" content="@blaze_begin" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta property="og:title" content="<?php echo htmlspecialchars($title) ?>" />
  <meta property="og:description" content="<?php echo htmlspecialchars(str_replace("|", "", str_replace("#", "", $subtitle))) ?>" />
  <meta property="og:type" content="article,">
  <meta property="og:url" content="https://www.blazebegin.com/startup/<?php echo $id ?>">

  <meta property="og:image" content="https://blazebegin.com/uploads/<?php echo $first_image ?>">
  <meta property="twitter:image" content="https://blazebegin.com/uploads/<?php echo $first_image ?>">

  <!-- Include FILES -->
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../responsive.css">
  <script src="../js/script.js"></script>

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
    .gradient {
      position: absolute;
      width: 100%;
      height: 100vh;
      z-index: -1;
    }
    .hide-image-right {
      transition: .3s ease-out;
      opacity: 0;
    }
    .hide-image-left {
      transition: .3s ease-out;
      opacity: 0;
    }

    .like.ripple > a {
      background-color: rgb(0, 0, 0, 0);
    }
    
    .like.ripple i.bx-heart + span::after {
      content: 'Click to like this startup';
    }
    .like.ripple i.bxs-heart + span::after {
      content: 'You liked this startup!';
    }
    .like.ripple > a:has(i.bxs-heart) {
      outline: 2px solid var(--primary);
    }

    .like.ripple .bxs-heart {
      color: var(--primary);
    }

    .show-image {
      transition: .3s ease-out;
      opacity: 1 !important;
    }

    .breadcrumb {
      margin-bottom: -20px;
    }

    .isReviewing {
      position: relative;
      width: 100%;
      border-radius: 10px;
      z-index: 1;
      background: var(--bg-objects);
      padding: 15px;
    }

  </style>

</head>

<body>

  <div class="gradient"></div>

  <?php include 'header.php'; ?>

  <section class="main">
    <div>

        <?php
          if ($status_bool == 0 || $status_bool == 3) {
            ?>
              <div class="isReviewing">Your submission is not yet approved. We usually approve apps within 24 hours on weekdays. Only you can see this app right now, so please do not share the link to it yet. You will get a notification when it's approved.</div>
            <?php
          }
        ?>

        <div class="breadcrumb">
          <a href="<?php echo $folder ?>/index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <a href="../profile/<?php echo strtolower(str_replace(" ", "-", $author)) ?>"><?php echo $author ?></a>
          <i class='bx bx-chevron-right'></i>
          <span><?php echo $title ?></span>
        </div>

      <a href="<?php echo $link ?>?ref=blazebegin.com" target="blank" class="title">
        <h1><?php echo $title ?></h1>
        <div class="underline"></div>
      </a>
      <h3 class="subtitle"><?php echo $subtitle ?></h3>
      <div class="image-slider">
        <div class="ripple disable-arrow previous-image"><a><i class='bx bx-chevron-left'></i></a></div>
        <?php
          $i = 0;
          $images_split = explode(";", $images_path);
          foreach($images_split as $image_src) {
              $image_src = trim($image_src);
              if ($image_src != '') {
                $i++;
          ?>
            <img onclick="window.open('<?php echo $link ?>?ref=blazebegin.com');" class="<?php if ($i > 1) echo 'hide-image-right hidden'; else echo 'show-image' ?>" src="../uploads/<?php echo $image_src ?>">
          <?php
              }
          }        
        ?>
        <div class="ripple <?php if ($i == 1) echo 'disable-arrow'; ?> next-image"><a><i class='bx bx-chevron-right'></i></a></div>
      </div>

      <?php if (isset($_COOKIE["login_user"]) && $status_bool == 2) { ?>
        <div onclick="putLike(event);" class="ripple outline like"><a data-id=<?php echo $id ?>><i class='bx <?php echo $class_like ?>'></i><span></span></a></div>
      <?php } ?>

      <h2 class="description"><b>Description</b><?php echo $description_c ?></h2>

      <div class="async-ads">
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-5682947198534776"
            data-ad-slot="8932812817"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>

      <div class="CTAs">
        <div>
          <div class="ripple primary"><a href="<?php echo $link ?>?ref=blazebegin.com" target="blank"><i class='bx bx-link-external' ></i>Visit Website</a></div>
          
          <div class="ripple outline">
            <a href="
              https://twitter.com/intent/tweet?text=<?php echo htmlspecialchars($title) ?> : <?php echo htmlspecialchars(str_replace("|", "", str_replace("#", "", str_replace("%", "", $subtitle)))) ?>.&url=https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>&via=blaze_begin&size=large"
              target="blank">
              <i class='bx bx-share' ></i>
            </a>
          </div>
        </div>
        <div class="social">
          <div class="ripple transparent <?php if ($instagram_link == '') echo 'disabled' ?>"><a href="https://instagram.com/<?php echo $instagram_link ?>" target="blank"><i class='bx bxl-instagram' ></i></a></div>
          <div class="ripple transparent <?php if ($tiktok_link == '') echo 'disabled' ?>"><a href="https://tiktok.com/@<?php echo $tiktok_link ?>" target="blank"><i class='bx bxl-tiktok' ></i></a></div>
          <div class="ripple transparent <?php if ($facebook_link == '') echo 'disabled' ?>"><a href="https://facebook.com/<?php echo $facebook_link ?>" target="blank"><i class='bx bxl-facebook' ></i></a></div>
          <div class="ripple transparent <?php if ($twitter_link == '') echo 'disabled' ?>"><a href="https://twitter.com/<?php echo $twitter_link ?>" target="blank"><i class='bx bxl-twitter' ></i></a></div>
        </div>
      </div>

    </div>
  </section>

  <div class="footer-page">
    <div>
      <span class="category">
        <span><i class="bx bxs-label"></i></span>
        <a href="../category/<?php echo strtolower(str_replace(" ", "-", str_replace("&", "and", $name_category))) ?>"><?php echo $name_category ?></a>
      </span>
      <span class="author">
        <span><i class="bx bxs-user"></i>by</span>
        <a href="../profile/<?php echo strtolower(str_replace(" ", "-", $author)) ?>"><?php echo $author ?></a>
      </span>
      <span class="date">
        <span><i class="bx bxs-calendar"></i>Featured on</span>
        <span><a class="disabled"><?php echo $date_string ?></a></span>
      </span>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <?php
    $hidden_string = "hidden";

    if (isset($_COOKIE["login_user"]) && $admin_id == $_COOKIE["login_user"]) $hidden_string = ""; //isAdmin
    if (!isset($_COOKIE["login_user"])) $hidden_string = "hidden"; //no account
    if (isset($_COOKIE["login_user"]) && $id_us == $_COOKIE["login_user"]) $hidden_string = ""; //can edit account

  ?>
  <div class="floating-butt ripple grey edit-butt <?php echo $hidden_string ?>" style="bottom: 100px;"><a href="<?php echo $folder ?>/edit/<?php echo $id ?>"><i class='bx bx-edit'></i></a></div>

  <script>
    window.addEventListener("load", function () {
      var rgb = getAverageRGB(document.querySelectorAll("img")[2]);
      document.querySelector(".gradient").style.background = 'linear-gradient(180deg, rgb('+rgb.r+','+rgb.g+','+rgb.b+'), var(--bg)';

      if (isHexTooLight([rgb.r, rgb.g, rgb.b])) {
        document.querySelector(".gradient").style.opacity = '.2';
      } else {
        document.querySelector(".gradient").style.opacity = '.4';
      }
    });
  </script>

</body>

</html>
