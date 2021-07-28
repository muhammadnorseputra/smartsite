<section class="pt-md-5">
	<div class="container">
		<div class="row mt-3 mt-lg-5 mt-md-5">
			<div class="col-12 col-md-4">
        <div id="sidebar">
  				<h3 class="text-uppercase">userportal</h3>
  				<p class="text-muted lead">
  					List Userportal yang telah berhasil bergabung.
  				</p>
  				<p class="text-dark font-weight-bold">Total Userportal</p>
  				<p class="display-1">
  					<?= $total_userlist ?>
  				</p>
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