<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

//Checks if file upload or text update
  if($_FILES['image']['size'] != 0){

    //Upload script
    require_once "../upload.php";

    $files = $_FILES['image'];

    //Uploads file
    $retur_array = Upload($files, '../../gfx/slideshow/');
    $fileName = $retur_array['filename'];

    $sqlArray = array(
      'IMG' => $fileName,
    );

    $slide = $crud->Save('Slideshow', $sqlArray);

    header("Location: /Administration");
  }
