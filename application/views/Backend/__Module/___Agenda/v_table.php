<div class="block-header row m-b-15">
	<div class="col-md-3">
		<h2>
			<i class="material-icons waves-effect pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">assignment</i> Agenda
			<small>Agenda Kegiatan</small>
		</h2>

	</div>
	<div class="col-md-9">
		<button data-toggle="modal" data-target="#addagenda" class="btn btn-link btn-rounded pull-right waves-effect waves-float m-t-10 m-r-15"><em class="material-icons font-18 pull-left m-r-5">add</em> Buat agenda baru</button>
	</div>
</div>
<div class="clearfix">
	<div class="card">
		<div class="body">

			<div class="row">
				<div class="col-md-12 m-t-15">
					<!-- <h2 class="card-title">Agenda Terbaru</h2>
					<small>List Agenda</small> -->
					<div class="col-md-5 border-r border-1 border-col-grey m-r-15">
						<?= form_open('backend/module/c_agenda/list_agenda/', array('id' => 'FormSearchAgendaByTgl')) ?>
						<div class="form-group masked-input">
							<label>Filter Tanggal:</label>
							<div class="input-group input-daterange col-md-3 m-t-5" id="bs_datepicker_range_container">
								<span class="input-group-addon"><em class="material-icons">date_range</em></span>
								<div class="form-line">
									<input type="text" name="stgl_mulai" class="form-control date" placeholder="Tgl Mulai">
								</div>

								<span class="input-group-addon font-bold">s/d</span>
								<div class="form-line">
									<input type="text" name="stgl_selesai" class="form-control date" placeholder="Tgl Selesai">
								</div>
								<span class="input-group-addon"><button type="reset" onclick="list()" class="btn btn-link btn-xs waves-effect waves-circle circle btn-circle" data-toggle="tooltip" data-placement="bottom" title="CLEAR KOLOM"><em class="material-icons m-t-8">replay</em></button></span>
							</div>
						</div>
						<?= form_close(); ?>
					</div>
					<div class="col-md-6 m-t-30">
						<?= form_open('backend/module/c_agenda/list_agenda/', array('id' => 'FormSearchAgenda')) ?>
						<div class="row">
							<div class="input-group">
								<div class="form-line">
									<input type="text" class="form-control" name="search" id="search" placeholder="Masukan kata kunci / judul agenda">
								</div>
								<span class="input-group-addon">
									<button type="submit" class="btn btn-xs btn-link waves-effect pull-left btn-circle waves-circle">
										<i class="glyphicon glyphicon-search"></i></button>
								</span>

							</div>
						</div>
						<?= form_close(); ?>
					</div>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table table-condensed table-hover" id="MyAgendaScroll">
					<thead>
						<tr>
							<!-- <th width="30" class="text-center"></th> -->
							<th>Topik</th>
							<th>Isi Agenda</th>
							<th width="280">Tanggal</th>
							<th width="80">Waktu</th>
							<th>Pengirim</th>
							<th width="50">Hapus</th>
							<th width="50">edit</th>
						</tr>
					</thead>
					<tbody id="MyAgenda"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- MODAL TAMBAH AGENDA -->
<div class="modal fade modal-fixed-footer" id="addagenda" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" role="document">
		<?= form_open('backend/module/c_agenda/add', array('id' => 'FormAddAgenda')) ?>
		<div class="modal-content z-depth-5">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> TAMBAH AGENDA</h4>
			</div>
			<div class="modal-body masked-input border-bottom">

				<div class="form-group">
					<label for="tema">Topik</label>
					<div class="form-line">
						<input type="text" name="tema" class="form-control" id="tema" placeholder="Masukan Topik">
					</div>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<div class="input-group input-daterange" id="datepicker_range_2">
						<div class="form-line">
							<input type="text" name="tgl_mulai" class="form-control date" placeholder="Tanggal Mulai">
						</div>
						<span class="input-group-addon"><em class="material-icons">date_range</em></span>
						<div class="form-line">
							<input type="text" name="tgl_selesai" class="form-control date" placeholder="Tanggal Selesai">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<label>Jam</label>
						<div class="form-group input-group">
							<span class="input-group-addon"><em class="glyphicon glyphicon-time"></em></span>
							<div class="form-line">
								<input type="text" name="jam" placeholder="Jam" class="timepicker form-control time24">
							</div>
						</div>
					</div>
					<div class="col-md-9 col-sm-9 col-xs12">
						<div class="form-group">
							<label for="lokasi">Lokasi</label>
							<div class="form-line">
								<input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukan Loaksi Acara">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="tinymce_agenda">Isi Agenda</label>
					<div class="form-line">
						<textarea name="isi_agenda" rows="4" class="form-control" placeholder="Masukan Isi dari Agenda"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="send_by">Dikirim Oleh</label>
						<div class="form-group input-group">
							<span class="input-group-addon"><em class="glyphicon glyphicon-user"></em></span>
							<div class="form-line">
								<input type="text" name="pengirim" class="form-control" value="<?= $this->session->userdata('namalengkap'); ?>" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="message"></div>
				<button type="submit" class="btn btn-rounded btn-warning btn-sm waves-effect"> SIMPAN</button>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>
