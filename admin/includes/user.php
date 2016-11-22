<?php

  class User extends Db_object{

    static protected $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    protected function properties(){
      $properties = [];
      foreach (self::$db_table_fields as $db_field) {
        if (property_exists($this, $db_field)) {
          $properties[$db_field] = $this->$db_field;
        }
      }
      return $properties;
    }

    public static function find_user_by_session(){
      $id = $_SESSION['user_id'];
      return static::return_object_with_sql_query("SELECT * FROM " . static::$db_table . " WHERE `id` = '$id'");
    }

    public static function verify_user($username, $password){
      global $database;
      $username = $database->escape_string($username);
      $password = $database->escape_string($password);
      $sql = "SELECT * FROM " . static::$db_table . " WHERE `username` = '$username' AND `password` = '$password'";
      return static::return_object_with_sql_query($sql);
    }

    public function get_full_name(){
      return $this->first_name . " " . $this->last_name;
    }

  }

?>
