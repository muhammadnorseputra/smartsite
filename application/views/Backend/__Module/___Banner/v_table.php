<div class="block-header row m-b-15">
	<h2>

		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">panorama</i> Banner
		<small>Iklan / Info / Spanduk / Famplate / Browsur </small>
	</h2>
</div>

<div class="clearfix">
	<div class="card card-shadow">
		<div class="header">
			<b class="card-heading">
				FORM TAMBAH BANNER</b>
			<a href="javascript:void(0);" class="collapsed" role="button" data-toggle="collapse" data-target="#FormBanner" aria-expanded="true" aria-controls="collapseExample">
				<button class="btn btn-lg btn-link bg-white pull-right waves-effect waves-float waves-indigo waves-ripple font-16 p-l-25 p-r-25"> Upload banner
					<span class="glyphicon glyphicon-chevron-right m-l-10"></span>
				</button>
			</a>
			<br>
			<small>Desain banner yang elegan dan profisional</small>



		</div>
		<?= form_open_multipart('backend/module/c_banner/add', array('class' => 'collapse', 'id' => 'FormBanner')) ?>
		<div class="body">
			<div class="row">
				<div class="col-md-5">

					<div class="form-group">
						<label for="judul">Judul</label>
						<div class="form-line">
							<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan Judul Banner..">
						</div>
					</div>

					<div class="form-group">
						<label for="url">Url</label>
						<div class="form-line">
							<input type="text" id="url" name="url" class="form-control" placeholder="http:// ">
						</div>
					</div>

					<div class="form-group">
						<label for="idjns_banner">Jenis Banner </label><a type="button" data-toggle="modal" data-target="#addJenisBanner" href="javascript:void(0);" class="pull-right"><em class="material-icons">add_box</em></a>
						<div class="form-line">
							<select class="bootstrap-select form-control" name="idjns_banner">
								<option value="0">Pilih Jenis Banner</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="tgl_publish" class="control-label col-md-2 m-t-1">Publish</label>
						<div class="col-md-5">
							<input name="publish" value="N" type="radio" id="radio_02_i" class="with-gap radio-col-red">
							<label for="radio_02_i">TIDAK</label>
							<input name="publish" value="Y" type="radio" id="radio_01_i" class="with-gap radio-col-teal">
							<label for="radio_01_i">YA</label>
						</div>
					</div>

				</div>
				<div class="col-md-7">
					<div class="text-center border-3 border-col-grey p-t-5 p-b-5 p-l-5 p-r-5" id="ShowGambar" style="width: 100%; height: 170px; overflow-y: scroll; overflow-x:hidden;">
						<div class="p-t-55 p-b-55" id="before"> <em class="glyphicon glyphicon-picture font-26"></em> <br> Pilih File </div>
						<img id="preview" style="display:none;">

					</div>

					<!-- <div class="form-group m-t-10">
						<div class="form-line">
						<label for="tgl_publish">Info Gambar</label>
							<input type="text" id="path" class="form-control" disabled>
						</div>
					</div> -->

					<div class="form-group m-t-10">
						<div class="form-line">
							<input type="file" name="gambar" class="form-control col-teal" accept="image/*" onchange="previewImg(event)">
						</div>
						<button type="submit" class="btn btn-link btn-rounded bg-indigo pull-right m-t-15 waves-effect waves-float"> Simpan <span class="glyphicon glyphicon-picture m-l-5"></span></button>
					</div>

				</div>

			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>

<!-- MODAL TAMBAH JENIS BANNER -->
<div class="modal fade" id="addJenisBanner" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md modal-vcenter" role="document">
		<?= form_open('backend/module/c_banner/add_jenis_banner', array('id' => 'FormAddJenisBanner')) ?>
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> TAMBAH JENIS BANNER</h4>
			</div>
			<div class="modal-body border-bottom">
				<div id="message"></div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-float form-group-md">
							<div class="form-line">
								<input type="text" class="form-control" name="posisi" />
								<label class="form-label">Posisi Banner</label>
							</div>
							<p class="help-block font-12 col-grey"> Default: <code>Header, Footer, Sidebar, Content</code> <em class="col-lime"> apabila dibuat costum poisi maka harus menambahkan manual script pada frontend</em> </p>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<select class="form-control show-tick" name="jenis">
									<option value="0">Pilih Jenis</option>
									<option value="ADS">ADS</option>
									<option value="SLIDE">SLIDE</option>
									<option value="BANNER">BANNER</option>
								</select>
							</div>
							<p class="help-block font-12 col-grey"><em> Sesuaikan jenis banner yang akan <u> diupload </u></em></p>
						</div>
					</div>
					<div class="col-md-6">
						<ul class="list-group" id="jenis-banner"></ul>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link btn-rounded waves-effect waves-float waves-teal waves-ripple p-l-15 p-r-15"> Simpan</button>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>

<!-- MODAL EDIT BANNER -->
<div class="modal fade modal-fixed-footer" id="editBanner" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" role="document">
		<?= form_open('backend/module/c_banner/update_banner', array('id' => 'FormUpdateBanner')) ?>
		<input type="hidden" name="idbanner_e">
		<input type="hidden" name="file_before">
		<div class="modal-content">
			<div class="modal-header">

				<div class="text-center border-dot border-2 border-col-grey p-t-5 p-b-5 p-l-5 p-r-5" id="MyGambar">
					<div class="p-t-35 p-b-35"><em class="glyphicon glyphicon-picture font-26"></em> <br> Gambar</div>
				</div>
			</div>
			<div class="modal-body border-bottom">
				<div id="response"></div>

				<!-- <div class="form-group m-t-10">
								<div class="form-line">
								<label for="path_e">Path</label>
									<input type="text" id="path_e" class="form-control" disabled>
								</div>
							</div> -->
				<div class="form-group">
					<label for="judul_e">Judul</label>
					<div class="form-line">
						<input type="text" id="judul_e" name="judul_e" class="form-control" placeholder="Masukan Judul Banner..">
					</div>
				</div>

				<div class="form-group">
					<label for="url_e">Url</label>
					<div class="form-line">
						<input type="text" id="url_e" name="url_e" class="form-control" placeholder="http:// ">
					</div>
				</div>

				<div class="form-group">
					<label for="idjns_banner">Jenis Banner </label>
					<div class="form-line">
						<select class="bootstrap-select form-control" name="idjns_banner">
							<option value="0">Pilih Jenis Banner</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="radio_03_i" class="control-label col-md-12 m-t-1">Publish</label>
					<div class="col-md-5">
						<input name="publish_e" value="N" type="radio" id="radio_03_i" class="with-gap radio-col-red">
						<label for="radio_03_i">TIDAK</label>
						<input name="publish_e" value="Y" type="radio" id="radio_04_i" class="with-gap radio-col-teal">
						<label for="radio_04_i">YA</label>
					</div>
				</div>

				<div class="form-group">
					<div class="alert alert-message alert-message-danger" role="alert">
						<i class="material-icons">info</i>
						<b>Notice</b> <br>Apabila gambar tidak diubah, biarkan kosong!
					</div>
					<label for="gambar_e">Ubah Gambar </label>
					<div class="form-line">
						<input type="file" id="gambar_e" name="gambar_e" class="form-control col-teal">
					</div>
					<p class="help-block font-12 col-grey"></p>
				</div>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link btn-rounded waves-effect waves-float waves-teal waves-rippel"> Simpan Perubahan</button>
				<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-link btn-rounded waves-effect waves-red waves-ripple waves-float m-l-15 p-l-15 p-r-15"> Batal</button>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>

<div class="clearfix m-t--10">
	<div class="row">
		<div id="list-banner"></div>
	</div>
</div>
