<?php

namespace Ellephanty\Database;

use PDO;

class Database
{
  private $dsn;
  private $host;
  private $dbName;
  private $userName;
  private $password;
  private $connection;

  public function __construct()
  {
    $this->dsn = getenv('DB_DSN');
    $this->host = getenv('DB_HOST');
    $this->dbName = getenv('DB_NAME');
    $this->userName = getenv('DB_USER');
    $this->password = getenv('DB_PASS');
  }

  public function connect()
  {
    $this->connection = null;
    $this->connection = new PDO($this->dsn . ':host=' . $this->host . ';dbname=' . $this->dbName . ';charset=utf8', $this->userName, $this->password);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $this->connection;
  }

  public function close()
  {
    $this->connection = null;
  }

  public function connection()
  {
    return $this->connection;
  }
}
