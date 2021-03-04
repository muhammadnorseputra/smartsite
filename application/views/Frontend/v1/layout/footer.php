<section class="py-4 bg-gradient-light mt-4">
	<div class="container">
		<div class="d-flex justify-content-lg-start align-content-center text-primary">
			<div class="mr-3">
				<i class="fas fa-search-location fa-3x"></i>
			</div>
			<div>
				<span class="d-block font-weight-bold">Alamat</span>
				Batupiring Km. 4,5 Paringin Selatan Kabupaten Balangan. Kodepos 71662
			</div>
		</div>
	</div>
</section>
<section class="py-5 bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="110"/>'; ?>
				<p class="my-4">
					<?= $mf_beranda->meta_desc ?>
				</p>
			</div>
			<!-- <div class="col-md-3">
				<h6>Bantuan</h6>
			</div>
			<div class="col-md-3">
				<h6>Privacy</h6>
			</div> -->
		</div>
	</div>
</section>
<section class="bg-white">
	<div class="container">
		<div class="row text-center py-4">
			<div class="col-md-12 d-flex align-items-center justify-content-center">
				<div class="text-center text-secondary">
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