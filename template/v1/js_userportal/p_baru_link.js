/*select tags*/
var label = $("select#tags").select2({
	placeholder: 'Pilih tags',
	tags: true,
	tokenSeparators: [',', ' '],
	width: 'resolve',
});

function clearForm(target) {
	return $(target).val('');
}

$("label i#trash").on("click", function() {
	clearForm("input[name='content']");
	$("#preview").html(``);
});

preview_link($('input[name="content"]').val());
function preview_link(url) {
	$.post(`${_uri}/frontend/v1/post/preview_url_link`, {url: url}, function(res) {
		let domain = (new URL(url));
		$("#preview").html(`
		<div class="bg-light rounded border">
			<img src="${res.image}" class="img-fluid w-100 rounded-top m-0 p-0">
			<div class="p-3">
			<p class="text-primary">${domain.hostname}</p>
			<b>${res.title}</b>
			<p class="mt-3 small text-muted">${res.description.substr(0,90)}</p>
			</div>
		</div>
		`);
		$("input[name='judul']").val(res.title);
	}, 'json');
}

function message(x,y) {
	notif({
		msg: `<i class='fas fa-check-circle mr-2'></i> ${x}`,
		type: y,
		position: "bottom",
	});
}

$(function() {
	$("#navbar").removeClass('d-md-block').addClass('d-md-none');
	$("form#f_post").on('submit', function(e) {
		e.preventDefault();
		let _this = $(this);
		$.post(_this.attr('action'), _this.serialize(), function(res) {
			message('Postingan berhasil diupdate', 'success');
		}, 'json');
	})
	$("input[name='content']").on('change', function() {
		let url = $(this).val();
		if(url!=''){
			preview_link(url);
		} else {
				$("input[name='judul']").val($("#title").html());
				$("#preview").html(``);
		}
	});
})