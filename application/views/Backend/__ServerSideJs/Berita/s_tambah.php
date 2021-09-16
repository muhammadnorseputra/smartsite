<script>

/*PREVIEW UPLOAD GAMBAR*/
let showImg 	= function(event) {
    var output 		= document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.width = '100%';
    output.style.display = "block";
    $("#before").css("display","none");
}

tinymce.init({ 
		selector: "#isi_berita",theme: "silver", height: 400,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak tabfocus searchreplace advcode codesample layer help",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor code fullscreen"
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

/*$("button[type='submit']").html('CHECK CONTENT');
AKSI TAMBAH BERITA
jQuery("#FormAddBerita").on('submit', function(e){
    e.preventDefault();
        let me = jQuery(this);
        jQuery.ajax({
            url: me.attr('action'),
            method: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            dataType: 'json',
            beforeSend: function() {
                NProgress.start();
            },
            success: function(result)
            {
                showNotification(result.pesan.colmsg, result.pesan.content, 'top', 'center', 'animated fadeIn', 'animated fadeOut');
                // alert(result.pesan.content);
                if((result.pesan.colmsg != 'bg-red') && (result.pesan.colmsg != 'bg-blue')){
                    me[0].reset();
                    showNotification('bg-amber', 'Mohon tunggu, proses penyimpanan ke database...', 'top', 'center', '', 'animated fadeOut');
                    setInterval(() => {  
                        window.history.back(-1);
                    }, 4500);
                    $("#preview").css("display","none");
                    $("#before").css("display","block"); 
                    
                } else if(result.pesan.colmsg == 'bg-blue') {
                    $("button[type='submit']").html('PUBLISH');  
                } else {
                    $("button[type='submit']").html('CHECK CONTENT');
                }
            },
            complete: function() {
                NProgress.done();
            }
        });
    });*/
    
jQuery(function() {


    /*SELECT KATEGORI BERITA*/
    var select = jQuery("#kategori").select2({
        placeholder: {
            id: '-1',
            text: '-- Pilih Kategori --'
        },
        width: '100%',
        allowClear: true,
        ajax: {
            url: '<?= base_url("backend/module/c_berita/ajax_kategori") ?>',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(pars) {
                return {
                    cariKategori: pars.term
                };
            },
            processResults: function(response) {
                return {
                    results: response.items
                };
            }
        }
    });

    
    /*SELECT TAGS / LABEL*/
    var label = jQuery("select#tags").select2({
        placeholder: 'Insert New Tags / Label',
        tags: true,
        tokenSeparators: [',', ' '],
        width: 'resolve',
        ajax: {
            url: '<?= base_url("backend/module/c_berita/ajax_tags") ?>',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(pars) {
                return {
                    cariTags: pars.term
                };
            },
            processResults: function(response) {
                return {
                    results: response.items
                };
            }
        }
    });

    
});

</script>