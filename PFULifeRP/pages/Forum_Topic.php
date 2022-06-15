<?php
$cat = $crud->Select('Forum_Cat', 'ID', $_SESSION['catid']);
$count = $crud->SelectCountWhere('Forum_Topic', 'Forum_Cat_ID', $_SESSION['catid']);
 ?>
<div class="container">
<div class="row">
    <div class="col-lg-12 white-bg rounded content">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="ibox-content m-b-sm border-bottom">
                <div class="p-xs">
                    <div class="pull-left m-r-md">
                        <img class="text-navy mid-icon" src="gfx/logo.avif"></img>
                    </div>
                    <h2>PFULifeRP Forum</h2>
                    <span></span>
                </div>
            </div>

            <div class="ibox-content forum-container">
              <a href=""><button class="btn btn-pfu float-right"><i class="fas fa-edit"></i> <b>Opret nyt Emne</b></button></a>
              <div id="fcat">
                <div class="forum-title">
                    <h3><?php echo $cat->Category_Name ?></h3>
                    <div class="pull-right forum-desc">
                        <small>Total topics: <?php echo $count->Amount ?></small>
                    </div>
                </div>
                <?php
                $topic = $crud->SelectAll('Forum_Topic', 'Forum_Cat_ID', $_SESSION['catid']);
                while($row = $topic->fetch_object()){
                  if($row->Pinned == '1'){
                  $author = $crud->Select('Profiles', 'SteamID64', $row->Author_ID);
                  $countans = $crud->SelectCountWhere('Forum_Answers', 'Forum_Topic_ID', $row->ID);
                ?>
                    <div class="forum-item active">
                        <div class="row">
                            <div class="col-md-9">
                                <a id="<?php echo $row->ID ?>" class="forum-item-title text-warning topic"><?php echo ucfirst($row->Topic_Name); ?></a>
                                <div class="forum-sub-title"><p>
                                  startet af: <img class="nav-avatar" height="40px" width="40px" src="<?php echo $author->SteamAvatarMedium; ?>" alt="profil picture"/> <i><?php echo $author->Displayname ?></i>
                                </p></div>
                            </div>
                            <div class="col-md-1 forum-info">
                                <span class="views-number">
                                    <?php echo $countans->Amount ?>
                                </span>
                                <div>
                                    <small>Posts</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                      }
                    }
                    $topic = $crud->SelectAll('Forum_Topic', 'Forum_Cat_ID', $_SESSION['catid']);
                    while($row = $topic->fetch_object()){
                      if($row->Pinned == '0'){
                      $author = $crud->Select('Profiles', 'SteamID64', $row->Author_ID);
                      $countans = $crud->SelectCountWhere('Forum_Answers', 'Forum_Topic_ID', $row->ID);
                    ?>
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-9">
                                    <a id="<?php echo $row->ID ?>" class="forum-item-title text-light topic"><?php echo ucfirst($row->Topic_Name); ?></a>
                                    <div class="forum-sub-title"><p>
                                      startet af: <img class="nav-avatar" height="40px" width="40px" src="<?php echo $author->SteamAvatarMedium; ?>" alt="profil picture"/> <i><?php echo $author->Displayname ?></i>
                                    </p></div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        <?php echo $countans->Amount ?>
                                    </span>
                                    <div>
                                        <small>Posts</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                          }
                        }
                        ?>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="js/Forum.js"></script>
