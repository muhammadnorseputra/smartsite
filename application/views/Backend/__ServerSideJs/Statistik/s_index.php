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
				type: 'POST',
				data: function(d) {
					d.tgl_m = $("[name='tgl_mulai']").val();
					d.tgl_s =$("[name='tgl_selesai']").val();
				}
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
					"orderable": true
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

	function initMaps(lat, long) {
		const myLatLng = { lat: parseInt(lat), lng: parseInt(long) };
				const map = new google.maps.Map(document.getElementById("map_canvas"), {
					zoom: 8,
					center: myLatLng,
					mapTypeId: google.maps.MapTypeId.HYBRID,
					mapId: "ee85d0d64294115",
				});
				return new google.maps.Marker({
					position: myLatLng,
					map,
					title: "Location",
					animation: google.maps.Animation.DROP,
					optimized: true 
				});
	}

	$("table").on('click', '#map-marker', function() {
		let lat = $(this).attr('data-lat');
		let long = $(this).attr('data-long');
		$.confirm({
		    title: 'Google Maps',
		    content: '<div id="map_canvas" style="width:100%; height:300px;"></div>',
		    onContentReady: function () {
		    	initMaps(lat, long);
		    },
		    columnClass: 'medium',
		});
	});	

	$("button#btn-reload").on('click', function() {
		return refresh();
	});

	$("button[type='reset']").on('click', function() {
		refresh();
	});

	function refresh()
	{
		dataTable.ajax.reload();
		_countIp();
	}

	$("#FormSearchByTgl").on('change', function(e) {
		e.preventDefault();
		let fr = $(this);
		let tglM = $("[name='tgl_mulai']").val();
		let tglS = $("[name='tgl_selesai']").val();
		dataTable.draw();
		_countIp();
	});

	_countIp();
	function _countIp() {
		let tglM = $("[name='tgl_mulai']").val();
		let tglS = $("[name='tgl_selesai']").val();
		$.getJSON(`<?= base_url('backend/module/c_statistik/jml_ip'); ?>`, {s: tglM, e: tglS}, function(res) {
			$("h1#total_ip").text(res.jml_ip);
			$("h1#ip_loc").text(res.ip_loc);
			$("h1#hits_max").text(res.hits_max);
			$("h1#hits_min").text(res.hits_min);
			$("b#ip_max").text(`(${res.ip_max})`);
			$("b#ip_min").text(`(${res.ip_min})`);
		});
	}

	})
</script>