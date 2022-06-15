<?php

//Database configuration
$dbHost     = "localhost:3306";
$dbUsername = "force";
$dbPassword = "2K2oqu8$";
$dbName     = "pfuliferp";

//lav database forbindelse
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//tjek forbindelse

/*
if($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}else{
  echo "connecton";
}
*/


define('APPLICATION_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

function Autoloader($classname)
{
    require_once APPLICATION_ROOT . '/classes/'.$classname.'.php';
}
spl_autoload_register('Autoloader');

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

?>
