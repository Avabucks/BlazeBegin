<!DOCTYPE html>
<html>

<head>

  <title>Dashboard - BlazeBegin</title>
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
    .search-input {
      display: flex;
      align-items: flex-end;
      gap: 15px;
    }
    .search-input > span {
      margin-bottom: 3px;
      white-space: nowrap;
    }
    section > div:nth-child(2) {
      border-top: 1px solid var(--line-color);
      padding-top: 20px;
    }

    .more-butt > a {
      border-radius: 50em;
      background-color: rgb(0, 0, 0, 0) !important;
    }
    .more-butt > a::after {
      border-radius: 50em !important;      
    }

    .vertical-more {
      position: absolute;
      z-index: 1000;
      width: 100%;
      left: 50%;
      top: 110px;
      display: flex;
      justify-content: flex-end;
      pointer-events: none;
    }
    .vertical-more > ul {
      margin-right: 10px;
    }
    .vertical-more > ul .ripple > a {
      min-width: 170px !important;
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

  <?php
  
      if (isset($_GET['q']) && $_GET['q'] == "send") {
        ?>
          <script>
            showTimerAlert("Your component has been sent! Wait for approval.");
            deleteQueryString();
          </script>
        <?php
      }

      if (isset($_GET['q']) && $_GET['q'] == "exist") {
        ?>
          <script>
            showTimerAlert("This startup already exists, so it hasn't been submitted.");
            deleteQueryString();
          </script>
        <?php
      }

      if (isset($_GET['q']) && $_GET['q'] == "boost") {
        $id_startup = $_GET['id'];
        $id_us = $_COOKIE['login_user'];

        // check if points
        $tabella = "tbl_user";

        $mysqli_diamonds = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_diamonds->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_diamonds, "utf8");
        $query_diamonds = "SELECT diamonds FROM $tabella WHERE id_us = '" . $id_us . "'";
        if ($result_diamonds = $mysqli_diamonds->query($query_diamonds)) {
        /* fetch associative array */
        while ($row = $result_diamonds->fetch_assoc()) {
            $diamonds = $row["diamonds"];
        }

        }

        /* free result set */
        $result_diamonds->free();
        $mysqli_diamonds->close();

        if ($diamonds < 300) {

          ?>
            <script>
              showTimerAlert("Sorry, you do not have sufficient points to apply a boost.");
              deleteQueryString();
            </script>
          <?php

        } else {

        //remove points

            $tabella_user = 'tbl_user';
            $mysqli_diamonds = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
            $mysqli_diamonds->select_db($db_name) or die( "Unable to select database");
              mysqli_set_charset($mysqli_diamonds,"utf8");

                $query_diamonds="UPDATE $tabella_user SET diamonds = diamonds - 300 WHERE id_us = '$id_us' ";

              if (mysqli_query($mysqli_diamonds, $query_diamonds)) {

              }

              $mysqli_diamonds->close();

        // update boost
              $boost_start = date("Y-m-d h:m:s");
              $boost_end = date("Y-m-d h:m:s", time() + 86400*3);

            $tabella_startups = 'tbl_startups';
            $mysqli_boost = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
            $mysqli_boost->select_db($db_name) or die( "Unable to select database");
              mysqli_set_charset($mysqli_boost,"utf8");

                $query_boost="UPDATE $tabella_startups SET boost_start = '" . $boost_start . "', boost_end = '" . $boost_end . "' WHERE id = $id_startup ";

              if (mysqli_query($mysqli_boost, $query_boost)) {

                $date_format = date('d', strtotime($boost_end)) . " " . date('F', strtotime($boost_end));

                ?>
                  <script>
                    showTimerAlert("The boost has been applied successfully! It expires on <?php echo $date_format ?>");
                    deleteQueryString();
                  </script>
                <?php
              }

              $mysqli_boost->close();

        } // end if has points
      }

      if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $tabella = 'tbl_startups';

        // Connessione al db
        $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
        $mysqli->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli,"utf8");

        $query="DELETE FROM $tabella WHERE id = $id";

        $mysqli->query($query) or die( "Unable to query insert cantiere");
        $mysqli->close();
        
        ?>
          <script>
            showTimerAlert("Startup deleted successfully!");
            deleteQueryString();
          </script>
        <?php
      }

  ?>

  <section>

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Dashboard</span>
        </div>
        <span>
          <i class='bx bxs-user' ></i>
          <h1><?php echo $_COOKIE["username"] ?></h1>
        </span>
        <div class="underline"></div>
      </div>
      <h2>Welcome to your account dashboard! From here, you'll be able to easily keep track of all of your startups and manage them as needed. Whether you need to share or view analytics.</h2>
    </div>

    <div>

      <div class="search-input">
        <span>Search from your startups:</span>
        <div class="input-cont">
          <input class="input" type="text" name="search" id="search" placeholder="Enter keywords ...">
          <label for="search">Enter keywords ...</label>
        </div>
      </div>

      <div class="tab tab-dashboard">

    <?php

    $tabella = 'tbl_startups';
    $count = 0;

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, category_id, status_bool, views, likes, boost_start, boost_end FROM $tabella WHERE id_us = '" . $_COOKIE["login_user"] . "' ORDER BY id DESC";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

        $count++;

        $id = $row["id"];
        $title = $row["title"];
        $description_c = $row["description_c"];
        $category_id = $row["category_id"];
        $status_bool = $row["status_bool"];
        $views = $row["views"];
        $count_likes = $row["likes"];
        if ($views > 1000) {
          $views = round($views/1000, 1) . 'K';
        }

        $boost_start = $row["boost_start"];
        $boost_end = $row["boost_end"];
        $date_format = date('d', strtotime($boost_end)) . " " . date('F', strtotime($boost_end));

        $tabella = "tbl_category";

        $mysqli_category = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_category->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_category, "utf8");
        $query_category = "SELECT name_category FROM $tabella WHERE id = '" . $category_id . "'";
        if ($result_category = $mysqli_category->query($query_category)) {
        /* fetch associative array */
        while ($row = $result_category->fetch_assoc()) {
            $name_category = $row["name_category"];
        }
        }
        /* free result set */
        $result_category->free();
        $mysqli_category->close();

    ?>
          <div onclick="location.href = 'edit/<?php echo $id ?>';" class="card type-<?php echo $status_bool ?>" data-id="<?php echo $id ?>">

            <div class="info-cont">
              <div class="text">
                <span class="title"><span><?php echo $title ?></span><span class="category"> - <?php echo $name_category ?></span></span>
                <span class="description"><?php echo $description_c ?></span>
              </div>
            </div>

            <div class="details-cont">

                <?php if ($status_bool == 2 && $boost_start == "0000-00-00 00:00:00") { ?>
                  <div class="td-icon published"><span><i class='bx bx-world'></i>Published</span></div>
                <?php } else if ($status_bool == 1 && $boost_start == "0000-00-00 00:00:00") { ?>
                  <div class="td-icon declined"><span><i class='bx bx-error-circle'></i>Declined</span></div>
                <?php } else if (($status_bool == 0 || $status_bool == 3) && $boost_start == "0000-00-00 00:00:00") { ?>
                  <div class="td-icon reviewing"><span><i class='bx bx-alarm'></i>Reviewing</span></div>
                <?php } else if ($boost_start != "0000-00-00 00:00:00") { ?>
                  <div class="td-icon boost"><span><i class='bx bx-bolt-circle'></i>Boost until <?php echo $date_format ?></span></div>
                <?php } ?>

                <div class="td-icon"><span><i class='bx bxs-bar-chart-alt-2' ></i><?php echo $views ?> <span class="dashboard-label">views</span></span></div>
                <div class="td-icon"><span><i class='bx bxs-heart' ></i><?php echo $count_likes ?> <span class="dashboard-label">likes</span></span></div>
            
            </div>

            <div onclick="event.stopPropagation(); showMenu('<?php echo $id ?>');" class="ripple transparent more-butt" name="preview"><a><i class='bx bx-dots-vertical-rounded' ></i></a></div>

            <div class="vertical-more vertical-menu hidden-menu" data-id="<?php echo $id ?>">
                <ul>
                    <?php if ($boost_start == "0000-00-00 00:00:00") { ?>
                      <li>
                        <div onclick="event.stopPropagation(); showAlert(this, 'boost'); showMenu('<?php echo $id ?>');" class="ripple" name="boost" data-id="<?php echo $id ?>"><a><i class='bx bx-bolt-circle' ></i>Boost</a></div>
                      </li>
                    <?php } else { ?>
                      <li>
                        <div onclick="" class="ripple disabled"><a><i class='bx bx-bolt-circle' ></i>Boost</a></div>
                      </li>
                    <?php } ?>
                    <li>
                      <div onclick="event.stopPropagation(); location.href = 'edit/<?php echo $id ?>'; showMenu('<?php echo $id ?>');" class="ripple" name="preview"><a><i class='bx bx-edit' ></i>Edit</a></div>
                    </li>
                    <li>
                      <div onclick="event.stopPropagation(); window.open('startup/<?php echo $id ?>'); showMenu('<?php echo $id ?>');" class="ripple" name="preview"><a><i class='bx bx-link-external' ></i>Preview</a></div>
                    </li>
                    <li>
                        <div class="h-divider"></div>
                    </li>
                    <li>
                      <div onclick="event.stopPropagation(); showAlert(this, 'send'); showMenu('<?php echo $id ?>');" class="ripple primary" name="delete" data-id="<?php echo $id ?>"><a><i class='bx bx-trash'></i>Delete</a></div>
                    </li>
                </ul>
            </div>

          </div>

            <div class="popup send hidden-timer" data-id="<?php echo $id ?>">
              <div id="send" class="hidden">
                <div class="header-popup"><i class='bx bx-info-circle'></i>Are you sure you want delete this startup?</div>
                <div class="text">Please confirm if you wish to proceed with deleting the startup from your list as this action is irreversible and cannot be undone.</div>
                <div class="butt-cont">
                  <div data-id="<?php echo $id ?>" onclick="hideAlert(this, 'send');" class="ripple outline"><a>Cancel</a></div>
                  <div data-id="<?php echo $id ?>" onclick="hideAlert(this, 'send'); location.href='<?php echo $folder ?>/dashboard?delete=<?php echo $id ?>';" class="ripple primary"><a>Delete</a></div>
                </div>
              </div>

              <div id="boost" class="hidden">
                <div class="header-popup"><i class='bx bx-info-circle'></i>Boost your startup!</div>
                <div class="text">Spend just 300 points and get it featured on our platform for 3 days. This will give your startup maximum visibility and a wider reach.</div>
                <div class="butt-cont">
                  <div data-id="<?php echo $id ?>" onclick="hideAlert(this, 'boost');" class="ripple outline"><a>Cancel</a></div>
                  <div data-id="<?php echo $id ?>" onclick="hideAlert(this, 'boost'); location.href='<?php echo $folder ?>/dashboard?q=boost&id=<?php echo $id ?>';" class="ripple transparent buy-points"><a><i class='bx bx-bolt-circle'></i>300</a></div>
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
        </div>
      <?php
      if ($count == 0) {
      ?>

      <div class="empty">
        <img alt="" src="assets/no-data.svg">
        <h3>No Startups Available</h3>
        <h4>You have not uploaded any startups yet.</h4>
      </div>

      <?php
      }
      ?>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script>
    function showMenu(id) {

      document.querySelectorAll(".vertical-more").forEach(function (el) {
        if (el.dataset.id != id) {
          el.classList.remove("show-menu");
          el.classList.add("hidden-menu");
        }
      });

      var x = document.querySelector(".vertical-more[data-id='" + id + "']");
      if (x.classList.contains("hidden-menu")) {
          x.classList.add("show-menu");
          x.classList.remove("hidden-menu");
      } else {
          x.classList.remove("show-menu");
          x.classList.add("hidden-menu");
      }
    }

  </script>

</body>

</html>
