<?php
//Enter frotpage name
$frontpage = 'Home';

//If $_GET['page'] isset
if(isset($_GET['page'])){

  //Set page path to file
  $page = 'pages/'.$_GET['page'].'.php';

  //Checks if file exists
  if(file_exists($page)){

    //Requires the page
    require_once $page;
  }else{

    //Requires the frontpage
    require_once 'pages/'.$frontpage.'.php';
  }
}else{

  //Requires the frontpage
  require_once 'pages/'.$frontpage.'.php';
}
