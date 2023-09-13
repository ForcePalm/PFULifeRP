<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$SteamID64= $_POST['SteamID64'];
$Role = $_POST['Role'];


$sqlArray = array(
  'Roles_ID' => $Role,
);

$identifyArray = array(
  'SteamID64' => $SteamID64,
);

$roleUpdate = $crud->Update('Profiles', $sqlArray, $identifyArray);

if($roleUpdate > 0){
  if($Role == 2){
    $staffArray = array(
      'Profiles_SteamID64' => $SteamID64,
    );

    $staff = $crud->Save('Staffs', $staffArray);
    //Success
      echo 1;
  }else{
    $staff = $crud->Delete('Staffs', 'Profiles_SteamID64', $SteamID64);
    //Success
      echo 1;
  }
}else{
//Failed
  echo 0;
}
