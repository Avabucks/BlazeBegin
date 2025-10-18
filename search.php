<!DOCTYPE html>
<html>

<head>

  <title>Search - BlazeBegin</title>
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
    .input-cont {
      margin-top: -30px;
    }
    .search-cont {
      display: flex;
      gap: 10px;
      width: 100%;
      align-items: center;
    }
    .search-cont .ripple > a {
      background-color: rgb(0, 0, 0, 0);
    }
    .search-cont .ripple > a::after {
      border-radius: 50em;
    }
  </style>

</head>

<body>

  <?php include 'header.php'; ?>

  <?php
  $query = "";
  if (isset($_GET['search'])) { 
    $query = $_GET['search'];
  }
  ?>

  <section>

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Search</span>
        </div>
      </div>
      <form class="search-cont">
        <div class="input-cont">
          <input class="input" type="text" name="search" id="search" placeholder="Enter keywords ..." value="<?php echo $query ?>" autofocus>
          <label for="search">Enter keywords ...</label>
        </div>
        <button class="ripple transparent"><a><i class='bx bx-search'></i></a></button>
      </form>
    </div>

    <div>

      <?php if (!isset($_GET['search'])) { ?>

        <div class="empty">
          <img alt="" src="assets/search.svg">
          <h3>Search For Startups</h3>
          <h4>Enter keywords related to the industry or sector you are interested in.</h4>
        </div>

      <?php } else { ?>

        <div class="search-label">
          <b><div><i class='bx bx-search' ></i><b>Search results for: </b></div><span><?php echo $query ?></span></b>
        </div>

        <div id="search-tab">

          <div class="grid-layout">
          </div>

          <div class="loader">
            <div></div>
          </div>

        </div>

        <div class="show-more hidden">
          <div id="show-more" class="ripple outline"><a><i class='bx bx-chevron-down'></i>Show More</a></div>
        </div>

  <script>

    var start = 0;

    $(document).ready(function() {

      $.ajax({
        type: "GET",
        url: "PHP_functions/load_search", 
        data: {"start":start, "tot":tot, "query":"<?php echo $query ?>"},
        success: function(response) {
          document.querySelector("#search-tab div").innerHTML += response;

          if (document.querySelector("#search-tab div").children.length == 0) {
            response = '<div class="empty">'
            +  '<img alt="" src="assets/no-data.svg">'
            +  '<h3>No Startups Available</h3>'
            +  '<h4>Please try your search again with another keywords.</h4>'
          + '</div>';
            document.querySelector("#search-tab").innerHTML = response;
          }

          if (document.querySelector("#search-tab div").children.length < 4)
            document.querySelector("#search-tab div").innerHTML += '<div class="hide-on-mobile"></div><div class="hide-on-mobile"></div><div class="hide-on-tablet hide-on-mobile"></div><div class="hide-on-tablet hide-on-mobile"></div>';

          document.querySelector(".loader").classList.add("hidden");

          // check if is last
          $.ajax({
            type: "GET",
            url: "PHP_functions/load_search", 
            data: {"start":start + tot, "tot":tot, "query":"<?php echo $query ?>"},
            success: function(response) {
              if (response.trim() == "") {
                document.querySelector(".show-more").classList.add("hidden");
              } else {
                document.querySelector(".show-more").classList.remove("hidden")
              }
            }
          });

        }
      });
      
    });

    $("#show-more").click(function() {

        document.querySelector(".show-more").classList.add("hidden");

        document.querySelector(".loader").classList.remove("hidden");

        start = start + tot;

        $.ajax({
          type: "GET",
          url: "PHP_functions/load_search", 
          data: {"start":start, "tot":tot, "query":"<?php echo $query ?>"},
          success: function(response) {
            document.querySelector("#search-tab div").innerHTML += response;
            document.querySelector(".loader").classList.add("hidden");

            // check if is last
            $.ajax({
              type: "GET",
              url: "PHP_functions/load_search", 
              data: {"start":start + tot, "tot":tot, "query":"<?php echo $query ?>"},
              success: function(response) {
                document.querySelector(".show-more").classList.remove("hidden");
                if (response.trim() == "") document.querySelector(".show-more").classList.add("hidden");
              }
            });

          }
        });

    });

  </script>

      <?php } ?>

    </div>
  </section>

  <?php include 'footer.php'; ?>

</body>

</html>
