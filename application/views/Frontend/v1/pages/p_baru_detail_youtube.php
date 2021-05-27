<section class="my-md-5 my-2">
	<div class="container">
		<?= form_open(base_url('frontend/v1/post/update_post_youtube/1'), ['id' => 'f_post'], ['id_berita' => $post->id_berita]) ?>
		<div id="title" class="sr-only"><?= $post->judul ?></div>
		<div class="row">
			<div class="col-md-8 mt-md-5">
				<span class="badge badge-pill badge-light p-3 mb-2">#<?= $this->postlist->get_namakategori($post->fid_kategori) ?></span>
				<div class="d-flex mb-3">
					<div class="w-100">
						<label for="judul">Judul</label>
						<input type="text" id="judul" name="judul" value="<?= $post->judul ?>" class="form-control form-control-lg">
					</div>
				</div>
				<div class="form-group">
					<label for="basic-url">URL Video Youtube</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3">https://www.youtube.com/watch?v=</span>
						</div>
						<input type="text" class="form-control form-control-lg" name="content" value="<?= $post->content ?>" id="basic-url" aria-describedby="basic-addon3">
					</div>
				</div>
				<div class="form-group">
					<select name="tags[]" id="tags" class="form-control" multiple="multiple" readonly>
						<?php
						foreach ($tags as $t) :
							$tag = $post->tags;
							$fid_tags = explode(",", $tag);
						?>
							<option <?= in_array($t->nama_tag, $fid_tags) ? 'selected' : '' ?> value="<?= $t->nama_tag ?>"><?= $t->nama_tag ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-primary mt-2"><i class="far fa-share-square mr-2"></i>Update & Publish</button>
				</div>
			</div>
			<div class="col-md-4 mt-md-5">
				<div id="preview"></div>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</section>
<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2-materialize.css') ?>">
<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script>
// select tags
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
			<b>${res.items[0].snippet.title}</b>
			<p class="text-mutted mt-3">${res.items[0].snippet.channelTitle}</p>
		`);
		$("input[name='judul']").val(res.items[0].snippet.title);
	});
}
function message(x,y) {
	notif({
		msg: `<i class='fas fa-check-circle mr-2'></i> ${x}`,
		type: y,
		position: "bottom",
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
})
</script>