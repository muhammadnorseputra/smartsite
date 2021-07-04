<div class="row clearfix">
	<?= form_open_multipart('backend/module/c_berita/send', array('id' => 'FormAddBerita')) ?>
	<div class="col-md-8 m-t-25">
		<?php $this->view('msg/flashdata') ?>

			<div class="form-group">
				<label for="title">Judul</label>
				<div class="form-line">
					<input type="text" name="title_berita" id="title" class="form-control"
					placeholder="Masukan judul berita disini..." value="<?php echo set_value('title_berita') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="content">Content</label>
				<textarea type="text" name="isi_berita" id="isi_berita"
				class=" form-control"><?php echo set_value('isi_berita') ?></textarea>
			</div>
			

		<div class="card card-border">
				<div class="header">
					<h2 class="card-title">Komentar</h2>
					<small> izinkan public memberikan komentar</small>
				</div>
				<div class="body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<input name="sts_komentar" checked value="0" type="radio" id="radio1" class="radio-col-green with-gap">
								<label for="radio1">PUBLIC</label>
								<input name="sts_komentar" value="1" type="radio" id="radio2" class="radio-col-pink with-gap">
								<label for="radio2">PRIVETE MEMBER</label>
							</div>
						</div>
					</div>
					
				</div>
			</div>
	</div>
	<div class="col-md-4">
		<div class="card card-border m-t-25">
			<div class="header">
				<h2 class="card-title">Publish</h2>
			</div>
			<div class="body">
				<div class="form-group">
				<select name="kategori" id="kategori"></select>
			</div>
			<div class="form-group">
				<label>Foto Original</label>
				<div class="text-center p-t-5 p-b-5 p-l-5 p-r-5 border-dot border-3 border-col-grey"
					id="img-edit-album">
					<div class="m-t-55 m-b-55 col-grey" id="before"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto
					</div>
					<img id="preview" style="display:none;">
				</div>
				<div class="form-line m-b-5"><input type="file" name="gambar" class="form-control col-teal"  accept="image/*" onchange="showImg(event)"></div>
				
				<input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-purple" checked="" name="thumb">
				<label for="md_checkbox_23">Created Thumbnail</label>
				
				<input type="checkbox" id="md_checkbox_24" class="filled-in chk-col-orange" checked="" name="mark">
				<label for="md_checkbox_24">Add Watermark</label>
			</div>
			<div class="form-group">
				<label>Publish</label>
				<div class="row">
					<div class="col-md-12">
						<div class="switch">
							<label>Simpan Draf <input name="publish" type="hidden" checked value="0"> <input name="publish" type="checkbox" value="1"> <span class="lever"></span> Ya</label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Headline</label>
				<div class="row">
					<div class="col-md-12">
						<div class="switch">
							<label>Tidak <input name="headline" type="hidden" checked value="0"> <input name="headline" type="checkbox" value="1"> <span class="lever"></span> Ya</label>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-sm btn-primary waves-effect pull-right">PUBLISH</button>
		</div>
	</div>
	<div class="card card-border">
		<div class="header">
			<h2 class="card-title">Kutipan Pendek Penulis</h2>
			<ul class="header-dropdown m-r--5">
				<li class="dropdown">
					<a href="javascript:void(0);" role="button" data-toggle="collapse" data-target="#collapse-penulis"
						aria-expanded="false" aria-controls="collapse-penulis">
						<i class="material-icons">keyboard_arrow_down</i>
					</a>
				</li>
			</ul>
		</div>
		<div class="body collapse in" id="collapse-penulis">
			<div class="row">
				<div class="col-md-3">
					<div class="image">
						<img src="<?= site_url('assets/images/users/') ?><?= $this->session->userdata('gravatar') ?>" width="48" height="48" alt="User" class="img-circle pull-left" />
					</div>
				</div>
				<div class="col-md-9">
					<div class="form-group">
				<div class="form-line">
					<textarea name="katapenulis" id="katapenulis" class="form-control" placeholder="Masukan pesan penulis, atau deskripsikan tentang penulis "></textarea>
				</div>
			</div>
				</div>
			</div>
			
			
		</div>
	</div>
	<div class="card card-border">
		<div class="header">
			<h2 class="card-title">Label / Tags</h2>
		</div>
		<div class="body">
			<div class="form-group">
			<select name="tags[]" id="tags" class="form-control" multiple="multiple" readonly></select>
		</div>
	</div>
</div>
</div>

<?= form_close(); ?>
</div>