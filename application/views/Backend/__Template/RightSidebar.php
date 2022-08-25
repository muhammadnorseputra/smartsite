 <!-- Right Sidebar -->
 <aside id="rightsidebar" class="right-sidebar">
 	<ul class="nav nav-tabs tab-nav-right border-bottom" role="tablist">
 		<li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
        <li role="presentation"><a href="#setting" data-toggle="tab">SETTING</a></li>
 	</ul>
 	<div class="tab-content">
 		<div role="tabpanel" class="tab-pane fade in active in active" id="skins">
        <input type="hidden" name="id_skin_active" value="">
 			<ul class="demo-choose-skin" style="overflow-y:scroll; max-height:calc(100vh - 120px);">
 				<?php foreach ($skin as $v): ?>
 				<?php
                        if($v->aktif == 'Y'){
                            $ac = 'class="active"';
                        }else{
                            $ac = '';
                        }
                    ?>
 				<li id="change_theme" 
                    data-id="<?= $v->idskin ?>"
                    data-active="<?php echo site_url("backend/c_admin/update_skin") ?>"
                    data-id-active="<?= $this->madmin->aktifskinid('t_skin','Y'); ?>"
 					data-off="<?php echo site_url("backend/c_admin/update_skin_n") ?>"
 					data-theme="<?= strtolower($v->color) ?>" <?= $ac ?>>
 					<div class="<?= strtolower($v->color) ?>"></div>
 					<span><?= ucwords($v->color_name) ?></span>
 				</li>
 				<?php endforeach; ?>
 			</ul>
 		</div>
        <div role="tabpanel" class="tab-pane fade in" id="setting">
            <!-- Maintenance -->
            <?= form_open('backend/c_pengaturan/do_maintenance', array('id' => '#formMaintenance')) ?>
                <img src="<?= base_url('assets/images/Maintenance/siorange.svg') ?>" width="100%" alt="maintenance" class="p-l-30 p-r-30 rounded">
              <div class="p-t-10 p-b-10 p-l-30 border-bottom">
                <div class="from-group">
                    <?php 
                        $check = $baseinfo->status_maintenance == 1 ? 'checked' : '';
                    ?>
                  <div class="switch">
                      <label>OFF  <input name="maintenance_status" type="checkbox" <?= $check ?>>  <span class="lever switch-col-red"></span>ON</label>
                  </div>
                  <small class="text-muted">Pilih <b>ON</b> apabila sedang melakukan perbaikan pada frontend.</small>
                </div>
              </div>
            <?= form_close() ?>
        </div>
 	</div>
 </aside>
 <!-- #END# Right Sidebar -->
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