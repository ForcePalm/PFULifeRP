$(document).ready(function(){

    $("#update-allow-draft").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var irlAge = $("#irl-age").val();
        var charname = $("#char-name").val();
        var charage = $("#char-age").val();
        var chardesc = $("#char-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Allowlistupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Irl_Age:irlAge,
                Main_char_name:charname,
                Main_char_age:charage,
                Main_char_desc:chardesc,
                AppliStatus_ID:1,
              },
              success:function(response){
                  if(response == 1){
                    $('#response').text('Successfuldt Sendt!');
                    $('#response').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response').text('Noget gik galt, Prøv igen!');
                    $('#response').css('background-color', '#dc3545');
                    document.location.reload(true);

                  }
              }
          });
        }else{
          $('#response').text('Udfyld venligst alle felter!');
          $('#response').css('background-color', '#dc3545');
        }
    });

    $("#update-allow-send").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var irlAge = $("#irl-age").val();
        var charname = $("#char-name").val();
        var charage = $("#char-age").val();
        var chardesc = $("#char-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && irlAge != "" && charname != "" && charage != "" && chardesc != ""){
          $.ajax({
              url:'/code/Apply/Allowlistupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Irl_Age:irlAge,
                Main_char_name:charname,
                Main_char_age:charage,
                Main_char_desc:chardesc,
                AppliStatus_ID:2,
              },
              success:function(response){
                  if(response == 1){
                    $('#response').text('Successfuldt Sendt!');
                    $('#response').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response').text('Noget gik galt, Prøv igen!');
                    $('#response').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response').text('Udfyld venligst alle felter!');
          $('#response').css('background-color', '#dc3545');
        }
    });

	    $("#update-slot-draft").click(function(){
        var id = $("#applid").val();
        var appliType = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#extra-char-name").val();
        var charage = $("#extra-char-age").val();
        var chardesc = $("#extra-char-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Slotupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                Main_char_age:charage,
                Main_char_desc:chardesc,
                AppliStatus_ID:1,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-slot').text('Successfuldt Sendt!');
                    $('#response-slot').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-slot').text('Noget gik galt, Prøv igen!');
                    $('#response-slot').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-slot').text('Udfyld venligst alle felter!');
          $('#response-slot').css('background-color', '#dc3545');
        }
    });

    $("#update-slot-send").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#extra-char-name").val();
        var charage = $("#extra-char-age").val();
        var chardesc = $("#extra-char-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && charage != "" && chardesc != ""){
          $.ajax({
              url:'/code/Apply/Slotupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                Main_char_age:charage,
                Main_char_desc:chardesc,
                AppliStatus_ID:2,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-slot').text('Successfuldt Sendt!');
                    $('#response-slot').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-slot').text('Noget gik galt, Prøv igen!');
                    $('#response-slot').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response').text('Udfyld venligst alle felter!');
          $('#response').css('background-color', '#dc3545');
        }
    });

    $("#update-police-draft").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#police-char-name").val();
        var policedesc = $("#police-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Policeupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                Police_apply:policedesc,
                AppliStatus_ID:1,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-police').text('Successfuldt Sendt!');
                    $('#response-police').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-police').text('Noget gik galt, Prøv igen!');
                    $('#response-police').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-police').text('Udfyld venligst alle felter!');
          $('#response-police').css('background-color', '#dc3545');
        }
    });

    $("#update-police-send").click(function(){
       var id = $("#applid").val();
       var appliType = $("#type").val();
       var steamid = $("#steamid").val();
       var discordname = $("#discord-name").val();
       var charname = $("#police-char-name").val();
        var policedesc = $("#police-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && policedesc != ""){
          $.ajax({
              url:'/code/Apply/Policeupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                Police_apply:policedesc,
                AppliStatus_ID:2,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-police').text('Successfuldt Sendt!');
                    $('#response-police').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-police').text('Noget gik galt, Prøv igen!');
                    $('#response-police').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-police').text('Udfyld venligst alle felter!');
          $('#response-police').css('background-color', '#dc3545');
        }
    });

    $("#update-ems-draft").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#ems-char-name").val();
        var emsdesc = $("#ems-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/EMSupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                EMS_apply:emsdesc,
                AppliStatus_ID:1,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-ems').text('Successfuldt Sendt!');
                    $('#response-ems').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-ems').text('Noget gik galt, Prøv igen!');
                    $('#response-ems').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-ems').text('Udfyld venligst alle felter!');
          $('#response-ems').css('background-color', '#dc3545');
        }
    });

    $("#update-ems-send").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#ems-char-name").val();
        var emsdesc = $("#ems-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && emsdesc != ""){
          $.ajax({
              url:'/code/Apply/EMSupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                EMS_apply:emsdesc,
                AppliStatus_ID:2,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-ems').text('Successfuldt Sendt!');
                    $('#response-ems').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-ems').text('Noget gik galt, Prøv igen!');
                    $('#response-ems').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-ems').text('Udfyld venligst alle felter!');
          $('#response-ems').css('background-color', '#dc3545');
        }
    });

    $("#update-gang-draft").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#gang-char-name").val();
        var gangname = $("#gang-name").val();
        var gangdesc = $("#gang-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Gangupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                Gang_name:gangname,
                Gang_Desc:gangdesc,
                AppliStatus_ID:1,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-gang').text('Successfuldt Sendt!');
                    $('#response-gang').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-gang').text('Noget gik galt, Prøv igen!');
                    $('#response-gang').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-gang').text('Udfyld venligst alle felter!');
          $('#response-gang').css('background-color', '#dc3545');
        }
    });

    $("#update-gang-send").click(function(){
        var id = $("#applid").val();
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#gang-char-name").val();
        var gangname = $("#gang-name").val();
        var gangdesc = $("#gang-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && gangname != "" && gangdesc != ""){
          $.ajax({
              url:'/code/Apply/Gangupdate.php',
              type:'post',
              data:{
                id:id,
                Profiles_SteamID64:steamid,
                AppliType_ID:appliType,
                Discord_name:discordname,
                Main_char_name:charname,
                Gang_name:gangname,
                Gang_Desc:gangdesc,
                AppliStatus_ID:2,
              },
              success:function(response){
                  if(response == 1){
                    $('#response-gang').text('Successfuldt Sendt!');
                    $('#response-gang').css('background-color', '#28a745');
                    document.location.reload(true);
                  }else{
                    $('#response-gang').text('Noget gik galt, Prøv igen!');
                    $('#response-gang').css('background-color', '#dc3545');
                    document.location.reload(true);
                  }
              }
          });
        }else{
          $('#response-gang').text('Udfyld venligst alle felter!');
          $('#response-gang').css('background-color', '#dc3545');
        }
    });
});
