<!DOCTYPE html>
<html>
<head>
	<title>UPLOAD HASIL VERIFIKASI PESERTA CPNS</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.css'); ?>" />
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.js'); ?>"></script>
</head>
<body>

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>UPLOAD</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
    
        <?= form_open(base_url('cpns/informasi/imports_peserta_hasilverifikasi'), ['id' => 'formUploadHasilVerifikasi']); ?>
            <label for="hasilverifikasi">Upload File :</label>
            <input type="file" required data-clear-btn="true" name="hasilverifikasi" id="hasilverifikasi">
            <button class="ui-btn" type="submit">Upload</button>
        <?= form_close(); ?>

    <table data-role="table" id="table-column-toggle" data-mode="column" class="ui-responsive table-stroke">
     <thead>
       <tr>
         <th>Hasil upload records</th>
        </tr>
     </thead>
     <tbody>
       <tr>
           <td>Success</td>
       </tr>
       <tr>
           <td>Gagal</td>
       </tr>
        <tr>
           <td>Total Data</td>
       </tr>
       
     </tbody>
   </table>
	</div><!-- /content -->

	<div data-role="footer" data-position="fixed">
        <!-- <div class="ui-grid-a">
            <div class="ui-block-a"><button class="ui-btn ui-icon-carat-l ui-btn-icon-left" id="btnBatal">Batal</button></div>
        </div> -->
        <div data-role="navbar">
            <ul>
                <li><a href="#" id="btnBatal" data-theme="a" data-icon="power">Keluar</a></li>
                <li><a href="<?= base_url('cpns/informasi/uploadDataHasilVerifikasi'); ?>" data-theme="a" data-icon="navigation" data-icon="navigation" class="ui-btn-active" data-transition="slide">Upload</a></li>
                <li><a href="<?= base_url('cpns/informasi/DownloadDataHasilVerifikasi'); ?>" data-theme="a" data-icon="cloud" data-transition="slide">Download Template</a></li>
            </ul>
        </div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page -->
<script>
$(document).ready(function() {

    $('#formUploadHasilVerifikasi').on('submit', function(event){
        event.preventDefault();
        $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown + 'upload file gagal.');
        },
        beforeSend: function() {
            $.mobile.loading( "show", {
                text: 'Importing to database',
                textVisible: true,
                theme: 'b'
            });
        },
        success:function(data){
            $('#hasilverifikasi').val('');
        },
        complete: function() {
            $.mobile.loading( "hide" );
            window.opener.reloadTabs();
        }
        });
    });

    $(document).on('click', "#btnBatal", function(event) {
        event.preventDefault();
        $.mobile.loading( "show", {
                text: false,
                textVisible: false
        });
        setTimeout(() => {
            $.mobile.loading( "hide" );
            window.close();
        }, 1000);
    });

});
</script>
</body>
</html>