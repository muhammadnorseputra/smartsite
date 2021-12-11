<section class="py-md-5 hero" style="min-height: 500px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12 pt-md-5 mt-5 text-left pb-5 pb-md-3">
        <?php
        if ($detail->num_rows() > 0) :
        $h = $detail->row();
        ?>
        <span class="font-weight-light small d-block text-white my-3">Created by <b>@<?= decrypt_url($this->users->get_userportal_namalengkap($h->fid_users_portal)) ?></b> &bull; <?= nominal($h->views) ?>x Diakses</span>
        <h1 class="font-weight-bold mb-0 pb-0">
        <span class="d-block font-weight-bold text-white"><?= $h->title; ?></span>
        </h1>
        <div id="share"></div>
        <?php else : ?>
        <h3 class="font-weight-bold text-white">not found</h3>
        <small class="font-weight-light d-block text-white pb-4">PagesID: <?= encrypt_url($uri_token_halaman) ?> | Halaman ini ditampilkan dalam waktu <strong>{elapsed_time}</strong> detik.</small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<section class="h-statis-detail mt--8 mb-3">
  <div class="container">
    <div class="row">
      <div class="col-md-8 bg-white p-3 p-md-3 rounded shadow-sm order-last order-md-first">
        <?php
        if ($detail->num_rows() > 0) :
        $h = $detail->row();
        ?>
        
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
      <div class="col-md-4 rounded">
      <?php
      if(!empty($h->file)):
      $path = !empty($h->filename) ? $h->filename : '';
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      ?>
        <?php
        if($ext === 'pdf'):
        ?>
        <object class="rounded-lg border mb-3" data="data:application/pdf;base64,<?= base64_encode($h->file) ?>" type="application/pdf" style="height:350px; width: 100%;"></object>
        <?php else: ?>
        <img style="object-fit:cotain;" data-src="<?= img_blob($h->file) ?>" width="100%" height="350" alt="<?= $h->filename ?>" class="mx-auto img-fluid d-block rounded lazy">
        <?php endif; ?>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>
$(function() {
  $("#share").jsSocials({
    shares: ["email", "twitter", "facebook", "telegram", "whatsapp"],
    text: "",
    shareIn: "blank",
    showCount: "inside",
    showLabel: false,
  });
})
</script>