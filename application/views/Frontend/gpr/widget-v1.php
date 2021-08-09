<section class="my-5">
	<div class="container">
		<div class="row pt-md-5">
			<div class="col-md-8 pr-5">
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
				Tambahkan script JS dibawah ini pada sebelum penutup <code>&lt;/body&gt;</code>
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
				<hr>
				<div class="small">Developer by <a rel="noreferrer, nofollow" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6"> putrabungsu6</a></div>
			</div>
			<div class="col-md-4">
				<h4>Tampilan Widget</h4>
				<hr>
				<div id="widget-gpr-bkppdblg"></div>
			</div>	
		</div>
	</div>
</section>