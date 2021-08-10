<div class="row clearfix">
  <div class="col-md-8 col-md-offset-2">
    <div class="card card-border m-t-15">
    <?= form_open('backend/module/c_agenda/update', array('id' => 'FormUpdateAgenda')) ?>
    <input type="hidden" name="id_agenda" value="<?= $data[0]->id_agenda ?>">
      <div class="header">
        <h2 class="card-title">
          Edit Agenda
        </h2>
      </div>
      <div class="body FormUpdateAgenda">
        <div class="form-group">
          <label for="tema">Tema</label>
          <div class="form-line">
            <input type="text" name="tema" class="form-control" id="tema" value="<?= $data[0]->tema ?>">
          </div>
        </div>

        <div class="form-group">
          <label>Tanggal</label>
          <div class="input-group input-daterange" id="bs_datepicker_range_container">
              <div class="form-line">
                  <input type="text" name="tgl_mulai" class="form-control date col-md-3" value="<?= $data[0]->tgl_mulai ?>">
              </div>
              <span class="input-group-addon"><em class="material-icons">date_range</em></span>
              <div class="form-line">
                  <input type="text" name="tgl_selesai" class="form-control date" value="<?= $data[0]->tgl_selesai ?>">
              </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">
              <label>Jam</label>
            <div class="form-group input-group">
              <span class="input-group-addon"><em class="glyphicon glyphicon-time"></em></span>
              <div class="form-line">
                <input type="text" name="jam" class="timepicker form-control time24" value="<?= substr($data[0]->jam, 0, 5) ?>">
              </div>
            </div>
          </div>
          <div class="col-md-9 col-sm-9 col-xs12">
            <div class="form-group">
              <label for="lokasi">Lokasi</label>
              <div class="form-line">
                <input type="text" name="lokasi" class="form-control" id="lokasi" value="<?= $data[0]->lokasi ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="tinymce_agenda">Isi Agenda</label>
          <div class="form-line">
            <textarea name="isi_agenda" rows="4" class="form-control" id="editor"><?= $data[0]->isi_agenda ?></textarea>
          </div>
        </div>

      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-link bg-indigo btn-rounded waves-effect waves-white pull-right">SIMPAN PERUBAHAN</button>
          <button type="button" onclick="window.history.back(-1);" class="btn btn-circle btn-link bg-indigo waves-effect pull-left m-r-15 m-t--35"><i class="glyphicon glyphicon-chevron-left"></i></button>
        
      </div>
    <?= form_close(); ?>
    </div>
  </div>
</div>
