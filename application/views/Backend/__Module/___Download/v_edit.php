<?php if($formdata[0]['file'] != '' ? $sel_ffile = "block" : $sel_ffile = 'none'); ?>
<?php if($formdata[0]['file'] == '' ? $sel_flink = "block" : $sel_flink = 'none'); ?>
<div class="row clearfix m-t-15">
	<div class="col-md-12">
	<?php
		if ($this->session->flashdata('pesan') <> ''){
	?>
	<div class="alert alert-dismissible <?php echo $this->session->flashdata('class');?>">
		<?php echo $this->session->flashdata('pesan');?>
	</div>
	<?php
			}
	?>	
	<?= form_open_multipart('module/c_download/update/'.$formdata[0]['id_download'], array('id' => 'FormUpdateDownload')) ?>

		<div class="row">
			<div class="col-md-6">
				<div class="card card-border">
					<div class="body">
						<div class="m-b-15">
							<div class="form-group">
								<label for="judul">Judul</label>
								<div class="form-line">
									<input type="text" id="judul" name="judul" class="form-control" value="<?= $formdata[0]['judul'] ?>">
								</div>
							</div>
						</div>

						<div class="row m-b-15">
							<div class="form-group">
								<label for="file" class="control-label col-md-12">Publish</label>
								<div class="col-md-12">
									<?php if($formdata[0]['publish'] == 'Y') { ?>
									<input checked name="publish" value="Y" type="radio" id="radio_01" class="with-gap radio-col-teal">
									<label for="radio_01">Ya</label>

									<input name="publish" value="N" type="radio" id="radio_02" class="with-gap radio-col-orange">
									<label for="radio_02">Tidak</label>
									<?php } else {  ?>
									<input name="publish" value="Y" type="radio" id="radio_01" class="with-gap radio-col-teal">
									<label for="radio_01">Ya</label>

									<input checked name="publish" value="N" type="radio" id="radio_02" class="with-gap radio-col-orange">
									<label for="radio_02">Tidak</label>
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="row m-b-15">
							<div class="form-group">
								<label for="file" class="control-label col-md-12 col-grey">Resource</label>
								<div class="col-md-12">
									<div class="form-line">
										<?php if($formdata[0]['link'] != '' ? $sel_link = "selected" : $sel_link = ''); ?>
										<?php if($formdata[0]['link'] == '' ? $sel_file = "selected" : $sel_file = ''); ?>
										<select class="bootstrap-select form-control col-grey" id="pilihSource_e" disabled>
											<option value="0">Pilih Sumber</option>
											<option value="1" <?= $sel_file ?>>File Local</option>
											<option value="2" <?= $sel_link ?>>Link Eksternal</option>
										</select>
									</div>
									<p class="help-block font-12 col-grey"> *Sumber tidak bisa dirobah
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label for="keterangan" class="control-label col-md-12">Keterangan</label>
								<div class="col-md-12">
									<div class="form-line">
	        							<textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukan keterangan disini ..."><?= $formdata[0]['keterangan'] ?></textarea>
	      							</div>
      							</div>
							</div>
						</div>
						<div class="row">
							<div class="alert alert-message" role="alert" style="display:<?= $sel_ffile ?>;">
								<span class="col-red">*</span> apabila file tidak diganti, biarkan kosong
							</div>
							<div class="form-group" id="f_file_e" style="display:<?= $sel_ffile ?>;">
								<label for="file" class="control-label col-md-1 m-t-10"><em
										class="material-icons">attachment</em></label>
								<div class="col-md-11">
									<label>Ganti File</label>
									<div class="form-line">
										<input type="file" id="file" name="file" class="form-control" placeholder="Pilih">
									</div>
									<p class="help-block font-12 col-grey"> File yang di ijinkan Upload hanya
										(<code>pdf,doc,xls,pptx,csv,zip,rar</code>),
										Ukuran Maksimal 2.5 MB (2548 Kb)</p>
								</div>
							</div>

						</div>
						<div class="row m-t-20">
							<button type="submit" class="btn btn-primary waves-effect m-r-10 pull-right m-l-10"> SIMPAN</button>
							<button type="button" onclick="window.history.back(-1)"
								class="btn btn-link btn-sm waves-effect pull-right"> BATAL</button>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="form-group" id="f_link_e" style="display:<?= $sel_flink ?>;">
						<label for="file" class="control-label col-md-1 m-t-10"><em class="material-icons">insert_link</em></label>
						<div class="col-md-10">
							<div class="form-line">
								<!-- <input type="text" id="link" name="link" class="form-control" value="<?= $formdata[0]['link'] ?>"> -->
								<textarea class="form-control" name="link" rows="3"><?= $formdata[0]['link'] ?></textarea>
							</div>
							<p class="help-block font-12 col-grey"> Contoh:
								<code>http://localhost/ci3/module/download/file.docs</code>
							</p>
							<!-- <iframe src="<?= $formdata[0]['link'] ?>" frameborder="1" width="100%" height="250" title="Preview Links"
								allowfullscreen="true" marginwidth="5" marginheight="5" scrolling="yes" importance="high"
								allowpaymentrequest="true"></iframe> -->
								<object type="application/pdf" data="<?= $formdata[0]['link'] ?>?#zoom=0&scrollbar=0&toolbar=0&navpanes=0"
			width="100%" height="250"></object>
						</div>
					</div>
				</div>

				<div class="clearfix">

					<?php if($formdata[0]['type'] == '.pdf' || $formdata[0]['type'] == '.PDF' ? $typepo = "block" : $typepo = "none"); ?>

					<input type="hidden" class="form-control" name="file_lama" value="<?= $formdata[0]['file'] ?>">
					<div style="display:<?= $sel_ffile ?>;"
						class="col-md-12 p-t-5 p-b-5">
						<?php if($formdata[0]['type'] == '.pdf' || $formdata[0]['type'] == '.PDF') { ?>

						<!-- <iframe id="view-file" src="<?= $formdata[0]['path'] ?>" frameborder="0" height="450" width="100%" class="p-t-10 p-b-5" style="display: <?= $typepo ?>"></iframe> -->
						<object id="view-file" data="data:application/pdf;base64, <?= base64_encode($formdata[0]['file_blob']) ?>" width="100%" height="550" style="display: <?= $typepo ?>"></object>

						<a href="javascript:void(0);" id="btn-fullscreen" class="btn btn-sm btn-link pull-right"
							style="display: <?= $typepo ?>"><em class="material-icons m-t-5 m-b-5">fullscreen</em></a>
						<?php } else { ?>
						<a href="<?= $formdata[0]['path'] ?>" class="btn btn-sm btn-link bg-cyan pull-right"><em
								class="glyphicon glyphicon-download"></em></a>
						<?php } ?>
						<b>File:</b> <?= $formdata[0]['file'] ?><br>
						<b>Size:</b> <?= byte_format($formdata[0]['ukuran']); ?>
					</div>
				</div>
			</div>
		</div>
		<?= form_close() ?>
	</div>
</div>
