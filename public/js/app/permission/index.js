$(document).ready( function () {
	
	//*************************Datatable*******************//
    $('#permission_tbl').DataTable({
    	// responsive: true,
    	"pageLength": 100,
		scrollCollapse: true,
		"columnDefs": [ { "orderable": false, "targets": [2] } ]
    });
    //*************************Datatable*******************//


} );