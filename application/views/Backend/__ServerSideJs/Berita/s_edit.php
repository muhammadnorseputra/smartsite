<script>

/*PREVIEW UPLOAD GAMBAR*/
let showImg 	= function(event) {
    var output 		= document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.width = '100%';
    /*output.style.display = "block";
    $("#before").css("display","none");*/
}

jQuery(function() {

tinymce.init({
    selector: "#isi_berita",
    theme: "silver",
    height: 600,
    fixed_toolbar_container: true,
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
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
    save_enablewhendirty: true,
    toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
    /* filemanager_crossdomain: true,*/
    image_advtab: true,
    external_filemanager_path: "<?= base_url('files/filemanager-v2/filemanager/') ?>",
    filemanager_title: "Filemanager",
    external_plugins: {
        "filemanager": "<?= base_url('files/filemanager-v2/filemanager/plugin.min.js') ?>"
    }
});
var select = $("#kategori").select2();
var label = jQuery("select#tags").select2({
    tags: true,
    tokenSeparators: [',', ' ']
});

});

</script>