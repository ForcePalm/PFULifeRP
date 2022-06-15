$('#type').on('change', function() {
  if(this.value == "1") {
    $('#allowlist').show();
	  $('#ekstraslot').hide();
    $('#police').hide();
    $('#ems').hide();
    $('#gang').hide();
  } else if(this.value == "2"){
    $('#allowlist').hide();
	  $('#ekstraslot').show();
    $('#police').hide();
    $('#ems').hide();
    $('#gang').hide();
  } else if(this.value == "3"){
    $('#allowlist').hide();
	  $('#ekstraslot').hide();
    $('#police').show();
    $('#ems').hide();
    $('#gang').hide();
  } else if(this.value == "4"){
    $('#allowlist').hide();
	  $('#ekstraslot').hide();
    $('#police').hide();
    $('#ems').show();
    $('#gang').hide();
  } else if(this.value == "5"){
    $('#allowlist').hide();
	  $('#ekstraslot').hide();
    $('#police').hide();
    $('#ems').hide();
    $('#gang').show();
  }
});
