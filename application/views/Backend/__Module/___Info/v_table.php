<!-- Header -->
<!-- <div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">info</i>
		Sekilas Info
		<small>Manajemen Informasi</small>
	</h2>
</div> -->

<div class="clearfix">
	<div class="row">

		<div class="col-md-4 m-t-35">
			<?= form_open('module/c_info/add', array('id' => 'FormInfo')); ?>
			<input type="hidden" name="idinfo">

			<div class="clearfix">
				<div class="form-group form-float">
					<div class="form-line">
						<input type="text" class="form-control" name="judul">
						<label class="form-label">Masukan judul atau tagline</label>
					</div>
				</div>
			</div>

			<div class="clearfix">
				<div class="form-group form-float">
					<div class="form-line">
						<textarea rows="6" class="form-control no-resize" name="informasi"></textarea>
						<label class="form-label">Masukan informasi</label>
					</div>
				</div>
			</div>

			<div class="clearfix">
				<label for="radio">Publish</label>
				<div class="form-group">
					<input name="publish" value="N" type="radio" id="radio_02_i" class="with-gap radio-col-red">
					<label for="radio_02_i">TIDAK</label>
					<input name="publish" value="Y" type="radio" id="radio_01_i" class="with-gap radio-col-teal">
					<label for="radio_01_i">YA</label>
				</div>
			</div>


			<button type="submit" class="btn btn-primary waves-effect pull-right">Simpan</button>

			<button type="reset" class="btn pull-right m-r-10 btn-warning waves-effect"> Reset Form</button>

			<button id="batal" type="button" style="display:none;" class="btn btn-link bg-pink waves-effect ">BATAL</button>

			<?= form_close(); ?>
		</div>
		<div class="col-md-8 m-t-25">

			<div class="card card-shadow">
				<div class="header bg-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">
					<h2 class="text-center">
						Daftar informasi badan kepegawaian, pendidikan dan pelatihan daerah kabupaten balangan <small>tahun <?= date('Y') ?></small>
					</h2>
				</div>
				<div class="body">


					<div class="body m-t--10" id="data" style="padding: 30px 0 0 0;"></div>

				</div>
				<div class="card-footer">
					<?= form_open('backend/module/c_halaman/list_halaman/', array('id' => 'FormSearchInfo')) ?>
					<div class="form-group">
						<div class="col-sm-10">
							<div class="form-line">
								<input type="text" class="form-control" name="search" id="search" placeholder="Search informasi">
							</div>
						</div>
						<button type="submit" class="btn waves-effect btn-sm btn-link btn-circle">
							<em class="glyphicon glyphicon-search"></em> </button>

						<button type="button" onclick="auto_clear()" class="btn waves-effect btn-sm btn-link btn-circle" title="Clear">
							<em class="glyphicon glyphicon-remove"></em> </button>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
