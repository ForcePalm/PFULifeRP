<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$Profiles_SteamID64 = $_POST['Profiles_SteamID64'];
$NewsTitle = $_POST['Title'];
$NewsText = $_POST['Text'];



$sqlArray = array(
  'Profiles_SteamID64' => $Profiles_SteamID64,
  'NewsTitle' => $NewsTitle,
  'NewsText' => $NewsText,
);

$changelog = $crud->Save('News', $sqlArray);

if($changelog > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
