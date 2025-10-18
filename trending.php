<!DOCTYPE html>
<html>

<head>

  <title>Trending - BlazeBegin</title>
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

  <?php include 'header.php'; ?>

  <section class="trending">

    <div class="title">
      <div>
        <div class="breadcrumb">
          <a href="index">Home</a>
          <i class='bx bx-chevron-right'></i>
          <span>Trending</span>
        </div>
        <h1>Top Trending startups</h1>
        <div class="underline"></div>
      </div>
      <h2>Whether you're looking to invest in the next big thing or simply curious about the latest trends in startup culture, these companies should definitely be on your radar.</h2>
    </div>

    <div id="trending-tab">

      <div class="grid-layout">
      </div>

      <div class="loader">
        <div></div>
      </div>

    </div>

    <div class="show-more hidden">
      <div id="show-more" class="ripple outline"><a><i class='bx bx-chevron-down'></i>Show More</a></div>
    </div>

  </section>

  <?php include 'footer.php'; ?>

  <script>

    var start = 0;

    $(document).ready(function() {

      $.ajax({
        type: "GET",
        url: "./PHP_functions/load_trending", 
        data: {"start":start, "tot":tot},
        success: function(response) {
          document.querySelector("#trending-tab div").innerHTML += response;

          if (document.querySelector("#trending-tab div").children.length == 0) {
            response = '<div class="empty">'
            +  '<img alt="" src="./assets/no-data.svg">'
            +  '<h3>No Startups Available</h3>'
            +  '<h4>There are currently no startups available.</h4>'
          + '</div>';
            document.querySelector("#trending-tab").innerHTML = response;
          }

          if (document.querySelector("#trending-tab div").children.length < 4)
            document.querySelector("#trending-tab div").innerHTML += '<div class="hide-on-mobile"></div><div class="hide-on-mobile"></div><div class="hide-on-tablet hide-on-mobile"></div><div class="hide-on-tablet hide-on-mobile"></div>';

          document.querySelector(".loader").classList.add("hidden");

          // check if is last
          $.ajax({
            type: "GET",
            url: "./PHP_functions/load_trending", 
            data: {"start":start + tot, "tot":tot},
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
          url: "./PHP_functions/load_trending", 
          data: {"start":start, "tot":tot},
          success: function(response) {
            document.querySelector("#trending-tab div").innerHTML += response;
            document.querySelector(".loader").classList.add("hidden");
      
            // check if is last
            $.ajax({
              type: "GET",
              url: "./PHP_functions/load_trending", 
              data: {"start":start + tot, "tot":tot},
              success: function(response) {
                document.querySelector(".show-more").classList.remove("hidden");
                if (response.trim() == "") document.querySelector(".show-more").classList.add("hidden");
              }
            });

          }
        });

    });

  </script>


</body>

</html>