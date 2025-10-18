<?php
    include 'config.php';

  $tabella = 'tbl_likes';

  $id_startup = $_POST['id_startup'];
  $id_us = $_COOKIE["login_user"];

  $exist = "0";

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT id FROM $tabella WHERE id_startup = '" . $id_startup . "' AND id_us = '" . $id_us . "'";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          $exist = "1";
        }
    }

      /* free result set */
      $result->free();
      $mysqli->close();

      $tabella_us = 'tbl_startups';

        $mysqli_us = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_us->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_us, "utf8");
        $query_us = "SELECT id_us FROM $tabella_us WHERE id = $id_startup";
        if ($result_us = $mysqli_us->query($query_us)) {
          /* fetch associative array */
          while ($row_us = $result_us->fetch_assoc()) {
              $id_us_startup = $row_us["id_us"];
            }
        }


    if ($exist == "0") {


      /* free result set */
      $result_us->free();
      $mysqli_us->close();

      // Connessione al db
      $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
      $mysqli->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli,"utf8");

        $query="INSERT INTO $tabella (id_startup, id_us, isLike) VALUES ('$id_startup', '$id_us', 1) ";

        if (mysqli_query($mysqli, $query)) {
          if ($id_us_startup != $_COOKIE["login_user"]) {
            // add 10 diamonds
            $tabella_user = 'tbl_user';
            $mysqli_diamonds = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
            $mysqli_diamonds->select_db($db_name) or die( "Unable to select database");
              mysqli_set_charset($mysqli_diamonds,"utf8");

                $query_diamonds="UPDATE $tabella_user SET diamonds = diamonds + 10 WHERE id_us = '$id_us_startup' ";

              if (mysqli_query($mysqli_diamonds, $query_diamonds)) {
                include 'sendMail_published.php';
              }

              $mysqli_diamonds->close();
            // end add diamonds

            // notification
            $tabella_notification = 'tbl_notifications';
            $mysqli_notification = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
            $mysqli_notification->select_db($db_name) or die( "Unable to select database");
              mysqli_set_charset($mysqli_notification,"utf8");

                $query_notification="INSERT INTO $tabella_notification (id_us, has_read, message_type, name_startup, name_user) VALUES ('$id_us_startup', '0', '0', '$id_startup', '" . $_COOKIE['username'] . "')";

              if (mysqli_query($mysqli_notification, $query_notification)) {

              }

              $mysqli_notification->close();
            // end notification

            updateLikes($id_startup, "+");

          }

        }
        $mysqli->close();

    } else if ($exist == "1") {

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT isLike FROM $tabella WHERE id_startup = '" . $id_startup . "' AND id_us = '" . $id_us . "'";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
        if ($id_us_startup != $_COOKIE["login_user"]) {
          if ($row["isLike"] == "1") {
            $isLike = "0";
            updateLikes($id_startup, "-");
          } else {
            $isLike = "1";
            updateLikes($id_startup, "+");
          }
        }
      }
    }

      /* free result set */
      $result->free();
      $mysqli->close();

      $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
      $mysqli->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli,"utf8");

          $query="UPDATE $tabella SET isLike = $isLike WHERE id_us = '" . $id_us . "' AND id_startup = '" . $id_startup . "' ";

        if (mysqli_query($mysqli, $query)) {

        }

        $mysqli->close();
    }

  
    function updateLikes($id, $type) {

      include 'config.php';

      $tabella_updatelikes = 'tbl_startups';

      $mysqli_updatelikes = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
      $mysqli_updatelikes->select_db($db_name) or die( "Unable to select database");
        mysqli_set_charset($mysqli_updatelikes,"utf8");

        if ($type == "-") {
          $query_updatelikes="UPDATE $tabella_updatelikes SET likes = likes-1 WHERE id = '" . $id . "' ";
        } else {
          $query_updatelikes="UPDATE $tabella_updatelikes SET likes = likes+1 WHERE id = '" . $id . "' ";
        }

        if (mysqli_query($mysqli_updatelikes, $query_updatelikes)) {

        }

        $mysqli_updatelikes->close();
      
    }
?>