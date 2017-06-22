$(document).ready(function() {
	$('.donate').click(function() {
		val = $('input[name=donation]:checked').val();
		chackval = $('.donation').val();
		var x = Number(val);
		campaign = $('#campaign').val();
		full_name = $('#full_name').val();
		phone_number = $('#phone_number').val();
		email = $('#email').val();


		if (full_name == "" && phone_number == "" && $('.donation').prop('checked') == false) {
			$('#firstname_error').show();
			$('#phone_error').show();
			$('#donationerror').show();
		}else if(full_name != '' && phone_number == '' && $('.donation').prop('checked') == true){
			$('#firstname_error').hide();
			$('#phone_error').show();
			$('#donationerror').hide();
		}else if(full_name == '' && phone_number != '' && $('.donation').prop('checked') == true){
			$('#firstname_error').show();
			$('#phone_error').hide();
			$('#donationerror').hide();
		}else if(full_name != '' && phone_number == '' && $('.donation').prop('checked') == false){
			$('#firstname_error').hide();
			$('#phone_error').show();
			$('#donationerror').show();
		}else if(full_name == '' && phone_number != '' && $('.donation').prop('checked') == false){
			$('#firstname_error').show();
			$('#phone_error').hide();
			$('#donationerror').show();
		}else if(full_name == '' && phone_number == '' && $('.donation').prop('checked') == true){
			$('#firstname_error').show();
			$('#phone_error').show();
			$('#donationerror').hide();
		}else if(full_name != '' && phone_number == '' && $('.donation').prop('checked') == true){
			$('#firstname_error').hide();
			$('#phone_error').show();
			$('#donationerror').hide();
		}else{
			if (x == '1') {

		}else{

			if ($('#anonymous').prop('checked') == true) {
				anonymous = 'yes';
			}else{
				anonymous = 'no';
			}

			url = '/campaign/insertdonation';
			$.get(
            url,
              {val: val,
              	campaign: campaign,
              	full_name: full_name,
              	phone_number: phone_number,
              	email: email,
              	anonymous: anonymous},
              function(data) {
              	$('#show').show().html(data);
		$('#full_name').val('');
		$('#phone_number').val('');
		$('#email').val('');
              }); 
		}
		}

		

	});


	$('.donation').click(function() {
		val = $('input[name=donation]:checked').val();

		var x = Number(val);
		if (x != '1') {
			$('#amountshow').hide();
		}else{
			$('#amountshow').show();
		}

	})
});