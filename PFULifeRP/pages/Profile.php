<?php
include('code/protect.php');
$allowlist = $crud->SelectCountWhereWhere('Applications','Profiles_SteamID64', $_SESSION['steamid'], 'AppliType_ID', '1', 'AppliStatus_ID', '3');
?>
<!--Profile page-->
<div class="container-fluid profile-page">
  <div class="row">
    <div class="col-sm-12 content">
        <div class="row">
          <div class="col-sm-12">
            <div class="main main-raised">
              <div class="profile-content">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                      <div class="profile">
                        <div class="avatar">
                            <img src="<?=$steamprofile['avatarfull']?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 class="title"><?=$steamprofile['personaname']?></h3>
                            <h6>
                              <?php
                              if($_SESSION['Role'] == 1){
                                echo "Medlem";
                              }else if($_SESSION['Role'] == 2){
                                echo "Staff";
                              }
                              ?>
                            </h6>
                          </div>
                       </div>
                     </div>
                  </div>
                  <div class="description text-center">
                    <button id="button" class="btn btn-info">Vis SteamID64</button>
					<br/>
					<br/>
                    <p id="steamidtxt" ><?=$steamprofile['steamid']?></p>
                  </div>
                  <hr class="spacer"/>
                  <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                      <h3 align="center">Ansøgninger</h3>
                      <table class="table table-dark-pfu">
                      <tbody>
                      <?php
                      $appli = $crud->SelectAll('ApplicationsView', 'Profiles_SteamID64', $_SESSION['steamid']);
                      while($row = $appli->fetch_object()){
                      ?>
                      <tr>
                        <td><?php echo $row->TypeName ?></td>
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
                        <td>
                          <?php
                          if($row->Status == "Draft"){
                           ?>
                          <button id="<?php echo $row->ID ?>" class="btn btn-info Profile-get-Application" data-toggle="modal" data-target="#editapp"><i class="fas fa-edit"></i></button>
                          <?php
                          }
                          ?>
                          <button id="<?php echo $row->ID ?>" class="btn btn-info Profile-Show-Application" data-toggle="modal" data-target="#showapp"><i class="fas fa-eye"></i></button>
                          <button id="<?php echo $row->ID ?>" class="btn btn-danger Delete-Application"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                      </tbody>
                    </table>
                    <hr class="spacer"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="showapp">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
<div class="modal-content dark">

<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title"></h4>
  <button type="button" class="close modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button>
</div>

<!-- Modal body -->
<div class="modal-body">
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto">
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
</div>
</div>
</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="editapp">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
<div class="modal-content dark">

<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title"></h4>
  <button type="button" class="close modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button>
</div>

<!-- Modal body -->
<div class="modal-body">
  <div class="row">
    <div class="col-sm-12">
      <h1 align="center">Ansøgning</h1>
      <div class="row justify-content-md-center">
        <div class="col-sm-6 rounded applybox">
          <p class="text-warning" align="center">
            Note: Du kan altid gemme din ansøgning for færdiggøre den når du har lyst.<br>
			Du kan kun søge om ekstra Character Slot hvis du har under 3 Slots tilgængelig.
          </p>
          <form id="apply-form" onsubmit="return false">
            <div class="form-group">
              <label for="type">Ansøgnings Type: <span class="text-warning">Vælg den type Ansøgning du vil lave, for at få den rigtige form.</span></label>
              <select class="form-control" id="type" disabled>
                <?php
                if($allowlist->Amount == "0"){
                ?>
                <option value="1">Allowlist</option>
                <?php
              }else{
                ?>
                <option value="2">Ekstra Slot</option>
                <option value="3">Politi</option>
                <option value="4">EMS</option>
                <option value="5">Bande</option>
                <?php
              }
                ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control id" id="applid" hidden>
            </div>
            <div class="form-group">
              <label for="usr">Steam profil navn: <span class="text-warning">Hentes automatisk fra Steam, kan ændres her.</span></label>
              <input type="text" class="form-control steam-usr" id="steam-usr" value="<?=$steamprofile['personaname']?>">
            </div>
            <div class="form-group">
              <label for="steamid">SteamID64: <span class="text-warning">Hentes automatisk fra Steam</span></label>
              <input type="text" class="form-control steamid" id="steamid" readonly>
            </div>
            <div class="form-group">
              <label for="discord-name">Discord navn:</label>
              <input type="text" class="form-control discord" id="discord-name">
            </div>
            <div id="allowlist">
              <div class="form-group">
                <label for="irl-age">Din IRL Alder?</label>
                <input type="date" class="form-control irl" id="irl-age" >
              </div>
              <div class="form-group">
                <label for="char-name">Karakters navn:</label>
                <input type="text" class="form-control charname" id="char-name" >
              </div>
              <div class="form-group">
                <label for="char-age">Karakters Alder:</label>
                <input type="date" class="form-control charbirth" id="char-age" >
              </div>
              <div class="form-group">
                 <label for="char-desc">Karakter Beskrivelse:</label>
                 <textarea class="form-control chardesc" rows="7" maxlength = "10000" id="char-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="row">
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-warning fa but" type="submit" id="update-allow-draft" value="Draft"/>
                      </div>
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="update-allow-send" value="Send"/>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-8">
                      <p id="response" class="rounded response">
                      </p>
                    </div>
                  </div>
                </div>
			  <div id="ekstraslot">
              <div class="form-group">
                <label for="extra-char-name">Karakters navn:</label>
                <input type="text" class="form-control charname" id="extra-char-name" placeholder="Sven Åge Jensen">
              </div>
              <div class="form-group">
                <label for="extra-char-age">Karakters Alder:</label>
                <input type="date" class="form-control charbirth" id="extra-char-age">
              </div>
              <div class="form-group">
                 <label for="extra-char-desc">Karakter Beskrivelse:</label>
                 <textarea class="form-control chardesc" rows="7" maxlength = "10000" id="extra-char-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="row">
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-warning fa but " type="submit" id="update-slot-draft" value="Draft"/>
                      </div>
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-success fa but " type="submit" id="update-slot-send" value="Send"/>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-4">
                      <p id="response-slot" class="rounded response">
                      </p>
                    </div>
                  </div>
                </div>
            <div id="police">
              <div class="form-group">
                <label for="char-name">Karakters navn:</label>
                <input type="text" class="form-control" id="police-char-name" placeholder="Sven Åge Jensen">
              </div>
              <div class="form-group">
                 <label for="police-desc">Hvorfor vil din karakter være i politiet?</label>
                 <textarea class="form-control" rows="7" maxlength = "10000" id="police-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-warning fa but" type="submit" id="update-police-draft" value="Draft"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="update-police-send" value="Send"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <p id="response-police" class="rounded response">
                  </p>
                </div>
              </div>
            </div>
            <div id="ems">
              <div class="form-group">
                <label for="char-name">Karakters navn:</label>
                <input type="text" class="form-control" id="ems-char-name" placeholder="Sven Åge Jensen">
              </div>
              <div class="form-group">
                 <label for="ems-desc">Hvorfor vil din karakter være EMS?</label>
                 <textarea class="form-control" rows="7" maxlength = "10000" id="ems-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-warning fa but" type="submit" id="update-ems-draft" value="Draft"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="update-ems-send" value="Send"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <p id="response-ems" class="bg-success rounded response">
                  </p>
                </div>
              </div>
            </div>
            <div id="gang">
              <div class="form-group">
                <label for="char-name">Karakters navn:</label>
                <input type="text" class="form-control" id="gang-char-name" placeholder="Sven Åge Jensen">
              </div>
              <p class="text-warning" align="center">
                Note: Bander der existere i virkeligheden vil blive afvist!
              </p>
              <div class="form-group">
                <label for="gang-name">Bandens navn: <span class="text-warning">Note: For at lave en bande skal du minimum have 5 der vil være medlem!</span></label>
                <input type="text" class="form-control" id="gang-name">
              </div>
              <div class="form-group">
                 <label for="gang-desc">Bande Beskrivelse:</label>
                 <textarea class="form-control" rows="7" maxlength = "10000" id="gang-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-warning fa but" type="submit" id="update-gang-draft" value="Draft"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="update-gang-send" value="Send"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <p id="response-gang" class="rounded response">
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal footer -->
<div class="modal-footer mfooter">
</div>
</div>
</div>
</div>
<script src="js/togglesteamid.js"></script>
<script src="js/applications.js"></script>
<script src="js/apply.js"></script>
<script src="js/updateapplyform.js"></script>
<script src="js/editapplication.js"></script>
