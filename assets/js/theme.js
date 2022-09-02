$(".demo-choose-skin li").on('click', function (e) {
	e.preventDefault();
	let theme = $(this).attr('data-theme');
	let id = $(this).attr('data-id');
	let id_active = $(this).attr('data-id-active');
	let getlink_active = $(this).attr('data-active');
	let getlink_off = $(this).attr('data-off');

	if (id_active == id) {
		var id_actives = id;
	} else {
		$(".demo-choose-skin li").attr('data-id-active', id);
		var id_actives = id_active;
	}

	$.ajax({
		url: getlink_active,
		method: 'GET',
		data: 'idskin=' + id,
		beforeSend: function () {
			UpdateSkinNon(getlink_off, id_actives);
		},
		success: function (response) {
			showNotification('bg-teal', 'Tema <b>' + theme + '</b> Telah Aktif', 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
		}
	});
});

function UpdateSkinNon(off, id) {
	jQuery.get(off, 'idskin_now=' + id, function (resonse) {});
}
