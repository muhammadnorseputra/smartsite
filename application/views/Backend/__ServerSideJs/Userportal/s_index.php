<script>
$(function() {

	let dataTable = $('table#tbl-userportal').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[5, 'desc']
			],
			deferRender: true,
			keys: false,
			autoWidth: false,
			select: false,
			searching: true,
			lengthChange: true,
			responsive: true,
			ajax: {
				url: '<?= base_url('backend/module/c_userportal/ajax_list'); ?>',
				type: 'POST'
			},
			columnDefs: [{
					"targets": [0],
					"className": "dt-center",
					"orderable": true,
				},
				{
					"targets": [1],
					"className": "dt-center",
					"orderable": false
				},
				{
					"targets": [2],
					"className": "dt-left",
					"orderable": false
				},
				{
					"targets": [3],
					"className": "dt-left",
					"orderable": false
				},
				{
					"targets": [4],
					"className": "dt-left",
					"orderable": false
				},
				{
					"targets": [5],
					"className": "dt-left",
					"orderable": true
				},
				{
					"targets": [6],
					"className": "dt-left",
					"orderable": false
				},
				{
					"targets": [7],
					"className": "dt-center",
					"orderable": false
				},
				{
					"targets": [8],
					"className": "dt-center",
					"orderable": false
				}


			],
			language: {
				search: "Cari Nama : ",
				processing: "Mohon Tunggu, Processing...",
				paginate: {
					previous: "Sebelumnya",
					next: "Selanjutnya"
				},
				emptyTable: "No matching records found, please filter this data"
			}
		});

});
</script>