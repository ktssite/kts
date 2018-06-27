$(document).ready( function () {
	
	$('#upload-profimg').on('click', function(e){ 
        var form = $("#fileinfo")[0]; 
        var data = new FormData(form);
      
        $.ajax({
          url: '/users/user/profileimg',
          method: 'POST',
          processData: false,
          contentType: false,
          data: data,
          processData: false,
          success: function(data){
            if (data) {
                $('.avatar-view').attr('src', data.avatar);
                $('.thumb-view').attr('src', data.thumb);
                form.reset(); 
                new PNotify({
                      title: 'Success',
                      text: 'Profile image updated.',
                      type: 'success',
                      animate_speed: 'fast',
                      styling: 'bootstrap3'
                });
            }
          }, 
          error: function(data) {
            form.reset(); 
            new PNotify({
                      title: 'Error',
                      text: data.responseJSON.message,
                      type: 'error',
                      animate_speed: 'fast',
                      styling: 'bootstrap3'
                });
          }
        })
    });    


} );