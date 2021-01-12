<?php
if ($this->session->flashdata('message') <> '') {
	echo '<div class="' . $this->session->flashdata('class') . ' alert-dismissible">
              ' . $this->session->flashdata('message') . '
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">Ã—</span></button>
          </div>';
}
?>
<div class="card card-border">
	<div class="body">
		<table class="table table-responsive table-condensed table-striped" id="tbl-users">
			<thead>
				<th>GRAVATAR</th>
				<th>NAMA</th>
				<th>EMAIL</th>
				<th>AKTIF</th>
				<th>MODULE</th>
				<th>AKSI</th>
			</thead>
			<tbody>
		</table>

	</div>
</div>
<script>
	$(document).ready(function() {

		let dataTable = $('table#tbl-users').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[1, 'desc']
			],
			deferRender: true,
			keys: false,
			autoWidth: false,
			select: false,
			searching: true,
			lengthChange: true,
			responsive: true,
			ajax: {
				url: '<?= base_url("backend/module/c_users/ajax_list") ?>',
				type: 'POST'
			},
			columnDefs: [{
					"targets": [0],
					"className": "dt-center",
					"orderable": false,
					"width": "10%"
				},
				{
					"targets": [1],
					"className": "dt-left",
					"orderable": true,
					"width": "25%"
				},
				{
					"targets": [2],
					"className": "dt-left",
					"orderable": false,
					"width": "15%"
				},
				{
					"targets": [3],
					"className": "dt-center",
					"orderable": false,
					"width": "5%"
				},
				{
					"targets": [4],
					"className": "dt-center",
					"orderable": false,
					"width": "10%"
				},
				{
					"targets": [5],
					"className": "dt-center",
					"orderable": false,
					"width": "35%"
				}
			],
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
			var nama = $(this).attr('data-title');
			var vatar = $(this).attr('data-gravatar');
			// let conf = confirm('Apakah anda yakin akan menghapus users? '+ nama.toLowerCase());
			// if(conf == true) {
			// $.post('<?= base_url("backend/module/c_users/hapus_user_list/") ?>', {id: id, nama: nama, gravatar: vatar}, function(result) {
			// dataTable.ajax.reload();
			// showNotification(result.type, result.content, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
			// }, 'json');
			// }

			$.confirm({
				title: 'Deleted User!',
				content: nama.toLowerCase(),
				backgroundDismissAnimation: 'shake',
				closeAnimation: 'opacity',
				buttons: {
					delete: function() {
						$.post('<?= base_url("backend/module/c_users/hapus_user_list/") ?>', {
							id: id,
							nama: nama,
							gravatar: vatar
						}, function(result) {
							dataTable.ajax.reload();
							$.alert({
								title: 'System Info',
								content: result.content,
								type: result.type,
								typeAnimated: true,
							});
						}, 'json');
					},
					cancel: function() {

					}
				}
			});
		});

		$("table").on('click', '#btn-reset-password', function(e) {
			e.preventDefault();
			let id = $(this).attr('data-id');
			let user = $(this).attr('data-user');
			swal({
				title: "Reset Password",
				text: "Masukan Password Baru User : " + user,
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				animation: "slide-from-bottom",
				inputPlaceholder: "Masukan password baru ..."
			}, function(inputValue) {
				if (inputValue === false) return false;
				if (inputValue === "") {
					swal.showInputError("Masukan Password Baru!");
					return false
				}
				$.post('<?= base_url("backend/module/c_users/reset_password/") ?>' + id, {
					new_pass: inputValue
				}, function(result) {
					swal(result.msg.title, result.msg.content, result.msg.type);
					dataTable.ajax.reload();
				}, 'json');
			});
		});

		$("table").on('click', '#btn-edit', function(e) {
			e.preventDefault();
			let id = $(this).attr('data-id');
			window.location.replace('<?= base_url("backend/module/c_users/edit_user/?id=") ?>' + id + '&module=<?= $this->madmin->getmodule('MANAJEMEN USER') . '&user=' . $this->session->userdata('user_access') ?>');
		});
	});
</script>
