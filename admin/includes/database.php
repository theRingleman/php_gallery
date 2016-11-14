<?php
  require_once("new_config.php");

  class Database {
    public  $connection;

    function __construct(){
      $this->open_db_connection();
    }

    public function open_db_connection(){
      $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      if (mysqli_connect_errno()) {
        die("Database connection failed badly" . mysqli_error());
      }
    }

    public function query($sql)
    {
      $result = mysqli_query($this->connection, $sql);
      return $result;
    }

    private function confirm_query($result){
      if (!$result) {
        die("Query failed");
      }
    }

    public function escape_string($string){
      mysqli_real_escape_string($this->connection, $string);
    }
  }

  $database = new Database();

 ?>
