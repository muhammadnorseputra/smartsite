<div id="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 m-t-15">
			<div class="card card-border card-shadow">
				<div class="header">
					<h2>
						Hak Akses <small>Buat hak akses baru</small>
					</h2>
				</div>
				<div class="body">
          <img src="<?= base_url('assets/images/no-profile-picture.jpg') ?>" class="pull-left m-r-15 m-b-25" width="100">
          
					Hak akses berguna agar user yang mengakses halaman index (<code>login</code>) bisa terbaca olah sistem bahwa
					user tersebut telah terdaftar. sistem akan memberika token acak sebagai pengganti iduser.
				</div>
				<div class="card-footer">
					<button type="button" id="newAkses" class="btn btn-sm bg-teal pull-right waves-effect"> Buat akses baru</button>
					<button type="button" id="listAkses" class="btn btn-sm btn-link pull-right waves-effect m-r-15"> Lihat daftar user </button>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
  $(document).ready(function() {
    $("button#listAkses").click();
  });
  var contains = $("#container");
  var loader   = `<img src="<?= base_url('assets/images/loader/simple-pre-loader/loader-icons-set-2-32x64x128/32x32/Preloader_5.gif') ?>">`;

  $("button#newAkses").on('click', function() {
    contains.html('<div class="m-t-125"><center>' + loader + '</center></div>');
    setTimeout(() => {
      $.ajax({
        url: '<?= base_url("backend/c_pengaturan/akseslogin_baru/") ?>',
        method: 'post',
        dataType: 'html',
        success: function(response) {
          contains.html(response).addClass('animated fadeIn');
        }
      });
    }, 100); 
  });

  $("button#listAkses").on('click', function() {
    $.confirm({
        title: 'Table Akses Login',
        animation: 'fade',
        closeAnimation: 'fade',
        columnClass: 'm',
        animateFromElement: false,
        theme: 'material',
        content: function () {
            var self = this;
            return $.ajax({
                url: '<?= base_url("backend/c_pengaturan/akseslogin_list/") ?>',
                dataType: 'html',
                method: 'get'
            }).done(function (response) {
                self.setContent(response);
            }).fail(function(){
                self.setContent('Something went wrong.');
            });
        },
        buttons: {
          ok: {
            isHidden: true /*initially not hidden*/
          },
          Tutup: {
            btnClass: 'btn btn-sm btn-link',
            keys: ['Esc'],
            action: function () {}
          }
        }
    });
  });

</script>