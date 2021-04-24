<section>
	<div class="container">
		<div class="separator">
			<span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-leaf text-secondary mr-2"></i>Digital Goverment</span>
		</div>
		<div class="d-flex flex-row align-items-center justify-content-around">
			<div>
				<a target="_blank" data-toggle="tooltip" href="http://silka.bkppd-balangankab.info/" title="aplikasi sistem informasi layanan kepegawaian balangan">
					<?php echo '<img src="'.base_url('assets/images/logo-silka.png').'" width="140"/>'; ?>
				</a>
			</div>
			<div class="my-4">
				<a target="_blank" data-toggle="tooltip" href="https://ekinerja.bkppd-balangankab.info/" title="aplikasi e-kinerja balangan">
					<?php echo '<img src="'.base_url('assets/images/logo-ekinerja.png').'" width="160"/>'; ?>
				</a>
			</div>
			<div class="mt-2 p-2">
				<a target="_blank" data-toggle="tooltip" href="https://eprilaku.bkppd-balangankab.info/" title="aplikasi e-prilaku balangan">
					<?php echo '<img src="'.base_url('assets/images/logo-eprilaku.png').'" width="80"/>'; ?>
				</a>
			</div>
		</div>
	</div>
</section>
<section class="py-2 bg-gradient-light">
	<div class="container">
		<div class="d-flex justify-content-lg-start align-content-center text-primary">
			<div class="mr-3">
				<i class="fas fa-map-pin fa-3x"></i>
			</div>
			<div>
				<span class="d-block font-weight-bold">Alamat</span>
				Batupiring Km. 4,5 Paringin Selatan Kabupaten Balangan. Kodepos 71662,
				<span class="text-dark">Kalimantan Selatan - Indonesia</span>
			</div>
			<div class="ml-auto my-auto">
				<a target="_blank" href="https://www.google.com/maps/dir//-2.364905,115.470992" class="btn btn-sm btn-primary">Buka pada maps <i class="fas fa-link"></i></a>
			</div>
		</div>
	</div>
</section>
<section class="py-5 bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-md-6 text-left">
				<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="150"/>'; ?>
				<p class="my-4 text-white">
					<?= $mf_beranda->meta_desc ?>
				</p>
				<div class="d-flex text-white align-content-around">
					<div>
						<b>Pengunjung Online</b>
						<h3><span class="text-danger"><?= $this->mf_visitor->visitor_count()['jml_online']  ?></span> Orang</h3>
					</div>
					<div class="mx-md-5 mx-2">
						<b>Total Hari Ini</b>
						<h3><span class="text-info"><?= $this->mf_visitor->visitor_count()['jml_hariini']  ?></span> Orang</h3>
					</div>
					<div>
						<b>Total Pengunjung</b>
						<h3><span class="text-warning"><?= $this->mf_visitor->visitor_count()['jml_total_pengunjung']  ?></span> Orang</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<h6 class="text-white pb-2 border-bottom">Ikuti Juga</h6>
				<ul class="list-unstyled">
					<li>
						<a href="<?= base_url('survey') ?>"><span><i class="fas fa-check-circle text-white mr-2"></i></span>Survey Kepegawaian</a>
					</li>
					<li>
						<a href="<?= base_url('kotak_saran') ?>"><span><i class="fas fa-check-circle text-white mr-2"></i></span>Kirim Saran</a>
					</li>
				</ul>
			</div>
			<div class="col-md-3">
				<h6 class="text-white pb-2 border-bottom">Lainnya</h6>
				<ul class="list-unstyled">
					<li>
						<a href="<?= base_url('userlist') ?>"><span><i class="fas fa-check-circle text-white mr-2"></i></span>User Terdaftar</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="bg-dark">
	<div class="container">
		<div class="row text-center py-5 border-top border-light">
			<div class="col-md-12 d-flex align-items-center justify-content-center">
				<div class="text-center text-white">
					<div class="small">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- jQuery -->
<script src="<?= base_url('template/v1/prod/vendor-min.js'); ?>"></script>
<script src="<?= base_url('template/v1/prod/app-min.js'); ?>"></script>
</body>
</html>