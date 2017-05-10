$(document).ready(function() {
$('.profile-wrap').on('dragstart', 'img', function(event) { event.preventDefault(); });

$("#userImages").sortable({
	
	containment: 'parent', 
	tolerance: 'pointer', 
	cursor: 'pointer'
	
});

var overlay = $("<div id='overlay'></div>");
var image = $("<img id='userImage' class='noclick'>");
var close = $("<img id='closeImage'>");
var container = $("<div id='container' class='noclick'></div>");
var info = $("#imgUserInfo");

$("body").append(overlay);
container.append(image,info);
overlay.append(container,close);

$.fn.disableScroll = function() {
    window.oldScrollPos = $(window).scrollTop();

    $(window).on('scroll.scrolldisabler',function ( event ) {
       $(window).scrollTop( window.oldScrollPos );
       event.preventDefault();
    });
};
$.fn.enableScroll = function() {
    $(window).off('scroll.scrolldisabler');
};
$("#userImages a").click(function(e) {
	
	$("html").disableScroll();
	$("html").css("position:fixed");
	e.preventDefault();
	var imageSource = $(this).attr("href");
	image.attr("src", imageSource);
	close.attr("src", "../assets/images/mediaconnect/close_overlay.png");
	overlay.show();
	
});

close,$("#overlay").click(function(e) {
	if ($(e.target).hasClass('noclick')) {
         return;
		 
    } else  {
		
		$("html").enableScroll();
		$(overlay).hide();
		
	}
});

});
