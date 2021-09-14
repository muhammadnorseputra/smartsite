<div class="row clearifx m-t-15">
	<div class="col-md-8 col-md-offset-2">
	<div id="msg"></div>
		<div class="card card-border">
		<?= form_open_multipart('backend/module/c_video/addByLocal', array('id' => 'FormVideoLocal')) ?>
			<div class="header">
				<h2 class="card-title">
					Tambah Video Local stroge
				</h2>
			</div>
			<div class="body mprogress">

				<div class="form-group">
					<div class="form-line">
						<label>Judul video</label>
						<input type="text" class="form-control" name="judul" placeholder="Masukan judul video disini ...">
					</div>
				</div>

				<div class="form-group">
					<label for="idalbum">Album</label>
					<div class="form-line">
						<select name="idalbum" id="pilihalbum" class="form-control">
							<option value="0">Pilih Album</option>
						</select>
						<input type="hidden" name="id_albumvideo">
					</div>
        </div>

				<div class="form-group">
					<div class="form-line">
					<textarea class="form-control" rows="5" name="keterangan" placeholder="Masukan keterangan video disini...."></textarea>
					</div>
				</div>
        
				<div class="form-group form-float">
					<label for="idalbum">File</label>
					<div class="form-line col-teal">
						<input type="file" name="file_video_local">
					</div>
					<!-- <button type="button" class="btn btn-xs btn-primary waves-effect pull-right m-t-5" onclick="testVideoLocal()">Test</button> -->
					<p class="help-block font-12 col-grey"> Only format (<code>mp4, mkv, flv</code>) Max size 3.3 MB</p>
				</div>  

				<!-- <div class="form-group">
					<div id="previewVideoLocal"></div>
				</div>       -->

				<div class="form-group">
					<label for="radio" class="control-label">Publish</label><br>
					<input name="publish" value="Y" type="radio" id="radio1" class="radio-col-teal">
					<label for="radio1">Ya</label>

					<input name="publish" value="N" type="radio" id="radio2" class="radio-col-orange">
					<label for="radio2">Tidak</label>
				</div>

				<div class="form-group">
					<label for="radio" class="control-label">Sebagai Video Pilihan</label><br>
					<input name="pilihan" value="Y" type="radio" id="radio3" class="radio-col-teal">
					<label for="radio3">Ya</label>

					<input name="pilihan" value="N" type="radio" id="radio4" class="radio-col-orange">
					<label for="radio4">Tidak</label>
				</div>

			</div>
			<div class="card-footer ">
				<button type="button" onclick="window.history.back(-1);" class="btn btn-circle btn-link waves-effect waves-float pull-left bg-indigo m-t--35"><i class="glyphicon glyphicon-chevron-left"></i></button>

				<button type="submit" class="btn btn-rounded btn-link bg-indigo waves-effect waves-float pull-right"> <span class="glyphicon glyphicon-send m-r-5"></span> Publish Video</button>
			</div>
		<?= form_close(); ?>
		</div>
	</div>
</div>
<script>
jQuery(function() {
/*JQUERY AUTOSIZE TEXTAERA*/
autosize(jQuery('textarea'));
});
</script>