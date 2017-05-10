var likeUser = function() { 
       var url = $(location).attr('origin');
		$(".like_heart").on('click', function () {
			var type = $(this).data('type');
			var load = $(this);
			
			// Liken
			if(type == 'like') {
				var imageid = $(this).data('imageid');
				var userid = $(this).data('userid');
				var likeid = $("#" + imageid);
				
				if(imageid != "" && userid != ""){
		
				var data = "&i=" + imageid + "&u=" + userid;
                                
				$.ajax({
				method: "post",
				url: url + "/feed/likePost?",
				data: data,
				//Als het bestaat OK
				success: function(data){
					
					if(data == 'success') {
							load.addClass(' hidden');
							load.siblings().removeClass('hidden');
							load.siblings().addClass('clicked');
							
								var like = parseInt(likeid.text());
	
								likeid.text(function(i, c) {
								
								if(like == 0) {
									var likesall = Number(like) + 1 + " like";
								} else {
									var likesall = Number(like) + 1 + " likes";
								}
								
								return likesall;
								}); 
							console.log("Foto is succesvol geliked");
					}
				}
			});
			}
			}
			else if (type == 'unlike') {

				var imageid = $(this).data('imageid');
				var userid = $(this).data('userid');
				var likeid = $("#" + imageid);
	
				if(imageid != "" && userid != ""){
						var data = "&i=" + imageid + "&u=" + userid;
				$.ajax({
				method: "post",
				url: url + "/feed/unlikePost?",
				data: data,
				//Als het bestaat OK
				success: function(data){
					
					if(data == 'success') {
							load.addClass(' hidden');
							load.siblings().removeClass('hidden');
							load.siblings().removeClass('clicked');
							
								var like = parseInt(likeid.text());
	
								likeid.text(function(i, c) {
								
								if(like == 2) {
									var likesall = Number(like) - 1 + " like";
								} else {
									var likesall = Number(like) - 1 + " likes";
								}
								
								return likesall;
								}); 
							
							console.log("Foto is succesvol geunliked");
					}
				}
			});
				}
				
			}
		});
	}
	// Comment user
	var commentUser = function() {
               var url = $(location).attr('origin');
               
		$('.comments_input').keyup(function(e) {
                    if($(this).val()) {
                        
                        if(e.keyCode == 13) {
                            
			var image_id = $(this).attr('image_id');
			var user = $(this).attr('user');
			var comment = $(this).val();
			
			$.post(url + '/feed/addComment' , { 
                            image_id: image_id, 
                            comment: comment
                        });
			$(this).parent().children('.comments').append('<p><a href="#" class="name">' + user + '</a> <span>' + comment + '</span></p>');        
			$('.comments_input').val('');
			console.log("Bericht is succesvol geplaatst");
			
                        }
                    } 
                    else 
                    {
                        return;
                    }
		});
                
	}
	
var doubleclicklike = function() {
		
		$(".instagram-content .photo-box .image-wrap img").on('dblclick', function () {
			alert("Hier word nog aan gewerkt!");
		});
		
}
	