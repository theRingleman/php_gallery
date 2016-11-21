<?php

  class User{

    static protected $db_table = "users";
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

    public function save() {
      return isset($this->id) ? $this->update() : $this->create();
    }

    public static function all(){
      return self::return_users_with_sql_query("SELECT * FROM " . self::$db_table);
    }

    public static function find_by_id($id){
      return self::return_users_with_sql_query("SELECT * FROM " . self::$db_table . " WHERE `id` = '$id'");
    }

    public static function find_user_by_session(){
      $id = $_SESSION['user_id'];
      return self::return_users_with_sql_query("SELECT * FROM " . self::$db_table . " WHERE `id` = '$id'");
    }

    private static function return_users_with_sql_query($query) {
      global $database;
      $results = $database->query($query);
      $users = [];
      while ($row = $results->fetch_array()) {
        array_push($users, self::instantiate($row));
      }
      return count($users) == 1 ? array_shift($users) : $users;
    }

    public static function verify_user($username, $password){
      global $database;
      $username = $database->escape_string($username);
      $password = $database->escape_string($password);
      $sql = "SELECT * FROM " . self::$db_table . " WHERE `username` = '$username' AND `password` = '$password'";
      return self::return_users_with_sql_query($sql);
    }

    public function get_full_name(){
      return $this->first_name . " " . $this->last_name;
    }

    public function create(){
      global $database;

      $sql = "INSERT INTO " . self::$db_table . " (username, password, first_name, last_name)";
      $sql .= "VALUES ('";
      $sql .= $database->escape_string($this->username) . "', '";
      $sql .= $database->escape_string($this->password) . "', '";
      $sql .= $database->escape_string($this->first_name) . "', '";
      $sql .= $database->escape_string($this->last_name) . "')";

      if ($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
      }else {
        return false;
      };
    }

    public function update(){
      global $database;
      $sql = "UPDATE " . self::$db_table . " SET ";
      $sql .= "username= '" . $database->escape_string($this->username) . "', ";
      $sql .= "password= '" . $database->escape_string($this->password) . "', ";
      $sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
      $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";
      $sql .= "WHERE id= '" . $database->escape_string($this->id) . "'";

      $database->query($sql);
      return $database->connection->affected_rows == 1 ? true : false;
    }

    public function delete(){
      global $database;
      global $session;
      $session->logout();
      $sql = "DELETE FROM " . self::$db_table . " WHERE id=" . $database->escape_string($this->id);
      $database->query($sql);
      return $database->connection->affected_rows == 1 ? true : false;
    }

  }

?>
