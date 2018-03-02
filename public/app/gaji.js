/**
* Intel JS
*
* @author Teitra Mega Team <teitramega@gmail.com> 
* @link Developer Link http://teitramega.co.id
*/
$(document).ready(function() {

	$(".select2").select2();
	
	$('a#delete-gaji').click(function() 
	{
		$('div#modal-delete').modal('show');

		$('a#delete-yes').attr('href', base_url + 'gaji_berkala/delete/' + $(this).data('id'))
	});

    //Date picker
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

	var kedipan = 200; 
	var dumet = setInterval(function () {
    var ele = document.getElementById('textkedip');
    ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden');
	}, kedipan);

});


