<?php

  class User{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function instantiate($new_user){
      $user = new self;
      foreach ($new_user as $attribute => $value) {
        if (property_exists($user, $attribute)) {
          $user->$attribute = $value;
        }
      }
      return $user;
    }

    public static function all(){
      return self::sql_queries("SELECT * FROM users");
    }

    public static function find_by_id($id){
      $user = self::sql_queries("SELECT * FROM users WHERE id=$id");
      return !empty($user) ? array_shift($user) : false;
    }

    private static function sql_queries($query) {
      global $database;
      $results = $database->query($query);
      $users = [];
      while ($row = mysqli_fetch_array($results)) {
        $users[] = self::instantiate($row);
      }
      return $users;
    }

  }

?>
