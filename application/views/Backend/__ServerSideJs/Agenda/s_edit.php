<script>
	$(document).ready(function() {
		$('input, textarea').css({
			color: 'grey'
		});
	});

	$("#FormUpdateAgenda").on('submit', function(e) {
		e.preventDefault();
		let fr = $(this);
		$.ajax({
			url: fr.attr('action'),
			method: 'POST',
			dataType: 'json',
			data: fr.serialize(),
			beforeSend: function() {
				$.Mprog.starts(3, '.FormUpdateAgenda', true);
			},
			success: function(result) {
				showNotification(result.message.color, result.message.content, 'bottom', 'center', '', '');
				setTimeout(() => {
					window.history.back(-1);
				}, 1500);
			},
			complete: function() {
				$.Mprog.starts(3, '.FormUpdateAgenda', false).end(true);
			}
		});
	});
</script>
