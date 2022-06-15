<?php
  //Set frontpage name
  $frontpage = "Home";
  //If isset $_GET['page,']
  if(isset($_GET['page'])){
    //Path to file
    $page = 'pages/'.$_GET['page'].'.php';
    //Checks if file exists
    if(file_exists($page)){
      //Titel of page
      if($_GET['page'] == "Forum_Topic" || $_GET['page'] == "Forum_view"){
        $title = "Forum";
      }else{
        $title = $_GET['page'];
      }
    }else{
      $title = $frontpage;
    }
  }else {
    //Titel of frontpage
    $title = $frontpage;
  }
