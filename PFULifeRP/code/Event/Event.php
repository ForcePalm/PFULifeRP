<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$Name = $_POST['Name'];
$Desc = $_POST['Desc'];
$Start = $_POST['Start'];
$End = $_POST['End'];



$sqlArray = array(
  'EventName' => $Name,
  'EventsDesc' => $Desc,
  'EventsDateStart' => $Start,
  'EventsDateEnd' => $End,
);

$events = $crud->Save('Events', $sqlArray);

if($events > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
