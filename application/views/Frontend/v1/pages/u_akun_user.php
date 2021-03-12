<?php
$d = $this->users->detail_user(encrypt_url($this->session->userdata('user_portal_log')['email']));
$cek_verify = $d->email_verifikasi == 'Y' ? '<i class="fas text-success fa-check-circle"></i>' : '<br><span class="badge badge-warning">Belum verify</span>';
$desc = $d->deskripsi == '' ? '<button class="btn btn-default text-left text-secondary" ><i class="fas fa-plus mr-2"></i> Tambahkan deskripsi tentang kamu disini.</button>' : $d->deskripsi;
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($d->id_user_portal)->photo_pic) . '';
?>
<div class="card border-0 shadow-none animated fadeIn bg-white">
  <div class="card-body p-0 p-md-5">
    <div class="container">
      <div class="row mt-md-0 mt-3">
        <div class="col-3 col-md-3 text-center">
          <img src="<?= $photo ?>" class="img-fluid rounded shadow">
        </div>
        <div class="col-9 col-md-9 pb-3 pb-md-0">
          <a href="<?= base_url('frontend/v1/users/edit/' . encrypt_url($d->id_user_portal)); ?>" class="btn btn-sm btn-light border float-right mt-1"><i class="fas fa-cog mr-2" aria-hidden="true"></i> Edit Profile</a>
          <h3 class="font-weight-bold"><?= $this->session->userdata('user_portal_log')['nama_lengkap']; ?></h3>
          <span class="text-secondary">@<?= $this->session->userdata('user_portal_log')['nama_panggilan']; ?> <span class="mx-1"> &bull;</span> <small>Bergabung pada: <?= longdate_indo($d->tanggal_bergabung); ?></small></span>
          <hr>
          <?= $desc; ?> <br>
          <?php if($d->email_verifikasi == 'Y'): ?>
          <a href="<?= base_url('frontend/v1/post/judul') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-newspaper my-2 fa-3x" aria-hidden="true"></i> <br> New Post </a>
          <a href="<?= base_url('frontend/v1/halaman/halamanstatis/add') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-pager my-2 fa-3x" aria-hidden="true"></i> <br> New Page </a>
          <a href="<?= base_url('frontend/v1/album/new_album') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-images my-2 fa-3x" aria-hidden="true"></i> <br> New Album </a>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer bg-white p-4">
    <span class="text-secondary d-inline-block mt-2">
      <?= $this->session->userdata('user_portal_log')['email'] . " " . $cek_verify; ?>
    </span>
    
  </div>
</div>
</div>