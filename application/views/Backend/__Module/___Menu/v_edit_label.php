<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-4/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>">
<div class="container">
  <h6 class="title-widget-popup">Manajemen Label Menu</h6>
  <h5 class="title-pages">Edit Label "<?= strtolower($data_by_id[0]->nama_label) ?>"</h5>
  <br>
  <div class="row mt-5 pt-5">
    <form action="<?= base_url('backend/module/c_menu/proses_update_label_menu') ?>" method="POST">
    <input type="hidden" name="id_label" value="<?= strtolower($data_by_id[0]->id_label) ?>">
        <div class="form-group">
          <label for="nm_label">Nama Label</label>
          <input type="text" class="form-control" id="nm_label" name="nm_label" value="<?= $data_by_id[0]->nama_label ?>">
        </div>

        <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="nm_urutan">Urutan</label>
            <input type="text" class="form-control" id="nm_urutan" name="nm_urutan" value="<?= $data_by_id[0]->order ?>">
          </div>
          <div class="col">
            <label for="nm_status">Status</label>
            <?php if($data_by_id[0]->aktif == 'Y') { ?>
            <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" checked type="radio" value="Y" name="nm_status" id="inlineRadio1">
              <label class="form-check-label" for="inlineRadio1">Aktif</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="N" name="nm_status" id="inlineRadio2">
              <label class="form-check-label" for="inlineRadio2">Tidak</label>
            </div>
            </div>
            <?php } else { ?>
              <div class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input"  type="radio" value="Y" name="nm_status" id="inlineRadio1">
                <label class="form-check-label" for="inlineRadio1">Aktif</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked type="radio" value="N" name="nm_status" id="inlineRadio2">
                <label class="form-check-label" for="inlineRadio2">Tidak</label>
              </div>
              </div>
            <?php } ?>
          </div>
        </div>
        </div>
      
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back(-1)">Batal</button>
      </form>

  </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
<style>
h6.title-widget-popup {
  position: fixed;
  display: block;
  width:100%;
  padding:15px 8px;
  top:0;
  left:0;
  color:#fff;
  background:#333;
  text-align: left;
  text-transform: uppercase;
  margin-bottom:20px;
}
h5.title-pages {
  display: block;
  width:100%;
  padding:15px 15px;
  border-bottom:1px solid #ccc;
  background:transparent;
  position: fixed;
  left:0;
  top:50px;
}

</style>