<div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">multiline_chart</i> Chart Visitors
		<small>Grafik Visitor</small>
	</h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-shadow chart_visitor_hari">
            <div class="header">
                <h2>
                    Visitor - Harian <small>Bulan <?= date('M') ?></small>
                </h2>
                <ul class="header-dropdown m-r--5">
                                <li>
                                </li>
                            </ul>
            </div>
            <div class="body">
                <div id="chart_visitor_hari" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-shadow chart_visitor_bulan">
            <div class="header">
                <h2>
                    Visitor - Bulanan <small>Tahun <?= date('Y') ?></small>
                </h2>
                <ul class="header-dropdown m-r--5">
                                <li>
                                </li>
                            </ul>
            </div>
            <div class="body">
                <div id="chart_visitor_bulan" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card card-shadow chart_visitor_tahun">
            <div class="header">
                <h2>
                    Visitor - Tahunan <small>ANTAR TAHUN 2020 - 2029</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                                <li>
                                </li>
                            </ul>
            </div>
            <div class="body">
                <div id="chart_visitor_tahun" style="height: 250px;"></div>
            </div>
        </div>
	</div>
</div>

