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

	$('a#delete-p16').click(function() 
	{
		$('div#modal-delete-p16').modal('show');

		$('a#delete-yes').attr('href', base_url + 'p16/delete/' + $(this).data('id') )
	});

	$('a#delete-p17').click(function() 
	{
		$('div#modal-delete-p17').modal('show');

		$('a#delete-yes').attr('href', base_url + 'p17/delete/' + $(this).data('id') )
	});

	$('a#delete-p18').click(function() 
	{
		$('div#modal-delete-p18').modal('show');

		$('a#delete-yes').attr('href', base_url + 'p18/delete/' + $(this).data('id') )
	});

	$('a#delete-p19').click(function() 
	{
		$('div#modal-delete-p19').modal('show');

		$('a#delete-yes').attr('href', base_url + 'p19/delete/' + $(this).data('id') )
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


