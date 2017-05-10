$(document).ready(function() {

			$(".user_follow_btn").on('click', function () {
			var type = $(this).data('type');
			var load = $(this);
			
			// Liken
			if(type == 'follow') {
				
				//var imageid = $(this).data('uid');
				var userid = $(this).data('utid');
				var volger = $("#volgers");
				
				if(userid != ""){
                                    
                var url = $(location).attr('origin');
				var data = "&utid=" + userid;
				$.ajax({
				method: "post",
				url: url + "/feed/follow",
				data: data,
				//Als het bestaat OK
				success: function(data){
					
					if(data == 'success') {
							load.addClass(' hidden');
							load.siblings().removeClass('hidden');
							load.siblings().addClass('unfollow');
							
							 
					
					var volg = parseInt(volger.text());
	
                            volger.text(function(i, c) {
								
								if(volg == 0) {
									var volgers = Number(volg) + 1 + " volger";
								} else {
									var volgers = Number(volg) + 1 + " volgers";
								}
								return volgers;
							
							
							}); 
					
					}
				}
			});
			}
			}
			else if (type == 'unfollow') {

				//var imageid = $(this).data('uid');
				var userid = $(this).data('utid');
				var ontvolg = $("#volgers");
				
				if(userid != ""){
                                    
                                var url = $(location).attr('origin');
				var data = "&utid=" + userid;
				$.ajax({
				method: "post",
				url: url + "/feed/unfollow",
				data: data,
				//Als het bestaat OK
				success: function(data){
					
					if(data == 'success') {
							load.addClass(' hidden');
							load.siblings().removeClass('hidden');
							load.siblings().removeClass('unfollow');
							
							
							var volg = parseInt(ontvolg.text());
	
                            ontvolg.text(function(i, c) {
								
								if(volg == 2) {
									var volgers = Number(volg) - 1 + " volger";
								} else {
									var volgers = Number(volg) - 1 + " volgers";
								}
								console.log("hij komt in ontvolg functie volgers: " + volgers);
								return volgers;
							
							
							}); 
						
					}
				}
			});
				}
				
			}
		});
});


