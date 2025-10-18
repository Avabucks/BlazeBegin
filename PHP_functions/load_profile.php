      <?php

      include '../config.php';

      $id_us = $_GET['id_us'];
      $tabella = 'tbl_startups';

      ?>

      <?php

      $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
      $mysqli->select_db($db_name) or die("Unable to select database");
      mysqli_set_charset($mysqli, "utf8");
      $query = "SELECT id, title, description_c, images_path, category_id, author FROM $tabella WHERE status_bool = 2 AND id_us = '$id_us' ORDER BY boost_start DESC, views DESC LIMIT " . $_GET['start'] . ", " . $_GET['tot'];
      if ($result = $mysqli->query($query)) {
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {

          $id = $row["id"];
          $title = $row["title"];
          $description_c = $row["description_c"];
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

      <div class="card" onclick="location.href='../startup/<?php echo $id ?>'">
        <img src="../<?php echo $image_src ?>">
        <div class="blurred-details">
          <div onclick="putLike(event);" class="ripple transparent like"><a data-id=<?php echo $id ?>><i class='bx <?php echo $class_like ?>'></i></a></div>
            <div class="info">
              <b><?php echo $title ?></b>
              <span class="category"><i class='bx bxs-label' ></i><a href="../category/<?php echo strtolower(str_replace(" ", "-", str_replace("&", "and", $name_category))) ?>"><?php echo $name_category ?></a></span>
              <span><?php echo $description_c ?></span>
              <span class="author"><span><i class='bx bxs-user' ></i>by</span> <a href="../profile/<?php echo strtolower(str_replace(" ", "-", $author)) ?>"><?php echo $author ?></a></span>
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