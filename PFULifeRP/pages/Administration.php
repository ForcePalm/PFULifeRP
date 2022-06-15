<?php
  include('code/protect.php');

  $profiles = $crud->SelectCount('Profiles');
  $pending = $crud->SelectCountWhere('Applications', 'AppliStatus_ID', '2');
  $approved = $crud->SelectCountWhere('Applications', 'AppliStatus_ID', '3');
  $denied = $crud->SelectCountWhere('Applications', 'AppliStatus_ID', '4');
  $staffs = $crud->Select('StaffList', 'SteamID64', $_SESSION['steamid']);
?>
<div class="container-fluid profile-page content">
  <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
  <div class="row">
    <div class="col-xl-3 col-lg-6">
         <a class="link-widget" data-toggle="modal" data-target="#users">
          <div class="card l-bg-blue-dark">
              <div class="card-statistic-3 p-4">
                  <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                  <div class="mb-4">
                      <h5 class="card-title mb-0">Brugere</h5>
                  </div>
                  <div class="row align-items-center mb-2 d-flex">
                      <div class="col-8 justify-content-left">
                          <h2 class="d-flex align-items-center mb-0">
                              <?php echo $profiles->Amount; ?>
                          </h2>
                      </div>
                  </div>
              </div>
          </div>
          </a>
      </div>
      <!-- The Modal -->
  <div class="modal fade" id="users">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content dark">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Brugere</h4>
        <button type="button" class="close modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto">
            <table class="table table-dark-pfu">
              <thead>
                <tr>
                  <th>Brugernavn</th>
                  <th>SteamID</th>
                  <th>Rolle</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $users = $crud->SelectAllOrderBy('ProfilesList', 'Displayname', 'ASC');
            while($row = $users->fetch_object()){
            ?>
            <tr class="<?php echo $row->SteamID64 ?>">
              <td><?php echo $row->Displayname ?></td>
              <td><?php echo $row->SteamID64 ?></td>
              <td class="roletext"><?php echo $row->Role ?></td>
                <form onsubmit="return false">
                  <td class="editroles" style="display: none">
                    <select id="<?php echo $row->SteamID64 ?>-role" class="form-control">
                      <?php
                      $role = $crud->ReadAll('Roles');
                       While($rows = $role->fetch_object()){
                      ?>
                      <option value="<?php echo $rows->ID; ?>" <?php if($row->Role == $rows->Role){ echo "selected"; } ?>><?php echo $rows->Role; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <input id="<?php echo $row->SteamID64 ?>-steamid" type="text" value="<?php echo $row->SteamID64; ?>" hidden/>
                    <input id="<?php echo $row->SteamID64 ?>-admin" type="text" value="<?php echo $_SESSION['steamid']; ?>" hidden/>
                  </td>
                  <td >
                    <input id="<?php echo $row->SteamID64 ?>" class="btn btn-warning updatebut" type="submit" value="Opdater" align="center" style="display: none"/>
                    <button id="<?php echo $row->SteamID64 ?>" class="role btn btn-info" align="center"><i class="fas fa-user-edit"></i></button>
                </td>
              </form>
            </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer mfooter">
      </div>

    </div>
  </div>
  </div>
      <div class="col-xl-3 col-lg-6">
        <a class="link-widget" data-toggle="modal" data-target="#await-approval">
          <div class="card l-bg-orange-dark">
              <div class="card-statistic-3 p-4">
                  <div class="card-icon card-icon-large"><i class="fas fa-sync"></i></div>
                  <div class="mb-4">
                      <h5 class="card-title mb-0">Afventende Ansøgninger</h5>
                  </div>
                  <div class="row align-items-center mb-2 d-flex">
                      <div class="col-8 justify-content-left">
                          <h2 class="d-flex align-items-center mb-0">
                              <?php echo $pending->Amount; ?>
                          </h2>
                      </div>
                  </div>
              </div>
          </div>
          </a>
      </div>
      <!-- The Modal -->
<div class="modal fade" id="await-approval">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content dark">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Afventer Godkendelse</h4>
        <button type="button" class="close modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto applilist">
            <table id="awaiting" class="table table-dark-pfu">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>SteamID64</th>
                  <th>Irl Alder</th>
                  <th>Karakters navn</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $appli = $crud->SelectAll('ApplicationsView', 'Status', '"Afventer Godkendelse"');
            while($row = $appli->fetch_object()){
            ?>
            <tr>
              <td><?php echo $row->TypeName ?></td>
              <td><?php echo $row->Profiles_SteamID64 ?></td>
              <?php
              if($row->Irl_Age == 0){
              ?>
              <td>ikke sat</td>
              <?php
            }else{
              ?>
              <td><?php echo $row->Irl_Age ?></td>
              <?php
            }
               ?>
              <td><?php echo $row->Main_char_name ?></td>
              <td class="status applystatus">
                <?php if($row->Status == "Draft"){ ?>
                <span class="badge badge-pill badge-info applystatus text-light"><?php echo $row->Status ?></span>
              <?php }elseif($row->Status == "Afventer Godkendelse"){ ?>
                <span class="badge badge-pill badge-warning applystatus  text-light"><?php echo $row->Status ?></span>
              <?php }elseif($row->Status == "Godkendt"){ ?>
                <span class="badge badge-pill badge-success applystatus  text-light"><?php echo $row->Status ?></span>
              <?php }elseif($row->Status == "Afvist"){ ?>
                <span class="badge badge-pill badge-danger applystatus  text-light"><?php echo $row->Status ?></span>
              <?php } ?>
              </td>
              <td><button id="<?php echo $row->ID ?>" class="btn btn-info Show-Application"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
          </div>
          <div class="col-md-12 ml-auto mr-auto applishow" style="display: none">
            <div class="row justify-content-md-center">
              <div class="col-sm-8 text-center">
                <div class="appl">
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">Ansøgnings type:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="type"></p>
                    </div>
                    <div class="col-sm-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">SteamID:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="steamid"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">Discord:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="discord"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="irla text-left"></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="irl"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">Karakters navn:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="charname"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="chara text-left"></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="charbirth"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="charb text-left"></p>
                      <p class="chardesc pre word text-left"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="pa text-left"></p>
                      <p class="police pre word text-left"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="emsa text-left"></p>
                      <p class="ems pre word text-left"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="bname text-left"></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="gangname"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="btext text-left"></p>
                      <p class="gangdesc pre word text-left"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-md-center">
              <div class="col-sm-6 text-center">
                <form onsubmit="return false">
                  <input class="id" type="text" hidden/>
                  <input type="submit" class="btn btn-success approve" value="Godkend" />
                  <input type="submit" class="btn btn-danger deni" value="Afvis" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer mfooter">
        <button class="btn btn-info Hide-Application" style="display: none"><i class="fas fa-arrow-left"></i></button>
      </div>
    </div>
  </div>
</div>
      <div class="col-xl-3 col-lg-6">
        <a class="link-widget" data-toggle="modal" data-target="#approved">
          <div class="card l-bg-green-dark">
              <div class="card-statistic-3 p-4">
                  <div class="card-icon card-icon-large"><i class="fas fa-check"></i></div>
                  <div class="mb-4">
                      <h5 class="card-title mb-0">Godkendte Ansøgninger</h5>
                  </div>
                  <div class="row align-items-center mb-2 d-flex">
                      <div class="col-8 justify-content-left">
                          <h2 class="d-flex align-items-center mb-0">
                              <?php echo $approved->Amount; ?>
                          </h2>
                      </div>
                  </div>
              </div>
           </div>
         </a>
      </div>
      <!-- The Modal -->
    <div class="modal fade" id="approved">
    <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content dark">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Godkendte Ansøgninger</h4>
        <button type="button" class="close modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto applilist">
            <table id="awaiting" class="table table-dark-pfu">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>SteamID64</th>
                  <th>Irl Alder</th>
                  <th>Karakters navn</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $appli = $crud->SelectAll('ApplicationsView', 'Status', '"Godkendt"');
            while($row = $appli->fetch_object()){
            ?>
            <tr>
              <td><?php echo $row->TypeName ?></td>
              <td><?php echo $row->Profiles_SteamID64 ?></td>
              <?php
              if($row->Irl_Age == 0){
              ?>
              <td>ikke sat</td>
              <?php
            }else{
              ?>
              <td><?php echo $row->Irl_Age ?></td>
              <?php
            }
               ?>
              <td><?php echo $row->Main_char_name ?></td>
              <td class="status applystatus">
                <?php if($row->Status == "Draft"){ ?>
                <span class="badge badge-pill badge-info applystatus"><?php echo $row->Status ?></span>
              <?php }elseif($row->Status == "Afventer Godkendelse"){ ?>
                <span class="badge badge-pill badge-warning applystatus"><?php echo $row->Status ?></span>
              <?php }elseif($row->Status == "Godkendt"){ ?>
                <span class="badge badge-pill badge-success applystatus"><?php echo $row->Status ?></span>
              <?php }elseif($row->Status == "Afvist"){ ?>
                <span class="badge badge-pill badge-danger applystatus"><?php echo $row->Status ?></span>
              <?php } ?>
              </td>
              <td><button id="<?php echo $row->ID ?>" class="btn btn-info Show-Application"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
          </div>
          <div class="col-md-12 ml-auto mr-auto applishow" style="display: none">
            <div class="row justify-content-md-center">
              <div class="col-sm-8 text-center">
                <div class="appl">
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">Ansøgnings type:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="type"></p>
                    </div>
                    <div class="col-sm-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">SteamID:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="steamid"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">Discord:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="discord"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="irla text-left"></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="irl"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-left">Karakters navn:</p>
                    </div>
                    <div class="col-sm-4">
                      <p class="charname"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="chara text-left"></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="charbirth"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="charb text-left"></p>
                      <p class="chardesc pre word text-left"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="pa text-left"></p>
                      <p class="police pre word text-left"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="emsa text-left"></p>
                      <p class="ems pre word text-left"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="bname text-left"></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="gangname"></p>
                    </div>
                    <div class="col-sm-4">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="btext text-left"></p>
                      <p class="gangdesc pre word text-left"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer mfooter">
        <button class="btn btn-info Hide-Application" style="display: none"><i class="fas fa-arrow-left"></i></button>
      </div>

    </div>
    </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <a class="link-widget" data-toggle="modal" data-target="#denied">
        <div class="card l-bg-red-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-times"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Afviste Ansøgninger</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8 justify-content-left">
                        <h2 class="d-flex align-items-center mb-0">
                            <?php echo $denied->Amount; ?>
                        </h2>
                    </div>
                </div>
            </div>
         </div>
       </a>
    </div>
    <!-- The Modal -->
<div class="modal fade" id="denied">
<div class="modal-dialog modal-dialog-centered modal-xl">
  <div class="modal-content dark">

    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title">Afviste Ansøgninger</h4>
      <button type="button" class="close modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 ml-auto mr-auto applilist">
          <table id="awaiting" class="table table-dark-pfu">
            <thead>
              <tr>
                <th>Type</th>
                <th>SteamID64</th>
                <th>Irl Alder</th>
                <th>Karakters navn</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
          </thead>
          <tbody>
          <?php
          $appli = $crud->SelectAll('ApplicationsView', 'Status', '"Afvist"');
          while($row = $appli->fetch_object()){
          ?>
          <tr>
            <td><?php echo $row->TypeName ?></td>
            <td><?php echo $row->Profiles_SteamID64 ?></td>
            <?php
            if($row->Irl_Age == 0){
            ?>
            <td>ikke sat</td>
            <?php
          }else{
            ?>
            <td><?php echo $row->Irl_Age ?></td>
            <?php
          }
             ?>
            <td><?php echo $row->Main_char_name ?></td>
            <td class="status applystatus">
              <?php if($row->Status == "Draft"){ ?>
              <span class="badge badge-pill badge-info applystatus"><?php echo $row->Status ?></span>
            <?php }elseif($row->Status == "Afventer Godkendelse"){ ?>
              <span class="badge badge-pill badge-warning applystatus"><?php echo $row->Status ?></span>
            <?php }elseif($row->Status == "Godkendt"){ ?>
              <span class="badge badge-pill badge-success applystatus"><?php echo $row->Status ?></span>
            <?php }elseif($row->Status == "Afvist"){ ?>
              <span class="badge badge-pill badge-danger applystatus"><?php echo $row->Status ?></span>
            <?php } ?>
            </td>
            <td><button id="<?php echo $row->ID ?>" class="btn btn-info Show-Application"><i class="fas fa-eye"></i></button></td>
          </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
        </div>
        <div class="col-md-12 ml-auto mr-auto applishow" style="display: none">
          <div class="row justify-content-md-center">
            <div class="col-sm-8 text-center">
              <div class="appl">
                <div class="row">
                  <div class="col-sm-4">
                    <p class="text-left">Ansøgnings type:</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="type"></p>
                  </div>
                  <div class="col-sm-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="text-left">SteamID:</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="steamid"></p>
                  </div>
                  <div class="col-sm-4">

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="text-left">Discord:</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="discord"></p>
                  </div>
                  <div class="col-sm-4">

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="irla text-left"></p>
                  </div>
                  <div class="col-sm-4">
                    <p class="irl"></p>
                  </div>
                  <div class="col-sm-4">

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="text-left">Karakters navn:</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="charname"></p>
                  </div>
                  <div class="col-sm-4">

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="chara text-left"></p>
                  </div>
                  <div class="col-sm-4">
                    <p class="charbirth"></p>
                  </div>
                  <div class="col-sm-4">

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <p class="charb text-left"></p>
                    <p class="chardesc pre word text-left"></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <p class="pa text-left"></p>
                    <p class="police pre word text-left"></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <p class="emsa text-left"></p>
                    <p class="ems pre word text-left"></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="bname text-left"></p>
                  </div>
                  <div class="col-sm-4">
                    <p class="gangname"></p>
                  </div>
                  <div class="col-sm-4">

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <p class="btext text-left"></p>
                    <p class="gangdesc pre word text-left"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer mfooter">
      <button class="btn btn-info Hide-Application" style="display: none"><i class="fas fa-arrow-left"></i></button>
    </div>

  </div>
</div>
</div>
  </div>
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-3">
      <div class="main main-raised">
        <div class="profile-content">
          <div class="container">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                <div class="profile">
                  <div class="avatar-staff">
                      <img src="<?php echo $staffs->SteamAvatarFull ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                  </div>
                  <div class="name">
                      <h2 class="title">Staff Instillinger</h2>
                      <h3 class="title"><?php echo $staffs->Displayname ?></h3>
                      <p>
                        <?php echo $staffs->Role ?>
                      </p>
                    </div>
                 </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-10 ml-auto mr-auto">
                <div class="description text-center">
                  <form onsubmit="return false">
                    <div class="form-group">
                      <input class="form-control" type="text" id="steamid" value="<?php echo $staffs->SteamID64 ?>" hidden/>
                    </div>
                    <div class="form-group">
                       <label for="staff-desc">Din staff Beskrivelse:</label>
                       <textarea class="form-control" rows="10" id="staff-desc" style="height: 344.43px;"><?php echo $staffs->Staff_Desc ?></textarea>
                    </div>
                    <div class="form-group">
                      <input class="form-control btn btn-success fa but" type="submit" id="staff-update" value="Opdater"/>
                    </div>
                    <div class="form-group">
                      <p id="response" class="rounded response"></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="main main-raised">
        <div class="profile-content">
          <div class="container">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                <div class="profile">
                  <h2 class="title">Changelog</h2>
                 </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-10 ml-auto mr-auto">
                <div class="description">
                  <form id="changelog" onsubmit="return false">
                    <div class="form-group">
                      <input class="form-control" type="text" id="steamid" value="<?php echo $_SESSION['steamid'] ?>" hidden/>
                    </div>
                    <div class="form-group">
                      <label for="version">Patch version:</label>
                      <input class="form-control" type="text" id="version"/>
                    </div>
                    <div class="form-group">
                      <input type="checkbox" name="wipe" id="wipe" data-toggle="toggle" data-on="Wipe" data-off="No Wipe" data-onstyle="danger" data-offstyle="success">
                    </div>
                    <div class="form-group">
                       <label for="feature-desc">Feature updates:</label>
                       <textarea class="form-control" rows="4" id="feature-desc"></textarea>
                    </div>
                    <div class="form-group">
                       <label for="issue-desc">Known Issues:</label>
                       <textarea class="form-control" rows="3" id="issue-desc"></textarea>
                    </div>
                    <div class="form-group">
                       <label for="bugfix-desc">Bugsfixes:</label>
                       <textarea class="form-control" rows="3" id="bugfix-desc"></textarea>
                    </div>
                    <div class="form-group">
                      <input class="form-control btn btn-success fa but" type="submit" id="patch-create" value="Opret Patch Notes"/>
                    </div>
                    <div class="form-group">
                      <p id="patch-response" class="rounded response"></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="main main-raised">
        <div class="profile-content">
          <div class="container">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                <div class="profile">
                  <h2 class="title">Events</h2>
                 </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-10 ml-auto mr-auto">
                <div class="description">
                  <form id="event" onsubmit="return false">
                    <div class="form-group">
                      <label for="version">Event Navn:</label>
                      <input class="form-control" type="text" id="eventname"/>
                    </div>
                    <div class="form-group">
                       <label for="feature-desc">Event Beskrivelse:</label>
                       <textarea class="form-control" rows="7" id="event-desc" style="height: 269px;"></textarea>
                    </div>
                    <div class="form-group">
                       <label for="start">Start tidspunkt:</label>
                       <input class="form-control" type="datetime-local" id="start"/>
                    </div>
                    <div class="form-group">
                       <label for="end">Slut tidspunkt:</label>
                       <input class="form-control" type="datetime-local" id="end"/>
                    </div>
                    <div class="form-group">
                      <input class="form-control btn btn-success fa but" type="submit" id="event-create" value="Opret Event"/>
                    </div>
                    <div class="form-group">
                      <p id="event-response" class="rounded response"></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-1">

    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-10">
      <div class="main main-raised">
        <div class="profile-content">
          <div class="container">
            <div class="row">
              <div class="col-md-12 ml-auto mr-auto">
                <div class="profile">
                  <h2 class="title">Slideshow upload</h2>
                  <div class="slide">
                    <form method="post" enctype="multipart/form-data" action="code/Slide/slideupload.php">
                      <div class="row justify-content-md-center">
                        <div class="col-sm-4 custom-file">
                           <input class="custom-file-input" id="customFile" type="file" name="image" required/>
                           <label class="custom-file-label" for="customFile">Vælg Billede</label>
                        </div>
                        <div class="col-sm-2 form-group">
                          <input class="btn btn-info" type="submit" value="Upload Billede" />
                        </div>
                      </div>
                     </form>
                     <script>
                     // Add the following code if you want the name of the file appear on select
                     $(".custom-file-input").on("change", function() {
                       var fileName = $(this).val().split("\\").pop();
                       $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                     });
                     </script>
                  </div>
                 </div>
               </div>
            </div>
            <div class="row">
              <?php
              $picture = $crud->ReadAll('Slideshow');
              while($row = $picture->fetch_object()){
               ?>
              <div class="col-sm-4">
                <div class="show-uploaded-pictures">
                  <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="gfx/slideshow/<?php echo $row->IMG; ?>" alt="Card image cap">
                   </div>
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
  <div class="row justify-content-md-center">
    <div class="col-sm-10">
        <div class="main main-raised">
          <div class="profile-content">
            <div class="container">
              <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                  <div class="profile">
                    <h2 class="title">Nyheder</h2>
                   </div>
                 </div>
              </div>
              <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                  <div class="description">
                    <form id="news" onsubmit="return false">
                      <div class="form-group">
                        <input class="form-control" type="text" id="steamid" value="<?php echo $_SESSION['steamid'] ?>" hidden/>
                      </div>
                      <div class="form-group">
                        <label for="newstitle">Title:</label>
                        <input class="form-control" type="text" id="newstitle"/>
                      </div>
                      <div class="form-group">
                         <label for="newstext">Nyheds text:</label>
                         <textarea class="form-control" rows="20" id="newstext"></textarea>
                      </div>
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="news-create" value="Opret Nyhed"/>
                      </div>
                      <div class="form-group">
                        <p id="news-response" class="rounded response"></p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script>
  window.onload = function() {
    CKEDITOR.replace( 'newstext' );
    //CKEDITOR.replace( 'event-desc' );
  };
</script>
<script src="js/staffupdate.js"></script>
<script src="js/createchangelog.js"></script>
<script src="js/changerole.js"></script>
<script src="js/createnews.js"></script>
<script src="js/event.js"></script>
<script src="js/applications.js"></script>
<script src="js/showuploadimg.js"></script>
