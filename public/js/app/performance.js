$(document).ready(function() {
	$('.performance_date').datepicker().datepicker('setDate', 'today')
	$('.filter_date').datepicker()
	$(".submit_performance").validate()
	$(".update_performance").validate()
	$("#students").fSelect({ placeholder: 'Select one or more'})
	$('[href="'+localStorage.getItem('prev_tab')+'"]').click()

	$('#myTab li a').on('click', function() {
		location.hash = $(this).attr('href')
		localStorage.setItem('prev_tab', location.hash)
	})

	$(".delete_performance").on('click', function(event) {
		var self = $(this)
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if(result.value) self.parent().submit()
		})
	})

	$('.edit_performance').on('click', function() {
		var data   = $(this).data();
		var columns = ['pid', 'e_date', 'e_instrument', 'e_lot_size', 'e_pip', 'e_profit']

		columns.forEach(function(e) {
			console.log(data[e])
			$('[name="'+e+'"]').val(data[e])
		})
	})


	$('.main').on('click', function() {
		$(this).next('.collapsed_row').toggle()
	})
})