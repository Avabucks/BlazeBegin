<!DOCTYPE html>
<html>

<head>

  <title>Submit - BlazeBegin</title>
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
    .title h1 {
      text-align: center;
    }
    
    .upload-field {
      margin-top: 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
      border: 2px dashed var(--line-color);
      width: 100%;
      aspect-ratio: 16/9;
      border-radius: 10px;
      cursor: pointer;
      transition: .3s;
    }
    .upload-field:hover {
      background-color: var(--line-color);
    }

    .upload-field i {
      font-size: 3em;
      opacity: .5;
      margin-bottom: 10px;
    }
    .upload-field b {
      font-weight: 600;
      opacity: .9;
    }
    .upload-field span {
      font-weight: 400;
      font-size: .9em;
      opacity: .7;
    }

    .upload-grid {
      width: 100%;
    }

    .uploaded-images {
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: 100%;
    }
    .uploaded-images > .img {
      position: relative;
      width: 100%;
      aspect-ratio: 16/9;
    }
    .uploaded-images > .img img {
      width: 100%;
      height: 100%;
      aspect-ratio: 16/9;
      object-fit: cover;
      border-radius: 10px;
      cursor: pointer;
    }

    .uploaded-images > .img::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: rgb(0, 0, 0, 0);
      pointer-events: none;
      border-radius: 10px;
      cursor: pointer;
      transition: .3s;
    }
    .uploaded-images > .img:hover::after {
      background-color: rgb(0, 0, 0, .8);
    }
    .uploaded-images > .img i {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 2em;
      opacity: 0;
      transition: .3s;
      z-index: 1000;
      pointer-events: none;
    }
    .uploaded-images > .img:hover i {
      opacity: .8;
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

  <?php include 'config.php'; ?>

  <?php
  // check if login
      if (!isset($_COOKIE["login_user"])) {
        ?>
          <script>location.href="login"</script>
        <?php
      }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $title = str_replace("'", "&lsquo;", $_POST['title']);
      $subtitle = str_replace("'", "&lsquo;", $_POST['subtitle']);
      $description_c = str_replace("'", "&lsquo;", $_POST['description']);
      $images_path = $_POST['images_path'];
      $link = $_POST['link'];
      $category_id = $_POST['category_id'];
      $instagram_link = $_POST['instagram'];
      $tiktok_link = $_POST['tiktok'];
      $facebook_link = $_POST['facebook'];
      $twitter_link = $_POST['twitter'];
      $author = $_COOKIE["username"];
      $id_us = $_COOKIE["login_user"];
      $views = 0;
      $status_bool = 0;
      $date_added = date("Y-m-d");


      $tabella = 'tbl_startups';
      $exist = 0;

      $mysqli_startup = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
      $mysqli_startup->select_db($db_name) or die("Unable to select database");
      mysqli_set_charset($mysqli_startup, "utf8");
      $query_startup = "SELECT id, title, link FROM $tabella";
      if ($result_startup = $mysqli_startup->query($query_startup)) {
      /* fetch associative array */
      while ($row = $result_startup->fetch_assoc()) {
          $title_search = $row["title"];
          $link_search = $row["link"];
          $link_search = "https://www." . str_replace("www.", "", str_replace("https://", "", $link_search));
          if ($title_search == $title || $link_search == "https://www." . str_replace("www.", "", str_replace("https://", "", $link))) {
            $exist = 1;
          }
      }

      }

      /* free result set */
      $result_startup->free();
      $mysqli_startup->close();


      if ($exist == 0) {

                    // Connessione al db
                  $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
          $mysqli->select_db($db_name) or die( "Unable to select database");
            mysqli_set_charset($mysqli,"utf8");
        
            $query="INSERT INTO $tabella (title, subtitle, description_c, images_path, link, category_id, instagram_link, tiktok_link, facebook_link, twitter_link, author, id_us, views, status_bool, date_added) VALUES ('$title', '$subtitle', '$description_c', '$images_path', '$link', '$category_id', '$instagram_link', '$tiktok_link', '$facebook_link', '$twitter_link', '$author', '$id_us', '$views', '$status_bool', '$date_added') ";
            if (mysqli_query($mysqli, $query)) {


                mail('info@blazebegin.com', 'Request add startup', "Request add startup by: " . $author, 'From: info@blazebegin.com' . "\r\n" .
        'Reply-To: info@blazebegin.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion());
              ?>
              <script>location.href="thanks"</script>
              <?php
            }

            $mysqli->close();

        } else {
              ?>
              <script>
                location.href="dashboard?q=exist";
              </script>
              <?php
        }

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
          <span>Submit</span>
        </div>
        <h1>Submit your startup</h1>
        <div class="underline"></div>
      </div>
    </div>

    <div>
      <form method="post" enctype="multipart/form-data">
        <div class="input-cont-css">

        <!-- SECTION GENERAL -->
        <div class="section general show-section">

          <h4>Tell us about your startup</h4>

          <div class="input-cont">
            <input class="input" type="text" name="title" id="title" placeholder="Startup Name" autofocus required>
            <label for="title">Startup Name</label>
          </div>
          <div class="input-cont">
            <input class="input" type="text" name="subtitle" id="subtitle" placeholder="Describe your product in one sentence" required>
            <label for="subtitle">Describe your product in one sentence</label>
          </div>
          <div class="input-cont">
            <textarea class="input" type="text" name="description" id="description" placeholder="Describe your startup in one or two paragraphs starting with its name" required></textarea>
            <label for="description">Describe your startup in one or two paragraphs</label>
          </div>

          <div class="input-cont">
            <span class="fixed-text">https://</span>
            <input class="input" type="text" name="link" id="link" placeholder="Website" required>
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
                          <option value="<?php echo $id ?>"><?php echo $name_category ?></option>
                        <?php
                        $list_categories .= $name_category . "(id:" . $id . ")" . ", ";
                    }

                    }

                    /* free result set */
                    $result_category->free();
                    $mysqli_category->close();
                    ?>
            </select>
            <label for="type">Startup Category</label>
          </div>

          <div onclick="goToNextSection('images');" class="ripple transparent" name="next"><a><i class='bx bx-chevron-right'></i>Select Images</a></div>

      </div>

       <!-- SECTION IMAGES -->
      <div class="section images hidden-section">

          <h4>Upload your startup's images</h4>
          <h4>We recommend using an image size of <b>1920x1080</b> pixels with a 16:9 aspect ratio.</h4>

          <div class="upload-grid">
              <input class="hidden" id="upload-thumbnails" name="upload-thumbnails" type="file" accept=".gif,.jpg,.jpeg,.png,.webp">
              <input class="hidden" name="images_path" id="images_path" type="text">
              <div class="uploaded-images">
                <label class="upload-field" for="upload-thumbnails">
                  <i class='bx bx-image-add'></i>
                  <b>Click to upload thumbnails</b>
                  <span>(At least 1 image)</span>
                </label>
              </div>
          </div>

          <div onclick="goToNextSection('links');" class="ripple transparent" name="next"><a><i class='bx bx-chevron-right'></i>Social Links</a></div>
          
      </div>

       <!-- SECTION LINKS -->
      <div class="section links hidden-section">

          <h4>Add your startup's social links</h4>

          <div class="input-cont">
            <span class="fixed-text">https://instagram.com/</span>
            <input class="input" type="text" name="instagram" id="instagram" placeholder="Instagram Username">
            <label for="instagram">Instagram Username</label>
          </div>
          <div class="input-cont">
            <span class="fixed-text">https://tiktok.com/@</span>
            <input class="input" type="text" name="tiktok" id="tiktok" placeholder="TikTok Username">
            <label for="tiktok">TikTok Username</label>
          </div>
          <div class="input-cont">
            <span class="fixed-text">https://facebook.com/</span>
            <input class="input" type="text" name="facebook" id="facebook" placeholder="Facebook Username">
            <label for="facebook">Facebook Username</label>
          </div>
          <div class="input-cont">
            <span class="fixed-text">https://twitter.com/</span>
            <input class="input" type="text" name="twitter" id="twitter" placeholder="Twitter Username">
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

      if (classname == "images") {
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

      if (classname == "links") {
        if (document.querySelector("#images_path").value == "") {
          showTimerAlert("You must add at least 1 image.");
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

    // AI Category
    document.querySelector("#description").addEventListener("change", function () {
      document.querySelector("#category_id").classList.add("disabled");
      var message = 'From this description "' + this.value + '" choose the category that suits you best among these: "<?php echo $list_categories ?>". Your answer must contain only the id number'
      $.ajax({
        type: "GET",
        url: "AI", 
        data: {"message":message},
        success: function(response) {
          document.querySelector("#category_id").classList.remove("disabled");
          document.querySelector("#category_id").value = response.match(/\d/g).join("");
        }
      });
    });
  </script>

</body>

</html>
