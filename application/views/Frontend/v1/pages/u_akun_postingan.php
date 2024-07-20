<h4 class="px-3 py-4 border-bottom border-light animated fadeIn">Manajemen Postingan <a href="<?php echo base_url('frontend/v1/post/judul') ?>" target="_blank" title="Buat Postingan Baru" data-toggle="tooltip" class="btn btn-sm btn-primary border-0 shadow rounded-circle float-right"><i class="fas fa-plus"></i></a></h4>
<div class="table-responsive p-3 my-2 animated fadeIn">
	<table data-id="<?= $id_user ?>" class="table table-condensed table-borderless table-striped display" id="table-postingan">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center"></th>
				<th>Postingan</th>
				<th>Komentar</th>
				<th>Views</th>
			</tr>
		</thead>
	</table>
</div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script>
	/*Tooltips*/
	$('[data-toggle="tooltip"]').tooltip();
	var table2 = $("#table-postingan").DataTable({
		"processing": true,
		"serverSide": true,
		"paging": true,
		"ordering": true,
		"info": true,
		"searching": true,
		"pagingType": "full_numbers",
		"responsive": true,
		"datatype": "json",
		/*"scrollY": "200px",
		 "scrollCollapse": true,*/
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"order": [],
		"ajax": {
			"url": _uri + '/frontend/v1/users/get_all_post',
			"type": "POST",
			"data": function(q) {
				q.id_a = $("#table-postingan").attr('data-id')
			},
		},
		"columnDefs": [{
				"targets": [0],
				"orderable": false,
				"className": "text-center"
			},
			{
				"targets": [1],
				"orderable": false,
				"className": "text-center"
			},
			{
				"targets": [2],
				"orderable": true,
			},
			{
				"targets": [3],
				"orderable": false,
			},
			{
				"targets": [4],
				"orderable": false,
				"width": '18%'
			}
		],
		"language": {
			"lengthMenu": "_MENU_",
			"zeroRecords": "Belum ada postingan",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "Belum ada postingan",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Pencarian",
			"processing": "<img src='" + _uri + "/template/v1/images/loading.gif' />"
		}
	});

	$(document).on("click", "a#btn-hapus", function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		notif_confirm({
			'position': "bottom",
			'offset': 30,
			'textaccept': 'Yakin',
			'textcancel': 'Batal',
			'fullscreen': true,
			'message': 'Apakah anda yakin akan menghapus postingan tersebut?',
			'callback': function(choice) {
				if (choice) {
					$.post(_uri + '/frontend/v1/post/deletePost', {
						id: id
					}, function(response) {
						if (response.valid == true) {
							table2.ajax.reload();
							notif({
								bgcolor: "#000",
								color: "#fff",
								'msg': 'Postingan berhasil dihapus',
								'position': 'bottom',
								'timeout': 2000,
								offset: -10,
							})
						}
					}, 'json');
				}
			}
		});
	});
</script>