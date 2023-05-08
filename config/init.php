<?php
session_start();
//To set default timezone in Philippines timezone.
date_default_timezone_set('Asia/Manila');
//To check if the current direcotry match with admin or not
$dir = dirname($_SERVER['PHP_SELF']);
$check_dir = strstr($dir, 'admin');
if($check_dir == "admin"){
    include "../helpers/helpers.php";
}else {
    include "helpers/helpers.php";
}
/*
* This will autoload classes
*/
spl_autoload_register(function($className){
    $dir = dirname($_SERVER['PHP_SELF']);
    $check_dir = strstr($dir, 'admin');
    $className = strtolower($className);
    if($check_dir == "admin"){
        if(file_exists("../classes/" . $className . ".class.php"))
        {
            include "../classes/" . $className . ".class.php";
        }
    } else{
        if(file_exists("classes/" . $className . ".class.php"))
        {
            include "classes/" . $className . ".class.php";
        }
    }
});
/*
* Defining constants for database credentials
*/
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "tourist_db");