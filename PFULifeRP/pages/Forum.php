<?php
$catoff = $crud->SelectAll('Forum_Cat', 'IsOfficial', '2');
$cat = $crud->SelectAll('Forum_Cat', 'IsOfficial', '1');
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
              <?php
              if(isset($_SESSION['steamid'])){
              ?>
              <div class="float-right">
            <?php
              if(isset($_SESSION['Role']) && $_SESSION['Role'] == 2){
            ?>
              <a href=""><button class="btn btn-pfu"><i class="fas fa-plus-square"></i> <b>Opret ny kategori</b></button></a>
            <?php
              }
            ?>
              <a href=""><button class="btn btn-pfu"><i class="fas fa-edit"></i> <b>Opret nyt Emne</b></button></a>
              </div>
              <?php
              }
               ?>
              <div id="fcat">
                <div class="forum-title">
                    <h3>Official</h3>
                    <div class="pull-right forum-desc">
                        <small>Total posts: 0</small>
                    </div>
                </div>
                <?php
                while($row = $catoff->fetch_object()){
                  if(!isset($_SESSION['steamid']) && $row->Category_Name != "Staff-Only"){
                    $count = $crud->SelectCountWhere('Forum_Topic', 'Forum_Cat_ID', $row->ID);
                    $pcount = $crud->SelectCountWhere('Posts', 'Forum_Cat_ID', $row->ID);
                    ?>
                    <div class="forum-item active">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="forum-icon">
                                    <i class="<?php echo $row->Icon ?>"></i>
                                </div>
                                <a id="<?php echo $row->ID ?>" class="forum-item-title text-warning category"><?php echo $row->Category_Name ?></a>
                                <div class="forum-sub-title"><?php echo $row->Category_Desc ?></div>
                            </div>
                            <div class="col-md-1 forum-info">
                                <span class="views-number">
                                    <?php echo $count->Amount ?>
                                </span>
                                <div>
                                    <small>Emner</small>
                                </div>
                            </div>
                            <div class="col-md-1 forum-info">
                                <span class="views-number">
                                    <?php echo $pcount->Amount ?>
                                </span>
                                <div>
                                    <small>Posts</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
              }
              elseif(isset($_SESSION['Role']) && $_SESSION['Role'] != 2 && $row->Category_Name != "Staff-Only"){
                $count = $crud->SelectCountWhere('Forum_Topic', 'Forum_Cat_ID', $row->ID);
                $pcount = $crud->SelectCountWhere('Posts', 'Forum_Cat_ID', $row->ID);
                ?>
                <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="<?php echo $row->Icon ?>"></i>
                            </div>
                            <a id="<?php echo $row->ID ?>" class="forum-item-title text-warning category"><?php echo $row->Category_Name ?></a>
                            <div class="forum-sub-title"><?php echo $row->Category_Desc ?></div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                <?php echo $count->Amount ?>
                            </span>
                            <div>
                                <small>Emner</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                <?php echo $pcount->Amount ?>
                            </span>
                            <div>
                                <small>Posts</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
          }elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == 2){
            $count = $crud->SelectCountWhere('Forum_Topic', 'Forum_Cat_ID', $row->ID);
            $pcount = $crud->SelectCountWhere('Posts', 'Forum_Cat_ID', $row->ID);
            ?>
            <div class="forum-item active">
                <div class="row">
                    <div class="col-md-9">
                        <div class="forum-icon">
                            <i class="<?php echo $row->Icon ?>"></i>
                        </div>
                        <a id="<?php echo $row->ID ?>" class="forum-item-title text-warning category"><?php echo $row->Category_Name ?></a>
                        <div class="forum-sub-title"><?php echo $row->Category_Desc ?></div>
                    </div>
                    <div class="col-md-1 forum-info">
                        <span class="views-number">
                            <?php echo $count->Amount ?>
                        </span>
                        <div>
                            <small>Emner</small>
                        </div>
                    </div>
                    <div class="col-md-1 forum-info">
                        <span class="views-number">
                            <?php echo $pcount->Amount ?>
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
                <div class="forum-title">
                    <h3>Andre Kategorier</h3>
                    <div class="pull-right forum-desc">
                        <small>Total posts: 0</small>
                    </div>
                </div>
                <?php
                while($rows = $cat->fetch_object()){
                  if($rows->IsOfficial == 1){
                    $counts = $crud->SelectCountWhere('Forum_Topic', 'Forum_Cat_ID', $rows->ID);
                  ?>
                <div class="forum-item">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="<?php echo $rows->Icon ?>"></i>
                            </div>
                            <a id="<?php echo $rows->ID ?>" class="forum-item-title category"><?php echo $rows->Category_Name ?></a>
                            <div class="forum-sub-title"><?php echo $rows->Category_Desc ?></div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                <?php echo $counts->Amount ?>
                            </span>
                            <div>
                                <small>Emner</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                0
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
