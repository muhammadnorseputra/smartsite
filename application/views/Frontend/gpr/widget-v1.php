<section class="my-md-5 my-3">
	<div class="container">
		<div class="row pt-md-5">
			<div class="col-md-8 pr-md-5 order-last order-md-first" id="main-content">
				<h4>Tentang GPR-BKPPD Balangan</h4>
				<hr>
				<p>
					GPR (Government Public Relation) BKPPD Balangan merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <span class="badge badge-light badge-pill" title="Official Site BKPPD Balangan"> https://bkpsdm.balangankab.go.id/</span> dan informasi statistik pegawai bersumber pada aplikasi SILKa (Sistem Informasi Kepegawaian) Daerah Balangan <span class="badge badge-light badge-pill" title="SILKa Online">http://silka.balangankab.go.id/</span>.
				</p>
				<h4>Cara Memasang Widget pada CMS (Wordpress, Joomla, dll)</h4>
				<hr>
				<p>
					Letakkan script tags dibawah ini pada widget HTML WP, Joomla dan semacamnya.
				</p>
				<p class="small">
					<pre><code>&lt;script defer="defer" type="text/javascript" src="//bkpsdm.balangankab.go.id/assets/gpr/gpr_bkppdblg_production.js"&gt;&lt;/script&gt;<br>&lt;div id="widget-gpr-bkppdblg"&gt;&lt;/div&gt;</code></pre>
				</p>
				<h4>Cara Memasang Widget dengan Inline Script <span class="badge badge-pill badge-success">rekomendasi</span></h4>
				<hr>
				Tambahkan script JS dibawah ini sebelum penutup <code>&lt;/body&gt;</code>
				<p>
					<pre><code>&lt;script&gt;<br>const jqueryScript = document.createElement('script');
jqueryScript.src = '//bkpsdm.balangankab.go.id/assets/gpr/gpr_bkppdblg_production.js';
document.head.append(jqueryScript);<br>&lt;/script&gt;</code></pre>
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
					Untuk memodifikasi widget hanya berlaku untuk perubahan <abbr title="gpr-theme">Tema</abbr>, <abbr title="gpr-height">Tinggi Widget</abbr>, <abbr title="Gambar Thumbnail">Thumbnail</abbr> sebagai penyesuaian thema website/blog anda. 
				</p>
				<p>
					<pre><code>&lt;div id="widget-gpr-bkppdblg" gpr-theme="teal" gpr-height="500" gpr-thumb="image"&gt;&lt;/div&gt;</code></pre>
				</p>
				<table class="table table-bordered table-sm">
					<thead>
						<tr>
							<th class="w-25">Atteribute</th>
							<th>Value</th>
							<th>Default</th>
							<th class="w-25">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><code>gpr-theme</code></td>
							<td><span class="badge badge-light">nama warna</span> <br> <span class="badge badge-light">kode warna</span></td>
							<td><span class="badge badge-light">teal</span> <br> <span class="badge badge-light">#01877C</span></td>
							<td class="small text-muted">Pilih value tema dengan nama warna atau dengan kode warna, sesuaikan dengan tema situs</td>
						</tr>
						<tr>
							<td><code>gpr-width</code></td>
							<td><span class="badge badge-light">auto</span></td>
							<td><span class="badge badge-light">auto</span></td>
							<td class="small text-muted">Widget akan secara otomatis menyesuaikan lebar dari ukuran layar atau element (responsive)</td>
						</tr>
						<tr>
							<td><code>gpr-height</code></td>
							<td><span class="badge badge-light">number</span></td>
							<td><span class="badge badge-light">500</span></td>
							<td class="small text-muted">Silahkan isi dengan format angka, sesuaikan dengan tinggi widget yang akan dipasang dengan element pada situs anda</td>
						</tr>
						<tr>
							<td><code>gpr-thumb</code></td>
							<td><span class="badge badge-light">default</span> <br> <span class="badge badge-light">icon</span> <br> <span class="badge badge-light">image</span> <br> <span class="badge badge-light">number</span></td>
							<td><span class="badge badge-light">default</span></td>
							<td class="small text-muted">Pilih tipe thumbnail widget, sistem akan secara default menset tipe thumbnail ke <span class="badge badge-light">default</span> tanpa menampilkan gambar/icon jika atteribute tidak diset</td>
						</tr>
					</tbody>
				</table>
				<p>
					Silahkan tambahkan Atteribute <code>gpr-theme</code> (Tema Widget), <code>gpr-height</code> (Tinggi Widget), <code>gpr-thumb</code> (Thumbnail) pada script HTML, jika Atteribute tidak dipasang kami akan setting secara <code>default</code>
				</p>
				<p>
					Untuk nilai value <b>tema</b> dapat diisi <span class="badge badge-pill badge-dark">nama warna / kode warna</span> (contoh: gpr-theme="<code>teal</code>") dan untuk nilai value <b>tinggi</b> dapat diisi dengan <span class="badge badge-pill badge-dark">angka</span> (contoh: gpr-height="<code>500</code>")
				</p>
				<p>
					Untuk tipe thumbnail bisa digunakan <code>default</code>, <code>icon</code>, <code>image</code>, <code>number</code>.
				</p>
				<hr>
				<div class="small">Developer by <a rel="noreferrer, nofollow" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6"> putrabungsu6</a></div>
			</div>
			<div class="col-md-4 mb-5">
				<div id="sidebar">
					<h4>Tampilan Widget</h4>
					<hr>
					<!-- <script defer="defer" type="text/javascript" src="//bkpsdm.balangankab.go.id/assets/gpr/gpr_bkppdblg_production.js"></script> -->
					<script defer="defer" type="text/javascript" src="<?= base_url("assets/gpr/gpr_bkppdblg_production.js") ?>"></script>
					<div id="widget-gpr-bkppdblg" gpr-theme="#000d6b" gpr-thumb="image"></div>
				</div>	
			</div>	
		</div>
	</div>
</section>