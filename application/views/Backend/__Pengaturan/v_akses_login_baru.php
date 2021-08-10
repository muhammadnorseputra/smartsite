<div class="row">
  <div class="col-md-6 col-md-offset-3 m-t-25">
      <div class="card card-border card-shadow">
				<div class="header">
        <button type="button" onclick="onBack();" class="btn btn-circle btn-link bg-indigo waves-effect pull-left m-r-15 m-t--15"><i class="glyphicon glyphicon-chevron-left"></i></button>
					<h2>
						Buat Hak akses
					</h2>
				</div>
				<div class="body">
        <?=  form_open('backend/c_pengaturan/do_hakakses', ['id' => 'frm_hakakses']) ?>
            <label for="ip">Ip address</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="ip" id="ip" class="form-control ip" placeholder="Masukan ip address user">
                </div>
                <p class="help-block">Contoh: 192.168.1.6</p>
            </div>
            <label for="np">Nama pemilik</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="nama_pemilik" id="np" class="form-control" placeholder="Masukan user pemilik ip address">
                </div>
                <p class="help-block">Contoh: Robot</p>
            </div>
            <label for="type">Jenis / Type perangkat yang digunakan</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="type_pemilik" id="type" class="form-control" placeholder="Masukan nama perangkat yang digunakan">
                </div>
                <p class="help-block">Contoh: Laptop / Aspire E1-470G</p>
            </div>
            <label for="block">Block</label>
            <div class="form-group">
              <div class="switch">
                  <label>TIDAK <input type="hidden" name="block" value="n"> <input type="checkbox" name="block" value="y" checked><span class="lever"></span>YA</label>
              </div>
            </div>
					<button type="submit" id="save" class="btn btn-primary pull-right waves-effect"> Simpan</button>
        <?= form_close() ?>
        <div class="clearfix"></div>
				</div>
			</div>
  </div>
</div>
<script>
function onBack() {
  window.location.href= '<?= base_url('backend/c_pengaturan/akseslogin?module='.$this->madmin->getmodule('PENGATURAN UMUM').'&user='.$this->session->userdata('user_access')) ?>';
}

$(document).on('submit', '#frm_hakakses', function(event) {
  event.preventDefault();
  let self = $(this);
  $action = self.attr('action');
  $input  = self.serialize();
  $.post($action, $input, function(response) {
    showNotification(response.status, response.message, 'bottom', 'center', 'none', 'animated fadeOutDown');
    if(response.status != 'bg-greadient-redpurple') {
      self[0].reset();
    }
  }, 'json');
});
</script>