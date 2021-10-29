<script>
$(function() {
  grafik_visitor_day();
  grafik_visitor_month();
  grafik_visitor_year();
});

function wait($el) {
    $el.waitMe({
      effect : 'bounce',
      bg : "rgba(255,255,255,0.7)",
      color : "#000",
      maxSize : '',
      waitTime : 300,
      textPos : 'vertical',
      fontSize : '',
      source : '',
      /*onClose : function(event, el) {
        console.log(event);
        return fuc;
      }*/
    })
}
function grafik_visitor_year() {
  var $container = $(".chart_visitor_tahun");
  
  $.ajax({
    url: "<?= base_url('backend/module/c_statistik/chart_visitor_year') ?>",
    method: 'post',
    dataType: 'json',
    beforeSend: function()
    {
      wait($container);
    },
    success: function(res) 
    {
      Morris.Line({
        element: 'chart_visitor_tahun',
        data: res,
        smooth: true,
        xkey: 'y',
        xLabels: 'year',
        ykeys: ['hits', 'count'],
        labels: ['Hits','Visitors'],
      });
    },
    complete: function() {
      $container.waitMe("hide");
    }
  })
}

function grafik_visitor_month() {
  var $container = $(".chart_visitor_bulan");

  $.ajax({
    url: "<?= base_url('backend/module/c_statistik/chart_visitor_month') ?>",
    method: 'post',
    dataType: 'json',
    beforeSend: function()
    {
      wait($container);
    },
    success: function(res) 
    {
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
    },
    complete: function() {
      $container.waitMe("hide");
    }
  })
}

function grafik_visitor_day() {
  
  var $container = $(".chart_visitor_hari");
  
  $.ajax({
    url: "<?= base_url('backend/module/c_statistik/chart_visitor_day') ?>",
    method: 'post',
    dataType: 'json',
    beforeSend: function()
    {
      wait($container);
    },
    success: function(res) 
    {
      Morris.Area({
        element: 'chart_visitor_hari',
        data: res,
        smooth: true,
        xkey: 'd',
        xLabels: 'day',
        ykeys: ['count','hits'],
        labels: ['Visitors', 'Hits']
      });
    },
    complete: function() {
      $container.waitMe("hide");
    }
  })
    
}
</script>