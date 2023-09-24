<?php

class Home extends Controller
{

     public function index()
     {
         $this->view("home/index");
     }

     public function show($param = [])
     {
          echo "<pre>" . print_r($param, true) . "</pre>";
     }
}
