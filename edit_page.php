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
        $link = str_replace("www.", "", str_replace("https://", "", $link));

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

    ?>

<!DOCTYPE html>
<html>

<head>

  <title>Edit <?php echo $title ?> - BlazeBegin</title>
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
    .title h1 {
      text-align: center;
    }
    
    textarea {
      height: 200px !important;
    }

    .title {
      align-items: center !important;
      padding-bottom: 30px !important;
    }

    .section {
      width: 450px;
      margin: 0 auto;
      flex-direction: column;
      gap: 30px;
      align-items: center;
      animation: fade-in .3s;
    }
    .section.show-section {
      display: flex;
    }
    .section.hidden-section {
      display: none;
    }
    .section .ripple,
    .section .ripple > a {
      margin-top: 10px;
      width: 100%;
    }

    .section h4 {
      font-weight: 400;
      opacity: .7;
      font-size: 1em;
      margin-bottom: -15px;
      text-align: center;
    }

    .fixed-text {
      position: absolute;
      top: 27px;
      left: 5px;
    }
    #link, #link + label {
      padding-left: 70px;
    }

    #instagram, #instagram + label {
      padding-left: 200px;
    }
    #tiktok, #tiktok + label {
      padding-left: 175px;
    }
    #facebook, #facebook + label {
      padding-left: 195px;
    }
    #twitter, #twitter + label {
      padding-left: 170px;
    }

    .disabled {
      opacity: .5;
      pointer-events: none;
    }

  </style>

</head>

<body>

  <div class="bg"></div>

  <?php
    // check if login
    $permission = false;

    if (isset($_COOKIE["login_user"]) && $admin_id == $_COOKIE["login_user"]) $permission = true; //isAdmin
    if (!isset($_COOKIE["login_user"])) $permission = false; //no account
    if (isset($_COOKIE["login_user"]) && $id_us == $_COOKIE["login_user"]) $permission = true; //can edit account

    if (!$permission) {
      ?>
        <script>location.href="../index"</script>
      <?php
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $title = str_replace("'", "&lsquo;", $_POST['title']);
      $subtitle = str_replace("'", "&lsquo;", $_POST['subtitle']);
      $description_c = str_replace("'", "&lsquo;", $_POST['description']);
      $link = $_POST['link'];
      $category_id = $_POST['category_id'];
      $instagram_link = $_POST['instagram'];
      $tiktok_link = $_POST['tiktok'];
      $facebook_link = $_POST['facebook'];
      $twitter_link = $_POST['twitter'];


      $status_bool = 3;
      if ($admin_id == $_COOKIE["login_user"]) $status_bool = 2; //isAdmin

                    // Connessione al db
                  $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
          $mysqli->select_db($db_name) or die( "Unable to select database");
            mysqli_set_charset($mysqli,"utf8");
        
            $query="UPDATE $tabella SET title = '$title', subtitle = '$subtitle', description_c = '$description_c', link = '$link', category_id = '$category_id', instagram_link = '$instagram_link', tiktok_link = '$tiktok_link', facebook_link = '$facebook_link', twitter_link = '$twitter_link', status_bool = $status_bool WHERE id = " . $id . "";
            if (mysqli_query($mysqli, $query)) {

                    if ($admin_id != $_COOKIE["login_user"]) {
                              mail('info@blazebegin.com', 'Request edit startup', "Request edit startup by: " . $author, 'From: info@blazebegin.com' . "\r\n" .
                      'Reply-To: info@blazebegin.com' . "\r\n" .
                      'X-Mailer: PHP/' . phpversion());
                      ?>
                      <script>location.href="../dashboard?q=send"</script>
                      <?php           
                    } else {
                      ?>
                      <script>location.href="../index"</script>
                      <?php
                    }

            }

            $mysqli->close();

        

      }

  ?>

  <?php include 'header.php'; ?>

  <script>
    document.querySelector(".floating-butt").classList.add("hidden");
  </script>

  <section class="submit">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Edit Startup</span>
        </div>
        <h1><?php echo $title ?></h1>
        <div class="underline"></div>
      </div>
    </div>

    <div>
      <form method="post" enctype="multipart/form-data">
        <div class="input-cont-css">

        <!-- SECTION GENERAL -->
        <div class="section general show-section">

          <h4>If you make any edits to your startup, it will need to undergo a review process.</h4>

          <div class="input-cont">
            <input class="input" type="text" name="title" id="title" placeholder="Startup Name" value="<?php echo $title ?>" autofocus required>
            <label for="title">Startup Name</label>
          </div>
          <div class="input-cont">
            <input class="input" type="text" name="subtitle" id="subtitle" placeholder="Describe your product in one sentence" value="<?php echo $subtitle ?>" required>
            <label for="subtitle">Describe your product in one sentence</label>
          </div>
          <div class="input-cont">
            <textarea class="input" type="text" name="description" id="description" placeholder="Describe your startup in one or two paragraphs starting with its name" required><?php echo $description_c ?></textarea>
            <label for="description">Describe your startup in one or two paragraphs</label>
          </div>

          <div class="input-cont">
            <span class="fixed-text">https://</span>
            <input class="input" type="text" name="link" id="link" placeholder="Website" value="<?php echo $link ?>" required>
            <label for="link">Website</label>
          </div>

          <div class="input-cont">
            <select class="input" name="category_id" id="category_id" placeholder="Startup Type">
                    <?php

                    $tabella = "tbl_category";
                    $list_categories = "";

                    $mysqli_category = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
                    $mysqli_category->select_db($db_name) or die("Unable to select database");
                    mysqli_set_charset($mysqli_category, "utf8");
                    $query_category = "SELECT id, name_category FROM $tabella ORDER BY name_category";
                    if ($result_category = $mysqli_category->query($query_category)) {
                    /* fetch associative array */
                    while ($row = $result_category->fetch_assoc()) {
                        $id = $row["id"];
                        $name_category = $row["name_category"];
                        ?>
                          <option value="<?php echo $id ?>" <?php if ($id == $category_id) echo "selected" ?>><?php echo $name_category ?></option>
                        <?php
                    }

                    }

                    /* free result set */
                    $result_category->free();
                    $mysqli_category->close();
                    ?>
            </select>
            <label for="type">Startup Category</label>
          </div>

          <div onclick="goToNextSection('links');" class="ripple transparent" name="next"><a><i class='bx bx-chevron-right'></i>Social Links</a></div>

      </div>

       <!-- SECTION LINKS -->
      <div class="section links hidden-section">

          <h4>Add your startup's social links</h4>

          <div class="input-cont">
            <span class="fixed-text">https://instagram.com/</span>
            <input class="input" type="text" name="instagram" id="instagram" placeholder="Instagram Username" value="<?php echo $instagram_link ?>">
            <label for="instagram">Instagram Username</label>
          </div>
          <div class="input-cont">
            <span class="fixed-text">https://tiktok.com/@</span>
            <input class="input" type="text" name="tiktok" id="tiktok" placeholder="TikTok Username" value="<?php echo $tiktok_link ?>">
            <label for="tiktok">TikTok Username</label>
          </div>
          <div class="input-cont">
            <span class="fixed-text">https://facebook.com/</span>
            <input class="input" type="text" name="facebook" id="facebook" placeholder="Facebook Username" value="<?php echo $facebook_link ?>">
            <label for="facebook">Facebook Username</label>
          </div>
          <div class="input-cont">
            <span class="fixed-text">https://twitter.com/</span>
            <input class="input" type="text" name="twitter" id="twitter" placeholder="Twitter Username" value="<?php echo $twitter_link ?>">
            <label for="twitter">Twitter Username</label>
          </div>

          <button class="ripple primary" name="login" type="submit"><a><i class='bx bx-plus'></i>Submit for a review</a></button>

      </div>

        </div> <!-- DIV INPUT CONT CSS -->

      </form>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script>
    $(document).ready(function () {
        // Warning
        $(window).on('beforeunload', function(){
            return "Any changes will be lost";
        });

        // Form Submit
        $(document).on("submit", "form", function(event){
            // disable warning
            $(window).off('beforeunload');
        });
    });

    function goToNextSection(classname) {

      window.scrollTo(0, 0);

      if (classname == "links") {
        if (document.querySelector("#title").value == "") {
          showTimerAlert("You must fill the name field.");
          return;
        }
        if (document.querySelector("#subtitle").value == "") {
          showTimerAlert("You must fill the subtitle field.");
          return;
        }
        if (document.querySelector("#description").value == "") {
          showTimerAlert("You must fill the description field.");
          return;
        }
        if (document.querySelector("#link").value == "") {
          showTimerAlert("You must fill the link field.");
          return;
        }
      }

      document.querySelectorAll(".section").forEach(function (el) {
        el.classList.remove("show-section");
        el.classList.add("hidden-section");
      });

      document.querySelector("." + classname).classList.add("show-section");
      document.querySelector("." + classname).classList.remove("hidden-section");
    }

  </script>

</body>

</html>
