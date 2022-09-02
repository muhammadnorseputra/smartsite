<script>
$(function() {

	let dataTable = $('table#tbl-userportal').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[5, 'desc']
			],
			lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
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
				},
				{
					"targets": [9],
					"className": "dt-center",
					"orderable": false
				},
				{
					"targets": [10],
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

	$(document).on("click", "a#deleteUserportal", function(e) {
		e.preventDefault();
		var $id = this.dataset.uid;
		if(confirm('Apakah anda akan menghapus user tersebut ?')) {		
			$.getJSON(`<?= base_url('backend/module/c_userportal/hapus') ?>`, {uid: $id}, function(res) {
				console.log(res);
				dataTable.ajax.reload();
			});
		}
		/*console.log();*/
	});

	$(document).on("click", "a#detailUserportal", function(e) {
		e.preventDefault();
		var $id = this.dataset.uid;	
		$.confirm({
			icon: 'glyphicon glyphicon-eye-open',
    		title: 'Detail',
			columnClass: 'large',
	        content: function () {
	            var self = this;
	            return $.ajax({
	                url: '<?= base_url('backend/module/c_userportal/detail') ?>',
	                dataType: 'json',
	                method: 'post',
	                data: {
	                	uid: $id
	                }
	            }).done(function (response) {
	                self.setContent(response);
	            }).fail(function(){
	                self.setContent('Something went wrong.');
	            });
	        }
	    });

		/*console.log();*/
	});

});
</script>