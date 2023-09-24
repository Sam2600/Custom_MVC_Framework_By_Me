<?php

class Controller
{
     public function view($view)
     {
          if (file_exists("../app/view/" . $view . ".php")) {
               require_once "../app/view/" . $view . ".php";
          }
     }

     public function model($model)
     {
          if (file_exists("../app/model/" . $model . ".php")) {
               require_once "../app/model/" . $model . ".php";
               return new $model(); 
          }
     }
}
