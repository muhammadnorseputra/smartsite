<div class="block-header row">
	<div class="col-md-3">
		<h2>
			<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">star_outline</i>
			Peraturan
			<small>#_Module Peraturan</small>
		</h2>
	</div>
	<div class="col-md-9">
		<a id="addvideo-button" href="#" data-toggle="modal" data-target="#ModalAddPeraturan" class="font-12 m-t-5 btn btn-link btn-sm  waves-effect waves-cyan waves-float pull-right"><em class="glyphicon glyphicon-plus m-r-10"></em>Tambah File Peraturan</a>
	</div>
</div>


<ul class="nav nav-tabs tab-col-grey m-t-0 p-t-0 m-l-15" role="tablist">
	<li role="presentation" class="active waves-effect"><a href="#table" data-toggle="tab" aria-expanded="false"><em class="glyphicon glyphicon-list-alt m-r-5"></em>
			Table Peraturan</a></li>
	<li role="presentation" class="waves-effect"><a href="#jenis-peraturan" data-toggle="tab" aria-expanded="false"><em class="glyphicon glyphicon-link m-r-5"></em>
			Table Jenis Peraturan</a></li>
</ul>
<div class="card card-border">
	<div class="body">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="table">
				<table class="table table-responsive table-hover table-condensed table-striped  animated fadeIn" id="tbl-peraturan">
					<thead>
						<th>NO</th>
						<th>JUDUL PERATURAN</th>
						<th>JENIS</th>
						<th>TAHUN</th>
						<th>FILE</th>
						<th>AKSI</th>
					</thead>
					<tbody>
				</table>
			</div>
			<div role="tabpanel" class="tab-pane" id="jenis-peraturan">
				<div class="row border-bottom m-b-10">
					<?= form_open('backend/module/c_peraturan/aksitambah_jenisperaturan', ['id' => 'formTambahJenisPeraturan', 'class' => 'form-horizontal']); ?>
					<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
						
							<div class="input-group">
								<div class="form-line">
									<input type="text" class="form-control" name="nama_jns_peraturan" placeholder="Masukan nama jenis peraturan baru disini.">
								</div>
								<span class="input-group-addon">
									<button type="submit" class="btn btn-link btn-sm m-t--10 waves-effect waves-float">
										Buat
									</button>
								</span>
							</div>
					</div>
					<?= form_close(); ?>
				</div>
				<table class="table table-responsive table-hover table-condensed table-striped animated fadeIn" id="tbl-jenis-peraturan">
					<thead>
						<th>NO</th>
						<th>NAMA JENIS PERATURAN</th>
						<th>AKSI</th>
					</thead>
				</table>
			</div>
		</div>
		<!-- MODAL ADD PERATURAN -->
		<div class="modal fade" id="ModalAddPeraturan" data-backdrop="static" data-keyboard="false" role="dialog">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<?= form_open_multipart('backend/module/c_peraturan/aksitambah', ['id' => 'formTambahPeraturan']); ?>
					<div class="modal-header">
						<h4 class="modal-title" id="smallModalLabel">
							TAMBAH FILE PERATURAN
							<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</h4>
					</div>
					<div class="modal-body">
						<div class="container-msg"></div>
						<div class="form-group">
							<label for="judul">Nama Peraturan</label>
							<div class="form-line">
								<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan nama peraturan">
							</div>
						</div>
						<label for="fid_jenis_peraturan">Jenis Peraturan</label>
						<div class="form-group">
							<div class="form-line">
								<select name="fid_jenis_peraturan" id="fid_jenis_peraturan" class="form-control"></select>
							</div>
						</div>
						<div class="form-inline">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="tahun">Tahun</label>
										<div id="bs_datepicker_component_container" class="date">
											<div class="form-line">
												<input type="text" id="tahun" name="tahun" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group col-md-3">
										<label for="file">File</label>
										<div class="form-line">
											<input type="file" id="file" name="file" class="form-control">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-link btn-sm waves-effect">SIMPAN</button>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>

	</div>
</div>
