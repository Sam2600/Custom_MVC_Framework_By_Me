<?php

/**
 * first we need to trim the route parameter to make it clean 
 * post/show/1/ into post/show/1
 */

$trimmedUrl = isset($_GET["url"]) ? rtrim($_GET["url"], "/") : '';


# $_GET["url"] is come from .htaccess file
$urlString = isset($trimmedUrl) ? $urlString = $trimmedUrl : '';


# build an array by making the string into pices based on "/"
$url = explode("/", $urlString);


/**
 * so the post/show/1 => post is like className 
 * if index zero is empty => default value is Home
 */
$className = "Home";

# first check the $url[]'s index 0 is empty or not. If empty => Home
if (!empty($url[0])) {

     # even it is not empty, we check again if that class name is actual .php file or not
     if (file_exists(ucfirst($url[0]) . ".php")) {
          $className = $url[0];
     }
}

require_once ucfirst($className) . ".php";
$className = new $className();


/**
 * so the post/show/1 => show is like method name of post class 
 * if index one is empty => default method name is index
 */
$methodName = "index";

# first check the $url[]'s index one is empty or not. If empty => index
if (!empty($url[1])) {

     # even it is not empty, we check again if the method exists in $className or not
     if (method_exists($className, $url[1])) {
          $methodName = $url[1];
     }
}

$params = [];

# now test our with method
call_user_func([$className, $methodName], $params);
