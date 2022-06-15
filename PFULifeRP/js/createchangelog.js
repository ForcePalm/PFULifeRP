$(document).ready(function(){
  const form = document.getElementById('changelog');

    $("#patch-create").click(function(){
        var steamid = $("#steamid").val();
        var patchversion = $("#version").val();
        if($('#wipe').is(':checked') == true){
          var wipe = 1;
        }else if($('#wipe').is(':checked') == false){
           var wipe = 0;
        }
        var feature = $("#feature-desc").val();
        var issue = $("#issue-desc").val();
        var bugfix = $("#bugfix-desc").val();

        if(steamid != "" && patchversion != "" && feature != "" && issue != "" && bugfix != ""){
          $.ajax({
              url:'/code/Changelog/Changelog.php',
              type:'post',
              data:{
                Profiles_SteamID64:steamid,
                IsWipe:wipe,
                ChangelogTitle:patchversion,
                ChangelogFeatures:feature,
                ChangelogKnownIssues:issue,
                ChangelogBugFixes:bugfix,
              },
              success:function(response){
                  if(response == 1){
                    $('#patch-response').text('Successfuldt oprettet!');
                    $('#patch-response').css('background-color', '#28a745')
                    form.reset();
                  }else{
                    $('#patch-response').text('Noget gik galt, Prøv igen!');
                    $('#patch-response').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#patch-response').text('Udfyld venligst alle felter!');
          $('#patch-response').css('background-color', '#dc3545');
        }
    });
});
