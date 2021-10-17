<div class="card card-border">
	<div class="body">

		<table class="table table-responsive table-condensed table-striped" id="tbl-module">
			<thead>
				<th>NO</th>
				<th>NAMA MODULE</th>
				<th>AKTIF</th>
				<th>AKSI</th>
			</thead>
			<tbody>
		</table>

	</div>
</div>
<style>
	.no-close .ui-dialog-titlebar-close {
		display: none;
	}
</style>
<script>
	$(function() {

		let dataTable = $('table#tbl-module').DataTable({
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
				url: '<?= base_url('backend/module/c_module/ajax_list'); ?>',
				type: 'POST'
			},
			columnDefs: [{
					"targets": [0],
					"className": "dt-center",
					"orderable": true,
					"width": "5%"
				},
				{
					"targets": [1],
					"className": "dt-left",
					"orderable": true,
					"width": "50%"
				},
				{
					"targets": [2],
					"className": "dt-center",
					"orderable": false,
					"width": "10%"
				},
				{
					"targets": [3],
					"className": "dt-center",
					"orderable": false,
					"width": "25%"
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
			var title = $(this).attr('data-title');
			var $dialog = $('<div></div>')
				.html("Apakah anda yakin akan menghapus module <b>" + title + "</b>")
				.dialog({
					autoOpen: false,
					modal: true,
					open: function() {
						var closeBtn = $('.ui-dialog-titlebar-close');
						closeBtn.append('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');
					},
					close: function() {
						var closeBtn = $('.ui-dialog-titlebar-close');
						closeBtn.html('');
					},
					width: 400,
					dialogClass: "no-close",
					title: 'Message!',
					buttons: [{
							text: "Ok",
							click: function() {
								$.getJSON('<?= base_url('backend/module/c_module/hapus'); ?>', {
									id: id,
									nama_module: title
								}, function(result) {
									dataTable.ajax.reload();
								}, 'json');
								$(this).dialog("close");
							}
						},
						{
							text: "Batal",
							click: function() {
								$(this).dialog("close");
							}
						},
					]
				});
			$dialog.dialog('open');
		});
	});
</script>
