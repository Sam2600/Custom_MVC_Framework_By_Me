<?php

class StudentController extends Controller
{
     public function index()
     {
          // get all post
          $students = $this->model("Student")->getAllStudent();
          echo "<pre>" . print_r($students, true) . "</pre>";

          // redirect to view with values
     }

     public function show($param = [])
     {
          echo "<pre>" . print_r($param, true) . "</pre>";
     }
}
