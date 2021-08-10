  <!DOCTYPE html>
  <html>

  <head>
  	<!--Import Google Icon Font-->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<!--Import materialize.css-->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  	<link rel="stylesheet" href="<?= base_url('assets/plugins/mprogres/css/mprogress.min.css') ?>">

  	<!--Let browser know website is optimized for mobile-->
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="<?php echo base_url('/files/tinymce/js/tinymce.min.js')?>"></script>

  </head>

  <body>
  	<nav class="black lighten-5">
  		<div class="container">
  			<div class="nav-wrapper">
  				<a href="#title" class="brand-logo modal-trigger"><i class="material-icons">edit</i>
  					<h5 class="truncate"> <?= $r[0]->title ?> </h5>
  				</a>
  				<ul id="nav-mobile" class="right hide-on-med-and-down">
  					<li><a class="waves-effect waves-light btn btn-save" href="javascript:void('save');" onclick="simpan()">Simpan</a>
  					</li>
  					<li><a class="waves-effect waves-light btn red" href="javascript:void('close');"
  							onclick="close_window()">Batal</a></li>
  				</ul>
  			</div>
  		</div>
  	</nav>

  	<div class="container">
  		<div class="row hoverable">
  							<form action="<?= base_url('backend/module/c_halaman/saveditor/') ?>" method="post" id="formEditor">
  								<input type="hidden" value="<?= $r[0]->token_halaman ?>" name="token">
  								<input type="hidden" value="<?= $r[0]->title ?>" name="title">
  								<textarea name="content" id="contents" >
									<?= $r[0]->content; ?>
									</textarea>
									<input type="hidden" name="submitbtn">
  							</form>
  		</div>
  	</div>
  	<!-- Modal Structure -->
  	<div id="title" class="modal">
  		<div class="modal-content"></div>
  		<div class="modal-footer">
  			<a href="#!" class="modal-close waves-effect waves-red btn-flat btn-small">Batal</a>
  			<a href="#!" class="waves-effect waves-green btn-flat submit btn-small">Simpan</a>
  		</div>
  	</div>


  	<!--JavaScript at end of body for optimized loading-->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
  	<script src="<?= base_url('assets/plugins/mprogres/js/mprogress.min.js') ?>"></script>

  	<!-- Page Content goes here -->
  	<script type="text/javascript">
			tinymce.init({ 
				selector: "#contents",theme: "silver", height: 800,
				menubar: true,
				plugins: [
						"advlist autolink link image lists charmap print preview hr anchor pagebreak save",
						"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
						"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
			],
			documentBaseURI: '<?= base_url("files/filemanager-v2/") ?>',
			content_css: [
				'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'
			],
			toolbar_drawer: 'sliding',
			content_style: "body {padding: 10px}",
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,
			save_enablewhendirty: true,
			save_onsavecallback: function () { simpan(); },
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | save",
			//  filemanager_crossdomain: true,
			image_advtab: true ,
			external_filemanager_path:"<?= base_url('files/filemanager-v2/filemanager/') ?>",
			filemanager_title:"Filemanager",
			external_plugins: { "filemanager" : "<?= base_url('files/filemanager-v2/filemanager/plugin.min.js') ?>"}
			});

  		var mprogress = new Mprogress({
  			template: 3,
  			parent: '.modal-content'
  		});

  		function close_window() {
  			$.confirm({
  				title: 'Confirm!',
  				content: 'Apa anda yakin akan menutup halaman?',
					animation: 'zoom',
  				closeAnimation: 'opacity',
					animateFromElement: false,
  				columnClass: 'small',
  				buttons: {
  					SimpanClose: {
  						text: 'Simpan & Keluar',
  						action: function () {
                window.opener.location.reload(true);
								$("li a.btn-save").click();
								$.blockUI({ 
									message: '<img src="https://icons8.com/preloaders/generator.php?filmstrip&image=15&speed=10&fore_color=4F4F4F&back_color=FFFFFF&size=160x20&transparency=0&reverse=0&orig_colors=0&gray_transp=1&image_type=2&inverse=0&flip=0&frames_amount=12&word=237-261-157-41-266-237-41-257-237-266-57-41-227-41-36-36-36"> <h6>Proses rediract halaman...</h6>',
									css: { 
										border: 'none', 
										padding: '15px', 
										backgroundColor: '#000', 
										'-webkit-border-radius': '10px', 
										'-moz-border-radius': '10px', 
										opacity: .5, 
										color: '#fff' 
									} 
								}); 
								setTimeout(() => {
  								window.close();
									$.unblockUI();
								}, 3000);
  						}
  					},
  					Close: {
  						text: 'Keluar Tanpa Simpan',
  						btnClass: 'btn-orange',
  						action: function () {
  							window.close();
  						}
  					},
  					cancel: {
  						text: 'Batal',
  						btnClass: 'btn-red',
  						action: function () {

  						}
  					}
  				}
  			});
  		}

  		function simpan() {
  			let meForm = $("#formEditor");
  			let $action = meForm.attr('action');
  			let contents = tinyMCE.activeEditor.getContent();;
  			let token = $("[name='token']").val();

  			$.ajax({
  				url: $action,
  				method: 'POST',
  				data: {
  					content: contents,
  					token: token
  				},
  				success: function (response) {
            window.opener.location.reload(true);
  					M.toast({
  						html: response,
  						displayLength: 800,
  						inDuration: 250,
  						outDuration: 800
  					});
  				}
  			});
  		}
  	</script>

  	<script>
  		$(document).ready(function () {
  			let id = $('[name="token"]').val();
  			let title = $('[name="title"]').val();
  			$('.modal').modal({
  				startingTop: '30%',
  				endingTop: '30%',
  				inDuration: '150',
  				opacity: 0.7,
  				dismissible: false,
  				onOpenStart: function () {
  					$('.modal-content').html('loading ...');
  				},
  				onOpenEnd: function () {
  					$('.modal-content').load("<?= base_url('backend/module/c_halaman/edittitle/') ?>" + id, {
  						title: title
  					}, 'post');
  				}
  			});
  			$('.modal .modal-footer a.submit').on('click', function (e) {
  				e.preventDefault();
  				let data = $("[name='titleedit']").val();
  				let id = $('[name="token"]').val();
  				if (data != '') {
  					$.post("<?= base_url('backend/module/c_halaman/simpantitle/') ?>" + id, {
  						title: data
  					}, function (response) {
  						$("a.brand-logo h5").html(response.res);
  						M.toast({
  							html: response.pesan,
  							displayLength: 3000,
  							completeCallback: function () {
  								location.reload();
                  window.opener.location.reload(true);
  							}
  						});
  					}, 'json').then(() => {
  						mprogress.start();
  					}).done(() => {
  						setTimeout(() => {
  							mprogress.end();
  							$('.modal').modal('close');
  						}, 3000);
  					});
  				}
  			});
  		});
  	</script>
  </body>

  </html>