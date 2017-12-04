<?php

session_start();

require_once "config.php";

spl_autoload_register("auto_load");

function auto_load($class_name){
    require_once "class/". $class_name . ".php";
}