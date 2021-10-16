<footer>
<section class="py-4 border-top border-light bg-white">
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
<section class="py-5 bg-white border-top bg-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-5 text-left">
				<?php echo '<img src="'.img_blob($mf_beranda->site_logo).'" width="210" alt="BKPPD Balangan"/>'; ?>
				<p class="my-4 text-dark">
					<?= $mf_beranda->meta_desc ?>
				</p>
				<div class="d-flex text-secondary align-content-center justify-content-between ">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
						  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
						</svg>
						<?php $this->mf_visitor->visitor_source(); ?>
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
						<h3><span class="text-info"><?= nominal($this->mf_visitor->visitor_count()['jml_hariini'])  ?></span> <span class="d-none d-md-block">Orang</span></h3>
					</div>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
						</svg>
						<div class="small">Total Pengunjung</div>
						<h3><span class="text-warning"><?= nominal($this->mf_visitor->visitor_count()['jml_total_pengunjung'])  ?></span> <span class="d-none d-md-block">Orang</span></h3>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<h6 class="text-secondary pb-3 border-bottom">Ikuti Juga</h6>
				<ul class="list-unstyled">
					<li>
						<a  rel="noreferrer" href="https://news.google.com/publications/CAAqBwgKMLfcpwswpOe_Aw?oc=3&ceid=ID:id"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>BKPPD Google News</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-external-link-alt text-light mr-2"></i></span>
						<a href="<?= base_url('skm') ?>">Survey Layanan Kepegawaian</a>
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
				<h6 class="text-secondary pb-3 border-bottom">Link Terkait</h6>
				<ul class="list-unstyled text-light">
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://www.bkn.go.id/">BKN Pusat</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://sscasn.bkn.go.id/">SSCASN BKN</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://www.kemendagri.go.id/">Kementerian Dalam Negeri</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://www.menpan.go.id/site/">Kementrian Pemberdayagunaan Aparatur Negara</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://bpsdm.kalselprov.go.id/">BPSDM Provinsi Kalimantan Selatan</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://bkd.kalselprov.go.id/">BKD Provinsi Kalimantan Selatan</a>
					</li>
					<li class="d-flex">
						<span><i class="fas fa-link text-light mr-2"></i></span>
						<a  rel="noreferrer" target="_blank" href="https://balangankab.go.id/">Pemerintah Kabupaten Balangan</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center pb-5 mb-5 mb-md-0 py-3 pb-md-3 d-flex align-items-center justify-content-between flex-lg-row flex-column">
				<div class="text-left text-dark">
					<div class="small">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</div>
				</div>
				<!-- <div class="text-right text-white d-none d-md-block d-lg-block">
					
				</div> -->
			</div>
		</div>
	</div> 
</section>
</footer>
<!-- jQuery -->
<script src="https://www.google.com/recaptcha/api.js?render=6Le5188cAAAAALJLPkaQd8MHHmzdLSMTmyRXxgNV"></script>
 <script>
  function onClick(e) {
    e.preventDefault();
    grecaptcha.ready(function() {
      grecaptcha.execute('6Le5188cAAAAALJLPkaQd8MHHmzdLSMTmyRXxgNV', {action: 'submit'}).then(function(token) {
          // Add your logic to submit to your backend server here.
      });
    });
  }
</script>
<script defer="defer" src="<?= base_url('template/v1/prod/vendor-min.js'); ?>" crossorigin="anonymous"></script>
<script defer="defer" src="<?= base_url('template/v1/prod/app-min.js'); ?>" crossorigin="anonymous"></script>
<script>
    /*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
    !function(a){"use strict";var b=function(b,c,d){function j(a){if(e.body)return a();setTimeout(function(){j(a)})}function l(){f.addEventListener&&f.removeEventListener("load",l),f.media=d||"all"}var g,e=a.document,f=e.createElement("link");if(c)g=c;else{var h=(e.body||e.getElementsByTagName("head")[0]).childNodes;g=h[h.length-1]}var i=e.styleSheets;f.rel="stylesheet",f.href=b,f.media="only x",j(function(){g.parentNode.insertBefore(f,c?g:g.nextSibling)});var k=function(a){for(var b=f.href,c=i.length;c--;)if(i[c].href===b)return a();setTimeout(function(){k(a)})};return f.addEventListener&&f.addEventListener("load",l),f.onloadcssdefined=k,k(l),f};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
    /*! loadCSS rel=preload polyfill. [c]2017 Filament Group, Inc. MIT License */
    !function(a){if(a.loadCSS){var b=loadCSS.relpreload={};if(b.support=function(){try{return a.document.createElement("link").relList.supports("preload")}catch(a){return!1}},b.poly=function(){for(var b=a.document.getElementsByTagName("link"),c=0;c<b.length;c++){var d=b[c];"preload"===d.rel&&"style"===d.getAttribute("as")&&(a.loadCSS(d.href,d,d.getAttribute("media")),d.rel=null)}},!b.support()){b.poly();var c=a.setInterval(b.poly,300);a.addEventListener&&a.addEventListener("load",function(){b.poly(),a.clearInterval(c)}),a.attachEvent&&a.attachEvent("onload",function(){a.clearInterval(c)})}}}(this);
  </script>
<!-- <script src="https://jouteetu.net/pfe/current/tag.min.js?z=4503415" data-cfasync="false" async></script>
<script>(function(d,z,s){s.src='//'+d+'/400/'+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})('rndhaunteran.com',4503438,document.createElement('script'))</script> -->
</body>
</html>