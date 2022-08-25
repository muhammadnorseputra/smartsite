<div class="row">
	<div class="col-md-5">
  <div class="text-left m-l-30">
    <img src="<?= base_url('assets/images/Maintenance/siorange.svg') ?>" width="100%" alt="maintenance">
  </div>
    <!-- <?= var_dump($fromdata[0]) ?> -->
    <?= form_open('backend/c_pengaturan/do_maintenance', array('id' => '#formMaintenance')) ?>
      <div class="text-left m-t-10 m-l-30">
        <div class="from-group">
          <p class="help-block">Pilih <b>ON</b> apabila sedang melakukan perbaikan pada website utama.</p>
          <?php 
            $check = $fromdata[0]->status_maintenance == 1 ? 'checked' : '';
          ?>
          <div class="switch">
              <label>OFF  <input name="maintenance_status" type="checkbox" <?= $check ?>>  <span class="lever switch-col-red"></span>ON</label>
          </div>

        </div>
      </div>
    <?= form_close() ?>
  </div>
</div>

<script>
$("[name='maintenance_status']").on('change', function() {

if ($(this).is(':checked')) {
  var values = 1;
} else {
  var values = 0;
}
  $.post('<?= base_url("backend/c_pengaturan/do_maintenance") ?>', {status: values}, function(response) {
    /*$.dialog(response.message);*/    
    showNotification(response.classes, response.message, 'bottom', 'center', 'none', 'animated bounceOutDown');
  }, 'json');

});
</script>