<!-- <div class="alert alert-message" role="alert">
	<em class="material-icons pull-left m-r-10">info_outline</em> Pertama buat sebuah album untuk gelari foto
</div> -->

<div class="row claerfix">
	<div class="col-md-4 m-t-25" id="album">

			<?= form_open_multipart('backend/module/c_foto/addphoto', array('id' => 'FormAlbum')); ?>
			<input type="hidden" name="gbrlama">
			<input type="hidden" id="fileName" class="form-control">

				<div class="text-center border-dot border-3 border-col-grey p-t-5 p-b-5 p-l-5 p-r-5" id="ShowPhoto" style="width: 100%; height: 180px; overflow-y: hidden; overflow-x:hidden;">
					<div class="p-t-45 p-b-45" id="before"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto Album</div>

					<img id="preview" style="display:none;" class="img-responsive">
				</div>

				<div class="form-group m-t-10">
					<label for="img_album">Pilih Gambar</label>
					<div class="form-line">
						<input type="file" class="form-control col-teal" name="gbr_album" placeholder="Select Images"
							id="img_album" accept="image/*" onchange="previewImg(event)">
					</div>
					<p class="help-block font-12 col-grey"> File yang di ijinkan Upload hanya (<code>jpg,jpeg,png</code>), Ukuran
						Maksimal 5 MB (5120 Kb)</p>
				</div>

				<div class="form-group m-t-5">
					<label for="judul">Judul</label>
					<div class="form-line">
						<input type="text" name="judul" class="form-control" placeholder="Masukan judul album" id="judul">
					</div>
				</div>

				<div class="form-group m-t-5">
					<label for="judul">Deskripsi</label>
					<div class="form-line">
						<textarea rows="3" name="keterangan" class="form-control no-resize"
							placeholder="Masukan keterangan album"></textarea>
					</div>
				</div>

				<div class="row m-t-5">
					<div class="col-md-12">
						<div class="form-group">
							<label for="file" class="control-label">Publish</label><br>

							<input name="publish" value="Y" type="radio" id="radio_01" class="with-gap radio-col-teal">
							<label for="radio_01">Ya</label>

							<input name="publish" value="N" type="radio" id="radio_02" class="with-gap radio-col-orange">
							<label for="radio_02">Tidak</label>

						</div>
					</div>
				</div>

				<button type="button" style="display:none;" id="hapus" class="pull-left btn btn-danger waves-effect" onclick="hapusAlbum()"> HAPUS</button>
				<button type="submit" id="add" class="btn btn-primary waves-effect pull-right">
					SIMPAN</button>
		<?= form_close(); ?>
	</div>

	<div class="col-md-8">


		<div class="card card-border m-t-25">
			<div class="header">
				<div class="row">
					<div class="col-md-7">
						<h2>
								<em class="material-icons pull-left m-r-10">photo_library</em> galeri <small>Add Photo
								Galeri</small>
						</h2>
					</div>
					<div class="col-md-5">

					</div>
				</div>
			</div>
			<div class="body collapse FormGaleri">
				<?= form_open_multipart('backend/module/c_foto/addgaleri', array('id' => 'FormGaleri')); ?>
				<div class="alert alert-message" role="alert">
					* Pilih Album untuk menambah galeri
				</div>
				<input type="text" name="idalbumadd" class="form-control">
				<div class="row clearfix">
					<div class="msg"></div>
					<div class="col-md-5">

						<div class="text-center p-l-5 p-r-5 p-b-5 p-t-5 border-dot border-3 border-col-grey" id="img-galeri">
							<div class="m-t-45 m-b-45"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto</div>
						</div>

						<div class="form-group m-t-25">
							<label for="img_album">Pilih Gambar</label>
							<div class="form-line">
								<input type="file" name="foto" class="form-control col-teal" placeholder="Select Images" id="img_album">
							</div>
							<p class="help-block font-12 col-grey"> Only format (<code>jpg,jpeg,png</code>)<br> Max size 5 MB (5120
								Kb)</p>
						</div>
					</div>
					<div class="col-md-7">
						<div class="form-group m-t-5">
							<label for="judul_galeri">Judul</label>
							<div class="form-line">
								<input type="text" name="judul_galeri" class="form-control" placeholder="Masukan Judul Foto..."
									id="judul_galeri">
							</div>
						</div>


						<div class="form-group m-t-5">
							<label for="keterangan_galeri">Keterangan</label>
							<div class="form-line">
								<textarea rows="3" name="keterangan_galeri" id="keterangan_galeri" class="form-control no-resize"
									placeholder="Masukan Keterangan Foto Disini..."></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="publish" class="control-label col-md-12">Publish</label>
								<div class="col-md-12">
									<input name="publish_galeri" value="Y" type="radio" id="radio_03_g" class="with-gap radio-col-teal">
									<label for="radio_03_g">Ya</label>

									<input name="publish_galeri" value="N" type="radio" id="radio_04_g" class="with-gap radio-col-orange">
									<label for="radio_04_g">Tidak</label>
								</div>
							</div>
						</div>

						<button type="submit" id="BtnAddGaleri" class="btn btn-rounded btn-primary waves-effect">
							SIMPAN</button>
					</div>
				</div>

				<?= form_close(); ?>

				<!-- </div> -->
			</div>
		</div>

		<div class="card m-t--15 card-border">
			<div class="header">
				<div class="row">
					<div class="col-md-6">
						<select name="idalbum" id="pilihalbum" class="pull-right form-control"></select>
					</div>
				</div>
				<input type="hidden" name="idalbum" class="form-control" readonly>
			</div>
			<div class="body" id="myGaleriLoading">
				<div class="row">
					<div id="myGaleri"></div>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="modal fade in" id="ModalEditGaleri" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<?= form_open_multipart('backend/module/c_foto/updategaleri', array('id' => 'FormUpdateGaleri')); ?>
			<div class="modal-header">
				<h4 class="modal-title">Edit Galeri <button type="button" class="close pull-right" data-dismiss="modal"
						aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body">
				<div id="response"></div>
				<input type="hidden" name="idgaleri_e">
				<input type="hidden" name="file_e">
				<div class="row clearfix">

					<div class="col-md-4">
						<div class="text-center" id="data-galeri"></div>
						<div class="form-group">
							<label for="gambar_e">Ganti gambar</label>
							<div class="form-line col-teal">
								<input type="file" name="gambar_e" class="form-control">
							</div>
							<p class="help-block font-12 col-grey"> Only format (<code>jpg,jpeg,png</code>)<br> Max size 5 MB (5120
								Kb)</p>
						</div>
					</div>

					<div class="col-md-8">

						<div class="form-group">
							<label for="judul_e">Judul</label>
							<div class="form-line">
								<input type="text" name="judul_e" class="form-control" placeholder="Masukan Judul Galeri">
							</div>
						</div>

						<div class="form-group">
							<label for="keterangan_e">Keterangan</label>
							<div class="form-line">
								<textarea name="keterangan_e" id="keterangan_e" rows="2" class="form-control"
									placeholder="Masukan Keterangan"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="publish">Publish</label><br>
							<input name="publish_galeri_e" value="Y" type="radio" id="radio_05_g" class="with-gap radio-col-teal m-l-10">
							<label for="radio_05_g">Ya</label>

							<input name="publish_galeri_e" value="N" type="radio" id="radio_06_g" class="with-gap radio-col-grey">
							<label for="radio_06_g">Tidak</label>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer bg-primary">
				<button type="submit" class="btn btn-warning m-l-10 waves-effect waves-float waves-teal waves-ripple">Simpan Perubahan</button>
				<button type="button" onclick="hapusGaleri()" class="btn btn-circle btn-danger pull-left waves-effect waves-red col-yellow waves-ripple m-t--35"><i class="glyphicon glyphicon-trash"></i> </button>
			</div>

			<?= form_close(); ?>
		</div>
	</div>
</div>

<script>
$(function () {
	
$('select').selectpicker({
			liveSearch: true,
			liveSearchPlaceholder: 'Masukan katakunci ...',
			showTick: true,
			size: 5
		});
		
});
</script>
