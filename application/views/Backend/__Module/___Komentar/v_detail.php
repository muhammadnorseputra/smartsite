<div class="media">
    <div class="media-left">
            <img class="media-object" src="<?= base_url('assets/images/gravatar/').$d->gravatar ?>" width="64" height="64">
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?= $d->nama_lengkap ?> / <span class="font-12 col-teal"><?= longdate_indo($d->tanggal)." - ".substr($d->jam,0,5) ?></span></h4>
        <p>
          <b><u><?= $this->mkomentar->getjudulberitabyidkomentar($d->fid_berita) ?></u></b>
        </p>
        <p>
            <?= $d->isi ?>
        </p>
        <?php if($d->parent_id != 0) { ?>
        <p>
          <b>Reply from</b><br>
          <div class="media">
              <div class="media-left">
                  <a href="#">
                      <img class="media-object" src="<?= base_url('assets/images/gravatar/').$r->gravatar ?>" width="64" height="64">
                  </a>
              </div>
              <div class="media-body">
                  <h4 class="media-heading"><?= $r->nama_lengkap ?></h4> 
                  <p>
                      <?= $r->isi ?>
                  </p>
              </div>
          </div>
        </p>
        <?php } ?>
    </div>
</div>

<div class="card">
  <div class="header">
    <h2 class="card-title">BALAS KOMENTAR SEBAGAI (<span class="col-pink"><?= $this->session->userdata('lvl') ?></span>)</h2>
  </div>
  <div class="body" style="padding:0;">
  <?= form_open('backend/module/c_komentar/proses_balas_komentar', array('id' => 'FormBalasKomentar')) ?>
  <div class="form-group">
      <div class="form-line">
          <textarea rows="4" class="form-control no-resize" name="isi_komentar" id="isi_komentar" placeholder="Masukan komentar balasan kepada: <?php echo $d->nama_lengkap ?> ..."></textarea>
      </div>
  </div>
  <input type="hidden" name="parent_id" value="<?= $id ?>">
  <input type="hidden" name="fid_berita" value="<?= $d->fid_berita ?>">
  <button type="submit" class="btn btn-primary btn-rounded waves-effect" >KIRIM</button>
  <?= form_close() ?>
  </div>
</div>

<script>



$('form#FormBalasKomentar').on('submit', function(event){
  event.preventDefault();
  let _this = $(this);
  let Url  = _this.attr('action');
  let Post = _this.serialize();

  $.post(Url, Post, function(result){
    // $.alert();
    showNotification('bg-black', result.msg, 'bottom', 'center', 'none', 'animated bounceOutUp');
    if(result.type != 0) {
    $("#modal-detail-komentar").modal('hide');
    _this[0].reset();
    $('#tbl-komentar').DataTable().ajax.reload();
    }
  }, 'json');
});
</script>