<section class="my-5">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-8 offset-md-2 mt-5">
				<?= form_open(base_url('frontend/v1/post/baru_detail'), ['class' => 'form_horizontal', 'id' => 'f_buatjudul']) ?>
				<div class="card border-0 shadow-sm">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								<a href="#" data-toggle="tooltip" data-placement="right" title="Batal" onclick="window.history.back(-1)" class="btn btn-inline-block py-3 text-muted btn-link rounded-0"><i class="fas fa-2x fa-times-circle"></i></a>
							</div>
							<div class="col-md-11">
								<button type="submit" class="btn mt-3 rounded-pill btn-outline-primary float-right">Simpan & Lanjutkan</button>
							</div>
						</div>
					</div>


					<div class="card-header bg-light rounded-0 text-dark border-light">
						<h4 class="card-title font-weight-bold my-3">Buat judul postinganmu bosqu!</h4>
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="text" name="judul" class="form-control form-control-lg" id="judul" autocomplete="false" onchange="myFunction()" onkeyup="myFunction()" aria-describedby="judulBlockHelp" placeholder="Buat judul postingan kamu disini.">
							<small id="judulBlockHelp" class="form-text text-dark my-2"><i>Slug:</i> <span class="text-muted" id="judul_slug"></span></small>
						</div>
						<label for="kategori" class=" text-danger">Pilih Kategorimu: <span class="change_label font-weight-bold text-dark"></span></label>
						<div class="form-group">
							<div class="btn-group btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
								<?php foreach ($kategori as $k) : ?>
									<label class="btn btn-outline-light text-dark rounded-0 mx-1 my-1 text-nowrap">
										<input type="radio" name="kategori" value="<?php echo $k->id_kategori ?>" id="option2" autocomplete="off" data-title="#<?php echo $k->nama_kategori ?>">
										#<?php echo $k->nama_kategori ?>
									</label>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</section>
<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script>
	function myFunction() {
		var x = document.getElementById("judul");
		var y = document.getElementById("judul_slug");
		y.innerHTML = x.value.toLowerCase().replace(/\s/g, "-");
	}

	$("input[name='kategori']").on("click", function() {
		var val = $(this).attr('data-title');
		$("span.change_label").text(val);
		// alert(val)
	})

	$(document).on("submit", "form#f_buatjudul", function(event) {
		event.preventDefault();
		var _this = $(this);
		var method = _this.attr('action');
		var act = _this.attr('action');
		var data = _this.serialize();
		$.post(act, data, function(response) {

			if (response.valid == true) {
				alert(response.pesan);
				window.location.href = _uri + '/frontend/v1/post/postDetail/' + response.id;
			} else {
				notif({
					msg: response.pesan,
					type: "error",
					position: "bottom",
					offset: -10,
				});
			}
		}, 'json')
	})
</script>