<section class="hero py-md-3 mt-md-5 py-4">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-start flex-lg-row flex-column">
			<div>
				<h3 class="font-weight-bold text-responsive">Direktori Download</h3>
				<p class="text-muted small">Resources arsip kepegawaian</p>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-md-3 mt--4">
<div class="container bg-white py-4 rounded shadow-sm">
	<div class="table-responsive-md">
		<table class="table table-condensed display" id="table-download">
			<thead>
				<tr>
					<th data-priority="1">No</th>
					<th data-priority="2">Judul</th>
					<th>Keterangan</th>
					<th>Hits</th>
					<th>Size</th>
					<th data-priority="3">Download</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
</section>

<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script>
var table = $("#table-download").DataTable({
    "processing": true,
    "serverSide": true,
    "paging": true,
    "ordering": true,
    "info": false,
    "searching": true,
    "pagingType": "full_numbers",
    "responsive": true,
    "datatype": "json",
    "fixedHeader": {
      headerOffset: 0,
      header: false,
      footer: false
    },
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    "order": [1, 'desc'],
    "ajax": {
      "url": _uri+'/frontend/v1/download/ajax_datatable',
      "type": "POST",
      "data": function(q) {
        q.key = urlParams.get('key')
      }
    },
    "columnDefs": [{
      "targets": [0,3,5],
      "orderable": false,
      "className": "text-center",
    }, {
      "targets": [4],
      "orderable": false,
      "className": "text-center",
      "width": "15%"
    }, {
      "targets": [1],
      "orderable": true,
      "className": "text-left",
      "width": "30%"
    }, {
      "targets": [2],
      "orderable": false,
      "className": "text-left"
    }],
    "language": {
      "lengthMenu": "_MENU_ Data per halaman",
      "zeroRecords": "File tidak ditemukan",
      "info": "Showing page _PAGE_ of _PAGES_",
      "infoEmpty": "File tidak ada",
      "infoFiltered": "(filtered from _MAX_ total records)",
      "search": "Pencarian",
      "processing": `<img src='${_uri}/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg'>`
    }
  });

</script>