<section class="py-2 bg-gradient-light mt-4">
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
						<b>Jumlah Hits</b>
						<h3><span class="text-info"><?= $this->mf_beranda->visitor()['jml_hariini']  ?></span> Orang</h3>
					</div>
					<div class="mx-md-5 mx-2">
						<b>Total Pengunjung</b>
						<h3><span class="text-warning"><?= $this->mf_beranda->visitor()['jml_total_pengunjung']  ?></span> Orang</h3>
					</div>	
					<div>
						<b>Pengunjung Online</b>
						<h3><span class="text-danger"><?= $this->mf_beranda->visitor()['jml_online']  ?></span> Orang</h3>
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
				<h6 class="text-white pb-2 border-bottom">Privacy</h6>
			</div>
		</div>
	</div>
</section>
<section class="bg-dark border-top border-primary">
	<div class="container">
		<div class="row text-center py-4">
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