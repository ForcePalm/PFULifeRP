<?php
if(!isset($_SESSION['steamid'])) {
  header("Location: /");
}
$allowlist = $crud->SelectCountWhereWhere('Applications','Profiles_SteamID64', $_SESSION['steamid'], 'AppliType_ID', '1', 'AppliStatus_ID', '3');
?>
<!--Apply page-->
<div class="container-fluid content">
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
      <h1 align="center">Ansøgning</h1>
      <div class="row">
        <div class="col-sm-6 rounded applybox">
          <p class="text-warning" align="center">
            Note: Du kan altid gemme din ansøgning for færdiggøre den når du har lyst.<br>
			Du kan kun søge om ekstra Character Slot hvis du har under 3 Slots tilgængelig.
          </p>
          <?php
          $application = $crud->Select('ApplicationsView', 'ID', $_SESSION['editapplication']);
          While($appl = $application->fetch_object()){
          ?>
          <form id="apply-form" onsubmit="return false">
            <div class="form-group">
              <label for="type">Ansøgnings Type: <span class="text-warning">Vælg den type Ansøgning du vil lave, for at få den rigtige form.</span></label>
              <select class="form-control" id="type">
                <?php
                $appliType = $crud->ReadAll('AppliType');
                $rows = $appliType->fetch_object();
                if($allowlist->Amount > "0"){
                 While($row = $appliType->fetch_object()){
                ?>
                <option value="<?php echo $row->ID; ?>" <?php if($row->TypeName == $appl->TypeName){ echo "selected"; } ?>><?php echo $row->TypeName; ?></option>
                <?php
                }
              }else{
                ?>
                <option value="<?php echo $rows->ID; ?>"><?php echo $rows->TypeName; ?></option>
                <?php
              }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="usr">Steam profil navn: <span class="text-warning">Hentes automatisk fra Steam, kan ændres her.</span></label>
              <input type="text" class="form-control" id="steam-usr" value="<?=$steamprofile['personaname']?>">
            </div>
            <div class="form-group">
              <label for="steamid">SteamID64: <span class="text-warning">Hentes automatisk fra Steam</span></label>
              <input type="text" class="form-control" id="steamid" value="<?=$steamprofile['steamid']?>" readonly>
            </div>
            <div class="form-group">
              <label for="discord-name">Discord navn:</label>
              <input type="text" class="form-control" id="discord-name" value="<?php echo $appl->Discord_name ?>">
            </div>
            <div id="allowlist" <?php if($appl->TypeName != "Allowlist"){ echo "style='display:none;'";} ?>>
              <div class="form-group">
                <label for="irl-age">Din IRL Alder?</label>
                <input type="date" class="form-control" id="irl-age" value="<?php echo $appl->Irl_Age ?>">
              </div>
              <div class="form-group">
                <label for="char-name">Karakters navn:</label>
                <input type="text" class="form-control" id="char-name" value="<?php echo $appl->Main_char_name ?>">
              </div>
              <div class="form-group">
                <label for="char-age">Karakters Alder:</label>
                <input type="date" class="form-control" id="char-age" value="<?php echo $appl->Main_char_age ?>">
              </div>
              <div class="form-group">
                 <label for="char-desc">Karakter Beskrivelse:</label>
                 <textarea class="form-control" rows="7" maxlength = "10000" id="char-desc"><?php echo $appl->Main_char_desc ?></textarea>
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
			  <div id="ekstraslot" <?php if($appl->TypeName != "Ekstra Slot"){ echo "style='display:none;'";} ?>>
              <div class="form-group">
                <label for="extra-char-name">Karakters navn:</label>
                <input type="text" class="form-control" id="extra-char-name" placeholder="Sven Åge Jensen">
              </div>
              <div class="form-group">
                <label for="extra-char-age">Karakters Alder:</label>
                <input type="date" class="form-control" id="extra-char-age">
              </div>
              <div class="form-group">
                 <label for="extra-char-desc">Karakter Beskrivelse:</label>
                 <textarea class="form-control" rows="7" maxlength = "10000" id="extra-char-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="row">
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-warning fa but" type="submit" id="update-slot-draft" value="Draft"/>
                      </div>
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="update-slot-send" value="Send"/>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-8">
                      <p id="response-slot" class="rounded response">
                      </p>
                    </div>
                  </div>
                </div>
            <div id="police" <?php if($appl->TypeName != "Politi"){ echo "style='display:none;'";} ?>>
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
            <div id="ems" <?php if($appl->TypeName != "EMS"){ echo "style='display:none;'";} ?>>
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
            <div id="gang" <?php if($appl->TypeName != "Bande"){ echo "style='display:none;'";} ?>>
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
          <?php
        }
           ?>
        </div>
      </div>
    </div>
    <div class="col-sm-1">
    </div>
  </div>
</div>
