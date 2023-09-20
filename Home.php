<?php

class Home
{
     public function __construct()
     {
          echo "I am the constructor of " . __CLASS__ . " class. <br/>";
     }

     public function __toString()
     {
          return "HEY I am object and you treat me like a string";
     }

     public function index()
     {
          echo "I am INDEX method of " . __CLASS__ . " class";
     }
}
