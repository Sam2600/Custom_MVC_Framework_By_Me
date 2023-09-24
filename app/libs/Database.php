<?php

class Database
{
     private $host = DB_HOST;
     private $dbname = DB_NAME;
     private $dbuser = DB_USER;
     private $dbpass = DB_PASS;

     private $pdo;
     private $stmt;

     public function __construct()
     {
          $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
          $options = [
               PDO::ATTR_PERSISTENT => true,
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
          ];

          try {
               $this->pdo =  new PDO($dsn, $this->dbuser, $this->dbpass, $options);
          } catch (PDOException $e) {
               exit($e->getMessage());
          }
     }

     public function query($query)
     {
          $this->stmt = $this->pdo->prepare($query);
     }

     public function bind($param, $value, $type = "")
     {
          if (empty($type)) {
               switch ($value) {
                    case is_int($value):
                         $type = PDO::PARAM_INT;
                         break;
                    case is_bool($value):
                         $type = PDO::PARAM_BOOL;
                         break;
                    case is_null($value):
                         $type = PDO::PARAM_NULL;
                         break;
                    default:
                         $type = PDO::PARAM_STR;
               }
          }

          $this->stmt->bindValue($param, $value, $type);
     }

     public function execute()
     {
          return $this->stmt->execute();
     }

     public function multipleSet()
     {
          $this->stmt->execute();
          return $this->stmt->fetchAll(PDO::FETCH_OBJ);
     }

     public function singleSet()
     {
          $this->stmt->execute();
          return $this->stmt->fetch(PDO::FETCH_OBJ);
     }

     public function rowCount()
     {
          return $this->stmt->rowCount();
     }

     public function lastInsertId()
     {
          return $this->stmt->lastInsertId();
     }
}
