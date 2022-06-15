<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$ID = $_POST['id'];
$Discord_name = $_POST['Discord_name'];
$Main_char_name = $_POST['Main_char_name'];
$Main_char_age = $_POST['Main_char_age'];
$Main_char_desc = $_POST['Main_char_desc'];
$AppliStatus_ID = $_POST['AppliStatus_ID'];

$charbirth = new DateTime($Main_char_age);
$today     = new DateTime();
$interval  = $today->diff($charbirth);
$charage = $interval->format('%y');

$sqlArray = array(
  'Discord_name' => $Discord_name,
  'Main_char_name' => $Main_char_name,
  'Main_char_birth' => $Main_char_age,
  'Main_char_age' => $charage,
  'Main_char_desc' => $Main_char_desc,
  'AppliStatus_ID' => $AppliStatus_ID,
);

$identifyArray = array(
  'ID' => $ID,
);

$apply = $crud->Update('Applications', $sqlArray, $identifyArray);

if($apply > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
