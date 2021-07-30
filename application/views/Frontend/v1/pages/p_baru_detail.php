<?php $id_berita = $this->uri->segment(5) ?>
<section class="my-5">
	<div class="container">
		<?= form_open_multipart(base_url('frontend/v1/post/update_post/1'), ['id' => 'f_post', 'data-id' => $post->id_berita]) ?>
		<div class="row">
			<div class="col-md-8 mt-5">
				<div class="d-flex mb-3">
					<div class="w-100">
						<label for="judul">Judul</label>
						<input type="text" id="judul" name="judul" value="<?= $post->judul ?>" class="form-control form-control-lg">
					</div>
				</div>
				<div class="form-group">
					<label for="content">Content <span class="badge badge-pill badge-light p-2">#<?= $this->postlist->get_namakategori($post->fid_kategori) ?></span></label>
					<textarea class="form-control border-light " name="content" id="content" rows="3"><?= $post->content ?></textarea>
				</div>
			</div>
			<div class="col-md-4 mt-md-4">

				<div id="accordionExample" class="accordion mt-3">
					<?php if($post->type !== 'SLIDE'): ?>
					<!-- Accordion item 1 -->
					<div class="card rounded-0">
						<div class="card-header shadow-sm border-0">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Photo utama</a>
							</h6>
						</div>
						<div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show border-0">
							<div class="card-body">
								<?php if (!empty($post->img_blob)) : ?>
									<img id="single-photo" src="data:image/jpeg;base64,<?= base64_encode($post->img_blob) ?>" alt="photo_berita" class="img-fluid border rounded shadow-sm">
									<button id="upload-img" type="button" class="btn btn-block btn-outline-danger my-2 d-block"><i class="fas fa-upload mr-2"></i>Ganti gambar</button>
									<input type="file" id="FileUpload" class="d-none" />
								<?php else : ?>
									<img id="single-photo" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/undraw_folder_x4ft.svg') ?>" class="img-fluid mx-auto d-block" alt="noimage">
									<p class="text-center text-nowrap my-2" id="FilePath">Gambar tidak ditemukan ?</p>
									<button id="upload-img" type="button" class="btn btn-outline-danger my-2 d-block mx-auto"><i class="fas fa-upload mr-2"></i>Upload</button>
									<input type="file" id="FileUpload" class="d-none" />
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if($post->type === 'SLIDE'): ?>
					<!-- Accordion item 3 -->
					<div class="card rounded-0">
						<div class="card-header shadow-sm border-0 d-flex justify-content-between align-items-center">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="false" aria-controls="collapseTree" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Photo terkait</a>
							</h6>
							<button type="button" data-toggle="modal" data-target="#uploadPhoto" id="upload" class="btn btn-sm btn-outline-primary rounded-circle"><i class="fas fa-plus"></i></button>
						</div>
						<div id="collapseTree" aria-labelledby="headingTree" data-parent="#accordionExample" class="collapse show">
								<div class="row no-gutters" id="list_photo_terkait"></div>
						</div>
					</div>
					<?php endif ?>
					<!-- Accordion item 2 -->
					<div class="card rounded-0">
						<div class="card-header shadow-sm border-0">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Tags / Label</a>
							</h6>
						</div>
						<div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse">
							<div class="card-body">
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
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mt-2"><i class="far fa-share-square mr-2"></i>Publish</button>
					<button type="button" id="draf" data-id="<?php echo $post->id_berita ?>" class="btn btn-secondary mt-2">
						<span class="fas fa-hourglass-end mr-2"></span>Draf
					</button>
					<button type="button" id="batal" class="btn btn-danger mt-2">
						<span class="fas fa-times-circle mr-2"></span> Batal
					</button>
				</div>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</section>
<!-- Modal -->
<div class="modal" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?= form_open_multipart(base_url('frontend/v1/post/upload_single_photo_terkait/'.$id_berita), ['class' => 'dropzone']) ?>
      <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2-materialize.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/dropzone/min/dropzone.min.css') ?>">
<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('files/tinymce/js/tinymce.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/dropzone/min/dropzone.min.js'); ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script>
	/*select tags*/
	var label = $("select#tags").select2({
		placeholder: 'Pilih tags',
		tags: true,
		tokenSeparators: [',', ' '],
		width: 'resolve',
	});

	$(document).ready(function() {
		/*Message*/
		function message(x,y) {
			notif({
				msg: `<i class='fas fa-info-circle mr-2'></i> ${x}`,
				type: y,
				position: "bottom",
			});
		}

		/*Image Preview*/
		function readURL(input, $element) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$($element).attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]); /*convert to base64 string*/
			}
		}
		/*inisialisasi tinymce content editor*/
		var tiny = tinymce.init({
			selector: "#content",
			theme: "silver",
			height: 500,
			plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak tabfocus searchreplace codesample help",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor code fullscreen"
			],
			content_css: [
				'<?= base_url("bower_components/bootstrap/dist/css/bootstrap.min.css") ?>',
			],
			content_style: "body{padding: 20px}",
			relative_urls: false,
			remove_script_host: false,
			convert_urls: true,
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
			/* filemanager_crossdomain: true,*/
			image_advtab: true,
			external_filemanager_path: "<?= base_url('files/filemanager-v2/filemanager/') ?>",
			filemanager_title: "Filemanager",
			external_plugins: {
				"filemanager": "<?= base_url('files/filemanager-v2/filemanager/plugin.min.js') ?>"
			}
		});
				
		/* upload single photo berita */
		var fileupload = $("#FileUpload");
		var filePath = $("p#FilePath");
		var button = $("#upload-img");
		button.click(function() {
			fileupload.click();
		});

		fileupload.change(function() {
			var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
			filePath.html("<b>Filename: </b>" + fileName);
			readURL(this, $('img#single-photo'));

			var form_data = new FormData();
			form_data.append("file", this.files[0]);

			var oFReader = new FileReader();
			oFReader.readAsDataURL(this.files[0]);

			let $online = _uriSegment[5];
	    let $local = _uriSegment[6];
	    let $id = $host ? $local : $online;
			
			$.ajax({
				url: _uri + "/frontend/v1/post/upload_single_photo/" + $id,
				method: "POST",
				data: form_data,
				contentType: false,
				cache: false,
				dataType: 'json',
				processData: false,
				beforeSend: function() {
					button.html("<img class='mx-auto d-block py-1' src='" + _uri + "/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg'>");
					$('img#single-photo').css({
						opacity: 0.3
					})
				},
				success: function(data) {
					if (data == true) {
						notif({
							msg: "<i class='fas fa-check-circle'></i> Photo terpengaruh.",
							type: "warning",
							position: "bottom",
							offset: -10,
						});
						$('img#single-photo').css({
							opacity: 1
						})
					}
					button.html('<i class="fas fa-upload mr-2"></i> Ganti gambar');
				}
			});
		});

		$(document).on("click", "button#batal", function() {
			window.history.back(-1);
		});

		/* draf */
		$(document).on("click", "button#draf", function() {

			var id = $(this).attr('data-id');
			let judul = $("input[name='judul']").val();
			let isi = tinymce.get("content").getContent();
			let tags = $('select[name="tags[]"]').val();

			/*console.log(img_blob)*/;
			$.post('<?= base_url("frontend/v1/post/update_post/0") ?>', {
					id: id,
					judul: judul,
					content: isi,
					tags: tags
				},
				function(response) {
					if (response.valid == true) {
						notif({
							msg: "<i class='fas fa-check-circle'></i> Postingan disimpan sementara!",
							type: "info",
							position: "bottom",
							offset: -10,
						});
					}
				}, 'json'
			);
		});

		/* publish */
		$(document).on("submit", "form#f_post", function(e) {
			e.preventDefault();

			let Url = $(this).attr('action');
			let Method = $(this).attr('method');

			let id = $(this).attr('data-id');
			let judul = $("input[name='judul']").val();
			let isi = tinymce.get("content").getContent();
			let tags = $('select[name="tags[]"]').val();

			notif_confirm({
				'textaccept': 'Publish',
				'textcancel': 'Batal',
				'fullscreen': true,
				'message': 'Apakah anda yakin akan mempublish postingan tersebut?',
				'callback': function(choice) {
					if (choice) {
						$.ajax({
							url: Url,
							method: Method,
							data: {
								id: id,
								judul: judul,
								content: isi,
								tags: tags
							},
							dataType: 'json',
							success: function(res) {
								if (res.valid == true) {
									notif({
										msg: "<i class='fas fa-check-circle'></i> Postingan Published",
										position: "bottom",
										offset: -10,
										bgcolor: "#000",
										color: "#fff",
										timeout: 2500,
									});
								}
							}
						});
					}
				}
			});
		});
	});

	/*Photo Terkait*/
	list_photo_terkait();
	function list_photo_terkait()
	{
		$("#list_photo_terkait").html(`<div class="d-flex justify-content-center align-items-center w-100 h-100">
				<div class="loader_small" style="width:30px; height:30px;"></div>
			</div>`);
		let $online = _uriSegment[5];
    let $local = _uriSegment[6];
    let $id = $host ? $local : $online;
		let id_berita = $id;
		$.getJSON(`${_uri}/frontend/v1/post/list_photo_terkait`, {id: id_berita}, function(result) {
			$("#list_photo_terkait").html(result);
			console.log(result);
		});
	}

	$(document).on("click", "a#delete_photo_terkait", function(e) {
		e.preventDefault();
		let $this = $(this);
		let $Url = $this.attr('href');
		$.post(`${$Url}`, function(res) {
			list_photo_terkait();
			notif({
				msg: res,
				type: "info",
				position: "bottom",
				/*offset: -10,*/
			});
		}, 'json');
	})
	
	Dropzone.autoDiscover = false;
	$(".dropzone").dropzone({  
			paramName: "file", /*The name that will be used to transfer the file*/
  		maxFilesize: 1, /*MB*/
  		resizeWidth: 300,
  		resizeHeight: 300,
  		resizeMethod: 'crop', 
  		resizeQuality: 0.8,
  		acceptedFiles: '.jpeg,.jpg,.png',
  		addRemoveLinks: true,
  		init: function() {
		    this.on("complete", function(file) { list_photo_terkait(); });
		  }
	});
</script>