<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$SteamID64 = $_POST['SteamID64'];
$Role = $_POST['Role'];


$sqlArray = array(
  'AppliStatus' => 3,
);

$identifyArray = array(
  'ID' => $ID,
);

$roleupdate = $crud->Update('Applications', $sqlArray, $identifyArray);

if($roleupdate > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
