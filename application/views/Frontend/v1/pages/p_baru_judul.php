<section class="my-md-5 my-2">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-8 offset-md-2 mt-md-5">
				<?= form_open(base_url('frontend/v1/post/baru_detail'), ['class' => 'form_horizontal', 'id' => 'f_buatjudul']) ?>
				<div class="card shadow-sm bg-white">
					<div class="card-header bg-light rounded-0 border-light">
						<!-- <a href="#" onclick="window.history.back(-1)" class="btn btn-inline-block text-muted btn-link rounded-0"><i class="fas fa-2x fa-times-circle"></i></a> -->
						<h4 class="card-title font-weight-bold text-uppercase mt-2">buat postingan.</h4>
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="text" name="judul" class="form-control form-control-lg" id="judul" autocomplete="false" onchange="myFunction()" onkeyup="myFunction()" aria-describedby="judulBlockHelp" placeholder="Masukan judul postingan...">
							<small id="judulBlockHelp" class="form-text my-2"><i>Slug:</i> <span class="text-muted" id="judul_slug"></span></small>
						</div>
						<div class="form-group">
							<label for="typepost" class="text-danger font-weight-bold">Type Post</label>
							<div id="typepost" class="btn-group btn-group-toggle d-flex flex-wrap justify-content-start" data-toggle="buttons">
								<label class="btn btn-outline-primary rounded-pill my-1 text-nowrap">
									<input type="radio" name="type" value="BERITA"> 
									<i class="fas fa-newspaper mr-2"></i>Berita
								</label>
								<label class="btn btn-outline-primary rounded-pill my-1 text-nowrap">
									<input type="radio" name="type" value="LINK"> 
									<i class="fas fa-link mr-2"></i>Link
								</label>
								<label class="btn btn-outline-primary rounded-pill my-1 text-nowrap">
									<input type="radio" name="type" value="SLIDE"> 
									<i class="fas fa-images mr-2"></i>Slide
								</label>
								<label class="btn btn-outline-primary rounded-pill my-1 text-nowrap">
									<input type="radio" name="type" value="YOUTUBE"> 
									<i class="fab fa-youtube mr-2"></i>Youtube
								</label>
							</div>
						</div>
						<div class="form-group">
						<label for="kategori" class="text-danger font-weight-bold">Pilih Kategori Postingan Kamu <span class="change_label font-weight-bold text-muted"></span></label>
							<div id="kategori" class="btn-group btn-group-toggle d-flex flex-wrap justify-content-start" data-toggle="buttons">
								<?php foreach ($kategori as $k) : ?>
									<label class="btn btn-outline-secondary rounded-pill my-1 text-nowrap">
										<input type="radio" name="kategori" value="<?php echo $k->id_kategori ?>" id="<?php echo $k->id_kategori ?>" data-title="<?= $k->nama_kategori ?>">
										#<?php echo $k->nama_kategori ?>
									</label>
								<?php endforeach; ?>
							</div>
						</div>
						<button type="submit" class="btn mt-3 btn-block rounded-pill btn-primary">Lanjutkan</button>
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

	$("input[name='kategori']").on("click", function(e) {
		e.preventDefault();
		let val = $(this).attr('data-title');
		$("span.change_label").html(`(${val})`);
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
				notif({
					msg: response.pesan,
					type: "success",
					position: "bottom",
					offset: -10,
				});
				if(response.type == 'BERITA' || response.type == 'SLIDE') {
					window.location.href = _uri + '/frontend/v1/post/postDetail/' + response.id;
				} else if(response.type == 'YOUTUBE') {
					window.location.href = _uri + '/frontend/v1/post/postDetailYoutube/' + response.id;
				} else if(response.type == 'LINK') {
					window.location.href = _uri + '/frontend/v1/post/postDetailLink/' + response.id;
				}
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