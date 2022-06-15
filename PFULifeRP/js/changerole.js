$(document).ready(function(){
$(document).on('click', '.role', function(e) {
   var id = $(this).attr('id');
   $("."+id).find(".editroles").toggle();
   $("."+id).find(".updatebut").toggle();
   $("."+id).find(".roletext").toggle();
});

$(document).on('click', '.updatebut', function(e){
    var id = $(this).attr('id');
    var steamid = $("#"+id+"-steamid").val();
    var role = $("#"+id+"-role").val();
    var admin = $("#"+id+"-admin").val();

      $.ajax({
          url:'/code/Staff/RoleUpdate.php',
          type:'post',
          data:{
            SteamID64:steamid,
            Role:role,
          },
          success:function(response){
              if(response == 1){
                $("."+id).find(".editroles").toggle();
                $("."+id).find(".updatebut").toggle();
                if(role == "1"){
                  $("."+id).find(".roletext").text('Medlem');
                  if(steamid == admin){
                    document.location.reload(true);
                  }
                }else if(role == "2"){
                  $("."+id).find(".roletext").text('Staff');
                }
                $("."+id).find(".roletext").toggle();
          }
        }
      });
   });
});
