<?php

include '../config.php';

if ($admin_id == $_COOKIE["login_user"]) {

  $tabella = 'tbl_startups';
  
  $arr_images = [];

    $mysqli = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
    $mysqli->select_db($db_name) or die("Unable to select database");
    mysqli_set_charset($mysqli, "utf8");
    $query = "SELECT images_path FROM $tabella ";
    if ($result = $mysqli->query($query)) {
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {

          $images_path = $row["images_path"];

          $i = 0;
          $images_split = explode(";", $images_path);
          foreach($images_split as $image_src) {
              $image_src = trim($image_src);
              if ($image_src != '') {
                $i++;
                array_push($arr_images, $image_src);
              }
            }
      }
    }


      /* free result set */
      $result->free();
      $mysqli->close();

    $path = "../uploads/";

    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;

            if (!in_array($file, $arr_images)) {
                unlink($path . $file);
            }

            $source_img = $path . $file;
            $destination_img = $path . $file;

            //$d = compress($source_img, $destination_img, 90);

        }
        closedir($handle);
    }
}

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

?>
<script>
    location.href="../index";
</script>