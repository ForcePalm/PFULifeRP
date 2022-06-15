$(document).ready(function(){
  const form = document.getElementById('news');

    $("#news-create").click(function(){
        var steamid = $("#steamid").val();
        var title = $("#newstitle").val();
        var text = CKEDITOR.instances['newstext'].getData();

        if(steamid != "" && title != "" && text != ""){
          $.ajax({
              url:'/code/News/News.php',
              type:'post',
              data:{
                Profiles_SteamID64:steamid,
                Title:title,
                Text:text,
              },
              success:function(response){
                  if(response == 1){
                    $('#news-response').text('Successfuldt oprettet!');
                    $('#news-response').css('background-color', '#28a745')
                    form.reset();
                  }else{
                    $('#news-response').text('Noget gik galt, Prøv igen!');
                    $('#news-response').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#news-response').text('Udfyld venligst alle felter!');
          $('#news-response').css('background-color', '#dc3545');
        }
    });
});
