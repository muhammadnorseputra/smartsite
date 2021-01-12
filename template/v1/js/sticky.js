$(document).ready(function () {
	var stickySidebar = $.fn.stickySidebar.noConflict(); // Returns $.fn.stickySidebar assigned value.
	$.fn.stickySidebar = stickySidebar; // Give $().stickySidebar functionality.
	
  	$('#sidebar, .post-list-view, .banner-list, .public_profile_menus, .ig-profile').stickySidebar({
  		topSpacing: 80, //80
  		bottomSpacing: 30,
	    resizeSensor: true,
	    stickyClass: 'is-affixed',
	    minWidth: 0
  	});

	// var prevScrollpos = window.pageYOffset;
	// window.onscroll = function () {
	// 	var currentScrollPos = window.pageYOffset;
	// 	if (prevScrollpos > currentScrollPos) {
	// 		document.getElementById("navbar").style.top = "0";
	// 	} else {
	// 		document.getElementById("navbar").style.top = "-65px";
	// 	}
	// 	prevScrollpos = currentScrollPos;
	// }
});