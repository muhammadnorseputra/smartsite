<section class="pt-md-5">
	<div class="container">
		<div class="row mt-3 mt-lg-5 mt-md-5">
			<div class="col-12 col-md-4 mb-md-5 mb-3">
        <div id="sidebar">
  				<h3 class="text-uppercase">userportal</h3>
  				<p class="text-muted lead">
  					List Userportal yang telah berhasil bergabung.
  				</p>
  				<p class="text-dark font-weight-bold">Userportal - Total</p>
  				<p class="display-1">
  					<?= $total_userlist ?>
  				</p>
          <p class="text-dark font-weight-bold">Userportal - Populer</p>
          <div class="row">
            <?php foreach($user_populer->result() as $u): ?>
              <div class="col-md-12">
                <div class="d-flex justify-content-start justify-content-lg-between align-items-center  border-bottom pb-3">
                  <div class="flex-grow-1">
                    <img width="80" height="80" class="rounded-circle border p-1" style="object-fit:cover; object-position: top;"  alt="Userportal - <?= decrypt_url($u->nama_lengkap) ?>" src="<?= img_blob($u->photo_pic) ?>">
                  </div>
                  <div class="flex-grow-1 font-weight-bold">
                    <p class="border-bottom py-2"><?= ucwords(decrypt_url($u->nama_lengkap)) ?></p>
                    <span  data-toggle="tooltip" data-title="Total Posts">
                      <i class="fas fa-newspaper mr-2"></i>
                      <?= $this->users->total_berita_by_user($u->id_user_portal)->num_rows(); ?>
                    </span>
                    <span  class="mx-3" data-toggle="tooltip" data-title="Total Comments">
                      <i class="far fa-comment-alt mr-2"></i>
                      <?= $this->users->total_comment_by_user($u->id_user_portal)->num_rows(); ?>
                    </span>
                    <span data-toggle="tooltip" data-title="Total Pages">
                      <i class="fas fa-book mr-2"></i>
                      <?= $this->users->total_statis_by_user($u->id_user_portal)->num_rows(); ?>
                    </span>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
			</div>
			<div class="col-12 col-md-8" id="main-content">
				<div class="table-responsive">
					<table class="table table-borderless table-condensed table-striped table-light" id="userportal">
						<thead>
							<tr>
								<th>Detail</th>
								<th>Photo</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script>
var table = $("#userportal").DataTable({
    "processing": true,
    "serverSide": true,
    "paging": true,
    "ordering": true,
    "info": true,
    "searching": false,
    "pagingType": "full_numbers",
    "responsive": true,
    "datatype": "json",
    "fixedHeader": {
      headerOffset: $('#navbarSupportedContent').innerHeight(),
      header: true,
      footer: false
    },
    "lengthMenu": [
      [6, 10, 25, 50, -1],
      [6, 10, 25, 50, "All"]
    ],
    "order": [0, 'desc'],
    "ajax": {
      "url": _uri+'/frontend/v1/users/ajax_user_terdaftar',
      "type": "POST"
    },
    "columnDefs": [{
      "targets": [0],
      "orderable": true,
      // "className": "text-center",
    }, {
      "targets": [1],
      "orderable": false,
      // "className": "text-center",
      // "width": "15%"
    }],
    "language": {
      "lengthMenu": "_MENU_ Data per halaman",
      "zeroRecords": "Userportal tidak ditemukan",
      "info": "Showing page _PAGE_ of _PAGES_",
      "infoEmpty": "Userportal tidak ada",
      "infoFiltered": "(filtered from _MAX_ total records)",
      "search": "Pencarian",
      "processing": `
      <div class="d-flex justify-content-center align-items-center">
      	<div class="loader_small" style="width:30px; height: 30px;"></div>
      </div> 
      `
    }
  });
</script>