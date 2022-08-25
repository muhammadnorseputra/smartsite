<script>
$(function () {
	/*TEXT AREA EDITOR*/
	tinymce.init({ 
		selector: "#content_halaman",theme: "silver", height: 400,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak tabfocus searchreplace advcode codesample layer",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code fullscreen"
   ],
	 content_css: [
		'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
		'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'
		],
	
		content_style: "body {padding: 10px}",
		relative_urls : false,
		remove_script_host : false,
		convert_urls : true,
  	save_enablewhendirty: true,
   toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
	/* filemanager_crossdomain: true,*/
   image_advtab: true ,
   external_filemanager_path:"<?= base_url('files/filemanager-v2/filemanager/') ?>",
   filemanager_title:"Filemanager",
   external_plugins: { "filemanager" : "<?= base_url('files/filemanager-v2/filemanager/plugin.min.js') ?>"}
	});
	
});
	/*jQuery('#FormAddHalaman').validate({
		rules: {
			'title_halaman': {
				required: true
			},
			'publish': {
				required: true
			},
			'fileinsert': {
				required: true
			}
		},
		highlight: function (input) {
			jQuery(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			jQuery(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			jQuery(element).parents('.form-group').append(error);
		}
	});

});

jQuery("#FormAddHalaman").on('submit', function(e){
e.preventDefault();
let form = jQuery(this);
let msg = jQuery("#message");
	jQuery.ajax({
		url: form.attr('action'),
		method: 'POST',
		contentType: false,
    cache: false,
  	processData:false,
		data: new FormData(this),
		dataType: 'json',
		beforeSend: function () {
			NProgress.start();
		},
		success: function (result) {
			// msg.html(`<div class="alert ${result.col} alert-dismissible" role="alert">
			// 						<strong>${result.content}</strong>
			// 						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			// 				</div>`);
			showNotification(result.col,result.content, 'top', 'center', 'animated fadeIn', 'animated fadeOut');
			if (result.status != false) {
				form[0].reset();
				CKEDITOR.instances.content_halaman.setData('');
				setInterval(() => {
					window.history.back(-1);
				}, 1000);
			}
		},
		complete: function () {
			NProgress.done();
		}
	});
});*/
</script>