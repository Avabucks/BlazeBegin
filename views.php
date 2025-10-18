<?php

$isAdmin = false;
if (isset($_COOKIE["login_user"]) && $admin_id == $_COOKIE["login_user"]) $isAdmin = true;

if (!$isAdmin) {

    $tabella = "tbl_startups";

        if (($status_bool == 0 || $status_bool == 3) && (!isset($_COOKIE["login_user"]) || $id_us != $_COOKIE["login_user"])) {
          ?>
            <script>location.href="../index"</script>
          <?php
        }

        if ($status_bool == 1 && !isset($_COOKIE["login_user"]) && $id_us != $_COOKIE["login_user"]) {
          ?>
            <script>location.href="../index"</script>
          <?php
        }

        if ($status_bool == 2 && (!isset($_COOKIE["login_user"]) || $id_us != $_COOKIE["login_user"])) {
          if (!isset($_COOKIE["viewed"]) || $_COOKIE["viewed"] != $id) {
            $tabella = "tbl_startups";

            // Connessione al db
            $mysqli_views = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
            $mysqli_views->select_db($db_name) or die( "Unable to select database");
            mysqli_set_charset($mysqli_views,"utf8");

            $views ++;

            $query_views="UPDATE $tabella SET views = '$views' WHERE id = $id";

                if (mysqli_query($mysqli_views, $query_views)) {
                  setcookie("viewed", $id);
                }

                $mysqli_views->close();

          }

        }

}
    ?>
