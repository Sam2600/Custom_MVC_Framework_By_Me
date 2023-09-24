<?php

class Core
{

     /**
      * so the post/show/1 => post is like className 
      * if index zero is empty => default value is Home
      */
     private $className = "Home";

     /**
      * so the post/show/1 => show is like method name of post class 
      * if index one is empty => default method name is index
      */
     private $methodName = "index";

     private $params = [];

     public function __construct()
     {
          $this->getUrl();
     }

     public function getUrl()
     {
          /**
           * first we need to trim the route parameter to make it clean 
           * post/show/1/ => post/show/1
           */

          # $_GET["url"] is come from .htaccess file
          $urlString = isset($_GET["url"]) ? rtrim($_GET["url"], "/") : '';


          # build an array by making the string into pices based on "/"
          $url = explode("/", $urlString);


          /**
           *  for the file name and class name
           *  first check the $url[]'s index 0 is empty or not. If empty => Home
           */

          if (!empty($url[0])) {

               # even it is not empty, we check again if that class name is actual .php file or not
               if (file_exists("../app/controller/" . ucfirst($url[0]) . ".php")) {
                    $this->className = $url[0];
                    # why unset ? First, the url array is like this => [0 => "Post",1 => "show",2 => 1].
                    # we don't need that file name index anymore so we remove it
                    unset($url[0]);

                    # $url = [1 => "show", 2 => 1]
               }
          }

          require_once "../app/controller/" . ucfirst($this->className) . ".php";
          $this->className = new $this->className();

          /**
           * for the method name
           * first check the $url[]'s index one is empty or not. If empty => index
           */

          if (!empty($url[1])) {

               # even it is not empty, we check again if the method exists in $className or not
               if (method_exists($this->className, $url[1])) {
                    $this->methodName = $url[1];
                    # same as class name and we remove it 
                    unset($url[1]);

                    # $url = [2 => 1]
               }
          }

          /**
           * finally only parameters remain in url array
           * $url = [2 => 1]  -> but url array is starting with index 2 and it doesn't look good and hard to manipulate right?
           * so we make brand new array with array_values function
           */

          $this->params = !empty($url) ? array_values($url) : [];

          # now test our with method
          call_user_func([$this->className, $this->methodName], $this->params);
     }
}
