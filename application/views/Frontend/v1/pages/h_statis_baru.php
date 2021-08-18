<section class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 my-md-5">
			<?= form_open_multipart(base_url('frontend/v1/halaman/doAdd/'), ['id'=>'f_add_halaman']) ?>
				<!-- form title halaman -->
				<div class="card mb-3 bg-white">
					<div class="card-header pb-0 bg-white border-bottom-0">
						<h5 class="card-title">Title Halaman</h5>
					</div>
					<div class="card-body">
						<div class="form-group">
						    <input type="title" name="title" class="form-control form-control-lg"aria-describedby="titleHelp">
						    <small id="titleHelp" class="form-text text-muted">Buat title halaman kamu, biar terlihat keren.</small>
						  </div>
					</div>
				</div>
				<!-- form cotent halaman -->
				<div class="card bg-white">
					<div class="card-header bg-transparent border-bottom-0">
						<h5 class="card-title">Content 
							<button type="button" id="upload-lampiran" class="btn btn-light rounded-pill float-right"><i class="fas fa-upload mr-2"></i> upload-lampiran</button>
							<span class="filename badge badge-info"></span>
							<input type="file" name="lampiran" class="form-control d-none">
						</h5>
					</div>
					<div class="card-body px-0 bg-transparent border-0">
						<div class="form-group">
						    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
						  </div>
					</div>
					<div class="card-footer border-top-0 bg-transparent">
						<button type="submit" id="save" class="btn btn-primary mr-3"><i class="fas fa-save mr-2"></i> Publish Halaman</button>
						<button type="button" onclick="window.history.back(-1)" class="btn btn-danger"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
					</div>
				</div>
			<?= form_close(); ?>
			</div>
		</div>
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
			/*apiKey: "E5EXDFLT",*/
			mobile: {
			    theme: 'mobile',
			    plugins: [ 'autosave', 'lists', 'autolink' ]
			  },
			plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak tabfocus searchreplace codesample help",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor code fullscreen",
			/*"n1ed"*/
			],
			content_css: [
			'<?= base_url("vendor/twbs/bootstrap/dist/css/bootstrap.min.css") ?>',
			],
			content_style: "body{padding: 10px}",
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
			/* filemanager_crossdomain: true,*/
			image_advtab: true ,
			external_filemanager_path:"<?= base_url('files/filemanager-v2/filemanager/') ?>",
			filemanager_title:"Filemanager",
			external_plugins: { "filemanager" : "<?= base_url('files/filemanager-v2/filemanager/plugin.min.js') ?>"}
		});
		
		let fileupload = $("input[name='lampiran']");
    	let btnUpload = $("button#upload-lampiran");
		btnUpload.click(function () {
            fileupload.click();
        });

        fileupload.change(function () {
	        var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
	        $("span.filename").html(fileName);
    	});

		$(document).on("submit", "form#f_add_halaman", function(e){
			e.preventDefault();
			let _this = $(this);
			let $url = _this.attr('action');
			let $method = _this.attr('method');
			let $data = new FormData(_this[0]);

			$.ajax({
				url: $url,
				method: $method,
				data: $data,
				dataType: 'json',
				contentType: false,
    			processData: false,
				beforeSend: berforeLoad,
				success: suksesAdd,
				complete: function() {
					_this[0].reset();
				}
			});
		});

		function berforeLoad()
		{
			$("button#save").html('Loading ...').prop("disabled", true);
		}

		function suksesAdd(response)
		{
			notif({
				msg: "<i class='fas fa-check-circle'></i> Halaman Published",
				bgcolor: "#000",
				color: "#fff",
				position: "bottom",
				timeout: 3000,
				callback: myCallBack,
			});
			$("button#save").html(`<i class="fas fa-save mr-2"></i> Publish Halaman`).prop("disabled", false);
		}

		function myCallBack() {
			/*window.history.back(-1);*/
			$("span.filename").html('');
		}
	});
</script>