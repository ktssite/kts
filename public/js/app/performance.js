$(document).ready(function() {
	$('.performance_date').datepicker().datepicker('setDate', 'today')
	$('.filter_date').datepicker()
	$(".submit_performance").validate()
	$("#students").fSelect({ placeholder: 'Select one or more'})
	$('[href="'+localStorage.getItem('prev_tab')+'"]').click()

	$('#myTab li a').on('click', function() {
		location.hash = $(this).attr('href')
		localStorage.setItem('prev_tab', location.hash)
	})

	$("#delete_performance").validate({
	    submitHandler: function(form) {
			$.confirm({
			    title: 'Are you sure?',
			    content: 'Please confirm.',
			    buttons: {
			        confirm: function () {
			            form.submit()
			        },
			        cancel: function () {},
			    }
			});
	    }			
	})		

	if(!$('.selectable').length) $('#select_all').parent().hide()
	$('input[type=checkbox]').on('click', function() {
		var selected          = $(this)
		var total_checkbox    = $('.selectable').length
		var selected_checkbox = $('.selectable:checked').length

		if(selected.val() == 'x') {
			$('.selectable').prop('checked', selected.is(':checked'))
		} else {
			$('#select_all').prop('checked', selected_checkbox == total_checkbox)
		}

		selected_checkbox = $('.selectable:checked').length
		$('#edit').prop('disabled', selected_checkbox!=1)
		$('#delete').prop('disabled', selected_checkbox==0)
	})

	$('#edit').click(function() {
		var data = $('.selectable:checked').data();
		$('[name=pid]').val(data.id)
		$('[name=e_date]').val(data.date)
		$('[name=e_lot_size]').val(data.lot_size)
		$('[name=e_pip]').val(data.pip)
	})
})