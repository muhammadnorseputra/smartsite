<?php
$d = $this->users->detail_user(encrypt_url($this->session->userdata('user_portal_log')['email']));
$cek_verify = $d->email_verifikasi == 'Y' ? '<i class="fas text-success fa-check-circle"></i>' : '<br><span class="badge badge-warning">Belum verify</span>';
$desc = $d->deskripsi == '' ? '<button class="btn btn-default text-left text-secondary"><i class="fas fa-plus mr-2"></i> Tambahkan deskripsi tentang kamu disini.</button>' : $d->deskripsi;
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($d->id_user_portal)->photo_pic) . '';
?>
<section class="hero">
  <div class="container py-5">
    <div class="col-md-8 offset-md-2 py-5 d-flex justify-content-center align-items-center">
      <div class="font-weight-bold text-center">
        
      </div>
    </div>
  </div>
</div>
</section>
<section class="mt--9">
  <div class="container bg-white rounded-lg border mb-3 shadow-sm">
    <div class="row">
      <div class="col-md-3 no-gutters px-0">
        <div class="list-group border-0 rounded-0">
          <div class="list-group-item text-primary border-0 rounded-0 mb-2">
            <b class="d-block">Menu</b>
            Halo, <?= $this->session->userdata('user_portal_log')['nama_panggilan']; ?> welcome back.
          </div>
          <a id="module" href="<?= base_url('frontend/v1/users/akunProfile'); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted">
            <i class="fas fa-user mr-3 float-right" aria-hidden="true"></i> Profile
          </a>

          <?php if($d->role == 'EDITOR'): ?>
          <a id="module" href="<?= base_url('frontend/v1/users/post/'.encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-newspaper mr-3 float-right" aria-hidden="true"></i> Postingan</a>
          <a id="module" href="<?= base_url('frontend/v1/users/halamanstatis/' . encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-pager mr-3 float-right" aria-hidden="true"></i> Halaman</a>
          <a id="module" href="<?= base_url('frontend/v1/users/halamanlink/'); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-link mr-3 float-right" aria-hidden="true"></i> Halaman Link</a>
          <a id="module" href="<?= base_url('frontend/v1/users/galeri/'); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-images mr-3 float-right" aria-hidden="true"></i> Galeri Foto</a>
          <a id="module" href="<?= base_url('frontend/v1/users/banner/'); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-image mr-3 float-right" aria-hidden="true"></i> Banner</a>
          <a id="module" href="<?= base_url('frontend/v1/users/submenu/'); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-leaf mr-3 float-right" aria-hidden="true"></i> Submenu</a>

          <div class="list-group-item text-primary border-0 rounded-0 mb-2">
            <b class="d-block">Interaksi</b>
          </div>
          <a id="module" href="<?= base_url('frontend/v1/users/komentar/'); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="far fa-comment-alt mr-3 float-right" aria-hidden="true"></i> Komentar</a>
          <a id="module" href="<?= base_url('frontend/v1/users/kotak_saran/'); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-box mr-3 float-right" aria-hidden="true"></i> Kotak Saran</a>
          <?php endif; ?>
          <!-- <a id="module" href="#" class="border-0  rounded-0 list-group-item list-group-item-action"><i class="fas fa-cogs mr-3 float-right" aria-hidden="true"></i> Pengaturan</a> -->
          <div class="list-group-item text-primary border-0 rounded-0 mb-2">
            <b class="d-block">Lainnya</b>
          </div>
          <?php if($d->email_verifikasi == 'Y'): ?>
          <a id="module" href="<?= base_url('frontend/v1/users/postDisukai/'.encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="far fa-thumbs-up mr-3 float-right" aria-hidden="true"></i> Disukai</a>
          <a id="module" href="<?= base_url('frontend/v1/users/postDisimpan/'.encrypt_url($d->id_user_portal)); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="far fa-bookmark mr-3 float-right" aria-hidden="true"></i> Disimpan</a>
          <?php endif; ?>
          <a href="<?= base_url('frontend/v1/users/logout/'); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted"><i class="fas fa-sign-out-alt mr-3 float-right" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
      <div class="col-md-9 px-md-0 border-left order-first order-md-last">
        <div id="containerModule">
          <?php $this->load->view('Frontend/v1/pages/u_akun_user'); ?>
        </div>
      </div>
    </div>
  </div>
</section>