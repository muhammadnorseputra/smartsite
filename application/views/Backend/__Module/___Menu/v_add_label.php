<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-4/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>">
<div class="container">
  <div class="row">
    <div class="col-sm mt-5">
    <?php 
          if($this->session->flashdata('message') <> '') {
            echo '<div class="'.$this->session->flashdata('class').'">
                      '. $this->session->flashdata('message') .'
                  </div>';
            echo '<script>
                    window.opener.location.reload(true);
                  </script>';
          }
        ?>
    <h6 class="title-widget-popup">Manajemen Label Menu</h6>

      <nav class=" mt-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Table</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tambah Label</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <table class="table table-condensed mt-2">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Label</th>
              <th scope="col">Aktif</th>
              <th scope="col">Urutan</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 1; foreach($this->menu->get_label('ref_label_menu') as $l): ?>
            <tr>
              <th scope="row"><?= $no ?></th>
              <td><?= strtoupper($l->nama_label) ?></td>
              <td><?= $l->aktif ?></td>
              <td><?= $l->order ?></td>
              <td>
                <a href="<?= base_url('backend/module/c_menu/proses_hapus_label_menu/'.$l->id_label) ?>"><i class="fa fa-trash"></i></a>
                <a href="<?= base_url('backend/module/c_menu/proses_edit_label_menu/'.$l->id_label) ?>"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          <?php $no++; endforeach; ?>
          </tbody>
        </table>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          
        <h6 class="mt-3">Tambah Label Menu</h6> <hr>
        <form action="<?= base_url('backend/module/c_menu/proses_add_label_menu') ?>" method="POST">
        <div class="form-group">
          <label for="nm_label">Nama Label</label>
          <input type="text" class="form-control" id="nm_label" name="nm_label">
        </div>

        <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="nm_urutan">Urutan</label>
            <input type="text" class="form-control" placeholder="1,2,3,4..." id="nm_urutan" name="nm_urutan">
          </div>
          <div class="col">
            <label for="nm_status">Status</label>
            <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="Y" name="nm_status" id="inlineRadio1">
              <label class="form-check-label" for="inlineRadio1">Aktif</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="N" name="nm_status" id="inlineRadio2">
              <label class="form-check-label" for="inlineRadio2">Tidak</label>
            </div>
            </div>
          </div>
        </div>
        </div>
      
        <button class="btn btn-primary btn-sm">Simpan</button>
        <button class="btn btn-danger btn-sm" onclick="window.close()">Batal</button>
        </form>
        </div>
      </div>

     
    </div>
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

</style>