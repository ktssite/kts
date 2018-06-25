

function onStatusChange() {
	var _token = $('input[name="_token"]').val();
	var isChecked = $(this).is(':checked') ? 1 : 0;
	var id = $(this).data('id');
	$.ajax({
	  url: "/users/ajax",
	  type: 'POST',
	  data: { _token:_token, id:id, a:'statupdate',checked:isChecked },
	  dataType: 'json'
	})
	.fail(function(response) {
	    new PNotify({
              title: 'Error',
              text: response.responseJSON.message,
              type: 'error',
              styling: 'bootstrap3'
        });
	})
	.done(function(response) {
	  if(!response.result) {
	  		new PNotify({
                  title: 'Error',
                  text: response.message,
                  type: 'error',
                  styling: 'bootstrap3'
            });
	  }
	});
}

$(document).ready( function () {
	
	//*************************Datatable*******************//
    $('#user_tbl').DataTable({
    	// responsive: true,
    	"pageLength": 100,
		scrollCollapse: true,
		"columnDefs": [ { "orderable": false, "targets": [3,4,5] } ]
    });
    //*************************Datatable*******************//

    $('.status_chk').on('ifChanged', onStatusChange);
    


} );