<!DOCTYPE html>
<html>

<head>

  <title>Admin - BlazeBegin</title>
  <link rel="icon" type="image/x-icon" href="../favicon.ico">

  <meta charset="utf-8" />
  <meta name="author" content="Avabucks">
  <meta name="keywords" content="BlazeBegin, promote, startup, instagram, faceboook, tiktok, brand, influencer, free">
  <meta name="description" content="BlazeBegin is a community where makers and early adopters can share new products and ideas. It's a place to discover and get early access to exciting startups.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <!-- Include FILES -->
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../responsive.css">
  <script src="../js/script.js"></script>

  <!-- ===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>  

  <style>
    .visibility_no {
      opacity: 0;
      pointer-events: none;
    }
    .ripple.green > a {
      background-color: #8ac926;
    }

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

  </style>

</head>

<body>

  <?php
  include '../config.php';
  include '../header.php';
  if (isset($_COOKIE["login_user"]) && $admin_id == $_COOKIE["login_user"]) {

    if (isset($_GET['user'])) {
      // get mail
        $id_us = $_GET['user'];
        $tabella = "tbl_user";

        $mysqli_mail = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_mail->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_mail, "utf8");
        $query_mail = "SELECT email_us FROM $tabella WHERE id_us = '" . $id_us . "'";
        if ($result_mail = $mysqli_mail->query($query_mail)) {
        /* fetch associative array */
        while ($row = $result_mail->fetch_assoc()) {
            $email_us = $row["email_us"];
        }
        }
        /* free result set */
        $result_mail->free();
        $mysqli_mail->close();

    }

      if (isset($_GET['q']) && $_GET['q'] == "decline") {
        $id = $_GET['id'];
        $tabella = 'tbl_startups';

        // Connessione al db
        $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
        $mysqli->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli,"utf8");

        $query="UPDATE $tabella SET status_bool = '1' WHERE id = $id ";

        if (mysqli_query($mysqli, $query)) {
          include 'sendMail_declined.php';
        }

        $mysqli->close();

        
      }

      if (isset($_GET['q']) && $_GET['q'] == "accept") {
        
        $id = $_GET['id'];
        $date_added = date("Y-m-d");

        $tabella = 'tbl_startups';

        // Connessione al db
        $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
        $mysqli->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli,"utf8");

        $query="UPDATE $tabella SET status_bool = '2', date_added = '" . $date_added . "' WHERE id = $id ";

        if (mysqli_query($mysqli, $query)) {

            $id_us_startup = $_COOKIE["login_user"];

            // notification
            $tabella_notification = 'tbl_notifications';
            $mysqli_notification = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
            $mysqli_notification->select_db($db_name) or die( "Unable to select database");
              mysqli_set_charset($mysqli_notification,"utf8");

                $query_notification="INSERT INTO $tabella_notification (id_us, has_read, message_type, name_startup, name_user) VALUES ('$id_us', '0', '1', '$id', '')";

              if (mysqli_query($mysqli_notification, $query_notification)) {

              }

              $mysqli_notification->close();
            // end notification

          // add 100 diamonds
          $tabella_user = 'tbl_user';
          $mysqli_diamonds = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
          $mysqli_diamonds->select_db($db_name) or die( "Unable to select database");
            mysqli_set_charset($mysqli_diamonds,"utf8");

              $query_diamonds="UPDATE $tabella_user SET diamonds = diamonds + 100 WHERE id_us = '$id_us' ";

            if (mysqli_query($mysqli_diamonds, $query_diamonds)) {
              include 'sendMail_published.php';
            }

            $mysqli_diamonds->close();
          // end add diamonds

          
        }

        $mysqli->close();

        
      }

      if (isset($_GET['q']) && $_GET['q'] == "edit") {
        $id = $_GET['id'];
        
        $tabella = 'tbl_startups';

        // Connessione al db
        $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
        $mysqli->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli,"utf8");

        $query="UPDATE $tabella SET status_bool = '2' WHERE id = $id ";

        if (mysqli_query($mysqli, $query)) {
          include 'sendMail_published.php';
        }

        $mysqli->close();

        
      }


  ?>

  <script>
    deleteQueryString();
  </script>

  <section>

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Admin</span>
        </div>
        <span>
          <i class='bx bx-key' ></i>
          <h1>Admin</h1>
        </span>
        <div class="underline"></div>
      </div>
      <h2>Manage users startups</h2>
    </div>

    <div>

      <div class="search-input">
        <span>Search from startups:</span>
        <div class="input-cont">
          <input class="input" type="text" name="search" id="search" placeholder="Enter keywords ...">
          <label for="search">Enter keywords ...</label>
        </div>
      </div>

      <div class="tab tab-dashboard">

    <?php

    $tabella = 'tbl_startups';

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, category_id, status_bool, views, author, id_us FROM $tabella WHERE status_bool != 1 ORDER BY CASE WHEN status_bool = 0 then 2 WHEN status_bool = 2 then 3 WHEN status_bool = 3 then 1 END ASC, id DESC";
        
    if ($result = $mysqli->query($query)) {
      $count = mysqli_num_rows($result);
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

        // if ($count < mysqli_num_rows($result) - 50) continue;

        $id = $row["id"];
        $title = $row["title"];
        $description_c = $row["description_c"];
        $category_id = $row["category_id"];
        $author = $row["author"];
        $id_us = $row["id_us"];
        $status_bool = $row["status_bool"];
        $views = $row["views"];
        if ($views > 1000) {
          $views = round($views/1000, 1) . 'K';
        }

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
          <div class="card type-<?php echo $status_bool ?>" data-id="<?php echo $id ?>">

            <div class="info-cont">
              <div class="text">
                <span class="title"><?php echo $count ?>. <?php echo $title ?><span class="category"> - Views: <?php echo $views ?></span></span>
              </div>
            </div>

            <div class="details-cont">

                <?php if ($status_bool == 2) { ?>
                  <div class="td-icon published"><span><i class='bx bx-world'></i>Published</span></div>
                <?php } else if ($status_bool == 1) { ?>
                  <div class="td-icon declined"><span><i class='bx bx-error-circle'></i>Declined</span></div>
                <?php } else if ($status_bool == 0 || $status_bool == 3) { ?>
                  <div class="td-icon reviewing"><span><i class='bx bx-alarm'></i>Reviewing</span></div>
                <?php } ?>

            </div>


            <div class="butt-cont">
              <div>
                <div class="ripple transparent" name="preview"><a href="<?php echo $folder ?>/startup/<?php echo $id ?>" target="blank"><i class='bx bx-link-external' ></i>Preview</a></div>
              </div>
              <?php if ($status_bool == 0 || $status_bool == 3) { ?>
                <?php
                  if ($status_bool == 0) {
                    $type_accept = "accept";
                  } else if ($status_bool == 3) {
                    $type_accept = "edit";
                  }
                ?>
                <div>
                  <div class="ripple primary" name="declined"><a href="?q=decline&id=<?php echo $id ?>&user=<?php echo $id_us ?>"><i class='bx bx-x'></i></a></div>
                </div>
                <div>
                  <div class="ripple green" name="published"><a href="?q=<?php echo $type_accept ?>&id=<?php echo $id ?>&user=<?php echo $id_us ?>"><i class='bx bx-check'></i></a></div>
                </div>
              <?php } else { ?>
                <div class="visibility_no">
                  <div class="ripple"><a><i class='bx bx-x'></i></a></div>
                </div>
                <div class="visibility_no">
                  <div class="ripple"><a><i class='bx bx-check'></i></a></div>
                </div>
              <?php } ?>
            </div>

          </div>
 
      <?php

        $count--;

        }
      }

      /* free result set */
      $result->free();
      $mysqli->close();

      ?>
        </div>
    </div>
  </section>

  <?php include '../footer.php'; ?>

  <?php
  } else { ?>
    <script>
      location.href = "<?php echo $folder ?>/";
    </script>
  <?php } ?>

</body>

</html>
