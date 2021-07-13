<section class="hero pt-md-5 py-5">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-start flex-lg-row flex-column">
			<div>
				<h3 class="font-weight-bold text-responsive">Grafik Pegawai </h3>
				<p class="text-muted small">Resources <code>SILKa Online</code> &bull; Uptodate <?= date('Y-m-d H:i:s') ?></p>
			</div>
		</div>
	</div>
</div>
</section>
<section class="bg-dark">
	<div class="container py-3">
		<div class="row mt--7 mb-3 bg-white p-3 rounded">
			<div class="col-6 col-md-4 col-lg-3 border px-0 rounded">
				<div class="font-weight-bold py-2 pl-3 bg-info text-white rounded-top border">ASN</div>
				<div class="m-3">
					<h1 id="data_asn">0</h1>
					<div class="text-muted small my-3">PNS + CPNS + NON PNS</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-3 border px-0 rounded">
				<div class="font-weight-bold py-2 pl-3 bg-success text-white rounded-top border">PNS</div>
				<div class="m-3">
					<h1 id="data_pns">0</h1>
					<div class="text-muted small my-3">Jumlah PNS</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-3 border px-0 rounded">
				<div class="font-weight-bold py-2 pl-3 bg-warning text-dark rounded-top border">Non PNS</div>
				<div class="m-3">
					<h1 id="data_nonpns">0</h1>
					<div class="text-muted small my-3">Non Jumlah PNS</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-3 border px-0 rounded">
				<div class="font-weight-bold py-2 pl-3 bg-dark text-white rounded-top border">Pensiunan</div>
				<div class="m-3">
					<h1 id="data_pensiun">0</h1>
					<div class="text-muted small my-3">Pensiunan <?= date('Y') ?></div>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-12 col-md-6 border-right p-4 bg-white rounded-top">
				  		<div id="chart-jenkel"></div>
				</div>
				<div class="col-12 col-md-6 p-4 bg-white rounded-top">
				  		<div id="chart-golru"></div>
				</div>
				<div class="col-12 col-md-6 p-4 bg-white border-top border-bottom border-right">
				  		<div id="chart-tingpen"></div>
				</div>
				<div class="col-12 col-md-6 p-4 bg-white border-top border-bottom">
				  		<div id="chart-jenjab"></div>
				</div>
				<div class="col-12 p-4 bg-white rounded-bottom">
				  		<div id="chart-eselon"></div>
				</div>
		</div>
	</div>
</section>
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script src="<?= base_url('bower_components/highcharts/highcharts.js') ?>"></script>
<script src="<?= base_url('bower_components/highcharts/highcharts-3d.js') ?>"></script>
<script src="<?= base_url('bower_components/highcharts/modules/cylinder.js') ?>"></script>
<script>
$("#chart-jenkel, #chart-golru, #chart-tingpen, #chart-jenjab, #chart-eselon").html(`<div style="min-height: 50vh;" class="d-flex justify-content-center align-items-center"><div class="loader_small" style="width: 40px; height:40px"></div></div>`);

$(document).ready(function () {

	function _jmlContainer(id, data) {
		return $(id).html(data);
	}

// JML ASN
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap/asn`, response => _jmlContainer("#data_asn", response));
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap/pns`, response => _jmlContainer("#data_pns", response));
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap/nonpns`, response => _jmlContainer("#data_nonpns", response));
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap/pensiun`, response => _jmlContainer("#data_pensiun", response));

// Jenis Kelamin
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap_pns/jenkel`, function (response) {
	Highcharts.chart('chart-jenkel', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Jumlah PNS Berdasarkan Jenis Kelamin'
		},
		tooltip: {
			pointFormat: 'Jumlah: {point.y:f} <br> <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				}
			}
		},
		series: [{
			data: response.jml
		}]
	});
});

// Golru
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap_pns/golru`, function (response) {
	Highcharts.chart('chart-golru', {
		chart: {
			type: 'bar',
			spacingBottom: 15,
			spacingTop: 10,
			spacingLeft: 10,
			spacingRight: 10
		},
		title: {
			text: 'Jumlah PNS Berdasarkan Golongan Ruang'
		},
		xAxis: {
			categories: response.nama
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah',
				align: 'high'
			},
			labels: {
				overflow: 'justify'
			}
		},
		tooltip: {
			pointFormat: 'Jumlah : <b>{point.y:f}</b> orang'
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				},
				showInLegend: false
			}
		},
		series: [{
			data: response.jml
		}]
	});
});

// Tingkat Pendidikan
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap_pns/tingpen`, function (response) {
			Highcharts.chart('chart-tingpen', {
				chart: {
					type: 'line',
					spacingBottom: 15,
					spacingTop: 10,
					spacingLeft: 10,
					spacingRight: 10
				},
				title: {
					text: 'Jumlah PNS Berdasarkan Tingkat Pendidikan'
				},
				xAxis: {
					categories: response.nama
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Jumlah',
						align: 'high'
					},
					labels: {
						overflow: 'justify'
					}
				},
				tooltip: {
					pointFormat: 'Jumlah : <b>{point.y:f}</b> orang'
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						},
						showInLegend: false
					}
				},
				series: [{
					name: 'Tingkat Pendidikan',
					data: response.jml
				}]
			});
		});

// Jenis Jabatan
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap_pns/jenjab`, function (response) {
	Highcharts.chart('chart-jenjab', {
		chart: {
			options3d: {
		      enabled: false,
		      alpha: 55,
		      beta: 0
		    },
			type: 'pie'
		},
		title: {
			text: 'Jumlah PNS Berdasarkan Jenis Jabatan'
		},
		tooltip: {
			pointFormat: 'Jumlah: {point.y:f} <br> <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				}
			}
		},
		series: [{
			data: response.jml
		}]
	});
});

// Eselon
$.getJSON(`${_uri}/frontend/v1/api/silka_get_grap_pns/eselon`, function (response) {
	Highcharts.chart('chart-eselon', {
		chart: {
			type: 'cylinder',
		    options3d: {
	            enabled: true,
	            alpha: 15,
	            beta: 15,
	            depth: 50,
	            viewDistance: 25
	        }
		},

		title: {
			text: 'Jumlah PNS Berdasarkan Eselonering'
		},

		subtitle: {
			text: 'Pilih Label untuk seleksi eselon'
		},

		legend: {
			align: 'right',
			verticalAlign: 'middle',
			layout: 'vertical'
		},

		xAxis: {
			categories: ['Eselonering'],
			labels: {
				x: -10
			}
		},

		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Jumlah'
			}
		},

		series: response.jml,

		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						align: 'center',
						verticalAlign: 'bottom',
						layout: 'horizontal'
					},
					yAxis: {
						labels: {
							align: 'left',
							x: 0,
							y: -5
						},
						title: {
							text: null
						}
					},
					subtitle: {
						text: null
					},
					credits: {
						enabled: false
					}
				}
			}]
		}
	});
});

});
</script>