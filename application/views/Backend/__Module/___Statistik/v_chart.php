<div class="block-header row m-b-15">
	<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">multiline_chart</i> Chart Visitors
		<small>Grafik Visitor</small>
	</h2>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card card-shadow">
            <div class="header">
                <h2>
                    Visitor By Tahun <small>2021 - 2025</small>
                </h2>
            </div>
            <div class="body">
                <div id="chart_visitor_tahun" style="height: 250px;"></div>
            </div>
        </div>
	</div>
</div>

<script>
$(function() {

new Morris.Bar({
  element: 'chart_visitor_tahun',
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  xkey: 'year',
  ykeys: ['100','200'],
  labels: ['Total Visitors','Hits']
});

});
</script>