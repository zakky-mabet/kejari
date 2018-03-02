/*!
*
* Javascript Source
* @author Vicky Nitinegoro <pkpvicky@gmail.com>
* @link http://vicky.work
*/

$(document).ready(function() {

	$(".select2").select2();
	
	$('a#delete-kepangkatan').click(function() 
	{
		$('div#modal-delete').modal('show');

		$('a#delete-yes').attr('href', base_url + 'kepangkatan/delete/' + $(this).data('id')+'?back='+$(this).data('back'))
	});

    //Date picker
    $('#datepicker, #datepicker1').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });

	$('.btn-print_detail').printPage({
		url: $(this).attr('href'),
		message: "Tunggu sebentar ..."
	})

//<![CDATA[
$(document).ready(function(){
$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"auto"});
});
//]]>

	var kedipan = 200; 
	var dumet = setInterval(function () {
    var ele = document.getElementById('textkedip');
    ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden');
	}, kedipan);

});