<?php

  function classAutoLoader($class){
    $class = strtolower($class);
    $path = "includes/{$class}.php";

    if (is_file($the_path) && !class_exists($class)) {
      include $the_path;
    } else {
      die("{$class}.php was not found");
    }
  }

  function redirect($location){
    header("Location: {$location}");
  }

  spl_autoload_register('classAutoLoader');

?>
