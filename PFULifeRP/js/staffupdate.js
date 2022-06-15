$(document).ready(function(){
$("#staff-update").click(function(){
    var steamid = $("#steamid").val();
    var staffdesc = $("#staff-desc").val();

    if(staffdesc != ""){
      $.ajax({
          url:'/code/Staff/Staffupdate.php',
          type:'post',
          data:{
            SteamID64:steamid,
            Staff_Desc:staffdesc,
          },
          success:function(response){
              if(response == 1){
                $('#response').text('Successfuld opdateret!');
                $('#response').css('background-color', '#28a745')
              }else{
                $('#response').text('Noget gik galt, Prøv igen!');
                $('#response').css('background-color', '#dc3545');
              }
          }
      });
    }else{
      $('#response').text('Udfyld venligst alle felter!');
      $('#response').css('background-color', '#dc3545');
    }
});
});
