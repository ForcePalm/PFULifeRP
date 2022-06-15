<div class="container-fluid profile-page">
  <div class="row">
    <?php
    $staffs = $crud->ReadAll("StaffList");
    while($row = $staffs->fetch_object()){
    ?>
    <div class="col-sm-3 content">
      <div class="main main-raised">
        <div class="profile-content">
          <div class="container">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                <div class="profile">
                  <div class="avatar-staff">
                      <img src="<?php echo $row->SteamAvatarFull ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                  </div>
                  <div class="name">
                      <h3 class="title"><?php echo $row->Displayname ?></h3>
                      <h6>
                        <?php echo $row->Role ?>
                      </h6>
                    </div>
                 </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-10 ml-auto mr-auto">
                <div class="description text-center">
                  <p><?php echo $row->Staff_Desc ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
     }
    ?>
  </div>
</div>
