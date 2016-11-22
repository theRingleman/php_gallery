<?php
  class Db_object{
    static protected $db_table = "";

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

    public function create(){
      global $database;
      $properties = $this->clean_properties();
      $sql = "INSERT INTO " . static::$db_table . " (" . implode(", ", array_keys($properties)) . ")";
      $sql .= "VALUES ('" . implode("', '", array_values($properties)) . "')";
      if ($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
      }else {
        return false;
      };
    }

    public function update(){
      global $database;

      foreach ($this->clean_properties() as $key => $value) {
        $property_pairs[] = "{$key}='{$value}'";
      }

      $sql = "UPDATE " . static::$db_table . " SET ";
      $sql .= implode(", ", $property_pairs);
      $sql .= " WHERE id= '" . $database->escape_string($this->id) . "'";

      $database->query($sql);
      return $database->connection->affected_rows == 1 ? true : false;
    }

    public function delete(){
      global $database;
      global $session;
      $session->logout();
      $sql = "DELETE FROM " . static::$db_table . " WHERE id=" . $database->escape_string($this->id);
      $database->query($sql);
      return $database->connection->affected_rows == 1 ? true : false;
    }

    protected function clean_properties(){
      global $database;

      foreach($this->properties() as $key => $value){
        $clean_properties[$key] = $database->escape_string($value);
      }

      return $clean_properties;
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

  $db_object = new Db_object;
?>
