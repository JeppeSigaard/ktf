jQuery(document).ready(function(){

function ajax_update_option(clicked,field,val,ret){
	clicked.after('<span class="spinner" id="spin-'+field+'" style="display: inline-block;"></span>')
	var update;
	if (window.XMLHttpRequest){update=new XMLHttpRequest();}
	else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	update.onreadystatechange=function(){
	if (update.readyState==4 && update.status==200)
	{
	//retur
	$(ret).css('box-shadow','0px 0px 5px green').val(update.response);
	$('#spin-'+field).remove();
	setTimeout(function(){
		$(ret).removeAttr('style');
		},100);
	}
	}
	
	update.open("POST","http://klartilfilm.dk/wp-content/themes/klartilfilm/ajax/update-field.php",true);
	update.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	update.send('field='+field+'&val='+val);
		
	}
	
	// Gem QR-kode
	if($('#save_qr').length){
		$('#save_qr').click(function(){
			var val = $('#option_qr').val();
			var field = 'option_qr';
			var ret = '#option_qr';
			var clicked = $(this);
			ajax_update_option(clicked,field,val,ret);
		});}
	});