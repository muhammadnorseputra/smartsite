<section class="my-md-5 my-3">
	<div class="container">
		<div class="row pt-md-5">
			<div class="col-md-8 pr-md-5 order-last order-md-first" id="main-content">
				<h4>Tentang GPR-BKPPD Balangan</h4>
				<hr>
				<p>
					GPR (Government Public Relation) BKPPD Balangan merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <span class="badge badge-light badge-pill" title="Official Site BKPPD Balangan"> https://web.bkppd-balangankab.info/</span> dan informasi statistik pegawai bersumber pada aplikasi SILKa (Sistem Informasi Kepegawaian) Daerah Balangan <span class="badge badge-light badge-pill" title="SILKa Online">http://silka.bkppd-balangankab.info/</span>.
				</p>
				<h4>Cara Memasang Widget pada CMS (Wordpress, Joomla, dll)</h4>
				<hr>
				<p>
					Letakkan script tags dibawah ini pada widget HTML WP, Joomla dan semacamnya.
				</p>
				<p class="small">
					<pre><code>&lt;script defer="defer" crossorigin="anonymous" type="text/javascript" src="//web.bkppd-balangankab.info/assets/gpr/gpr_bkppdblg_production.js"&gt;&lt;/script&gt;<br>&lt;div id="widget-gpr-bkppdblg"&gt;&lt;/div&gt;</code></pre>
				</p>
				<h4>Cara Memasang Widget dengan Inline Script</h4>
				<hr>
				Tambahkan script JS dibawah ini sebelum penutup <code>&lt;/body&gt;</code>
				<p>
					<pre><code>const jqueryScript = document.createElement('script');
jqueryScript.src = '//web.bkppd-balangankab.info/assets/gpr/gpr_bkppdblg_production.js';
document.head.append(jqueryScript);</code></pre>
				</p>
				<p>
					Kemudian tambahkan script HTML dibawah ini pada posisi yang anda ingin tampilkan widget
				</p>
				<p>
					<pre><code>&lt;div id="widget-gpr-bkppdblg"&gt;&lt;/div&gt;</code></pre>
				</p>
				<h4>Modifikasi Widget</h4>
				<hr>
				<p>
					Untuk memodifikasi widget hanya berlaku untuk perubahan <abbr title="gpr-theme">Tema</abbr> dan <abbr title="gpr-height">Tinggi Widget</abbr> sebagai penyesuaian thema website/blog anda. 
				</p>
				<p>
					Silahkan tambahkan Atteribute <code>gpr-theme</code> (Tema Widget), <code>gpr-height</code> (Tinggi Widget) pada script HTML, jika Atteribute tidak dipasang kami akan mengisi Tema dan Tinggi secara <code>default</code>
				</p>
				<p>
					Untuk nilai value <b>tema</b> dapat diisi <b>nama warna</b> (contoh: gpr-theme="<code>teal</code>") dan untuk nilai value <b>tinggi</b> dapat diisi dengan <b>angka</b> (contoh: gpr-height="<code>500</code>")
				</p>
				<p>
					<pre><code>&lt;div id="widget-gpr-bkppdblg" gpr-theme="teal" gpr-height="500"&gt;&lt;/div&gt;</code></pre>
				</p>
				<hr>
				<div class="small">Developer by <a rel="noreferrer, nofollow" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6"> putrabungsu6</a></div>
			</div>
			<div class="col-md-4 mb-5">
				<div id="sidebar">
					<h4>Tampilan Widget</h4>
					<hr>
					<script defer="defer" crossorigin="anonymous" type="text/javascript" src="//web.bkppd-balangankab.info/assets/gpr/gpr_bkppdblg_production.js"></script>
					<div id="widget-gpr-bkppdblg"></div>
				</div>	
			</div>	
		</div>
	</div>
</section>