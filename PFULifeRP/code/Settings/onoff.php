<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

  $on = $_POST["on"];
  $off = $_POST["off"];

  $sqlArray = array(
    'InUse' => $on,
  );

  $identifyArray = array(
    'ID' => 1,
  );

  $row = $crud->Update('AllowlistStatus', $sqlArray, $identifyArray);

  $sqlArrays = array(
    'InUse' => $off,
  );

  $identifyArrays = array(
    'ID' => 2,
  );

  $rows = $crud->Update('AllowlistStatus', $sqlArrays, $identifyArrays);

  if($row > 0 && $rows > 0){
    if($on == 1){
     echo 2;
    }else{
     echo 1;
    }
  }else{
    echo 0;
  }
