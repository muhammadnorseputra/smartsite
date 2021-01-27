<section class="py-5" style="background-image: url(<?= base_url('assets/images/bg/svg_.svg') ?>); background-size: cover; background-repeat: no-repeat; background-position: top left; background-clip: cover;">
  <div class="container">
    <div class="row">
      <div class="col-md-12 my-5 pt-4 text-left">
        <?php
        if ($detail->num_rows() > 0) :
          $h = $detail->row();
        ?>
          <h2 class="font-weight-bold mb-0 pb-0">
            <span class="d-block text-white font-weight-bold"><?= $h->title; ?></span>    
            </h2>
          <small class="font-weight-light d-block text-white my-3">Halaman ini dibuat oleh <b><?= decrypt_url($this->users->get_userportal_namalengkap($h->fid_users_portal)) ?></b></small>
        <?php else : ?>
          <h3 class="font-weight-bold text-primary">not found</h3>
          <small class="font-weight-light d-block text-light pb-4">PagesID: <?= $this->uri->segment(5) ?> | Halaman ini ditampilkan dalam waktu <strong>{elapsed_time}</strong> detik.</small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<section class="h-statis-detail">
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1 mb-md-5 shadow-sm mt--7 bg-white p-3 p-md-5" style="border-radius: 12px;">
        <?php
        if ($detail->num_rows() > 0) :
          $h = $detail->row();
        ?>
        <?php if(!empty($h->file)): ?>
        <object class="rounded-lg border mb-3" data="data:application/pdf;base64,<?= base64_encode($h->file) ?>" type="application/pdf" style="height:350px; width: 100%;"></object>
        <?php endif; ?>
        <?= $h->content ?>
        <?php else : ?>
          <img class="d-block mx-auto mb-2 mt-5" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/page-not-found.svg') ?>">
          <p>
            <h4 class="text-center">Halaman tidak ditemukan!</h4>
            <p class="text-center font-weight-light">
              Ops, halaman yang kamu cari tidak ditemukan.
            </p>
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>