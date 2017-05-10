function searchq(e) {
	var searchVal = $("input[name='search']").val();
        var url = $(location).attr('origin');
        
	$.post(url + "/feed/search", {searchVal: searchVal}, function(data) {
		
	if(searchVal == "")  {
			$("#searchData").hide();
			$("#searchData").html("");
		} else {
			$("#searchData").fadeIn();
			$("#searchData").html(data);
			}
	$(document).click(function(){  
	$('#searchData').hide(); //hide the button
	});
	});
}
