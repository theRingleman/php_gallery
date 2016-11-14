<?php

  class User{
    public function find_all_users()
    {
      global $database;
      return $result = $database->query("SELECT * FROM users");
    }
  }

?>
