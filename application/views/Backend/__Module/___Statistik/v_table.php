<div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">show_chart</i> Statistisi
		<small>Statistik</small>
	</h2>
</div>
<div class="row">
	<div class="col-md-6">
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
				<span class="input-group-addon"><button type="button" id="reset" class="btn btn-primary waves-effect waves-circle btn-circle" data-toggle="tooltip" data-placement="bottom" title="Reset Filter"><em class="material-icons">replay</em></button></span>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-3">
		<div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-teal">phonelink</i>
            </div>
            <div class="content">
                <div class="text">TOTAL IP</div>
                <div class="total_ip number" data-speed="1000" data-fresh-interval="20">0</div>
        		<b class="ip_presentase_day">0%</b>
            </div>
        </div>
	</div>
	<div class="col-md-3">
		<div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-blue">location_on</i>
            </div>
            <div class="content">
                <div class="text">OPEN LOCATION</div>
                <div class="ip_loc number" data-speed="1000" data-fresh-interval="20">0</div>
                <b class="ip_loc_close">0</b> OFF
            </div>
        </div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-3">
		<div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-light-green">trending_up</i>
            </div>
            <div class="content">
                <div class="text">HIT'S MAX</div>
                <div class="hits_max number" data-speed="1000" data-fresh-interval="20">0</div>
                <b class="ip_max">-</b>
            </div>
        </div>
	</div>
	<div class="col-md-3">
		<div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">trending_down</i>
            </div>
            <div class="content">
                <div class="text">HIT'S MIN</div>
                <div class="hits_min number" data-speed="1000" data-fresh-interval="20">0</div>
                <b class="ip_min">-</b>
            </div>
        </div>
	</div>
</div>
<div class="card card-shadow">
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

