$(document).ready(function() {
	$("a#module").on("click", function(e) {
		e.preventDefault();
		let $this = $(this);
		let $url = $this.attr('href');
		let $container = $("#containerModule");
		$.ajax({
			url: $url,
			method: 'post',
			dataType: 'html',
			beforeSend: preloadModule,
			success: function(res) {
				$container.html(res);
			}
		});

		function preloadModule()
		{
			$container.html(`<p class="d-block my-5"><img class="d-block mx-auto my-md-5 py-md-5" width="40" src="${_uri}/bower_components/SVG-Loaders/svg-loaders/vtree.svg"></p>`);
		}
	})
});