$(function() {
var $grid = $('.grid').masonry({
	            transitionDuration: '0.8s',
	          });
	// layout Masonry after each image loads
	$grid.imagesLoaded().progress( function() {
	  $grid.masonry('layout');
	});
});