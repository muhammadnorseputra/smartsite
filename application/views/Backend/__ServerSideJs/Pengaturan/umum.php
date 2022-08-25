<script>
$( function() {
  $( "#tabs" ).tabs({
    active: 0,
    collapsible: false,
    beforeLoad: function( event, ui ) {
      $("#tabs .ui-tabs-nav .ui-state-active").removeClass('active');
      ui.jqXHR.fail(function() {
        ui.panel.html(
          "Couldn't load this tab. We'll try to fix this as soon as possible. " +
          "If this wouldn't be a demo." );
      });
      ui.tab.addClass('active');
      ui.panel.html('<img src="<?= base_url('assets/images/loader/rolling.svg') ?>"> Please wait, loading ...');
    },
    activate: function( event, ui ) {
      ui.newTab.addClass('active');
    }
  });
});
</script>
<style>
.ui-tabs-panel.ui-corner-bottom.ui-widget-content {
  padding:18px !important;
} 
.ui-tabs-panel.ui-corner-bottom.ui-widget-content input, 
.ui-tabs-panel.ui-corner-bottom.ui-widget-content textarea {
  border-bottom: 1px solid #fefefe;
}
.ui-tabs-panel.ui-corner-bottom.ui-widget-content input:focus, 
.ui-tabs-panel.ui-corner-bottom.ui-widget-content textarea:focus {
  border-bottom: 1px solid lightseagreen;
}
</style>