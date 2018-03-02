/**
* Intel JS
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
$(document).ready(function() {

	$('a#delete-spdp').click(function() 
	{
		$('div#modal-delete-spdp').modal('show');

		$('a#delete-yes').attr('href', base_url + 'spdp/delete/' + $(this).data('id') )
	});

    $('#datepicker, #datepicker1').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });

	$('.btn-print').printPage({
		url: $(this).attr('href'),
		message: "Tunggu sebentar ..."
	});

	$(function () {
  	$('[data-toggle="tooltip"]').tooltip()
	});

});


