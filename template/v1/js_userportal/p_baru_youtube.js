/*select tags*/
var label = $("select#tags").select2({
	placeholder: 'Pilih tags',
	tags: true,
	tokenSeparators: [',', ' '],
	width: 'resolve',
});
preview_yt($('input[name="content"]').val());
function preview_yt(id) {
	$.getJSON(`${_uri}/frontend/v1/post/preview_url_youtube/${id}`, function(res) {
		$("#preview").html(`
			<img src="${res.items[0].snippet.thumbnails.high.url}" class="img-fluid w-100 rounded mb-3">
			<p class="text-primary">${res.items[0].snippet.channelTitle}</p>
			<b>${res.items[0].snippet.title}</b>
			<p class="text-muted small">${res.items[0].snippet.description.substr(0,70)}</p>
		`);
		$("input[name='judul']").val(res.items[0].snippet.title);
	});
}
function message(x,y) {
	notif({
		msg: `<i class='fas fa-check-circle mr-2'></i> ${x}`,
		type: y,
		position: "bottom",
		offset: '-10'
	});
}
$(function() {
	$("form#f_post").on('submit', function(e) {
		e.preventDefault();
		let _this = $(this);
		$.post(_this.attr('action'), _this.serialize(), function(res) {
			message('Postingan berhasil diupdate', 'success');
		}, 'json');
	})
	$("input[name='content']").on('change', function() {
		let id = $(this).val();
		if(id!=''){
			preview_yt(id);
		} else {
				$("input[name='judul']").val($("#title").html());
				$("#preview").html(``);
		}
	});
});