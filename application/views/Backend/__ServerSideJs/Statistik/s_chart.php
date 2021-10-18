
<script>
$(function() {
grafik_visitor_year();
});

function grafik_visitor_year() {
  $.getJSON("<?= base_url('backend/module/c_statistik/chart_visitor_year') ?>", function(res) {
    new Morris.Line({
      element: 'chart_visitor_tahun',
      data: res,
      xkey: 'y',
      xLabels: 'year',
      ykeys: ['count', 'hits'],
      labels: ['Visitor','Hits'],
    });

  });
}
</script>