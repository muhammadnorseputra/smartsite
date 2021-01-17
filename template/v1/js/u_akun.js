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
			$container.html(`<div id="loader" class="m-2"></div> `);
		}
	})
});