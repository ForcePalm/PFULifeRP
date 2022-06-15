<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$site = basename(parse_url($url, PHP_URL_PATH));

if($site == "Administration" || $site == "Settings"){
  if($_SESSION['Role'] != 2){
    header("Location: /");
  }
}else{
  if(!isset($_SESSION['steamid'])) {
    header("Location: /");
  }
}
