<section class="my-md-5 my-2">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-4 d-none d-md-block">
				<div class="d-flex justify-content-center align-items-center h-100">
					<div>
						<img src="<?= base_url('assets/images/bg/Gak Pusying.235aa0ce.png') ?>" class="img-fluid w-100">
					</div>
				</div>
			</div>
			<div class="col-md-8 mt-md-5">
				<?= form_open(base_url('frontend/v1/post/baru_detail'), ['autocomplete' => 'off', 'class' => 'toggle-disabled form_horizontal', 'id' => 'f_buatjudul']) ?>
				<div class="card bg-white border-0">
					<div class="card-header rounded border-0 shadow-sm d-flex justify-content-between">
						<!-- <a href="#" onclick="window.history.back(-1)" class="btn btn-inline-block text-muted btn-link rounded-0"><i class="fas fa-2x fa-times-circle"></i></a> -->
						<div class="font-weight-bold text-uppercase">buat postingan baru</div>
						<div><i class="fas fa-times-circle"></i></div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="text" data-validation-event="keyup" data-validation="required,length,alphanumeric" data-validation-length="min5" data-validation-allowing=". _'-" data-sanitize="capitalize" name="judul" class="form-control form-control-lg" id="judul" onchange="slug()" onkeyup="slug()" aria-describedby="judulBlockHelp" placeholder="Masukan judul postingan disini...">
							<small id="judulBlockHelp" class="form-text my-2"><i>Slug:</i> <span class="text-muted" id="judul_slug"></span></small>
						</div>
						<div class="form-group">
							<label for="typepost" class="text-danger font-weight-bold">Type Post</label>
							<div id="typepost" class="btn-group btn-group-toggle d-flex flex-wrap justify-content-between align-items-center" data-toggle="buttons">
								<label class="btn btn-outline-primary  flex-grow-1 my-1 text-nowrap">
									<input type="radio" name="type" value="BERITA"> 
									<i class="fas fa-newspaper mr-2"></i><br> Berita
								</label>
								<label class="btn btn-outline-primary flex-grow-1 my-1 text-nowrap">
									<input type="radio" name="type" value="LINK"> 
									<i class="fas fa-link mr-2"></i><br> Link
								</label>
								<label class="btn btn-outline-primary flex-grow-1 my-1 text-nowrap">
									<input type="radio" name="type" value="SLIDE"> 
									<i class="fas fa-images mr-2"></i><br> Slide
								</label>
								<label class="btn btn-outline-primary flex-grow-1 my-1 text-nowrap">
									<input type="radio" name="type" value="YOUTUBE"> 
									<i class="fab fa-youtube mr-2"></i><br> Youtube
								</label>
							</div>
						</div>
						<div class="form-group">
						<label for="kategori" class="text-danger font-weight-bold">Pilih Kategori Postingan Kamu <span class="change_label font-weight-bold text-muted"></span></label>
							<div id="kategori"  style="overflow-x: auto;" class="btn-group btn-group-toggle d-flex flex-row flex-nowrap justify-content-start" data-toggle="buttons">
								<?php foreach ($kategori as $k) : ?>
									<label class="btn btn-outline-secondary rounded-pill my-1 text-nowrap">
										<input type="radio" name="kategori" value="<?php echo $k->id_kategori ?>" id="<?php echo $k->id_kategori ?>" data-title="<?= $k->nama_kategori ?>">
										#<?php echo $k->nama_kategori ?>
									</label>
								<?php endforeach; ?>
							</div>
						</div>
						<button type="submit" class="btn mt-3 rounded btn-primary"><i class="fas fa-save mx-2"></i> Lanjutkan <i class="fas fa-arrow-right ml-2"></i></button>
					</div>
					<div class="devider-line d-none d-md-block d-lg-block" style="height:55px;"></div>
				</div>
				<?= form_close() ?>
			</div>
		</div>

	</div>
</section>
<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script>
	$("input[name='judul']").focus();
	$(function () {
		$.validate({
          form: '#f_buatjudul',
          lang: 'en',
          showErrorDialogs: true,
          modules: 'toggleDisabled, security, html5, sanitize',
          disabledFormFilter: 'form.toggle-disabled',
          onError: function($form) {
             notif({
				msg: "Form Error, silahkan lengkapi formulir",
				type: "error",
				position: "bottom",
				offset: -10,
			}); 
          },
          onSuccess: function($form) {
              var _this = $form;
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
              return false; // Will stop the submission of the form
              $form.removeClass('toggle-disabled');
              $form.get(0).reset();
          }
      });
	});
	function slug() {
		var x = document.getElementById("judul");
		var y = document.getElementById("judul_slug");
		y.innerHTML = x.value.toLowerCase().replace(/\s/g, "-");
	}
	
</script>