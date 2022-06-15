$(document).ready(function(){
  const form = document.getElementById('apply-form');

    $("#allow-draft").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var irlAge = $("#irl-age").val();
        var charname = $("#char-name").val();
        var charage = $("#char-age").val();
        var chardesc = $("#char-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Allowlist.php',
              type:'post',
              data:{
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
                    $('#response').css('background-color', '#28a745')
                    form.reset();
                  }else{
                    $('#response').text('Noget gik galt, Prøv igen!');
                    $('#response').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response').text('Udfyld venligst alle felter!');
          $('#response').css('background-color', '#dc3545');
        }
    });

    $("#allow-send").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var irlAge = $("#irl-age").val();
        var charname = $("#char-name").val();
        var charage = $("#char-age").val();
        var chardesc = $("#char-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && irlAge != "" && charname != "" && charage != "" && chardesc != ""){
          $.ajax({
              url:'/code/Apply/Allowlist.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response').text('Noget gik galt, Prøv igen!');
                    $('#response').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response').text('Udfyld venligst alle felter!');
          $('#response').css('background-color', '#dc3545');
        }
    });

	    $("#slot-draft").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#extra-char-name").val();
        var charage = $("#extra-char-age").val();
        var chardesc = $("#extra-char-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Slot.php',
              type:'post',
              data:{
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
                    $('#response-slot').css('background-color', '#28a745')
                    form.reset();
                  }else{
                    $('#response-slot').text('Noget gik galt, Prøv igen!');
                    $('#response-slot').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-slot').text('Udfyld venligst alle felter!');
          $('#response-slot').css('background-color', '#dc3545');
        }
    });

    $("#slot-send").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#extra-char-name").val();
        var charage = $("#extra-char-age").val();
        var chardesc = $("#extra-char-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && charage != "" && chardesc != ""){
          $.ajax({
              url:'/code/Apply/Slot.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response-slot').text('Noget gik galt, Prøv igen!');
                    $('#response-slot').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response').text('Udfyld venligst alle felter!');
          $('#response').css('background-color', '#dc3545');
        }
    });

    $("#police-draft").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#police-char-name").val();
        var policedesc = $("#police-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Police.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response-police').text('Noget gik galt, Prøv igen!');
                    $('#response-police').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-police').text('Udfyld venligst alle felter!');
          $('#response-police').css('background-color', '#dc3545');
        }
    });

    $("#police-send").click(function(){
       var appliType = $("#type").val();
       var steamid = $("#steamid").val();
       var discordname = $("#discord-name").val();
       var charname = $("#police-char-name").val();
        var policedesc = $("#police-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && policedesc != ""){
          $.ajax({
              url:'/code/Apply/Police.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response-police').text('Noget gik galt, Prøv igen!');
                    $('#response-police').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-police').text('Udfyld venligst alle felter!');
          $('#response-police').css('background-color', '#dc3545');
        }
    });

    $("#ems-draft").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#ems-char-name").val();
        var emsdesc = $("#ems-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/EMS.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response-ems').text('Noget gik galt, Prøv igen!');
                    $('#response-ems').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-ems').text('Udfyld venligst alle felter!');
          $('#response-ems').css('background-color', '#dc3545');
        }
    });

    $("#ems-send").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#ems-char-name").val();
        var emsdesc = $("#ems-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && emsdesc != ""){
          $.ajax({
              url:'/code/Apply/EMS.php',
              type:'post',
              data:{
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
                  form.reset();
                  }else{
                    $('#response-ems').text('Noget gik galt, Prøv igen!');
                    $('#response-ems').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-ems').text('Udfyld venligst alle felter!');
          $('#response-ems').css('background-color', '#dc3545');
        }
    });

    $("#gang-draft").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#gang-char-name").val();
        var gangname = $("#gang-name").val();
        var gangdesc = $("#gang-desc").val();

        if(appliType != "" && steamid != "" && discordname != ""){
          $.ajax({
              url:'/code/Apply/Gang.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response-gang').text('Noget gik galt, Prøv igen!');
                    $('#response-gang').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-gang').text('Udfyld venligst alle felter!');
          $('#response-gang').css('background-color', '#dc3545');
        }
    });

    $("#gang-send").click(function(){
        var appliType = $("#type").val();
        var steamid = $("#steamid").val();
        var discordname = $("#discord-name").val();
        var charname = $("#gang-char-name").val();
        var gangname = $("#gang-name").val();
        var gangdesc = $("#gang-desc").val();

        if(appliType != "" && steamid != "" && discordname != "" && charname != "" && gangname != "" && gangdesc != ""){
          $.ajax({
              url:'/code/Apply/Gang.php',
              type:'post',
              data:{
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
                    form.reset();
                  }else{
                    $('#response-gang').text('Noget gik galt, Prøv igen!');
                    $('#response-gang').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#response-gang').text('Udfyld venligst alle felter!');
          $('#response-gang').css('background-color', '#dc3545');
        }
    });
});
