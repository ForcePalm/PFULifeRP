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
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 rounded applybox">
          <p class="text-warning" align="center">
            Note: Du kan altid gemme din ansøgning for færdiggøre den når du har lyst.<br>
			Du kan kun søge om ekstra Character Slot hvis du har under 3 Slots tilgængelig. <?php echo $allowlist->Amount; ?>
          </p>
          <form id="apply-form" onsubmit="return false">
            <div class="form-group">
              <label for="type">Ansøgnings Type: <span class="text-warning">Vælg den type Ansøgning du vil lave, for at få den rigtige form.</span></label>
              <select class="form-control" id="type">
                <?php
                $appliType = $crud->ReadAll('AppliType');
                $rows = $appliType->fetch_object();
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
              <label for="usr">Steam profil navn: <span class="text-warning">Hentes automatisk fra Steam, kan ændres her.</span></label>
              <input type="text" class="form-control" id="steam-usr" value="<?=$steamprofile['personaname']?>">
            </div>
            <div class="form-group">
              <label for="steamid">SteamID64: <span class="text-warning">Hentes automatisk fra Steam</span></label>
              <input type="text" class="form-control" id="steamid" value="<?=$steamprofile['steamid']?>" readonly>
            </div>
            <div class="form-group">
              <label for="discord-name">Discord navn:</label>
              <input type="text" class="form-control" id="discord-name" placeholder="ForcePalm#****">
            </div>
            <div id="allowlist" <?php if($allowlist->Amount > "0"){ echo 'style="display:none;"';} ?>>
              <div class="form-group">
                <label for="irl-age">Din IRL Alder?</label>
                <input type="date" class="form-control" id="irl-age">
              </div>
              <div class="form-group">
                <label for="char-name">Karakters navn:</label>
                <input type="text" class="form-control" id="char-name" placeholder="Sven Åge Jensen">
              </div>
              <div class="form-group">
                <label for="char-age">Karakters Alder:</label>
                <input type="date" class="form-control" id="char-age">
              </div>
              <div class="form-group">
                 <label for="char-desc">Karakter Beskrivelse:</label>
                 <textarea class="form-control" rows="7" maxlength = "10000" id="char-desc"></textarea>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="row">
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-warning fa but" type="submit" id="allow-draft" value="Draft" disabled/>
                      </div>
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="allow-send" value="Send"/>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-8">
                      <p id="response" class="rounded response">
                      </p>
                    </div>
                  </div>
                </div>
			  <div id="ekstraslot" <?php if($allowlist->Amount == "0"){ echo 'style="display:none;"';} ?>>
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
                        <input class="form-control btn btn-warning fa but" type="submit" id="slot-draft" value="Draft"/>
                      </div>
                      <div class="col-sm-6 form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="slot-send" value="Send"/>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-8">
                      <p id="response-slot" class="rounded response">
                      </p>
                    </div>
                  </div>
                </div>
            <div id="police" style="display:none;">
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
                        <input class="form-control btn btn-warning fa but" type="submit" id="police-draft" value="Draft"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="police-send" value="Send"/>
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
            <div id="ems" style="display:none;">
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
                        <input class="form-control btn btn-warning fa but" type="submit" id="ems-draft" value="Draft"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="ems-send" value="Send"/>
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
            <div id="gang" style="display:none;">
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
                        <input class="form-control btn btn-warning fa but" type="submit" id="gang-draft" value="Draft"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input class="form-control btn btn-success fa but" type="submit" id="gang-send" value="Send"/>
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
        <div class="col-sm-3">
        </div>
      </div>
    </div>
    <div class="col-sm-1">
    </div>
  </div>
</div>
<script src="js/apply.js"></script>
<script src="js/applyform.js"></script>
