<div class="m-t-15">
	<div id="msg"></div>
	<div class="card card-border">
	<?= form_open_multipart('backend/module/c_video/addByYoutube', array('id' => 'FormVideoYoutube')) ?>
		<div class="header">
			<button type="button" onclick="window.history.back(-1);" class="btn btn-circle btn-link waves-effect waves-float pull-left m-r-15 m-t--15 bg-indigo"><i class="glyphicon glyphicon-chevron-left"></i></button>
			<h2 class="card-title">
				Tambah Video
			</h2>
		</div>
		<div class="body mporgress">
			<div class="col-md-4">
				<div class="form-group">
					<label for="pilihalbum" class="control-label">Pertama Pilih Album Video</label>
					<div class="form-line">
						<select name="idalbum" id="pilihalbum" class="form-control"></select>
						<input type="hidden" name="id_albumvideo">
					</div>
				</div>
				<!-- <div class="text-center border-dot border-2 border-col-grey  p-t-5 p-b-5 p-r-5 p-l-5" id="myAlbumVideo">
					<div class="m-t-80 m-b-80"><em class="glyphicon glyphicon-picture font-26"></em> <br>Gambar Album</div>
				</div>
				<div class="clearfix m-t-25 m-b-25"></div> -->
				<div class="text-center border-dot border-2 border-col-grey  p-t-5 p-b-5 p-r-5 p-l-5" id="myVideoPoster">
					<div class="m-t-65 m-b-65" id="before"><em class="glyphicon glyphicon-picture font-26"></em> <br>Poster Video<br>
					</div>
					<img id="preview" style="display:none;">
				</div>	
				<div class="form-group m-t-5">
							<label for="poster">Pilih Poster <span class="col-red">*</span></label>
							<div class="form-line">
							<input type="file" name="postervideo" class="form-control"  accept="image/*" onchange="showImg(event)">
							</div>
						</div>
				
			</div>
			<div class="col-md-8">
						<div class="form-group">
							<label for="judul">Judul <span class="col-red">*</span></label>
							<div class="form-line">
								<input type="text" name="judul" class="form-control" placeholder="Judul video">
							</div>
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan Video</label>
							<div class="form-line">
							<textarea name="keterangan_video" class="form-control" rows="5" placeholder="Masukan keterangan video disini"></textarea>
							</div>
						</div>
						

				<div class="form-group">
					<div class="form-line">
						<label for="link_yotube">Link Youtube <span class="col-red">*</span></label>
						<input type="text" name="link_youtube" class="form-control" placeholder="Masukan link youtube..">
					</div>
					<p class="help-block"><em><small>Contoh: <code> <del>www.m.youtube.com/?w=</del>abcdefg2019</code></small></em> <button type="button" onclick="testVideo()" class="btn btn-sm btn-link waves-effect waves-float pull-right"><em
							 class="material-icons pull-left font-20 m-r-5">play_circle_filled</em> Cek URL</button></p>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="radio" class="control-label">Publish <span class="col-red">*</span></label><br>
							<input name="publish" value="Y" type="radio" id="radio1" class="radio-col-teal with-gap">
							<label for="radio1">Ya</label>

							<input name="publish" value="N" type="radio" id="radio2" class="radio-col-red  with-gap">
							<label for="radio2">Tidak</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
					<label for="radio" class="control-label">Video Pilihan <span class="col-red">*</span></label><br>
					<input name="pilihan" value="Y" type="radio" id="radio3" class="radio-col-teal with-gap">
					<label for="radio3">Ya</label>

					<input name="pilihan" value="N" type="radio" id="radio4" class="radio-col-red  with-gap">
					<label for="radio4">Tidak</label>
				</div>	
					</div>
				</div>
				<button class="btn btn-block btn-md btn-link bg-indigo waves-effect waves-float"><span class="glyphicon glyphicon-send m-r-5"></span> Publish Video</button>

				
			</div>
		</div>
		<div class="clearfix"></div>
		<?= form_close(); ?>
	</div>
</div>

<div class="modal fade in" data-backdrop="true" id="ModalTest" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Preview Video <button type="button" class="close pull-right"
					 data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> </h4>
			</div>
			<div class="modal-body">
				<div id="testVideo"></div>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(function() {
/*JQUERY AUTOSIZE TEXTAERA*/
autosize(jQuery('textarea'));
});
</script>