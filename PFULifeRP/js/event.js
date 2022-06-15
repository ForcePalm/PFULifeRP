$(document).ready(function(){
  const form = document.getElementById('event');

    $("#event-create").click(function(){
        var eventname = $("#eventname").val();
        var eventdesc = $("#event-desc").val();
        var start = $("#start").val();
        var end = $("#end").val();

        if(eventname != "" && eventdesc != "" && start != "" && end != ""){
          $.ajax({
              url:'/code/Event/Event.php',
              type:'post',
              data:{
                Name:eventname,
                Desc:eventdesc,
                Start:start,
                End:end,
              },
              success:function(response){
                  if(response == 1){
                    $('#event-response').text('Successfuldt oprettet!');
                    $('#event-response').css('background-color', '#28a745')
                    form.reset();
                  }else{
                    $('#event-response').text('Noget gik galt, Prøv igen!');
                    $('#event-response').css('background-color', '#dc3545');
                    form.reset();
                  }
              }
          });
        }else{
          $('#event-response').text('Udfyld venligst alle felter!');
          $('#event-response').css('background-color', '#dc3545');
        }
    });
});
