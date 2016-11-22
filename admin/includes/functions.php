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

  function redirect_if_not_logged_in(){
    global $session;
    if (!$session->is_signed_in()) {
      redirect('login.php');
    }
  }

  spl_autoload_register('classAutoLoader');

?>
