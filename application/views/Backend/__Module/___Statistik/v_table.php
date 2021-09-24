<div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">show_chart</i> Statistisi
		<small>Statistik</small>
	</h2>
</div>
<div class="card card-border">
	<div class="header">
		<button id="btn-reload" role="button" class="btn btn-sm btn-circle btn-primary waves-effect"><i class='glyphicon glyphicon-repeat'></i></button>
	</div>
	<div class="body">
		<table class="table table-responsive table-condensed table-striped" id="tbl-statistik">
			<thead>
				<th>IP</th>
				<th>Browser (version)</th>
				<th>OS</th>
				<th>Date</th>
				<th>Hits</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th>Jam</th>
				<th>Loc</th>
			</thead>
			<tbody>
		</table>
	</div>
</div>
<script>
	$(function() {
		let dataTable = $('table#tbl-statistik').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[3, 'desc']
			],
			deferRender: true,
			keys: false,
			autoWidth: false,
			select: false,
			searching: true,
			lengthChange: true,
			responsive: true,
			ajax: {
				url: '<?= base_url('backend/module/c_statistik/ajax_list'); ?>',
				type: 'POST'
			},
			columnDefs: [{
					"targets": [0],
					"className": "dt-left",
					"orderable": true,
					"responsivePriority": 1,
				},
				{
					"targets": [1],
					"className": "dt-left",
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
					"orderable": true
				},
				{
					"targets": [4],
					"className": "dt-center",
					"orderable": true,
					"responsivePriority": 2,
				},
				{
					"targets": [5],
					"className": "dt-left",
					"orderable": false
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
				search: "Cari IP : ",
				processing: "Mohon Tunggu, Processing...",
				paginate: {
					previous: "Sebelumnya",
					next: "Selanjutnya"
				},
				emptyTable: "No matching records found, please filter this data"
			}
		});

	$("table").on('click', '#map-marker', function() {
		let lat = $(this).attr('data-lat');
		let long = $(this).attr('data-long');
		$.confirm({
		    title: 'Google Maps',
		    content: '<div id="map_canvas" style="width:100%; height:300px;"></div>',
		    onContentReady: function () {
				/*var map_canvas = document.getElementById('map_canvas');
				var map_options = {
					center: new google.maps.LatLng(lat, long),
					zoom:4,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				return new google.maps.Map(map_canvas, map_options);*/
				const myLatLng = { lat: parseInt(lat), lng: parseInt(long) };
				const map = new google.maps.Map(document.getElementById("map_canvas"), {
					zoom: 10,
					center: myLatLng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				return new google.maps.Marker({
					position: myLatLng,
					map,
					title: "Location"
				});
		    },
		    columnClass: 'medium',
		});
	});	

	$("button#btn-reload").on('click', function() {
		return refresh();
	});

	function refresh()
	{
		dataTable.ajax.reload();
	}


	});
</script>