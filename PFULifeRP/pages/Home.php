<?php
/*-----------------------[ SETTINGS ]------------------------------*/
$server_settings['title'] = "PFU LifeRP"; // Server name or brand to display
$server_settings['ip'] = "144.91.122.78"; // localhost for local servers / IP or domain name for VDS/VPS
$server_settings['port'] = "30120"; // basically 30120
$server_settings['max_slots'] = 48; // maximum slots. By default 24
/*----------------------------------------------------------------*/
 ?>
<!--Home page-->
<div class="container-fluid content break-text">
  <div class="row">
    <div class="col-sm-9">
      <?php
      $slide = $crud->ReadAll('Slideshow');
      ?>
      <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
        <ol id="indicators" class="carousel-indicators">
          <?php
          while($row = $slide->fetch_object()){
           ?>
          <li data-target="#carouselIndicators" data-slide-to="<?php echo $row->ID; ?>"></li>
          <?php
          }
           ?>
        </ol>
        <div id="pictures" class="carousel-inner rounded">
          <?php
          $slideshow = $crud->ReadAll('Slideshow');
          while($rows = $slideshow->fetch_object()){
           ?>
          <div class="carousel-item">
            <img class="d-block slide" height="516" width="964" src="gfx/slideshow/<?php echo $rows->IMG; ?>" alt="<?php echo $rows->IMG; ?>">
          </div>
          <?php
          }
           ?>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <hr class="spacer"/>
      <div class="row">
        <div class="col-sm-12">
          <div class="main-div rounded">
            <h3 class="pfu-logo-text" align="center"><b>Nyheder</b></h3>
            <div class="row">
              <div class="col-sm-12">
                <div class="main-div">
                  <?php
                  $news = $crud->ReadallOrderBy('NewsView', 'ID', 'DESC');
                  while($row = $news->fetch_object()){
                  ?>
                  <div class="row justify-content-md-center">
                    <div class="col-sm-10">
                  <h4 align="center"><?php echo $row->NewsTitle; ?></h4>
                    </div>
                  </div>
                  <div class="row justify-content-md-center">
                    <div class="col-sm-10">
                  <?php echo $row->NewsText; ?>
                    </div>
                  </div>
                  <div class="row justify-content-md-center">
                    <div class="col-sm-10">
                      <p class="news-author"><img class="nav-avatar" height="40px" width="40px" src="<?php echo $row->SteamAvatarMedium; ?>" alt="profil picture"/> <i><?php echo $row->Displayname; ?></i></p>
                    </div>
                  </div>
                  <div class="row justify-content-md-center">
                    <div class="col-sm-10">
                      <hr class="spacer"/>
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          <iframe src="https://discord.com/widget?id=903541251406716928&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
            <?php
            print "<div class='sidebar-div rounded'>";
            $content = json_decode(file_get_contents("http://".$server_settings['ip'].":".$server_settings['port']."/info.json"), true);
            $img_d64 = $content['icon'];
            if($content):
                $gta5_players = file_get_contents("http://".$server_settings['ip'].":".$server_settings['port']."/players.json");
            	$content = json_decode($gta5_players, true);
            	$pl_count = count($content);
            	$SRV_STATUS = "<font style='color: green;'>Online</font>";
            	if($img_d64) { print "<div align='center'><img  width='150' src='data:image/png;base64, $img_d64' ></div>"; }
            	print "<p align='center'><strong>$server_settings[title]</strong></p>";
            	print "<p align='center'><strong>Players:</strong> $pl_count / $server_settings[max_slots]</p>";
            else:
            	print "<p align='center' style='color:#000000; background-color: #ffffff;'><strong>$server_settings[title]</strong></p>";
            	$SRV_STATUS = "<font style='color: red;'>Offline</font>";
            endif;
            print "<hr/><p align='center'><strong>Status: $SRV_STATUS</strong></p></div>";
            ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="sidebar-div rounded">
            <h3 class="pfu-logo-text"><b>Ansøgning</b></h3>
            <?php
            if(isset($_SESSION['steamid'])) {
              $status = $crud->Select('AllowlistStatus', 'InUse', 1);
              if($status->ID == 1){
            ?>
            <p>
              Allowlist Status: <span class="text-success status"><?php echo $status->Status; ?></span>
            </p>
			  <p class="text-warning">
              Note: Du kan nu ansøge om lukket beta allowlist.<br>
			        <br>
		          Der er begrænset antal,<br>
              lukket beta allowlist pladser.
			        <br>
		          <i>Mængden af pladser <strong>stiger</strong> som Betaen skrider frem.</i>
            </p>
            <a href="Apply"><button class="btn btn-success p-3 mb-2"><b>Ansøg her</b></button></a>
            <?php
          }else{
            ?>
            <p>
              Allowlist Status: <span class="text-danger status"><?php echo $status->Status; ?></span>
            </p>
            <p class="text-warning">
              Note: Du kan stadig ansøge.<br>
              Din ansøgning bliver bare ikke taget,<br>
              i betragtning før,<br>
              vi åbner for allowlist igen!
            </p>
            <a href="Apply"><button class="btn btn-success p-3 mb-2"><b>Ansøg her</b></button></a>
            <?php
              }
            }else{
            ?>
            <p class="text-warning"><i class="fa-solid fa-triangle-exclamation fa-xl"></i> Note: Du skal Login,<br>for at kunne ansøge om Allowlist!</p>
            <button class=" btn btn-danger p-3 mb-2" disabled><b>Ansøg her</b></button>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <?php
      $evcount = $crud->SelectCount('Events');
      if($evcount->Amount != '0'){
      ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="sidebar-div dark rounded">
            <h3 class="pfu-logo-text"><b>Events</b></h3>
            <?php
            $event = $crud->SelectAllOrderByLimit('Events', 'ID');
            while($row = $event->fetch_object()){
            $startdate = date_create($row->EventsDateStart);
            $enddate = date_create($row->EventsDateEnd);
            if(date_format($startdate,"D") == "Mon"){
              $day = "Man";
            }else if(date_format($startdate,"D") == "Tue"){
              $day = "Tirs";
            }
            else if(date_format($startdate,"D") == "Wed"){
              $day = "Ons";
            }
            else if(date_format($startdate,"D") == "Thu"){
              $day = "Tors";
            }
            else if(date_format($startdate,"D") == "Fri"){
              $day = "Fre";
            }
            else if(date_format($startdate,"D") == "Sat"){
              $day = "Lør";
            }
            else if(date_format($startdate,"D") == "Sun"){
              $day = "Søn";
            }
             ?>
            <div class="row row-striped">
              <div class="col-sm-3">
                <p class="h1"><span class="badge badge-secondary text-warning"><?php echo date_format($startdate,"d"); ?></span></p>
                <p class="h3"><span class="badge badge-202225"><?php echo date_format($startdate,"M"); ?></span></p>
              </div>
              <div class="col-sm-8 text-center" align="right">
                <p class="h5 text-uppercase"><strong><?php echo $row->EventName; ?></strong></p>
                <ul class="list-inline text-light">
                  <li class="list-inline-item"><i class="fas fa-calendar" aria-hidden="true"></i> <?php echo $day; ?></li>
                  <li class="list-inline-item"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date_format($startdate,"H:i"); ?></li>
                </ul>
                <p><?php echo $row->EventsDesc; ?></p>
              </div>
            </div>
            <div class="row justify-content-md-center">
              <div class="col-sm-10">
                <hr class="spacer"/>
              </div>
            </div>
            <?php
            }
             ?>
          </div>
        </div>
      </div>
    <?php } ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="changelog-sidebar-div dark rounded">
            <h3 class="text-center pfu-logo-text"><b>Changelog</b></h3>
            <div class="row">
              <div class="col-sm-12">
                <?php
                $changelog = $crud->SelectOrderBy('ChangelogView', 'ID');
                $date = date_create($changelog->Timestamp);
                 ?>
                 <h5 class="text-center"><strong><?php echo $changelog->ChangelogTitle; ?></strong></h5>
                 <?php
                   if($changelog->IsWipe == true){
                  ?>
                  <p class="pre word text-danger">!Database Wipe!</p>
                  <?php
                  }
                  ?>
                 <p class="pre word text-warning">Feature Updates:<br><br><span class="text-light"><?php echo $changelog->ChangelogFeatures; ?></span></p>
                 <p class="pre word text-warning">Known Issues:<br><br><span class="text-light"><?php echo $changelog->ChangelogKnownIssues; ?></span></p>
                 <p class="pre word text-warning">BugFixes:<br><br><span class="text-light"><?php echo $changelog->ChangelogBugFixes; ?></span></p>
                 <p class="news-author"><?php echo date_format($date,"d/m/y H:i"); ?></p>
                 <p class="news-author"><img class="nav-avatar" height="40" width="40" src="<?php echo $changelog->SteamAvatarFull; ?>" alt="profil picture"/> <i><?php echo $changelog->Displayname; ?></i></p>
               </div>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/slideshow.js"></script>
