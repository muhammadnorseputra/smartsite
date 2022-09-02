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

	$("button#reset").on('click', function() {
		$("[name='tgl_mulai']").val('');
		$("[name='tgl_selesai']").val('');
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
			$('.total_ip').countTo({from: 0, to: res.jml_ip});
			$('.ip_loc').countTo({from: 0, to: res.ip_loc});
			$('.hits_max').countTo({from: 0, to: res.hits_max});
			$('.hits_min').countTo({from: 0, to: res.hits_min});
			$('.ip_presentase_day').countTo({speed: 1000, refreshInterval: 50, from: 0, to: res.ip_persentase_day, formatter: function (value, options) {
					return `${value}%`;
				}});
			$('.ip_loc_close').countTo({from: 0, to: res.ip_loc_off});
			$(".ip_max").text(`(${res.ip_max})`);
			$(".ip_min").text(`(${res.ip_min})`);
		});
	}
});

function show_ip_detail(ip) {
	$.confirm({
    title: 'IP. ' + ip,
    content: function () {
	    var self = this;
	    return $.ajax({
	        url: '<?= base_url('backend/module/c_statistik/ip_detail'); ?>',
	        dataType: 'json',
	        method: 'post',
	        data: {ip: ip}
	    }).done(function (response) {
	        self.setContent(response);
	    }).fail(function(){
	        self.setContent('Something went wrong.');
	    });
	},
	columnClass: 'col-md-12'
	});
}
</script>