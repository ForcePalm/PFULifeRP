<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$ID = $_POST['id'];
$AppliType_ID = $_POST['AppliType_ID'];
$Profiles_SteamID64 = $_POST['Profiles_SteamID64'];
$Discord_name = $_POST['Discord_name'];
$Main_char_name = $_POST['Main_char_name'];
$Gang_name = $_POST['Gang_name'];
$Gang_Desc = $_POST['Gang_Desc'];
$AppliStatus_ID = $_POST['AppliStatus_ID'];


$sqlArray = array(
  'AppliType_ID' => $AppliType_ID,
  'Profiles_SteamID64' => $Profiles_SteamID64,
  'Discord_name' => $Discord_name,
  'Main_char_name' => $Main_char_name,
  'Gang_name' => $Gang_name,
  'Gang_Desc' => $Gang_Desc,
  'AppliStatus_ID' => $AppliStatus_ID,
);

$identifyArray = array(
  'ID' => $ID,
);

$apply = $crud->Save('Applications', $sqlArray);

if($apply > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
