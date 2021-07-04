<?=  form_open('backend/c_pengaturan/do_hakakses_update/'.$datas[0]->id_access_logregistered, ['id' => 'frm_hakakses_update']) ?>
<label for="ip">Ip address</label>
<div class="form-group">
	<div class="form-line">
		<input type="text" name="ip" id="ip" class="form-control ip" placeholder="Masukan ip address user" value="<?= $datas[0]->ip ?>">
	</div>
</div>
<label for="np">Nama pemilik</label>
<div class="form-group">
	<div class="form-line">
		<input type="text" name="nama_pemilik" id="np" class="form-control" placeholder="Masukan user pemilik ip address" value="<?= $datas[0]->name ?>">
	</div>
</div>
<label for="type">Jenis / Type perangkat yang digunakan</label>
<div class="form-group">
	<div class="form-line">
		<input type="text" name="type_pemilik" id="type" class="form-control"
			placeholder="Masukan nama perangkat yang digunakan" value="<?= $datas[0]->type ?>">
	</div>
</div>
<label for="block">Block</label>
<?php if($datas[0]->block == 'y') { ?>
<div class="form-group">
	<div class="switch">
		<label>TIDAK <input type="hidden" name="block" value="n"> <input type="checkbox" name="block" value="y"
				checked><span class="lever"></span>YA</label>
	</div>
</div>
<?php } else { ?>
  <div class="form-group">
	<div class="switch">
		<label>TIDAK <input type="hidden" name="block" value="n" checked> <input type="checkbox" name="block" value="y"><span class="lever"></span>YA</label>
	</div>
</div>
<?php } ?> 

<?= form_close() ?>