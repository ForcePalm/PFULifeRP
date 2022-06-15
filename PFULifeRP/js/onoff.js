$(document).ready(function(){
    $("#onoff").change(function(){
          if($('#onoff').is(':checked') == true){
           var on = 1;
           var off = 0;
          }

	  if($('#onoff').is(':checked') == false){
           var on = 0;
           var off = 1;
          }

          $.ajax({
              url:'code/Settings/onoff.php',
              type:'post',
              data:{
                on:on,
                off:off,
              },
              success: function(response){
                if(response == 1){
                  //alert("Allowlist Lukket");
                }else if(response == 2){
                  //alert("Allowlist Åbnet");
                }else{
                  //alert("Der skete en fejl");
                }
              }
          });
    });
});

$(document).ready(function(){
    $("#monoff").change(function(){
          if($('#monoff').is(':checked') == true){
           var on = 1;
           var off = 0;
          }

	  if($('#monoff').is(':checked') == false){
           var on = 0;
           var off = 1;
          }

          $.ajax({
              url:'code/Settings/monoff.php',
              type:'post',
              data:{
                on:on,
                off:off,
              },
              success: function(response){
                if(response == 1){
                  //alert("Allowlist Lukket");
                }else if(response == 2){
                  //alert("Allowlist Åbnet");
                }else{
                  //alert("Der skete en fejl");
                }
              }
          });
    });
});
