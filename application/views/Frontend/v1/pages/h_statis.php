<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-10 pt-md-1 mt-md-1 offset-md-3 offset-lg-2 text-left pb-5 pb-md-1 px-md-0">
        <?php
        if ($detail->num_rows() > 0) :
        $h = $detail->row();
        ?>
        <span class="font-weight-light small d-block text-dark my-3">Post On <b>@<?= decrypt_url($this->users->get_userportal_namalengkap($h->fid_users_portal)) ?></b> &bull; <?= nominal($h->views) ?>x Diakses</span>
        <h1 class="mb-0 pb-0 fs7 d-none d-md-block d-lg-block"><span class="d-block text-dark"><?= $h->title; ?></span></h1>
        <h1 class="mb-0 pb-0 fs9 d-md-none d-block"><span class="d-block text-dark"><?= $h->title; ?></span></h1>
        <div id="share" class="mb-md-3"></div>
        <?php else : ?>
        <h3 class="font-weight-bold text-dark">not found</h3>
        <small class="font-weight-light d-block text-dark pb-4">PagesID: <?= encrypt_url($uri_token_halaman) ?> | Halaman ini ditampilkan dalam waktu <strong>{elapsed_time}</strong> detik.</small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<section class="h-statis-detail bg-white rounded trinket_statis">
  <div class="container mb-md-5">
    <div class="row">
      <div class="col-md-6 order-last" style="overflow-x: hidden;">
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
      <div class="col-md-4 offset-md-2 mb-3 mb-md-0 pl-md-0 pt-md-0">
      <?php
      if(!empty($h->file)):
      $path = !empty($h->filename) ? $h->filename : '';
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      ?>
        <?php
        if($ext === 'pdf'):
        ?>
        <object class="rounded-lg border my-3" data="data:application/pdf;base64,<?= base64_encode($h->file) ?>" type="application/pdf" style="height:350px; width: 100%;"></object>
        <?php else: ?>
        <img style="object-fit:cotain; min-height: 350px" data-src="<?= img_blob($h->file) ?>" width="100%" height="350" alt="<?= $h->filename ?>" class="mx-auto img-fluid d-block rounded-lg lazy">
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