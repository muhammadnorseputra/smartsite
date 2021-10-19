<script>
$(function() {
  grafik_visitor_day();
  grafik_visitor_month();
  grafik_visitor_year();
});

function grafik_visitor_year() {
  $.getJSON("<?= base_url('backend/module/c_statistik/chart_visitor_year') ?>", function(res) {
    new Morris.Line({
      element: 'chart_visitor_tahun',
      data: res,
      smooth: true,
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
function grafik_visitor_day() {
  $.getJSON("<?= base_url('backend/module/c_statistik/chart_visitor_day') ?>", function(res) {
    new Morris.Area({
      element: 'chart_visitor_hari',
      data: res,
      smooth: true,
      xkey: 'd',
      xLabels: 'day',
      ykeys: ['count','hits'],
      labels: ['Visitors', 'Hits']
    });
  });
}
</script>