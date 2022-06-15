<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$ID= $_POST['Id'];

$ApplicationDelete = $crud->Delete('Applications', 'ID', $ID);

if($ApplicationDelete > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
