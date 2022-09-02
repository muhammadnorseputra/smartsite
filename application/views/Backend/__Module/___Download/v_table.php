<div class="block-header row m-b-15">
	<div class="col-md-3">
		<h2>
	<i class="material-icons pull-left m-r-5 m-b-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">file_download</i>
	Download
	<small>Download File List</small>
	</h2>
	</div>
	<div class="col-md-9">
		<button data-toggle="modal" data-target="#ModalAdd" aria-expanded="true" aria-controls="ModalAdd" class="btn btn-link btn-sm pull-right waves-effect waves-float m-t-10 m-r-15"><i class="glyphicon glyphicon-file"></i> Tambah File</button>
	</div>
	
</div>
<ul class="nav nav-tabs tab-col-indigo m-l-15" role="tablist">
	<li role="presentation" class="active"><a href="#in" class="m-t--10" data-toggle="tab" aria-expanded="true"><em
		class="glyphicon glyphicon-save"></em>
	Local File</a></li>
	<li role="presentation"><a href="#eks" class="m-t--10" data-toggle="tab" aria-expanded="true"><em
		class="glyphicon glyphicon-link"></em>
	Eksternal File</a></li>
</ul>
<div class="card card-shadow">
	<div class="body">
		
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="in">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="myTable">
						<thead>
							<tr>
								<th width="20">No</th>
								<th width="100">KEY</th>
								<th width="250">Judul</th>
								<th width="130">Tgl Publish</th>
								<th width="30" class="text-center">File</th>
								<th width="50" class="text-center">Hits</th>
								<th width="90" class="text-center">Ukuran</th>
								<th width="100" class="text-center">Aksi</th>
							</tr>
						</thead>
					<tbody id="myDataInternal"></tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade in" id="eks">
			<div class="table-responsive table-eksternal collapse in">
				<table class="table table-striped table-hover" id="myTable">
					<thead>
						<tr>
							<th width="20">No</th>
							<th width="100">KEY</th>
							<th width="250">Judul</th>
							<th width="100">Tgl Publish</th>
							<th width="30" class="text-center">File</th>
							<th width="30" class="text-center">Count</th>
							<th width="100" class="text-center">Aksi</th>
						</tr>
					</thead>
				<tbody id="myDataEksternal"></tbody>
			</table>
		</div>
	</div>
</div>

</div>
</div>
<!-- ################################ MODAL TAMBAH ################################-->
<div class="modal fade modal-fixed-footer" id="ModalAdd" tabindex="2" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
	<?= form_open_multipart('backend/module/c_download/add', array('id' => 'FormDownload')) ?>
	<div class="modal-header">
		<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right"
		data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> Tambah Download
		</h4>
	</div>
	<div class="modal-body border-bottom">
		<label for="judul">Judul</label>
		<div class="form-group">
			<div class="form-line">
				<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan Judul Download">
			</div>
		</div>
		<div class="row m-b-20">
			<div class="form-group">
				<label for="keterangan" class="control-label col-md-12">Keterangan</label>
				<div class="col-md-12">
					<div class="form-line">
						<textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukan keterangan disini ..."></textarea>
						</div>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="file" class="control-label">Publish</label><br>
					<input name="publish" value="Y" type="radio" id="radio_01" class="with-gap radio-col-green">
					<label for="radio_01">Ya</label>
					<input name="publish" value="N" type="radio" id="radio_02" class="with-gap radio-col-red">
					<label for="radio_02">Tidak</label>
				</div>
			</div>
		</div>
		<div class="row m-b-5">
			<div class="form-group">
				<label for="file" class="control-label col-md-12">Source</label>
				<div class="col-md-12">
					<div class="form-line">
						<select class="form-control bootstrap-select show-tick" data-width="100%" id="pilihSource">
							<option value="0">Pilih Sumber</option>
							<option value="1">File Local</option>
							<option value="2">Link Eksternal</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-t-20" id="f_link" style="display:none;">
			<label for="file" class="control-label col-md-1 m-t-10"><em class="material-icons">insert_link</em></label>
			<div class="col-md-11">
				<div class="form-group">
					<label>Paste link</label>
					<div class="form-line">
						<!-- <input type="text" id="link_file" name="link_file" class="form-control"
						placeholder="Masukan link eksternal http://"> -->
						<textarea class="form-control" name="link_file" rows="3" placeholder="Masukan link eksternal http://"></textarea>
					</div>
					<p class="help-block font-12 col-grey"> Contoh:
					<code>http://localhost/ci3/module/download/file.docs</code> </p>
				</div>
			</div>
		</div>
		<div class="row m-t-20" id="f_file" style="display:none;">
			<label for="file" class="control-label col-md-1 m-t-10"><em class="material-icons">attachment</em></label>
			<div class="col-md-10">
				<div class="form-group">
					<label>Pilih file</label>
					<div class="form-line">
						<input type="file" id="file" name="file" class="form-control" placeholder="Pilih">
					</div>
					<p class="help-block font-12 col-grey"> File yang di ijinkan Upload hanya
						(<code>pdf,doc,xls,pptx,csv,zip,rar</code>),
					Ukuran Maksimal 2.5 MB (2548 Kb)</p>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-link btn-sm waves-effect"> Simpan</button>
	</div>
	<?= form_close() ?>
</div>
</div>
</div>
<!-- ############################## END MODAL TAMBAH ######################################-->