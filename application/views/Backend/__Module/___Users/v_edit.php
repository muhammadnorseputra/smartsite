<?php 
  if($this->session->flashdata('message') <> '') {
    echo '<div class="'.$this->session->flashdata('class').' alert-dismissible">
              '. $this->session->flashdata('message') .'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button>
          </div>';
  }
?>	
<div class="card card-border m-t-25">
	<div class="body">
  <?= form_open_multipart('backend/module/c_users/proses_update_users', array('id' => 'FormUpdateUsers')); ?>
  <input type="hidden" value="<?php echo $id ?>" name="id">
  <input type="hidden" value="<?php echo $x[0]->username ?>" name="username">
  <div class="alert alert-message alert-message-info m-b-25" role="alert">
   <i class="material-icons">info</i> 
   <b>Informasi User</b> <br>Masukan informasi pribadi user
  </div>
		<div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="gravatar">Gravatar</label>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-8 col-xs-7">
				<div class="form-group">
          <img id="preview" class="img-rounded" width="110" src="<?= base_url('assets/images/users/'.$x[0]->gravatar) ?>">
					<input type="file" name="gravatar"  onchange="view(event)" class="form-control">
				</div>
			</div>
		</div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="nama_lengkap">Nama Lengkap</label>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?= $x[0]->nama_lengkap ?>">
					</div>
				</div>
			</div>
		</div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="email">Email</label>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="email" name="email" class="form-control" value="<?= $x[0]->email ?>">
					</div>
				</div>
			</div>
		</div>

    <div class="alert alert-message m-b-25 alert-message-warning" role="alert">
    <i class="material-icons">info</i> <b>Informasi Akun</b><br>
      Formulir informasi akun, jangan berikan username & password anda kepada orang lain.
    </div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="level">Level</label>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<select name="level" id="level" class="form-control">
            <option value="0"> -- PILIH LEVEL --</option>
              <?php if($x[0]->level == 'ADMIN') { ?>
              <option value="ADMIN" selected> ADMINISTRATOR</option>
              <option value="USER"> USER</option>
              <?php } else { ?>
              <option value="ADMIN"> ADMINISTRATOR</option>
              <option value="USER" selected> USER</option>
              <?php } ?>
            </select>
					</div>
				</div>
			</div>
		</div>

		<div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="aktif">Aktif</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
         <?php if($x[0]->aktif == 'Y') { ?>
          <input name="aktif" checked value="Y" type="radio" id="radio3" class="radio-col-teal">
          <label for="radio3">Ya</label>

          <input name="aktif" value="N" type="radio" id="radio4" class="radio-col-orange">
          <label for="radio4">Tidak</label>
          <?php } else { ?>
          <input name="aktif" value="Y" type="radio" id="radio3" class="radio-col-teal">
          <label for="radio3">Ya</label>

          <input name="aktif" checked value="N" type="radio" id="radio4" class="radio-col-orange">
          <label for="radio4">Tidak</label>
          <?php } ?>
				</div>
			</div>
		</div>


    <div class="clearfix">
	<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
      <button type="submit" id="c_module_simpan" class="btn btn-sm btn-primary waves-effect waves-float m-r-10 m-t-15">Simpan Perubahan</button>
      <button type="button" id="c_module_batal" class="btn btn-sm btn-link waves-effect waves-red waves-float m-t-15"> Batalkan</button>
			</div>
		</div>
    <?= form_close(); ?>
  </div>
</div>

<script>
var view 	= function(event) {
	var output 		= document.getElementById('preview');
	output.src = URL.createObjectURL(event.target.files[0]);
}

$(document).on('click', 'button#c_module_batal', function() {
  window.location.replace('<?= base_url('backend/module/c_users?module='.$this->madmin->getmodule('MANAJEMEN USER').'&user='.$this->session->userdata('user_access')) ?>')
});
</script>