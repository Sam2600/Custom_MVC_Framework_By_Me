<?php

class Student
{
     private $db;

     public function __construct()
     {
          $this->db = new Database();
     }

     public function getAllStudent()
     {
          $query = "SELECT * FROM students";

          $this->db->query($query);

          return $this->db->multipleSet();
     }
}
