<section class="bg-white mt-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="d-block p-4">
					<div class="container text-center">
						<div class="d-flex flex-column flex-md-row justify-content-md-center align-items-md-center">
							<div>
								<a href="<?= base_url() ?>" title="website resmi bkppd balangan">
									<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="140"/>'; ?>
								</a>
							</div>
							<div class="ml-md-5 mt-3">
								<a target="_blank" href="http://silka.bkppd-balangankab.info/" title="aplikasi sistem informasi layanan kepegawaian balangan">
									<?php echo '<img src="'.base_url('assets/images/logo-silka.png').'" width="140"/>'; ?>
								</a>
							</div>
							<div class="mx-md-5 my-3">
								<a target="_blank" href="https://eprilaku.bkppd-balangankab.info/" title="aplikasi e-prilaku balangan">
									<?php echo '<img src="'.base_url('assets/images/logo-eprilaku.png').'" width="80"/>'; ?>
								</a>
							</div>
							<div>
								<a target="_blank" href="https://ekinerja.bkppd-balangankab.info/" title="aplikasi e-kinerja balangan">
									<?php echo '<img src="'.base_url('assets/images/logo-ekinerja.png').'" width="160"/>'; ?>
								</a>
							</div>
						</div>
						<br>
						<div class="text-muted small">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan. Semua Hak Dilindungi. <br> Alamat: Desa Batu Piring, Kecamatan Paringin Selatan, Kabupaten Balangan, Kalimantan Selatan. Kodepos 71662</div>
					</div>
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