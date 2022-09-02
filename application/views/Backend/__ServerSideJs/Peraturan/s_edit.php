<script>
$(function() {
  /*SELECT JENIS PERATURAN*/
  let select_jns_peraturan = $("[name='jsnperaturan']").select2();

  /*INPUT TAHUN */
  let dateYear = $("[name='tahun']").datepicker({
    	format: " yyyy",
    	autoclose: true,
    	viewMode: "years",
    	minViewMode: "years",
    	orientation: 'auto top',
    	container: '#bs_datepicker_component_container'
  });
});
</script>