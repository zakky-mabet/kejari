/**
* Intel JS
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
$(document).ready(function() {

	$('a#delete').click(function() 
	{
		$('div#modal-delete').modal('show');

		$('a#delete-yes').attr('href', base_url + 'laporan_masyarakat/delete/' + $(this).data('id')+'?disposisi='+ $(this).data('disposisi') )
	});

	$('a#delete-laporan-informasi').click(function() 
	{
		$('div#modal-delete-laporan-informasi').modal('show');

		$('a#delete-yes').attr('href', base_url + 'laporan_informasi/delete/' + $(this).data('id') )
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


