<footer>
<section class="py-4 bg-white border-top">
	<div class="container">
		<div class="d-flex justify-content-lg-start align-content-center text-dark flex-column flex-lg-row">
			<div class="mr-3 d-none d-md-block d-lg-block">
				<i class="fas fa-map-pin fa-3x"></i>
			</div>
			<div>
				<span class="d-block font-weight-bold">Alamat Kantor</span>
				Batupiring Km. 4,5 Paringin Selatan Kabupaten Balangan. Kodepos 71662,
				<span class="text-primary">Kalimantan Selatan - Indonesia</span>
			</div>
			<div class="ml-md-auto my-auto">
				<a rel="noreferrer" target="_blank" href="https://www.google.com/maps/dir//-2.364905,115.470992" class="btn btn-sm btn-light">Buka pada maps <i class="fas fa-link"></i></a>
			</div>
		</div>
	</div>
</section>
<section class="py-5 bg-footer bg-footer-style">
	<div class="container">
		<div class="row">
			<div class="col-md-5 text-left">
				<div class="d-flex justify-content-start mb-3">
					<div>
						<img src="<?= base_url('assets/images/logo.png') ?>" width="80" alt="logo kabupaten balangan from bkpsdm">	
					</div>
					<div>
						<p class="text-white">
							<?= $mf_beranda->meta_desc ?>
						</p>
					</div>
				</div>
				<div class="d-flex justify-content-start align-items-center mb-3">
				    <a  rel="noreferrer" target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn py-3 btn-primary-old" data-toggle="tooltip" data-placement="bottom" data-title="Join group facebook" title="Join group facebook">
				        <i class="fab fa-facebook"></i>
				    </a>
				    <a  rel="noreferrer" target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn py-3 btn-warning my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" data-title="Follow Our Instagram" title="Follow Our Instagram" data-username="<?= $mf_beranda->ig; ?>">
				        <i class="fab fa-instagram"></i>
				    </a>
				    <a  rel="noreferrer" target="_blank" href="https://www.youtube.com/channel/UCFDRHqqNeuYql8O7y5sHgmw" class="btn py-3 btn-danger my-2 my-sm-0 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" data-title="Subscribe Channel Youtube" title="Subscribe Channel Youtube">
				        <i class="fab fa-youtube"></i>
				    </a>
				    <a  rel="noreferrer" target="_blank" href="mailto:bkppdbalangan@gmail.com" class="btn py-3 btn-success my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" data-title="Email for works" title="Email for works">
				        <i class="fas fa-envelope-open"></i>
				    </a>
				    <a  rel="noreferrer" target="_blank" href="https://news.google.com/publications/CAAqBwgKMLfcpwswpOe_Aw?oc=3&ceid=ID:id" class="btn py-3 btn-info my-2 my-sm-0 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" data-title="Google News" title="Google News">
				        <i class="fab fa-google"></i>
				    </a>
				</div>
				<div class="d-flex text-light align-content-center justify-content-between ">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
						  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
						</svg>
						<?php
							$this->mf_visitor->visitor_source(); 
							$this->mf_visitor->visitor_count(); 
						?>
						<div class="small">Pengunjung Online</div>
						<h3><span class="text-danger"><?= $this->mf_visitor->visitor_view()['jml_online']  ?></span> 
						</h3>
					</div>
					<div class="mx-md-5 mx-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
						  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
						  <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
						</svg>
						<div class="small">Total Hari Ini</div>
						<h3><span class="text-info"><?= nominal($this->mf_visitor->visitor_view()['jml_hariini'])  ?></span></h3>
					</div>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
						</svg>
						<div class="small">Total Pengunjung</div>
						<h3><span class="text-warning"><?= nominal($this->mf_visitor->visitor_view()['jml_total_pengunjung'])  ?></span></h3>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<h6 class="text-warning pb-3 border-bottom">Ikuti Juga</h6>
				<ul class="list-unstyled list-footer">
					<li>
						<a  rel="noreferrer" href="https://news.google.com/publications/CAAqBwgKMLfcpwswpOe_Aw?oc=3&ceid=ID:id"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>BKPPD Google News</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-external-link-alt text-light mr-2"></i></span>
						<a href="//www.bkpsdm-skm.balangankab.go.id" target="_blank">Survey Layanan Kepegawaian</a>
					</li>
					<li>
						<a href="<?= base_url('kotak_saran') ?>"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Kirim Saran / Laporkan BUG</a>
					</li>
					<li>
						<a href="<?= base_url('koran-online') ?>"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Koran Online Gratis</a>
					</li>					
					<li class="d-flex">
						<span><i class="fas fa-external-link-alt text-light mr-2"></i></span>
						<a href="<?= base_url('news') ?>">Berita Seputar Indonesia</a>
					</li>
					<li>
						<a href="<?= base_url('userlist') ?>"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Userportal</a>
					</li>
				</ul>
				
			</div>
			<div class="col-md-4 col-sm-6">
				<h6 class="text-warning pb-3 border-bottom">Link Terkait</h6>
				<ul class="list-unstyled list-footer text-light">
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="nofollow, noreferrer" target="_blank" href="https://www.bkn.go.id/">BKN Pusat</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="nofollow, noreferrer" target="_blank" href="https://sscasn.bkn.go.id/">SSCASN BKN</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="nofollow, noreferrer" target="_blank" href="https://www.kemendagri.go.id/">Kementerian Dalam Negeri</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="nofollow, noreferrer" target="_blank" href="https://www.menpan.go.id/site/">Kementrian Pemberdayagunaan Aparatur Negara</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="nofollow, noreferrer" target="_blank" href="https://bpsdm.kalselprov.go.id/">BPSDM Provinsi Kalimantan Selatan</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="nofollow, noreferrer" target="_blank" href="https://bkd.kalselprov.go.id/">BKD Provinsi Kalimantan Selatan</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a target="_blank" href="https://balangankab.go.id/">Pemerintah Kabupaten Balangan</a>
					</li>
				</ul>
			</div>
				<div class="col-md-7 offset-md-5">
				<h6 class="mb-2 border-bottom text-warning panel-title d-flex pb-3 align-item-center" data-toggle="collapse" data-target="#collapseTree">Link Patner Informative</h6>
					<ul class="list-unstyled list-footer panel-collapse collapse" id="collapseTree">
						<li class="d-flex align-item-center justify-content-between">
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://worldquran.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>World Quran</a>
							</div>
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://www.mediabalangan.com/"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Media Balangan</a>
							</div>
							<div>
								<!-- 2 Bulan Exp (23 Juli - 23 September) -->
								<a target="_blank" href="https://kicaumania.net/"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>kicaumania</a>
							</div>
						</li>
						<li class="d-flex align-item-center justify-content-between">
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://satechainmedia.com/"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Blockchain technology</a>
							</div>
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://sdn-haurgading.xyz"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Berita Technology</a>
							</div>
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://www.soundoftext.co.id"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Soundoftext</a>
							</div>
						</li>
						<li class="d-flex align-item-center justify-content-between">
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://lokeridn.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Lowongan Kerja</a>
							</div>
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://world-giveaways.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Giveaway Gratis</a>
							</div>
							<div>
								<!-- Permanent -->
								<a target="_blank" href="https://www.ulastempat.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>UlasTempat </a>
							</div>
						</li>
					</ul>
				</div>
		</div>
	</div>
</section>
<section style="background-color: #03045e;">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center pb-4 pt-3 mb-5 mb-md-0 pb-md-3 d-flex align-items-center justify-content-between flex-lg-row flex-column">
				<div class="text-left text-white">
					<div class="align-content-center align-items-center">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</div>
				</div>
				<!-- <div class="text-right text-white d-none d-md-block d-lg-block">
					
				</div> -->
			</div>
		</div>
	</div> 
</section>
</footer>
<script defer src="<?= base_url('template/v1/prod/vendor-min.js'); ?>"></script>
<script defer src="<?= base_url('template/v1/prod/app-min.js'); ?>"></script>
</body>
</html>
