$(document).ready(function(){

$(document).on('click', '.category', function(e){
    var id = $(this).attr('id');

      $.ajax({
          url:'/code/Forum/SelectCategory.php',
          type:'post',
          data:{
            id:id
          },
          success:function(response){
              if(response == 1){
                console.log(id);
                window.location = "Forum_Topic";
          }
        }
     });
   });

   $(document).on('click', '.topic', function(e){
       var id = $(this).attr('id');

         $.ajax({
             url:'/code/Forum/SelectTopic.php',
             type:'post',
             data:{
               id:id
             },
             success:function(response){
                 if(response == 1){
                   console.log(id);
                   window.location = "Forum_view";
             }
           }
        });
      });
});
