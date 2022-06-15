<?php
session_start();
$catid = $_POST['id'];

$_SESSION['catid'] = $catid;


if($_SESSION['catid'] == $catid){
  echo "1";
}else{
  echo "0";
}
