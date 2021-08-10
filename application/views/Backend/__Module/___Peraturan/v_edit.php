<div class="row clearfix">
  <div class="col-md-10 col-md-offset-1">
    <?php 
        if($this->session->flashdata('message') <> ''):
    ?>
        <div class="alert <?= $this->session->flashdata('errorStatus') ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <?= $this->session->flashdata('message') ?>
        </div>
    <?php 
        endif;
    ?>
    <div class="card card-border m-t-25">
      <div class="header">
        <h2 class="card-title">EDIT PERATURAN</h2>
      </div>
      <div class="body">
        <div id="preview-pdf">
          <!-- <?= $model[0]->file; ?> -->
          <iframe src="<?= base_url('./files/file_peraturan/'.$model[0]->file) ?>" width="100%" height="400"></iframe>
        </div>
        <?= form_open_multipart('backend/module/c_peraturan/aksiupdate/'.$model[0]->id_peraturan.'/'.$model[0]->file, ['id' => 'formEditPeraturan', 'class' => 'form-horizontal']); ?>

        <div class="row clearfix m-t-10">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="file">Ganti File</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" id="file" name="file" class="form-control">
                    </div>
                    <p class="help-block"> <em>*) apabila file tidak diganti, biarkan kosong</em></p>
                </div>
            </div>
        </div>

        <div class="row clearfix m-t-10">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="judul">Nama Peraturan</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" id="judul" name="judul" class="form-control" value="<?= $model[0]->judul ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix m-t-10">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="jsnperaturan">Jenis</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <select name="jsnperaturan" id="jsnperaturan" class="form-control">
                          <?php 
                            $row = $this->mperaturan->get_select_jenisperaturan_noajax();
                            if(count($row) > 0 ){
                                foreach($row as $r) {
                                $ckselect = $model[0]->fid_jns_peraturan == $r->id_jenis_peraturan ? 'selected' : '';
                                echo "<option value='". $r->id_jenis_peraturan ."' ". $ckselect .">". strtoupper($r->nama_jenis_peraturan) ."</option>";
                                }
                            }
                          ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix m-t-10">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="tahun">Tahun</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group ">
                <div id="bs_datepicker_component_container" class="date">
                    <div class="form-line">
                        <input type="text" max="4" min="1" id="tahun" name="tahun" value="<?= $model[0]->tahun ?>" class="form-control">
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                <button type="button" onclick="window.location.href='<?= base_url('backend/module/c_peraturan?module='.$this->madmin->getmodule('peraturan').'&user='.$this->session->userdata('user_access')) ?>'" class="btn btn-danger m-t-15 m-r-10 waves-effect">BATAL</button>
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SIMPAN</button>
            </div>
        </div>
    

        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>