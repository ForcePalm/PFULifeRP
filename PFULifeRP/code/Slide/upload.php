<?php
//Upload function
function Upload($files, $hvilken_mappe_skal_filen_gemmes_i){
  if(substr($hvilken_mappe_skal_filen_gemmes_i, -1) != "/"){
          $hvilken_mappe_skal_filen_gemmes_i .= "/";
  }
  $filename = $files["name"];
  $tmp_filename = $files["tmp_name"];
  $size = $files["size"];
  $mimetype = $files["type"];
  $error = $files["error"];

  $allowed_mime_types = array(
          "image/png",
  );

  $allowed_file_size = 10;

  if($error != 0){
          return "Filen kunne ikke uploades, der er sket en fejl!";
  }
  if($allowed_file_size < ($size / 1000000)){
          return "Filen er for stor";
  }
  if(!in_array($mimetype, $allowed_mime_types)){
          return "Filtypen understøttes ikke - vælg andet format";
  }

  $new_filename = strtolower($filename);
  $new_filename = str_replace(
          array("æ","ø","å"," ",","),
          array("ae","oe","aa","-","."),
          utf8_encode($new_filename)
  );
  $new_filename = preg_replace("/[^A-Z0-9._-]/i", "_", $new_filename);

  $i = 0;
  $parts = pathinfo($new_filename);
  while (file_exists($hvilken_mappe_skal_filen_gemmes_i . $new_filename)) {
      $i++;
      $new_filename = $parts['filename'] . '-' . $i .".". $parts['extension'];
  }
  $success = move_uploaded_file($tmp_filename, $hvilken_mappe_skal_filen_gemmes_i . $new_filename);

  if($success == true){
          return array(
              "filename" => $new_filename,
              "type" => $mimetype,
              "save_folder" => $hvilken_mappe_skal_filen_gemmes_i
          );
  }
  else{
          return "Filen kunne ikke kopires";
  }
}
