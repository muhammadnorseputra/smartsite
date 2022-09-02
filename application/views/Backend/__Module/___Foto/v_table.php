<div class="block-header row m-b-15">
	<h2>
	<i class="material-icons pull-left m-r-5 m-b-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">collections</i>
	Galeri Foto
	<small>Semua media foto</small>
	</h2>
</div>
<div id="myAlbum"></div>

<div class="clearfix"></div>
<a href="<?= site_url('module/c_foto/add?module='.$this->madmin->getmodulebycontroller('c_foto').'&user='.$this->session->userdata('user_access')); ?>">
	<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 text-center p-t-60 p-b-60 border-dot m-t-25 m-l-15">
		<em class="material-icons">add_a_photo</em> <br>Buat Album & Galeri Baru
	</div>
</a>
<div class="modal fade in" id="ModalDetail" role="dialog">
	<div class="modal-dialog" role="document" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header bg-danger" style="padding-bottom:0 !important;">
				<h4 class="modal-title" id="largeModalLabel"><span id="AlbumFoto"></span> <button type="button"
				class="close pull-right" data-dismiss="modal" aria-label="Close"><span
				aria-hidden="true">&times;</span></button> </h4>
				<ul class="nav nav-tabs tab-col-teal" role="tablist">
					<li role="presentation" class="active pull-left">
						<a href="#MyGaleri" data-toggle="tab"><em class="material-icons">photo_library</em> Galeri Saya</a>
					</li>
					<li role="presentation">
						<a href="#AddBoxGaleri" data-toggle="tab"><em class="material-icons">add_circle</em> Tambah Photo</a>
					</li>
					<li role="presentation">
						<a href="#EditBoxGaleri" data-toggle="tab"><em class="material-icons">edit</em> Edit Album</a>
					</li>
				</ul>
			</div>
			<div class="modal-body">
				
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="MyGaleri">
						<div class="row clearfix">
							<div id="_MyGaleri" data-role-galeri="aniimated-thumbnials"></div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="AddBoxGaleri">
						
						<?= form_open_multipart('backend/module/c_foto/addgaleridepan', array('id' => 'FormGaleriDepan')); ?>
						<input type="hidden" name="idalbum" class="form-control">
						<div class="row clearfix">
							
							<div class="col-md-6">
								<!-- <div class="alert alert-info">
											<strong>History</strong> foto yang ditambahkan oleh <u class="col-black"><b>
									<?= $this->session->userdata('namalengkap'); ?></b></u>
								</div> -->
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">search</i>
									</span>
									<div class="form-line">
										<input type="text" name="cariHistoryGaleriByUser" onkeyup="listGaleriByUser(this.value)"
										class="form-control"
										placeholder="Cari foto yang telah diupload <?= $this->session->userdata('namalengkap'); ?> ...">
									</div>
								</div>
								<div id="historyGaleriByUser" style="overflow-y:auto;max-height:300px;"></div>
							</div>
							<div class="col-md-4">
								<div class="msg" style="position:absolute; top:-130px; left:200px;"></div>
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
											<input name="publish_galeri" value="Y" type="radio" id="radio_03_g" class="radio-col-teal">
											<label for="radio_03_g">Ya</label>
											<input name="publish_galeri" value="N" type="radio" id="radio_04_g" class="radio-col-orange">
											<label for="radio_04_g">Tidak</label>
										</div>
									</div>
								</div>
								<button type="submit" id="BtnAddGaleri" class="btn btn-sm btn-info waves-effect">
								SIMPAN</button>
							</div>
							<div class="col-md-2">
								<div class="text-center p-t-5 p-b-5 p-l-5 p-r-5 border-dot border-3 border-col-grey" id="img-galeri">
									<div class="m-t-35 m-b-35 col-grey"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto
									</div>
								</div>
								<div class="form-group m-t-25">
									<label for="img_album">Pilih Gambar</label>
									<div class="form-line">
										<input type="file" name="foto" class="form-control col-teal" placeholder="Select Images"
										id="img_album">
									</div>
									<p class="help-block font-11 col-grey"> Only format (<code>jpg,jpeg,png</code>)<br> Max size 5 MB
									(5120 Kb)</p>
								</div>
							</div>
							
						</div>
						<?= form_close(); ?>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="EditBoxGaleri">
						<div class="row clearfix">
							<?= form_open_multipart('backend/module/c_foto/updatealbumdepan', array('id' => 'FormAlbumDepan')); ?>
							<input type="hidden" name="editalbumid">
							<input type="hidden" name="gbralbumbefore">
							<div class="col-md-8 col-md-offset-2 m-t-10">
								<div id="msg" style="position:absolute; top:-130px; left: 190px;"></div>
							</div>
							<div class="col-md-3 col-md-offset-2 m-t-35 m-b-35">
								
								
								<div class="m-t--25 text-center p-t-5 p-b-5 p-l-5 p-r-5 border-dot border-3 border-col-grey"
									id="img-edit-album">
									<div class="m-t-35 m-b-35 col-grey"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto
									</div>
								</div>
								<div class="form-group m-t-25">
									<label for="img_album">Pilih Gambar</label>
									<div class="form-line">
										<input type="file" name="fotoalbum" class="form-control col-teal" placeholder="Select Images"
										id="fotoalbum">
									</div>
									<p class="help-block font-12 col-grey"> Only format (<code>jpg,jpeg,png</code>)<br> Max size 5 MB
									(5120 Kb)</p>
								</div>
							</div>
							<div class="col-md-5 border-l border-col-grey bg-warning p-t-10 p-b-10">
								<div class="form-group m-t-5">
									<label for="judul_album">Judul</label>
									<div class="form-line">
										<input type="text" name="judul_album" class="form-control" id="judul_album">
									</div>
								</div>
								<div class="form-group m-t-5">
									<label for="keterangan_album">Keterangan</label>
									<div class="form-line">
										<textarea rows="3" name="keterangan_album" id="keterangan_album"
										class="form-control no-resize"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label for="publish" class="control-label col-md-12">Publish</label>
										<div class="col-md-12">
											<input name="publish_album" value="Y" type="radio" id="radio_05_g" class="radio-col-teal with-gap">
											<label for="radio_05_g">Ya</label>
											<input name="publish_album" value="N" type="radio" id="radio_06_g" class="radio-col-orange with-gap">
											<label for="radio_06_g">Tidak</label>
										</div>
									</div>
								</div>
								<button type="submit" id="BtnUpdateAlbum" class="btn btn-md btn-warning waves-effect waves-float">
								UPDATE</button>
							</div>
							
							
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>