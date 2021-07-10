<h4 class="px-3 py-4 border-bottom border-light animated fadeIn">
	<a href="<?= base_url('frontend/v1/halaman/halamanstatis/add') ?>" title="Buat Halaman Statis" data-toggle="tooltip" class="btn btn-sm btn-primary border-0 shadow rounded-circle float-right"><i class="fas fa-plus"></i></a>
Tabel Halaman 
</h4>

<div class="table-responsive my-2 p-3">
	<table data-id="<?= $id_user ?>" class="table table-condensed table-borderless table-striped display" id="table-halamanstatis">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center"></th>
				<th>Judul Halaman</th>
				<th>Token</th>
			</tr>
		</thead>
	</table>
</div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script>
	// Tooltips
	$('[data-toggle="tooltip"]').tooltip();
	var table3 = $("#table-halamanstatis").DataTable({
		"processing": true,
		"serverSide": true,
		"paging": true,
		"ordering": true,
		"info": true,
		"searching": true,
		"pagingType": "full_numbers",
		"responsive": true,
		"datatype": "json",
		// "scrollY": "200px",
		//  "scrollCollapse": true,
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"order": [],
		"ajax": {
			"url": _uri + '/frontend/v1/users/get_all_halamanstatis',
			"type": "POST",
			"data": function(q) {
				q.id_a = $("#table-halamanstatis").attr('data-id')
			},
		},
		"columnDefs": [{
			"targets": [0, 1],
			"orderable": false,
			"className": "text-center"
		}, {
			"targets": [2],
			"orderable": true,
		}, {
			"targets": [3],
			"orderable": false,
		}],
		"language": {
			"lengthMenu": "_MENU_ Data per halaman",
			"zeroRecords": "Belum ada halaman",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "Belum ada halaman",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Pencarian",
			"processing": "<img src='" + _uri + "/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg' />"
		}
	});


	$(document).on("click", "a#btn-hapus-halaman", function(e) {
		e.preventDefault();
		let id = $(this).attr('data-id');
		notif_confirm({
			'position': "bottom",
			'offset': 30,
			'textaccept': 'Yakin',
			'textcancel': 'Batal',
			'fullscreen': true,
			'message': 'Apakah anda yakin akan menghapus halaman tersebut?',
			'callback': function(choice) {
				if (choice) {
					$.post(_uri + '/frontend/v1/halaman/deleteHalaman', {
						id: id
					}, function(response) {
						if (response.valid == true) {
							table3.ajax.reload();
							notif({
								bgcolor: "#000",
								color: "#fff",
								'msg': 'Halaman berhasil dihapus',
								'position': 'bottom',
								'timeout': 3000
							})
						}
					}, 'json');
				} else {
					notif({
						'type': 'error',
						'msg': 'Dibatalkan',
						'position': 'bottom',
						'timeout': 1000
					})
				}
			}
		});
	});
</script>