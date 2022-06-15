<?php
include('code/protect.php');
?>
<div class="container-fluid content">
  <div class="row">
    <div class="col-sm-2">
      <div class="dark rounded setting-box">
        <?php
        $main = $crud->Select('Maintenance', 'ID', 1);
        $mstatus = $main->Maintenancemode;
        ?>
        <form>
          <div class="form-group">
            <label>Maintenance Mode</label>
          </div>
          <div class="form-group">
            <input type="checkbox" name="monoff" id="monoff" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" <?php if($mstatus == 1){ echo "checked"; } ?>>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="dark rounded setting-box">
        <?php
        $apply = $crud->Select('AllowlistStatus', 'InUse', 1);
        $status = $apply->ID;
        ?>
        <form>
          <div class="form-group">
            <label>Åben / Luk Ansøgning</label>
          </div>
          <div class="form-group">
            <input type="checkbox" name="onoff" id="onoff" data-toggle="toggle" data-on="Åben" data-off="Lukket" data-onstyle="success" data-offstyle="danger" <?php if($status == 1){ echo "checked"; } ?>>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="js/onoff.js"></script>
