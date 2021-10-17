<script>
	$(function() {
		let dataTable = $('table#tbl-ps').DataTable({
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
				url: '<?= base_url('backend/module/c_statistik/ajax_list_ps'); ?>',
				type: 'POST',
				/*data: function(d) {
					d.tgl_m = $("[name='tgl_mulai']").val();
					d.tgl_s =$("[name='tgl_selesai']").val();
				}*/
			},
			columnDefs: [{
					"targets": [0],
					"className": "dt-left",
					"orderable": false,
					"responsivePriority": 1,
				},
				{
					"targets": [1],
					"className": "dt-left",
					"orderable": true
				},
				{
					"targets": [2],
					"className": "dt-left",
					"orderable": false
				}
			],
			language: {
				search: "Cari Hit's : ",
				processing: "Mohon Tunggu, Processing...",
				paginate: {
					previous: "Prev",
					next: "Next"
				},
				emptyTable: "No matching records found, please filter this data"
			}
		});
	})
</script>