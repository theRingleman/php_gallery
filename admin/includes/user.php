<?php

  class User{

    public static function all(){
      return self::sql_queries("SELECT * FROM users");
    }

    public static function find_by_id($id){
      return self::sql_queries("SELECT * FROM users WHERE id=$id");
    }

    private static function sql_queries($query) {
      global $database;
      return $database->query($query);
    }
  }

?>
