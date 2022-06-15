<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

  $on = $_POST["on"];
  $off = $_POST["off"];

  $sqlArray = array(
    'Maintenancemode' => $on,
  );

  $identifyArray = array(
    'ID' => 1,
  );

  $row = $crud->Update('Maintenance', $sqlArray, $identifyArray);

  $sqlArrays = array(
    'Maintenancemode' => $off,
  );

  $identifyArrays = array(
    'ID' => 0,
  );

  $rows = $crud->Update('Maintenance', $sqlArrays, $identifyArrays);

  if($row > 0 && $rows > 0){
    if($on == 1){
     echo 2;
    }else{
     echo 1;
    }
  }else{
    echo 0;
  }
