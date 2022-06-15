<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$SteamID64= $_POST['SteamID64'];
$Staff_Desc = $_POST['Staff_Desc'];


$sqlArray = array(
  'Staff_Desc' => $Staff_Desc,
);

$identifyArray = array(
  'Profiles_SteamID64' => $SteamID64,
);

$staffupdate = $crud->Update('Staffs', $sqlArray, $identifyArray);

if($staffupdate > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
