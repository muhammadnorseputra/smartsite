<div id="sticky-header">
	<div class="block-header border-b border-1 border-col-grey">
		<div class="row">
			<div class="col-md-4">
				<h2>
					<i class="material-icons pull-left m-r-5 m-b-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">video_library</i>
					Galeri Video
					<small>Video List</small>
				</h2>
			</div>
			<div class="col-md-8">

				<button data-target="#ModalAdd" data-toggle="modal" class="btn btn-sm btn-link pull-right waves-effect waves-float bg-white m-r-15 m-t-5"><em class="glyphicon glyphicon-plus m-r-5"></em> Buat
					album video</button>
				<a id="addvideo-button" href="<?= site_url('backend/module/c_video/addvideo/youtube?module=' . $this->madmin->getmodulebycontroller('c_video') . '&user=' . $this->session->userdata('user_access')) ?>" class="font-12 pull-left m-r-15 m-t-5 btn btn-danger btn-sm waves-effect waves-red waves-float"><em class="glyphicon glyphicon-facetime-video m-r-5"></em> Tambah Youtube</a>
				<a id="addvideo-button" href="<?= site_url('backend/module/c_video/addvideo/local?module=' . $this->madmin->getmodulebycontroller('c_video') . '&user=' . $this->session->userdata('user_access')) ?>" class="font-12 pull-left m-t-5 btn btn-primary btn-sm waves-effect waves-cyan waves-float"><em class="glyphicon glyphicon-hdd m-r-5"></em> Tambah Local</a>
			</div>
		</div>
	</div>
</div>
<div class="row clearfix">
	<div id="sticky-left">
		<div class="col-md-4 p-t-15" id="album">
			<div class="text-center border-dot border-3 border-col-grey m-t-0 p-t-5 p-b-5 p-r-5 p-l-5" id="imgPreview">
				<div class="p-t-60 p-b-60"><em class="glyphicon glyphicon-picture font-26"></em> <br> Poster</div>
			</div>
			<input type="hidden" name="id_albumvideo">
			<input type="hidden" name="path_video">
			<input type="hidden" name="poster_video">
			<div class="clearfix m-t-10" id="infoVideo">
			</div>
		</div>
	</div>
	<div id="list-album-video" class="col-md-8 p-t-15">
		<div class="sticky-album-video">
			<div class=" clearfix border-b border-1 border-col-grey">

				<div class="col-md-4">
					<b class="font-16">DAFTAR VIDEO</b>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12 m-t--5">
							<div class="form-group">
								<div class="form-line">
									<select name="idalbum" id="pilihalbum" class="form-control bootstrap-select"></select>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div id="media-video" class=" m-t-20">
			<p class="text-center">
				<img class="img-rounded" width="35%" src="<?php echo base_url('assets/images/fitur/video-camera.png') ?>" alt="video-camera">
				<h4 class="text-center">Video Studio BKPPD</h4>
				<p class="text-mutted text-center">Pilih album untuk menampilkan beberapa video</p>
			</p>
		</div>
	</div>
</div>
<!-- MODAL TAMBAH ALBUM VIDEO -->
<div class="modal modal-fixed-footer fade in" data-backdrop="static" id="ModalAdd" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<?= form_open_multipart('backend/module/c_video/add', array('id' => 'FormVideo')) ?>
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Tambah Album <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body border-top border-bottom">
				<div class="row">
					<div class="col-md-4">
						<div class="text-center border-dot border-2 border-col-grey" id="imgView">
							<div class="m-t-25 m-b-25"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto</div>
						</div>

					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label for="img_album">Pilih Poster</label>
							<div class="form-line">
								<input type="file" name="poster" class="form-control" placeholder="Select Images" id="img_album">
							</div>
							<p class="help-block font-12 col-grey"> Only format (<code>jpg,jpeg,png</code>) Dimesi <code>360 x 240
									pixel</code> Max size 5 MB (5120 Kb) </p>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label for="judul">Judul</label>
					<div class="form-line">
						<input type="text" name="judul" class="form-control" placeholder="Masukan judul album..." id="judul">
					</div>
				</div>
				<div class="form-group m-t-5">
					<label for="judul">Deskripsi</label>
					<div class="form-line">
						<textarea rows="2" name="keterangan" class="form-control no-resize" placeholder="Masukan deskripsi album video disini..."></textarea>
					</div>
				</div>
				<div class="form-group m-t-5">
					<label for="judul">Publish</label><br>
					<input name="publish" value="Y" type="radio" id="radio1" class="with-gap radio-col-teal" />
					<label for="radio1">Ya</label>
					<input name="publish" value="N" type="radio" id="radio2" class="with-gap radio-col-red" />
					<label for="radio2">Tidak</label>
				</div>
			</div>
			<div class="modal-footer bg-primary">
				<button type="submit" class="btn btn-link bg-yellow waves-effect waves-float btn-rounded"><span class="glyphicon glyphicon-picture m-r-5"></span> Buat album</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<!-- MODAL EDIT ALBUM VIDEO -->
<div class="modal fade in" data-backdrop="static" id="ModalEdit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<?= form_open_multipart('backend/module/c_video/update', array('id' => 'FormUpdateVideo')) ?>
			<input type="hidden" name="id_albumvideo_e">
			<input type="hidden" name="path_video_e">
			<input type="hidden" name="poster_video_e">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Edit Album <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body border-bottom">
				<div class="row clearfix">
					<div class="col-md-4">
						<div class="text-center border-dot border-2 border-col-grey  p-t-5 p-b-5 p-r-5 p-l-5" id="imgViewEdit"></div>
						<div class="form-group m-t-25">
							<label for="img_album">Pilih Poster</label>
							<div class="form-line">
								<input type="file" name="poster_e" class="form-control" placeholder="Select Images" id="img_album">
							</div>
							<p class="help-block font-12 col-grey"> Only format (<code>jpg,jpeg,png</code>) <br>Dimesi <code>360 x 240
									pixel</code> <br> Max size 5 MB (5120 Kb) </p>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group m-t-5">
							<label for="judul">Judul</label>
							<div class="form-line">
								<input type="text" name="judul_e" class="form-control" placeholder="Masukan Judul Foto..." id="judul">
							</div>
						</div>
						<div class="form-group m-t-5">
							<label for="judul">Deskripsi</label>
							<div class="form-line">
								<textarea rows="2" name="keterangan_e" class="form-control no-resize" placeholder="Masukan Deskripsi Foto Disini..."></textarea>
							</div>
						</div>
						<div class="form-group m-t-5">
							<label for="judul">Publish</label><br>
							<input name="publish_e" value="Y" type="radio" id="radio3" class="with-gap radio-col-cyan" />
							<label for="radio3">Ya</label>
							<input name="publish_e" value="N" type="radio" id="radio4" class="with-gap radio-col-pink" />
							<label for="radio4">Tidak</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link btn-sm waves-effect">&nbsp; Simpan Perubahan &nbsp;</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<!-- MODAL PINDAH VIDEO KE ALBUM LAIN -->
<div class="modal fade in" data-backdrop="static" id="ModalPindah" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<?= form_open('backend/module/c_video/pindah_video', array('id' => 'FormPindahVideo')); ?>
			<input type="hidden" name="videoid">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Pidah Video <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="form-line">
						<select id="pilihalbum_utama" class="form-control"></select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<!-- MODAL EDIT VIDEO YOUTUBE -->
<div class="modal fade in" data-backdrop="static" id="ModalEditYoutube" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document" style="width:80%;">
		<div class="modal-content edit_youtubevideo">
			<?= form_open('backend/module/c_video/update_videoyoutube', array('id' => 'FormEditVideoYoutube')); ?>
			<input type="hidden" name="videoidYoutube">
			<input type="hidden" name="imgBeforeYoutube">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Youtube <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body border-bottom">
				<div class="row ">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div id="previewVideoYoutube"></div>
								<div class="form-group">
									<label for="url">ID video youtube</label>
									<div class="form-line">
										<input type="text" name="url_videoyoutube" id="url" class="form-control">
									</div>
									<p class="help-block col-grey font-11">Tanpa menggunakan <code>http | https</code> Contoh: <s>https://www.youtube.com/watch?v=</s><code class="bg-lime">D5KRv5GBHYQ</code></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-border">
							<div class="body">
								<div class="row">
									<div class="alert alert-message" role="alert">
										<span class="col-red"> <em class="material-icons pull-left m-r-10">info_outline</em></span>Apabila poster tidak diubah, biarkan kosong
									</div>
									<div class="col-md-5">
										<div class="text-center border-dot border-2 border-col-grey m-b-10 p-l-5 p-r-5 p-t-5 p-b-5" id="imagesView">
											<div class="m-t-25 m-b-25"><em class="glyphicon glyphicon-picture font-26"></em> <br> Foto</div>
										</div>
										<div class="form-group m-t-5">
											<label for="ubahposter">Ubah Poster</label>
											<div class="form-line">
												<input type="file" name="poster_videoyoutube" id="ubahposter" class="form-control col-teal">
											</div>
											<p class="help-block col-grey font-11">Only format (<code>jpg, jpeg, png</code>) Max size 5MB, Resolution 1366 x 768 (px)</p>
										</div>
										<div class="form-group m-t-5">
											<label for="radio5">Publish</label><br>
											<input name="publish_videoyoutube" value="Y" type="radio" id="radio5" class="with-gap radio-col-teal" />
											<label for="radio5">Ya</label>
											<input name="publish_videoyoutube" value="N" type="radio" id="radio6" class="with-gap radio-col-red" />
											<label for="radio6">Tidak</label>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<label for="title">Judul</label>
											<div class="form-line">
												<input type="text" name="judul_videoyoutube" id="title" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="des">Keterangan</label>
											<div class="form-line">
												<textarea name="keterangan_videoyoutube" id="des" class="form-control" rows="5"></textarea>
											</div>
										</div>
										<div class="form-group m-t-5">
											<label for="radio7">Video Pilihan</label><br>
											<input name="pilihan_videoyoutube" value="Y" type="radio" id="radio7" class="with-gap radio-col-teal" />
											<label for="radio7">Ya</label>
											<input name="pilihan_videoyoutube" value="N" type="radio" id="radio8" class="with-gap radio-col-red" />
											<label for="radio8">Tidak</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="message" class="d-block"></div>
				<button type="button" id="infoEditYoutube" class="btn btn-sm btn-link" disabled="disabled">UPDATE</button>
				<button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<!-- MODAL EDIT VIDEO LOCAL -->
<div class="modal fade in" data-backdrop="static" id="ModalEditLocal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document" style="width:80%;">
		<div class="modal-content">
			<?= form_open('backend/module/c_video/update_videolocal', array('id' => 'FormEditVideoLocal')); ?>
			<input type="hidden" name="videoidLocal">
			<input type="hidden" name="fileBeforeLocal">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Local<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div id="previewVideoLocal"></div>
							</div>
							<div class="col-md-12">
								<div class="alert alert-message m-b-5" role="alert">
									<span class="col-red font-12"><span class="col-red">*</span> Apabila video tidak diubah, biarkan kosong</span>
								</div>
								<div class="form-group">
									<label for="ubahvideo">Ubah File</label>
									<div class="form-line">
										<input type="file" name="file_videolocal" id="ubahvideo" class="form-control col-teal">
									</div>
									<p class="help-block font-11 col-grey"> Only format (<code>mp4, mkv, flv</code>) Max size 3.3 MB
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="title">Judul</label>
							<div class="form-line">
								<input type="text" name="judul_videolocal" id="title" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="des">Keterangan</label>
							<div class="form-line">
								<textarea name="keterangan_videolocal" id="des" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="radio9">Publish</label><br>
							<input name="publish_videolocal" value="Y" type="radio" id="radio9" class="with-gap radio-col-cyan" />
							<label for="radio9">Ya</label>
							<input name="publish_videolocal" value="N" type="radio" id="radio10" class="with-gap radio-col-pink" />
							<label for="radio10">Tidak</label>
						</div>
						<div class="form-group">
							<label for="radio11">Video Pilihan</label><br>
							<input name="pilihan_videolocal" value="Y" type="radio" id="radio11" class="with-gap radio-col-cyan" />
							<label for="radio11">Ya</label>
							<input name="pilihan_videolocal" value="N" type="radio" id="radio12" class="with-gap radio-col-pink" />
							<label for="radio12">Tidak</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="message-local" class="d-block"></div>
				<button type="button" id="infoEditLocal" class="btn btn-sm btn-secondary" disabled="disabled">UPDATE</button>
				<button type="submit" class="btn btn-sm btn-link">UPDATE</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
