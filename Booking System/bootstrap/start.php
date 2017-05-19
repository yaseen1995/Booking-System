<?php

/* a method that retrieves or gain acces to the autoload file. This file finds the direcotry that contains the code below. */
require(__DIR__ . "/../vendor/autoload.php");

session_start();

 /* the below is oo code that allows me to detect any errors in my code to fix */
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new AltoRouter();
