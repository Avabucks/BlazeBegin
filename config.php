<?php

    if($_SERVER['HTTP_HOST'] == 'localhost') {

      $username_db = "root";
      $password_db= "";
      $db_name = "blazebegin";
      $host = "localhost";
      $folder = "/BlazeBegin/source_code";

    } else {

      $username_db = "h1015089_user";
      $password_db= "Avery123!ALE04";
      $db_name = "h1015089_blazebegin";
      $host = "localhost";
      $folder = "";

    }

    $admin_id = "34811d5b037c3be94b8c86253b36806d";

    // remove boost
    $tabella_boost = 'tbl_startups';
    $mysqli_boost = new mysqli($host, $username_db, $password_db, $db_name) or die( "Unable to connect");
    $mysqli_boost->select_db($db_name) or die( "Unable to select database");
      mysqli_set_charset($mysqli_boost,"utf8");

        $query_boost="UPDATE $tabella_boost SET boost_start = '1970-01-01 00:00:00', boost_end = '1970-01-01 00:00:00' WHERE boost_end < NOW() ";

      if (mysqli_query($mysqli_boost, $query_boost)) {

      }

      $mysqli_boost->close();
    // end remove boost

?>
