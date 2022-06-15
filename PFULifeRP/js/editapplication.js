$(document).on('click', '.Profile-get-Application', function(e) {
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
               $(".steamid").val(response.Profiles_SteamID64);
               $(".discord").val(response.Discord_name);
               if(response.TypeName == "Allowlist"){
                 document.getElementById("allowlist").style.display = "block";
                 document.getElementById("ekstraslot").style.display = "none";
                 $("#type option[value='1']").prop('selected', true);
                 document.getElementById("police").style.display = "none";
                 document.getElementById("ems").style.display = "none";
                 document.getElementById("gang").style.display = "none";
                 $(".irl").val(response.Irl_Birth);
                 $(".charname").val(response.Main_char_name);
                 $(".charbirth").val(response.Main_char_birth);
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
                 document.getElementById("ekstraslot").style.display = "block";
                 document.getElementById("allowlist").style.display = "none";
                 document.getElementById("police").style.display = "none";
                 document.getElementById("ems").style.display = "none";
                 document.getElementById("gang").style.display = "none";
                 $("#type option[value='2']").prop('selected', true);
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".charname").val(response.Main_char_name);
                 $(".charbirth").val(response.Main_char_birth);
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
                 $("#type option[value='3']").prop('selected', true);
                 document.getElementById("police").style.display = "block";
                 document.getElementById("allowlist").style.display = "none";
                 document.getElementById("ekstraslot").style.display = "none";
                 document.getElementById("ems").style.display = "none";
                 document.getElementById("gang").style.display = "none";
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".chara").text("");
                 $(".charbirth").text("");
                 $(".charb").text("");
                 $(".chardesc").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".police").text(response.Police_apply);
                 $(".emsa").text("");
                 $(".ems").text("");
                 $(".bname").text("");
                 $(".gangname").text("");
                 $(".btext").text("");
                 $(".gangdesc").text("");
               }else if(response.TypeName == "EMS"){
                 $("#type option[value='4']").prop('selected', true);
                 document.getElementById("allowlist").style.display = "none";
                 document.getElementById("police").style.display = "none";
                 document.getElementById("ekstraslot").style.display = "none";
                 document.getElementById("gang").style.display = "none";
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".chara").text("");
                 $(".charbirth").text("");
                 $(".charb").text("");
                 $(".chardesc").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".ems").text(response.EMS_apply);
                 $(".pa").text("");
                 $(".police").text("");
                 $(".bname").text("");
                 $(".gangname").text("");
                 $(".btext").text("");
                 $(".gangdesc").text("");
               }else if(response.TypeName == "Bande"){
                 $("#type option[value='5']").prop('selected', true);
                 document.getElementById("allowlist").style.display = "none";
                 document.getElementById("police").style.display = "none";
                 document.getElementById("ems").style.display = "none";
                 document.getElementById("ekstraslot").style.display = "none";
                 $(".irla").text("");
                 $(".irl").text("");
                 $(".chara").text("");
                 $(".charbirth").text("");
                 $(".charb").text("");
                 $(".chardesc").text("");
                 $(".charname").text(response.Main_char_name);
                 $(".gangname").text(response.Gang_name);
                 $(".gangdesc").text(response.Gang_Desc);
                 $(".pa").text("");
                 $(".police").text("");
                 $(".emsa").text("");
                 $(".ems").text("");
               }
         }
     });
});
