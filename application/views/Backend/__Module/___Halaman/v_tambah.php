  <div class="card m-t-25 card-border">
  	<div class="header">
  		<h2 class="title">Buat halaman baru</h2>
  	</div>
  	<div class="body" style="padding-top: 0; padding-bottom: 0;">
  		<div class="row clearfix">
  			<?= form_open_multipart('backend/module/c_halaman/add', array('id' => 'FormAddHalaman')) ?>
  			<div class="col-md-9 border-r border-1 border-col-grey">
  				<div class="m-t-10">
  					<?php $this->view('msg/flashdata') ?>
  				</div>

  				<div class="form-group">
  					<label for="title">Judul Halaman</label>
  					<div class="form-line">
  						<input type="text" name="title_halaman" id="title" class="form-control" placeholder="Masukan judul halaman disini...">
  					</div>
  				</div>
  				<div class="form-group">
  					<label for="content">Isi Content</label>
  					<a class="btn btn-sm btn-link pull-right m-b-5 bg-indigo" target="_blank" href="<?= base_url() . 'files/filemanager-v2/filemanager/dialog.php?type=0&field_id=imgField&lang=id' ?>">
  						<i class="glyphicon glyphicon-folder-close   m-r-5"></i> Files Manager</a>
  					<div class="clearfix"></div>
  					<div class="form-line">
  						<textarea type="text" name="content_halaman" id="content_halaman" rows="10" class="form-control"></textarea>
  					</div>
  				</div>

  			</div>
  			<div class="col-md-3 m-t-15">

  				<div class="text-center p-l-5 p-r-5 p-b-5 p-t-5 border-dot border-3 border-col-grey" id="file">
  					<div class="m-t-10 m-b-10"><em class="glyphicon glyphicon-file font-26"></em> <br> Insert File <br><code class="font-11">Image or PDF</code></div>
  				</div>
  				<div class="form-group m-t-10">
  					<label>Select File</label>
  					<div class="form-line"><input type="file" name="fileinsert" class="form-control col-teal"></div>

  					<div class="alert alert-message" role="alert">
  						<span class="col-orange font-12 font-bold"> File akan ditampilkan pada bagian paling bawah, setelah bagian content</span>
  					</div>
  				</div>
  				<div class="form-group">
  					<label>Publish</label>
  					<div class="row">
  						<div class="col-md-12">
  							<!--<input name="publish" value="Y" type="radio" id="radio1" class="radio-col-teal">
              <label for="radio1">Ya</label>
              
              <input name="publish" value="N" type="radio" id="radio2" class="radio-col-orange">
              <label for="radio2">Tidak</label>-->
  							<div class="switch">
  								<label> Tidak <input name="publish" type="hidden" checked value="N"> <input name="publish" type="checkbox" value="Y"> <span class="lever"></span> Ya</label>
  							</div>

  						</div>
  					</div>
  				</div>
  				<input type="submit" name="submit" value="Simpan" class="btn btn-block btn-primary waves-effect waves-float">
  				<button onclick="window.history.back(-1)" type="button" class="btn btn-block btn-danger waves-effect waves-float">Kembali</button>
  			</div>
  			<?= form_close(); ?>
  		</div>
  	</div>
  </div>
