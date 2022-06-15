<?php
   require ('steamauth/steamauth.php');
	# You would uncomment the line beneath to make it refresh the data every time the page is loaded
	 unset($_SESSION['steam_uptodate']);

   require ('steamauth/userInfo.php');

   require_once "code/pagetitle.php";

   #database stuff
   require_once "DB/dbConfig.php";
   $crud = new Crud($db);

   if(isset($_SESSION['steamid'])) {

     //Checks if steamid exist
  $row = $crud->Select('Profiles', 'SteamID64', $_SESSION['steamid']);

  if($row > 0){

    $role = $crud->Select('Profiles', 'SteamID64', $steamprofile['steamid']);
    $_SESSION['Role'] = $role->Roles_ID;
	  $sqlArray = array(
      'Displayname' => $steamprofile['personaname'],
      'SteamAvatarSmall' => $steamprofile['avatar'],
      'SteamAvatarMedium' => $steamprofile['avatarmedium'],
      'SteamAvatarFull' => $steamprofile['avatarfull'],
     );

	 $identifyArray = array(
		'SteamID64' => $_SESSION['steamid']
     );

	$profileUpdate = $crud->Update('Profiles', $sqlArray, $identifyArray);

  }else{

    $sqlArray = array(
      'SteamID64' => $steamprofile['steamid'],
      'Displayname' => $steamprofile['personaname'],
      'SteamAvatarSmall' => $steamprofile['avatar'],
      'SteamAvatarMedium' => $steamprofile['avatarmedium'],
      'SteamAvatarFull' => $steamprofile['avatarfull'],
    );
    //Create
    $profile = $crud->Save('Profiles', $sqlArray);

    $role = $crud->Select('Profiles', 'SteamID64', $steamprofile['steamid']);

    $_SESSION['Role'] = $role->Roles_ID;
    }
  }

  $maintenance = $crud->select('Maintenance', 'ID', '1');
  if($maintenance->Maintenancemode == 1 && $_SESSION['Role'] != 2){
    header("Location: ../Maintenance.php");
  }
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $site = basename(parse_url($url, PHP_URL_PATH));
?>
<!--Index Page-->
<!doctype html>
<html lang="en">
<head>
    <title>PFULifeRP | <?php echo ucfirst($title); ?></title>
    <meta name="description" content="Author: ForcePalm, PFULifeRP Roleplay community hjemmeside.">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="gfx/favicon.png" rel="icon" type="image/png">
    <link href="css/core.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" preload>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" preload>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet" preload>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js" defer></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-dark">
  <!--Nav bar-->
  <nav class="navbar navbar-expand-sm fixed-top dark navbar-dark nav-bot-border">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand pfu-logo-text" href="/"><img src="gfx/logo.avif" height="40" width="40" class="d-inline-block align-top" alt=""/>
      <?php
      if($site == "Administration" || $site == "Settings"){
       ?>
      <b>PFULifeRP Administration</b>
      <?php
    }else{
      ?>
      <b>PFULifeRP</b>
      <?php
    }
      ?>
    </a>
    <!--navbar administration-->
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <?php
     if($site == "Administration" || $site == "Settings"){
    ?>
       <li class="nav-item">
         <a class="nav-link" href="Administration">Dashboard</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="Settings">Instillinger</a>
       </li>
      <?php
    }else{
       ?>

       <li class="nav-item">
         <a class="nav-link" href="Forum" style="display: none">Forum</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="Manual">Manual</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="Staff">Staff</a>
       </li>
      <?php
       }
      ?>
    </ul>
    <ul class="navbar-nav">
      <?php
      if(!isset($_SESSION['steamid'])) {
          loginbutton(); //login button
      }  else {
      ?>
      <!--Steam login-->
      <div class="dropdown">
          <a class=" nav-link nav-link-right dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"><?=$steamprofile['personaname']?> <img class="nav-avatar" src='<?=$steamprofile['avatarmedium']?>' alt="Avatar" ></a>

        <div class="dropdown-menu drop-bg" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item drop-txt" href="Profile"><i class="fas fa-user"></i> Profile</a>
          <?php
              if($_SESSION['Role'] == 2){
           ?>
          <a class="dropdown-item drop-txt" href="Administration"><i class="fas fa-tachometer-alt"></i> Administration</a>
          <?php
        }
          logoutbutton();
           ?>
        </div>
      </div>
      <?php
      }
      ?>
    </ul>
  </div>
</nav>
<!--Index content-->
<main class="main-content">
  <?php
    //Pager
    require_once 'code/pager.php';
  ?>
</main>
<br/>
<!--Footer-->
<footer class="mt-auto footer">
  <p class="footer-text" align="center">
    For spørgsmål eller andet kan vi kontaktes via discord.
  </p>
</footer>
<script src="js/active.js"></script>
<script src="js/lazysizes.min.js" async></script>
</body>
</html>
