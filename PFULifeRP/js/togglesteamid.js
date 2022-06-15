
$("#button").click(function(){
  $("#steamidtxt").toggle();
})

$(document).on('click', '.Delete-Application', function(e) {
   var id = $(this).attr('id');

   $.ajax({
       url:'/code/Profile/Delete-Application.php',
       type:'post',
       data:{
         Id:id,
       },
       success:function(response){
           if(response == 1){
             document.location.reload(true);
           }else{
             document.location.reload(true);
           }
       }
   });
});
