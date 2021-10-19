<script>
$(function() {
  grafik_visitor_month();
  grafik_visitor_year();
});

function grafik_visitor_year() {
  $.getJSON("<?= base_url('backend/module/c_statistik/chart_visitor_year') ?>", function(res) {
    new Morris.Line({
      element: 'chart_visitor_tahun',
      data: res,
      xkey: 'y',
      xLabels: 'year',
      ykeys: ['hits', 'count'],
      labels: ['Hits','Visitors'],
    });
  });
}
function grafik_visitor_month() {
  $.getJSON("<?= base_url('backend/module/c_statistik/chart_visitor_month') ?>", function(res) {
    Morris.Bar({
      element: 'chart_visitor_bulan',
      axes: true,
      stacked: true,
      data: res,
      barColors: ['#801','#3f0'],
      hideHover: 'auto',
      xkey: 'month',
      xLabels: 'month',
      ykeys: ['count','hits'],
      labels: ['Visitors', 'Hits']
    });
  });
}

</script>