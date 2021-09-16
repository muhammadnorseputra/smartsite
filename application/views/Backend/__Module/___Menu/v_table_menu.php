<div class="clearfix">
	<div class="card card-shadow card-border">
		<div class="body">
			<table class="table table-responsive table-codensed table-hover" id="tbl-menu">
				<thead>
					<th width="20">No</th>
					<th width="20">#</th>
					<th>Label</th>
					<th>Icon</th>
					<th>Menu</th>
					<th>Link</th>
					<th>Aktif</th>
					<th>Status</th>
					<th>Aksi</th>
				</thead>
				<tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(function() {
		var btn_add_label = $("button#btn-label").on('click', function() {
			window.open("<?= base_url('backend/module/c_menu/add_label_menu'); ?>", '_blank', 'width=600,height=500,left=80,top=50, scrollbars=no, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no', true);
		});
		var btn_ref_icon = $("button#btn-icons").on('click', function() {
			window.open("<?= base_url('backend/module/c_menu/ref_icons'); ?>", '_blank', 'width=350,height=500,left=250,top=20, scrollbars=yes, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no', true);
		});
		let dataTable = $('table#tbl-menu').DataTable({
			processing: true,
			serverSide: true,
			searching: true,
			lengthChange: true,
			responsive: true,
			order: [0, 'desc'],
			ajax: {
				url: '<?= base_url('backend/module/c_menu/ajax_list'); ?>',
				type: 'POST'
			},
			columnDefs: [{
				"targets": [1, 2, 3, 5, 6, 7, 8],
				"orderable": false
			}],
			language: {
				search: "Pencarian: ",
				processing: "Mohon Tunggu, Processing...",
				paginate: {
					previous: "Sebelumnya",
					next: "Selanjutnya"
				},
				emptyTable: "No matching records found, please filter this data"
			}
		});
		$("table").on('click', '#btn-delete', function() {
			var id = $(this).attr('data-id');
			var title = $(this).attr('data-title');

			$.confirm({
				title: 'Hapus',
				content: 'Apakah anda yakin akan menghapus menu? (<b>' + title.toLowerCase() + '</b>)',
				animation: 'none',
				backgroundDismissAnimation: 'shake',
				closeAnimation: 'opacity',
				type: 'red',
				animationType: true,
				buttons: {
					delete: function() {
						$.get('<?= base_url('backend/module/c_menu/hapus'); ?>', {
							id: id,
							nama_menu: title
						}, function(result) {
							dataTable.ajax.reload();
							showNotification(result.bg, result.msg, 'bottom', 'center', 'none', 'animated fadeOutDown');
						}, 'json');
					},
					cancel: function() {}
				}
			});
		});
	});
	$("table").on('click', '#btn-edit', function(e) {
		e.preventDefault();
		let id = $(this).attr('data-id');
		window.location.replace('<?= base_url('backend/module/c_menu/edit_menu/?id='); ?>' + id + '&module=<?= $this->madmin->getmodule('MENU UTAMA') . '&user=' . $this->session->userdata('user_access'); ?>');
	});
</script>
