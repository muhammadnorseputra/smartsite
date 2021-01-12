$(document).ready(function () {
  	var $backToTop = $(".btn-backtop");
  	$backToTop.hide();
  	$(window).on('scroll loaded', function () {
  		if ($(this).scrollTop() > 100) {
  			$backToTop.slideDown();
  		} else {
  			$backToTop.fadeOut();
  		}
  	});

  	$backToTop.on('click', function (e) {
  		$("html, body").animate({
  			scrollTop: 0
  		}, 1000);
  	});
});