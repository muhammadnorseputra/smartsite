<section class="hero pt-md-5 pt-3">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-start flex-lg-row flex-column">
			<div>
				<h3 class="font-weight-bold text-responsive">Grafik Pegawai </h3>
				<p class="text-muted small">Resources <code>SILKa Online</code> &bull; Uptodate <?= date('Y-m-d H:i:s') ?></p>
			</div>
			<div class="pb-3 pb-pd-0">
				<div class="btn-group" role="group" aria-label="Basic example">
				  <button type="button" class="btn btn-warning" disabled><i class="fas fa-print"></i></button>
				  <a role="button" href="<?= base_url('pegawai/report') ?>" class="btn btn-warning">Views Report</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section>
	<div class="container py-3 my-3">
		<div class="row">
				<div class="col-12 col-md-6">
				  		<div id="chart-jenkel"></div>
				</div>
				<div class="col-12 col-md-6">
				  		<div id="chart-golru"></div>
				</div>
				<div class="col-12 col-md-6">
				  		<div id="chart-tingpen"></div>
				</div>
				<div class="col-12 col-md-6">
				  		<div id="chart-jenjab"></div>
				</div>
				<div class="col-12">
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
let url = _silka;
$(document).ready(function () {
// Jenis Kelamin
$.getJSON(`${url}/api/get_grap_pns/jenkel`, function (response) {
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
$.getJSON(`${url}/api/get_grap_pns/golru`, function (response) {
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
$.getJSON(`${url}/api/get_grap_pns/tingpen`, function (response) {
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
					name: 'Line Chart',
					data: response.jml
				}]
			});
		});
});

// Jenis Jabatan
$.getJSON(`${url}/api/get_grap_pns/jenjab`, function (response) {
	Highcharts.chart('chart-jenjab', {
		chart: {
			options3d: {
		      enabled: true,
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
$.getJSON(`${url}/api/get_grap_pns/eselon`, function (response) {
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
</script>