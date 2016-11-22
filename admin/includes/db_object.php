<?php
  class DB_Object{
    static protected $db_table = "";
    static protected $db_table_fields = [];

    public static function instantiate($new_object){
      $calling_class = get_called_class();
      $object = new $calling_class;
      foreach ($new_object as $attribute => $value) {
        if (property_exists($object, $attribute)) {
          $object->$attribute = $value;
        }
      }
      return $object;
    }

    public function properties(){
      global $database;
      $properties = [];
      foreach (static::$db_table_fields as $db_field) {
        if (property_exists($this, $db_field)) {
          $properties[$db_field] = $database->escape_string($this->$db_field);
        }
      }
      return $properties;
    }

    public function create(){
      global $database;
      $properties = $this->properties();
      $sql = "INSERT INTO " . static::$db_table . " (" . implode(", ", array_keys($properties)) . ")";
      $sql .= "VALUES ('" . implode("', '", array_values($properties)) . "')";
      if ($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
      }else {
        return false;
      };
    }

    public function update() {
      global $database;
      $properties = $this->properties();
      $properties_to_sql = [];

      foreach ($properties as $key => $value) {
        $properties_to_sql[] = "{$key} = '{$value}'";
      }

      $sql = "UPDATE " . static::$db_table . " SET ";
      $sql .= implode($properties_to_sql, ', ') . " ";
      $sql .= "WHERE id= '" . $database->escape_string($this->id) . "'";

      $database->query($sql);
      return ($database->connection->affected_rows == 1) ? true : false;
  }

    public function delete(){
      global $database;
      global $session;
      $session->logout();
      $sql = "DELETE FROM " . static::$db_table . " WHERE id=" . $database->escape_string($this->id);
      $database->query($sql);
      return $database->connection->affected_rows == 1 ? true : false;
    }

    public static function return_object_with_sql_query($query) {
      global $database;
      $results = $database->query($query);
      $objects = [];
      while ($row = $results->fetch_array()) {
        array_push($objects, static::instantiate($row));
      }
      return count($objects) == 1 ? array_shift($objects) : $objects;
    }

    public function save() {
      return isset($this->id) ? $this->update() : $this->create();
    }

    public static function all(){
      return static::return_object_with_sql_query("SELECT * FROM " . static::$db_table);
    }

    public static function find_by_id($id){
      return static::return_object_with_sql_query("SELECT * FROM " . static::$db_table . " WHERE `id` = '$id'");
    }
  }

  $db_object = new DB_Object;
?>
