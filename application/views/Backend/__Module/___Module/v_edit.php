
<?php
 foreach($data->result() as $row):
?>

<input type="hidden" name="id_module" value="<?= $row->id_module; ?>">
<label for="nama_module">Nama Module</label>
<div class="form-group">
  <div class="form-line focused warning">
    <input type="text" id="nama_module" name="nama_module" class="form-control" value="<?= $row->nama_module; ?>">
  </div>
  
<div class="alert alert-message" role="alert">
  <span class="col-red font-12 font-bold">* Jangan merubah nama module, karena digunakan untuk akses link rediract halaman.</span>
</div>
</div>
<label for="aktif">Aktif</label>
<div class="form-group">
  <?php if($row->aktif == 'Y') { ?>
  <input name="aktif" value="N" type="radio" id="radio_9" class="with-gap radio-col-red">
  <label for="radio_9">NO ACTIVE</label>

  <input name="aktif" checked value="Y" type="radio" id="radio_10" class="with-gap radio-col-green">
  <label for="radio_10">ACTIVE</label>
  <?php } else { ?>
    <input name="aktif" checked value="N" type="radio" id="radio_9" class="with-gap radio-col-red">
    <label for="radio_9">NO ACTIVE</label>

    <input name="aktif" value="Y" type="radio" id="radio_10" class="with-gap radio-col-green">
    <label for="radio_10">ACTIVE</label>
  <?php } ?>
</div>
<?php
  endforeach;
?>