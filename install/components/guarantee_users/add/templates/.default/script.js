$(document).on('keyup','[name="ARTICLE"]',function(){
	let code = $(this).val();
	if(code!=''){
		$.ajax({
			type: "POST",
			url: "/guarantee/ajax.php",
			data: {code:code},
			success: function(data){
				$('.ajaxAlko').html(data);		
			}
		});
	}
});

$(document).ready(function(){
	let code = $('[name="ARTICLE"]').val();
	if(code!=''){
		$.ajax({
			type: "POST",
			url: "/guarantee/ajax.php",
			data: {code:code},
			success: function(data){
				$('.ajaxAlko').html(data);		
			}
		});
	}

});