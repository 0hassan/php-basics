<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "workshopDB";

class Connection
{
  public $conn;
  public function __construct($serverName, $username, $password, $dbname)
  {
    $this->conn = new mysqli($serverName, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function __destruct()
  {
    $this->conn->close();
  }
}

$connection = new Connection($serverName, $username, $password, $dbname);
