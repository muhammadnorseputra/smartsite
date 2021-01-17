<section class="my-5">
	<div class="container">
			<?php $token = $_GET['token']; ?>
			<?= form_open_multipart(base_url('frontend/v1/halaman/update/'.$token), ['id'=>'f_edit_halaman']) ?>
			<div class="row">
				<div class="col-md-12 mt-md-5 mb-md-3">
					<!-- form title halaman -->
				<div class="card mb-3 rounded bg-white">
					<div class="card-header pb-0 bg-white border-bottom-0">
						<h5 class="card-title">Judul Halaman <span title="Dilihat" data-toggle="tooltip" data-placement="bottom" class="float-right py-1 px-3 border rounded"><i class="fas fa-eye text-muted mr-2"></i> <small><?= $h->views ?></small></span> </h5>
					</div>
					<div class="card-body">
						<div class="form-group">
						    <input type="title" name="title" value="<?= $h->title ?>" class="form-control form-control-lg" aria-describedby="titleHelp" placeholder="Masukan judul halaman kamu disini...">
						    <small id="titleHelp" class="form-text text-muted small font-italic">Usahakan judul halaman menggunakan huruf kecil semua dan hanya menggukana spasi tanpa karakter lain</small>
						  </div>
					</div>
				</div>
				</div>
			</div>
		<div class="row">
			<div class="col-md-8">
				<!-- form cotent halaman -->
				<div class="card border-0 rounded">
					<div class="card-header bg-white border">
						<h5 class="card-title">Isi halaman statis </h5>
					</div>
					<div class="card-body py-2 px-0 bg-white border-0">
						<div class="form-group">
						    <textarea class="form-control" name="content" id="content" rows="3">
						    	<?= $h->content ?>
						    </textarea>
						  </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php if(!empty($h->filename)): ?>
					 <object data="data:application/pdf;base64,<?= base64_encode($h->file) ?>" type="application/pdf" style="height:250px; width: 100%;"></object>
							<span class="badge badge-light">filename:</span>
							<span class="label">
								<?= $h->filename ?>
								</span> 
							<button  id="btn-upload-lampiran" type="button" class="btn btn-block btn-primary-old rounded-pill mt-2"><i class="fas fa-upload mr-2"></i> ganti-lampiran</button>
							<?php else: ?>
							<button id="btn-upload-lampiran" type="button" class="btn btn-block btn-primary-old rounded-pill"><i class="fas fa-upload mr-2"></i> upload-lampiran</button> 
							<?php endif; ?>
							<span class="filename badge badge-success"></span>
							<input type="file" name="lampiran" class="form-control d-none">
							<hr>
								<div class="custom-control custom-switch">
								  <input type="checkbox" name="etoken" class="custom-control-input" id="updateToken">
								  <label class="custom-control-label" for="updateToken">update token</label>	
								</div>
							<hr>
						<button type="button" onclick="window.history.back(-1)" class="btn btn-outline-danger rounded-pill"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
				<button type="submit" id="saveHalaman" class="btn rounded-pill btn-primary ml-3"><i class="fas fa-save mr-2"></i> Update</button>
			</div>
		</div>
			<?= form_close(); ?>
	</div>
</section>

<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('files/tinymce/js/tinymce.min.js'); ?>"></script>
<script>
	$(document).ready(function() {
		var tiny = tinymce.init({
			selector: "#content",
			height: 400,
			themes: "modern",
			mobile: {
			    theme: 'mobile',
			    plugins: [ 'autosave', 'lists', 'autolink' ]
			  },
			plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak tabfocus searchreplace codesample help",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor code fullscreen"
			],
			content_css: [
				'<?= base_url("vendor/twbs/bootstrap/dist/css/bootstrap.min.css") ?>',
			],
			content_style: "body{padding: 10px}",
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
			//  filemanager_crossdomain: true,
			image_advtab: true ,
			external_filemanager_path:"<?= base_url('files/filemanager-v2/filemanager/') ?>",
			filemanager_title:"Filemanager",
			external_plugins: { "filemanager" : "<?= base_url('files/filemanager-v2/filemanager/plugin.min.js') ?>"}
		});

		let fileupload = $("input[name='lampiran']");
    	let btnUpload = $("button#btn-upload-lampiran");
		btnUpload.click(function () {
            fileupload.click();
        });

        fileupload.change(function () {
	        var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
	        $("span.filename").html(fileName);
    	});
		
		$(document).on("submit", "form#f_edit_halaman", function(e){
			e.preventDefault();
			let _this = $(this);
			let $url = _this.attr('action');
			let $method = _this.attr('method');
			let $data = new FormData(_this[0]);

			$.ajax({
				url: $url,
				method: $method,
				data: $data,
				contentType: false,
    			processData: false,
				beforeSend: berforeLoad,
				success: suksesEdit,
			});
		});

		function berforeLoad()
		{
			$("button[type='submit']#saveHalaman").html(`<img class='mx-auto d-block py-1 px-4' src='${_uri}/bower_components/SVG-Loaders/svg-loaders/oval-white.svg'>`).prop("disabled", true);
		}

		function suksesEdit(result)
		{
			notif({
				msg: "<i class='fas fa-check-circle'></i> Halaman Updated",
				bgcolor: "#000",
				color: "#fff",
				position: "bottom",
				timeout: 2500,
				callback: callback_success(result)
			});	
		}
		function callback_success(result) {
			if(result != '') {
				var str = result;
				window.history.pushState({},"",`?token=${Number(str)}`);
				// $("input[name='etoken']").prop('checked', false);
				window.location.reload();
			}
			// console.log(str);
			$("button[type='submit']#saveHalaman").html(`<i class="fas fa-save mr-2"></i> Update`).prop("disabled", false);
		}
	});
</script>