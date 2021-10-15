<div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">show_chart</i> Statistisi
		<small>Statistik</small>
	</h2>
</div>
<div class="card card-border">
	<div class="header">
		<div class="row">
			
		<div class="col-md-2">	
		<button id="btn-reload" role="button" class="btn btn-sm btn-circle btn-primary waves-effect"><i class='glyphicon glyphicon-repeat'></i></button>
		</div>
		<div class="col-md-10">
		<?= form_open('#', array('id' => 'FormSearchByTgl')) ?>
		<div class="form-group masked-input">
			<label>Filter Tanggal:</label>
			<div class="input-group input-daterange col-md-3" id="bs_datepicker_range_container">
				<span class="input-group-addon"><em class="material-icons">date_range</em></span>
				<div class="form-line">
					<input type="text" name="tgl_mulai" class="form-control date" placeholder="Tgl Mulai">
				</div>

				<span class="input-group-addon font-bold">s/d</span>
				<div class="form-line">
					<input type="text" name="tgl_selesai" class="form-control date" placeholder="Tgl Selesai">
				</div>
				<span class="input-group-addon"><button type="reset" class="btn btn-link btn-xs waves-effect waves-circle circle btn-circle" data-toggle="tooltip" data-placement="bottom" title="Reset Filter"><em class="material-icons">replay</em></button></span>
			</div>
		</div>
		<?= form_close(); ?>
		</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-3">
				<h5>Total IP</h5>
				<h1 id="total_ip">0</h1>
			</div>
			<div class="col-md-3">
				<h5>Open Location</h5>
				<h1 id="ip_loc">0</h1>
			</div>
			
			<div class="col-xs-6 col-sm-6 col-md-3">
				<h5>Hit's Max</h5>
				<h1 id="hits_max">0</h1>
				<b id="ip_max">-</b>
			</div>
			<div class="col-md-3">
				<h5>Hit's Min</h5>
				<h1 id="hits_min">0</h1>
				<b id="ip_min">-</b>
			</div>
		</div>
	</div>
	<div class="body">
		<table class="table table-responsive table-condensed table-striped" id="tbl-statistik">
			<thead>
				<th>IP</th>
				<th>Browser (version)</th>
				<th>OS</th>
				<th>Date</th>
				<th>Hits</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th>Jam</th>
				<th>Loc</th>
			</thead>
			<tbody>
		</table>
	</div>
</div>

