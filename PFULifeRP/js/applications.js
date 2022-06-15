$(document).ready(function(){

$(document).on('click', '.Show-Application', function(e) {
   var id = $(this).attr('id');
   $(".applilist").toggle();
     $.ajax({
         url:'/code/Apply/Show-Application.php',
         type:'GET',
         data: {
           id:id
         },
         success:function(response){
               response = JSON.parse(response);
               $(".id").val(response.ID);
               $(".type").text(response.TypeName);
               $(".steamid").text(response.Profiles_SteamID64);
               $(".discord").text(response.Discord_name);
               if(response.TypeName == "Allowlist"){
                 $(".irla").text("Irl Alder:");
                 $(".irl").text(response.Irl_Age);
                 $(".charname").text(response.Main_char_name);
                 $(".chara").text("Karakters alder:");
                 $(".charbirth").text(response.Main_char_age);
                 $(".charb").text("Karakter Beskrivelse:");
                 $(".chardesc").text(response.Main_char_desc);
                 $(".pa").text("");
                 $(".police").text("");
                 $(".emsa").text("");
                 $(".ems").text("");
                 $(".bname").text("");
                 $(".gangname").text("");
                 $(".btext").text("");
                 $(".gangdesc").text("");
               }else if(response.TypeName == "Ekstra Slot"){
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".chara").text("Karakters alder:");
                 $(".charbirth").text(response.Main_char_age);
                 $(".charb").text("Karakter Beskrivelse:");
                 $(".chardesc").text(response.Main_char_desc);
                 $(".pa").text("");
                 $(".police").text("");
                 $(".emsa").text("");
                 $(".ems").text("");
                 $(".bname").text("");
                 $(".gangname").text("");
                 $(".btext").text("");
                 $(".gangdesc").text("");
               }else if(response.TypeName == "Politi"){
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".chara").text("");
                 $(".charbirth").text("");
                 $(".charb").text("");
                 $(".chardesc").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".pa").text("Politi Ansøgning:");
                 $(".police").text(response.Police_apply);
                 $(".emsa").text("");
                 $(".ems").text("");
                 $(".bname").text("");
                 $(".gangname").text("");
                 $(".btext").text("");
                 $(".gangdesc").text("");
               }else if(response.TypeName == "EMS"){
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".chara").text("");
                 $(".charbirth").text("");
                 $(".charb").text("");
                 $(".chardesc").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".emsa").text("EMS Ansøgning:");
                 $(".ems").text(response.EMS_apply);
                 $(".pa").text("");
                 $(".police").text("");
                 $(".bname").text("");
                 $(".gangname").text("");
                 $(".btext").text("");
                 $(".gangdesc").text("");
               }else if(response.TypeName == "Bande"){
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".chara").text("");
                 $(".charbirth").text("");
                 $(".charb").text("");
                 $(".chardesc").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".bname").text("Bande Navn:");
                 $(".gangname").text(response.Gang_name);
                 $(".btext").text("Bande Beskrivelse:");
                 $(".gangdesc").text(response.Gang_Desc);
                 $(".pa").text("");
                 $(".police").text("");
                 $(".emsa").text("");
                 $(".ems").text("");
               }
         }
     });

   $(".applishow").toggle();
   $(".Hide-Application").toggle();
});

    $('.modal').on('hidden.bs.modal', function(e) {
      if($(".applilist").css('display') === 'none'){
        $(".applishow").toggle();
        $(".applilist").toggle();
        $(".Hide-Application").toggle();
      }
    });

$(document).on('click', '.Hide-Application', function(e) {
   $(".applilist").toggle();
   $(".applishow").toggle();
   $(".Hide-Application").toggle();

});

$(document).on('click', '.approve', function(e){
    var id = $(".id").val();
    var status = 3;

      $.ajax({
          url:'/code/Staff/Approve.php',
          type:'post',
          data:{
            id:id,
            status:status
          },
          success:function(response){
              if(response == 1){
                document.location.reload(true);
          }
        }
      });
   });

   $(document).on('click', '.deni', function(e){
      var id = $(".id").val();
      var status = 4;

         $.ajax({
             url:'/code/Staff/Deni.php',
             type:'post',
             data:{
               id:id,
               status:status
             },
             success:function(response){
                 if(response == 1){
                   document.location.reload(true);
             }
           }
         });
      });

      $(document).on('click', '.Profile-Show-Application', function(e) {
         var id = $(this).attr('id');
           $.ajax({
               url:'/code/Apply/Show-Application.php',
               type:'GET',
               data: {
                 id:id
               },
               success:function(response){
                     response = JSON.parse(response);
                     $(".id").val(response.ID);
                     $(".type").text(response.TypeName);
                     $(".steamid").text(response.Profiles_SteamID64);
                     $(".discord").text(response.Discord_name);
                     if(response.TypeName == "Allowlist"){
                       $(".irla").text("Irl Alder:");
                       $(".irl").text(response.Irl_Age);
                       $(".charname").text(response.Main_char_name);
                       $(".chara").text("Karakters alder:");
                       $(".charbirth").text(response.Main_char_birth);
                       $(".charb").text("Karakter Beskrivelse:");
                       $(".chardesc").text(response.Main_char_desc);
                       $(".pa").text("");
                       $(".police").text("");
                       $(".emsa").text("");
                       $(".ems").text("");
                       $(".bname").text("");
                       $(".gangname").text("");
                       $(".btext").text("");
                       $(".gangdesc").text("");
                     }else if(response.TypeName == "Ekstra Slot"){
                       $(".irla").text("");
                       $(".irl").text("");
                       $(".charname").text(response.Main_char_name);
                       $(".chara").text("Karakters alder:");
                       $(".charbirth").text(response.Main_char_birth);
                       $(".charb").text("Karakter Beskrivelse:");
                       $(".chardesc").text(response.Main_char_desc);
                       $(".pa").text("");
                       $(".police").text("");
                       $(".emsa").text("");
                       $(".ems").text("");
                       $(".bname").text("");
                       $(".gangname").text("");
                       $(".btext").text("");
                       $(".gangdesc").text("");
                     }else if(response.TypeName == "Politi"){
                       $(".irla").text("");
                       $(".irl").text("");
                       $(".chara").text("");
                       $(".charbirth").text("");
                       $(".charb").text("");
                       $(".chardesc").text("");
                       $(".charname").text(response.Main_char_name);
                       $(".pa").text("Politi Ansøgning:");
                       $(".police").text(response.Police_apply);
                       $(".emsa").text("");
                       $(".ems").text("");
                       $(".bname").text("");
                       $(".gangname").text("");
                       $(".btext").text("");
                       $(".gangdesc").text("");
                     }else if(response.TypeName == "EMS"){
                       $(".irla").text("");
                       $(".irl").text("");
                       $(".chara").text("");
                       $(".charbirth").text("");
                       $(".charb").text("");
                       $(".chardesc").text("");
                       $(".charname").text(response.Main_char_name);
                       $(".emsa").text("EMS Ansøgning:");
                       $(".ems").text(response.EMS_apply);
                       $(".pa").text("");
                       $(".police").text("");
                       $(".bname").text("");
                       $(".gangname").text("");
                       $(".btext").text("");
                       $(".gangdesc").text("");
                     }else if(response.TypeName == "Bande"){
                       $(".irla").text("");
                       $(".irl").text("");
                       $(".chara").text("");
                       $(".charbirth").text("");
                       $(".charb").text("");
                       $(".chardesc").text("");
                       $(".charname").text(response.Main_char_name);
                       $(".bname").text("Bande Navn:");
                       $(".gangname").text(response.Gang_name);
                       $(".btext").text("Bande Beskrivelse:");
                       $(".gangdesc").text(response.Gang_Desc);
                       $(".pa").text("");
                       $(".police").text("");
                       $(".emsa").text("");
                       $(".ems").text("");
                     }
               }
           });
      });

});
