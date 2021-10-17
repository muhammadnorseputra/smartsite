<script>
		$(function() {
				/*tippy('[data-hover="hover"]', {
					placement: 'bottom',
					arrow: true,
					followCursor: false,
					interactiveBorder: 5
				});*/
		});

		loadIcon();

		function loadIcon() {
			jQuery.get('<?= base_url("backend/module/c_icons/listicon") ?>', function (response) {
				jQuery("#IconReferensi").html(JSON.parse(response));
			});
		}

		$("[name='namaicon']").on('keyup', function (e) {
			e.preventDefault();
			let filed = jQuery(this);
			if (filed.val() == '') {
				jQuery("#review-icon").html('<em class="glyphicon glyphicon-plus"></em>');
			} else {
				jQuery("#review-icon").html('<em class="material-icons font-21">' + filed.val() + '</em>');
			}
		});


		jQuery("[name='kataicon']").on('keyup', function (e) {
			e.preventDefault();
			let filed = jQuery(this);
			if (filed.val() == '') {
				loadIcon();
			} else {
				jQuery.post('<?= base_url("backend/module/c_icons/search") ?>', {
					kata: filed.val()
				}, function (response) {
					jQuery("#IconReferensi").html(JSON.parse(response));
				});
			}
		});

		$("#FormIcon").on('submit', function (e) {
			e.preventDefault();
			var me = jQuery(this);
			jQuery.post(me.attr('action'), me.serialize(), function (data) {
				showNotification(data.type, data.pesan, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
				me[0].reset();
				loadIcon();
				jQuery("#review-icon").html('<em class="glyphicon glyphicon-plus"></em>');
			}, 'json').then(() => {
				$.Mprog.starts(3, '.card .header', true);
			}).done(() => {
				$.Mprog.starts(3, '.card .header', false).end(true);
			});
		});
		
</script>