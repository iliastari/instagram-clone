$(document).ready(function() {
	
	$('#instafeed').on('dragstart', 'img', function(event) { event.preventDefault(); });
        
        var url = $(location).attr('origin');
	var flag = 0;
	$.ajax({
		type: "GET",
		url: url + "/feed/posts",
		data: {
			'offset':0,
			'limit':2
		},
		success: function(data){
			
			$('#all_feed_content').append(data);
			likeUser();
			commentUser();
			doubleclicklike();
			flag += 2;
		}
	
	});
	//ajax end
	$(window).scroll(function() {
		
	if($(window).scrollTop() >= $(document).height() - $(window).height()) {
		
			$.ajax({
			type: "GET",
			url: url + "/feed/posts",
			data: {
				'offset':flag,
				'limit':2
			},
			success: function(data){
				
				$('#all_feed_content').append(data);
				likeUser();
				commentUser();
				doubleclicklike();
				flag += 2;
			
			}

			});
		}
	});
	
});