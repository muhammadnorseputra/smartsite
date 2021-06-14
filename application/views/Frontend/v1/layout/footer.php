<section class="py-4 border-top border-light bg-white">
	<div class="container">
		<div class="d-flex justify-content-lg-start align-content-center text-primary flex-column flex-lg-row">
			<div class="mr-3 d-none d-md-block d-lg-block">
				<i class="fas fa-map-pin fa-3x"></i>
			</div>
			<div>
				<span class="d-block font-weight-bold">Alamat Kantor</span>
				Batupiring Km. 4,5 Paringin Selatan Kabupaten Balangan. Kodepos 71662,
				<span class="text-dark">Kalimantan Selatan - Indonesia</span>
			</div>
			<div class="ml-md-auto my-auto">
				<a target="_blank" href="https://www.google.com/maps/dir//-2.364905,115.470992" class="btn btn-sm btn-primary">Buka pada maps <i class="fas fa-link"></i></a>
			</div>
		</div>
	</div>
</section>
<section class="py-4 bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-md-5 text-left">
				<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="150"/>'; ?>
				<p class="my-4 text-light">
					<?= $mf_beranda->meta_desc ?>
				</p>
				<div class="d-flex text-light align-content-center justify-content-between ">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
						  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
						</svg>
						<div class="small">Pengunjung Online</div>
						<h3><span class="text-danger"><?= $this->mf_visitor->visitor_count()['jml_online']  ?></span> 
							<span class="d-none d-md-block">Orang</span></h3>
					</div>
					<div class="mx-md-5 mx-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
						  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
						  <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
						</svg>
						<div class="small">Total Hari Ini</div>
						<h3><span class="text-info"><?= $this->mf_visitor->visitor_count()['jml_hariini']  ?></span> <span class="d-none d-md-block">Orang</span></h3>
					</div>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
						</svg>
						<div class="small">Total Pengunjung</div>
						<h3><span class="text-warning"><?= $this->mf_visitor->visitor_count()['jml_total_pengunjung']  ?></span> <span class="d-none d-md-block">Orang</span></h3>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<h6 class="text-white-50 pb-3 border-bottom">Ikuti Juga</h6>
				<ul class="list-unstyled">
					<li>
						<a href="<?= base_url('survey') ?>"><span><i class="fas fa-external-link-alt text-white mr-2"></i></span>Survey Kepegawaian</a>
					</li>
					<li>
						<a href="<?= base_url('kotak_saran') ?>"><span><i class="fas fa-external-link-alt text-white mr-2"></i></span>Kirim Saran / Laporkan BUG</a>
					</li>
					<li>
						<a href="<?= base_url('userlist') ?>"><span><i class="fas fa-external-link-alt text-white mr-2"></i></span>Userportal</a>
					</li>
				</ul>
			</div>
			<div class="col-md-4 col-sm-6">
				<h6 class="text-white-50 pb-3 border-bottom">Link Terkait</h6>
				<ul class="list-unstyled">
					<li class="d-flex">
						<span><i class="fas fa-link text-white mr-2"></i></span>
						<a target="_blank" href="https://www.bkn.go.id/">BKN Pusat</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-white mr-2"></i></span>
						<a target="_blank" href="https://www.kemendagri.go.id/">Kementerian Dalam Negeri</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-white mr-2"></i></span>
						<a target="_blank" href="https://www.menpan.go.id/site/">Kementrian Pemberdayagunaan Aparatur Negara</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-white mr-2"></i></span>
						<a target="_blank" href="https://bkd.kalselprov.go.id/">BKD Provinsi Kalimantan Selatan</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-white mr-2"></i></span>
						<a target="_blank" href="https://bpsdm.kalselprov.go.id/">BPSDM Provinsi Kalimantan Selatan</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-white mr-2"></i></span>
						<a target="_blank" href="https://balangankab.go.id/">Pemerintah Kabupaten Balangan</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="bg-dark">
	<div class="container border-top border-light">
		<div class="row text-center pb-5 mb-5 mb-md-0 py-3 pb-md-3">
			<div class="col-md-12 d-flex align-items-center justify-content-between flex-lg-row flex-column">
				<div class="text-left text-white">
					<div class="small">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</div>
				</div>
				<div class="text-right text-white d-none d-md-block d-lg-block">
					<a target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn py-3 btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn  py-3 btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Our Instagram" data-username="<?= $mf_beranda->ig; ?>">
                        <i class="fab fa-instagram"></i>
                    </a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- jQuery -->
<script src="<?= base_url('template/v1/prod/vendor-min.js'); ?>"></script>
<script src="<?= base_url('template/v1/prod/app-min.js'); ?>"></script>
<script src="https://apis.google.com/js/platform.js"></script>
<!-- <script type='text/javascript' src='//overlapflintsidenote.com/ee/4a/40/ee4a400fe2d588e699491311fb2352cc.js'></script> -->
</body>
</html>