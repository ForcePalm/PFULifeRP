<?php
session_start();
$topicid = $_POST['id'];

$_SESSION['topicid'] = $topicid;


if($_SESSION['topicid'] == $topicid){
  echo "1";
}else{
  echo "0";
}
