<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$ID = $_POST['id'];
$Status = $_POST['status'];

$sqlArray = array(
  'AppliStatus_ID' => $Status,
);

$identifyArray = array(
  'ID' => $ID,
);

$statusupdate = $crud->Update('Applications', $sqlArray, $identifyArray);

if($statusupdate > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
