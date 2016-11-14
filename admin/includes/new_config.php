<?php

  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'root');
  define('DB_NAME', 'gallery_db');

  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if ($connection) {
    echo "true";
  }
?>
