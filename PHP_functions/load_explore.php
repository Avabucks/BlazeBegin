    <?php

    include '../config.php';

    $tabella = 'tbl_startups';

    $mysqli_date = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli_date->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli_date, "utf8");
    $query_date = "SELECT date_added FROM $tabella WHERE status_bool = 2 GROUP BY date_added ORDER BY date_added DESC LIMIT " . $_GET['start'] . ", " . $_GET['tot'];
    if ($result_date = $mysqli_date->query($query_date)) {
      /* fetch associative array */
      while ($row_date = $result_date->fetch_assoc()) {
        $date_added = $row_date["date_added"];

        $day = explode("-", $date_added)[2];
        $month = explode("-", $date_added)[1];
        $year = explode("-", $date_added)[0];
        $date_string = $day . " " . date('F', strtotime($date_added));

    ?>

    <b class="date-label"><i class='bx bx-calendar' ></i><?php echo date('l', strtotime($date_added)) ?><span><?php echo $date_string ?></span></b>

    <div class="grid-layout">
        
    <?php

    $count = 0;

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id, title, description_c, images_path, category_id, author, id_us FROM $tabella WHERE status_bool = 2 AND date_added = '$date_added' ORDER BY date_added DESC, id DESC";
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

    ?>
    
      <div class="hide-on-mobile"></div>
      <div class="hide-on-mobile"></div>
      <div class="hide-on-tablet hide-on-mobile"></div>
    </div>

    <?php
        }
      }

      /* free result set */
      $result_date->free();
      $mysqli_date->close();

    ?>
