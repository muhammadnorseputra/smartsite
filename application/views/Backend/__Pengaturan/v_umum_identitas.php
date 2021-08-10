<div class="row">
	<div class="col-md-6">
		<div class="card card-border">
			<div class="header">
				<h2>Identitas</h2>
			</div>
			<div class="card-body p-t-20 p-l-20 p-r-20">
				<?= form_open_multipart('backend/c_pengaturan/do_identitas', array('id' => '#formIdentitas')) ?>

				<label for="brand">Brand Website</label>
				<div class="form-group">
					<div id="view-container" class="w-100 m-b-10 text-center" style="background-color:#f8f8f7;">
						<?php
						$img_default = base_url('assets/images/noimage.gif');
						$img_blob    = 'data:image/jpeg;base64,' . base64_encode($fromdata[0]->site_logo);
						$brand = $fromdata[0]->site_logo  != '' ? $img_blob : $img_default;
						?>
						<img id="views_logo" src="<?= $brand ?>" class="image-rounded" width="100%" alt="bkppd_logo" />
					</div>
					<div class="form-line">
						<input type="file" name="bkppd_logo" class="form-control" placeholder="Pilih file">
					</div>
					<p class="help-block col-cgrey font-italic font-12">Ukuran gambar maksimal lebar = 200(px), tinggi = 70(px)
					</p>
				</div>

				<label for="title-site">Title Website</label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="title" name="bkppd_title" class="form-control" value="<?= $fromdata[0]->site_title  ?>" placeholder="Masukan title website ...">
					</div>
					<p class="help-block col-cgrey font-italic font-12">Masukan ini akan ditempatkan pada tab browser, pada
						setiap halaman.</p>
				</div>

				<label for="meta-seo">Meta Seo</label>
				<div class="form-group">
					<div class="form-line">
						<textarea rows="1" name="bkppd_seo" class="form-control no-resize auto-growth" placeholder="Contoh: Tags1, tags2, tags3, ..." style="overflow: hidden; overflow-wrap: break-word; height: 52px;"><?= $fromdata[0]->meta_seo   ?></textarea>
					</div>
					<p class="help-block col-cgrey font-italic font-12">Masukan beberapa tag yang terkait dengan website agar
						mempermudah pencarian pada search engine google.</p>
				</div>

				<label for="meta-desk">Meta Deskripsi</label>
				<div class="form-group">
					<div class="form-line">
						<textarea rows="4" name="bkppd_desc" class="form-control no-resize" placeholder="Masukan deskripsi website ..."><?= $fromdata[0]->meta_desc   ?></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-sm btn-link waves-effect pull-right m-b-20">UPDATE IDENTITAS</button>
				<div class="clearfix"></div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">

		<div class="card card-border">
			<div class="header">
				<h2>Kontak</h2>
			</div>
			<div class="card-body p-t-10 p-l-20 p-r-20">
				<?= form_open('backend/c_pengaturan/do_kontak', array('id' => '#formKontak')) ?>
				<label for="fb">Facebook</label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" name="bkppd_fb" id="fb" value="<?= $fromdata[0]->fb  ?>" class="form-control" placeholder="Masukan Link Id Facebook">
					</div>
				</div>

				<label for="ig">Instagram</label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" name="bkppd_ig" id="ig" value="<?= $fromdata[0]->ig  ?>" class="form-control" placeholder="Masukan Link Id Instakgram">
					</div>
				</div>

				<label for="email">Email</label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" name="bkppd_email" id="email" value="<?= $fromdata[0]->email  ?>" class="form-control" placeholder="Masukan Email">
					</div>
				</div>

				<label for="nohp">Nomor HP / Cell Center</label>
				<div class="form-group">
					<div class="form-line">
						<input type="number" name="bkppd_nohp" value="<?= $fromdata[0]->nohp  ?>" min="0" minlength="-1" id="nohp" class="form-control" placeholder="Masukan nohp aktif & valid">
					</div>
					<p class="help-block col-cgrey font-italic font-12">Masukan seperti ini 082151815132</p>
				</div>

				<div class="form-group">
					<label for="email_address">Embed Maps</label>
					<div class="form-line">
						<textarea rows="4" name="embed_maps" placeholder="SDK Api Google Maps" class="form-control no-resize"><?= $fromdata[0]->map_embed ?></textarea>
					</div>
					<p class="help-block col-cgrey font-italic font-12"><b>Pastekan kode embed yang didapat pada google maps.</b><br>
						Dengan cara buka google map versi web (<a target="_blank" href="https://www.google.co.id/maps/">google-maps</a>)
						cari lokasi > share lokasi > sematkan / embed > copy code</p>
				</div>
				<hr>
				<button type="submit" class="btn btn-sm btn-link waves-effect pull-right m-b-20">UPDATE KONTAK</button>
				<div class="clearfix"></div>
				<?= form_close() ?>
			</div>
		</div>
	</div>

</div>

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#views_logo').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("[name='bkppd_logo']").change(function() {
		readURL(this);
	});
</script>
