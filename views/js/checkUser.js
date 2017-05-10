$(document).ready(function() {
	
	jQuery.fn.shake = function(interval,distance,times){
		interval = typeof interval == "undefined" ? 100 : interval;
		distance = typeof distance == "undefined" ? 10 : distance;
		times = typeof times == "undefined" ? 3 : times;
		var jTarget = $(this);
			
		jTarget.css('position','relative');
		
		for(var iter=0;iter<(times+1);iter++){
		  jTarget.animate({ left: ((iter%2==0 ? distance : distance*-1))}, interval);
		}
		
		return jTarget.animate({ left: 0},interval);
   }
	
		$('.register_box').hide();
	
	showloginpage = function(){
		$('.register_box').hide();
		$('.login_box').show();	
		
	}
	showregpage = function() {
		$('.login_box').hide();	
		$('.register_box').show();
		
	}
	
	function shake() {
		$(".button").css( "border:2px solid red" );
		$(".button").shake(); 
	}
	$(".inloggen_form").submit(function() {
            var url = $(location).attr('origin');
		var username = $("#username").val();
		var password = $("#password").val();
		
		$.ajax({
			method: "post",
			url: url + "/login/login?",
			data: {
				username: username,
				password: password
			},
			//Als het bestaat OK
			success: function(data){
				//$(".button").addClass("animated wobble");
					shake();
					$(".error_login").html(data);  
			}
		});
		return false;
	});
		
	$(".reg_form").submit(function() {
		var url = $(location).attr('origin');
		var username = $("#reg_username").val();
		var firstname = $("#reg_firstname").val();
		var surname = $("#reg_surname").val();
		var email    = $("#reg_email").val();
		var password = $("#reg_password").val();
		
		if(grecaptcha.getResponse().length !== 0){
			console.log("The captcha has been already solved");
		}

			$.ajax({
				method: "post",
				url: url + "/login/register?",
				 data: {
					email: email,
					firstname: firstname,
					surname: surname,
					username: username,
					password: password,
					//THIS WILL TELL THE FORM IF THE USER IS CAPTCHA VERIFIED.
					captcha: grecaptcha.getResponse()
				},
				success: function(data){
						shake();
						$(".error_reg").html(data);  
				}	
			});
		return false;
	});
	});