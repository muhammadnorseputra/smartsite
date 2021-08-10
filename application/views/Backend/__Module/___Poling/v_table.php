<div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">insert_chart</i> Poling Web
		<small>Poling</small>
	</h2>
</div>

<div class="card card-border mprogress">
	<div class="body" style="padding-top: 0; padding-bottom: 0;">
		<div class="row clearfix">
			<div class="col-md-8">
				<div class="row clearfix m-t-25">
					<div class="col-md-6">
						<?= form_open('module/c_poling/add', array('id' => 'FormPoling')); ?>
						<input type="hidden" name="idpoling">
						<div class="clearfix">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="judul">
									<label class="form-label">PERTANYAAN / JAWABAN</label>
								</div>
							</div>
						</div>

						<div class="clearfix">
							<div class="form-group">
								<select name="jenispoling" id="jenispoling" class="form-control bootstrap-select">
									<option value="0">Pilih Jenis Poling</option>
									<option value="PERTANYAAN">PERTANYAAN</option>
									<option value="JAWABAN">JAWABAN</option>
								</select>
							</div>
						</div>

						<div class="clearfix m-t-10">
							<label for="radio">Publish</label>
							<div class="form-group">
								<input name="aktif" value="N" type="radio" id="radio_02_i" class="with-gap radio-col-grey">
								<label for="radio_02_i">TIDAK</label>
								<input name="aktif" value="Y" type="radio" id="radio_01_i" class="with-gap radio-col-teal">
								<label for="radio_01_i">YA</label>
							</div>
						</div>

						<button id="batal" type="button" style="display:none;" class="btn btn-link btn-sm bg-pink waves-effect pull-right m-t--60 m-r-90">BATAL</button>

						<button type="submit" class="btn btn-primary btn-sm waves-effect pull-right m-t--60"> SIMPAN</button>
						<?= form_close(); ?>
					</div>
					<div class="col-md-6">
						<div class="row clearfix">
							<div class="col-md-12 border-b border-1 border-col-grey">
								<b class="font-12">Pertanyaan</b>
								<ul class="list-unstyled m-t-10" id="myPertanyaan">
								</ul>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-md-12">
								<b class="font-12">Jawaban</b>
								<ul class="list-unstyled m-t-10" id="myJawaban">
								</ul>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="clearfix m-t--5 border-t border-1 border-col-grey">
						<div class="col-md-12 m-t-10">
							<div class="row">
								<div class="col-md-8">
									<div class="font-18 align-left col-teal clearfix" id="labelPertanyaan"></div>
									<div id="labelJawaban"></div>
								</div>
								<div class="col-md-4">
									<span class="label label-info">Total Partisipasi</span> <span class="font-right m-l-10">
										<?= $this->mpoling->countPartisipasi() ?> Orang</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 border-l border-1 border-col-grey p-t-35" style="margin-bottom: 0;">

				<b class="font-12 text-center"> Grafik Poling</b>
				<div id="donut_chart" class="graph"></div>
			</div>
		</div>
	</div>
</div>
