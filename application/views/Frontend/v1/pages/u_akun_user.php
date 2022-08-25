<?php
$d = $this->users->detail_user(encrypt_url($this->session->userdata('user_portal_log')['email']));
$cek_verify = $d->email_verifikasi === 'Y' ? '<i class="fas text-success fa-check-circle"></i>' : '<br> <span class="badge badge-warning">Unverify</span>';
$cek_role = $d->role === 'EDITOR' ? '<span class="badge badge-info">Editor</span' : '<span class="badge badge-info">Tamu</span>';
$desc = $d->deskripsi === '' ? '<button class="btn btn-default text-left text-secondary" ><i class="fas fa-plus mr-2"></i> Tambahkan deskripsi tentang kamu disini.</button>' : $d->deskripsi;
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($d->id_user_portal)->photo_pic) . '';
?>
<div class="card border-0 shadow-none animated fadeIn">
  <div class="card-body p-0 p-md-3">
    <div class="container">
      <div class="row mt-md-0 mt-3">
        <div class="col-12 col-md-12 pb-3 pb-md-0">
          <div class="d-flex justify-content-between align-items-center">
            <div class="w-auto">
              <p class="small text-success">Registered Success: <?= longdate_indo($d->tanggal_bergabung); ?></p>
              <h3>My Dashboard</h3>
              <p class="text-muted">
                Ayoo! buat aktivitas dan produktifitas kamu benilai positif, mari bangun konten yang bernilai & bermanfaat bagi orang lain.
              </p>
              <b>Description</b>
              <p class="text-muted"><?= $desc ?></p>
              
            </div>
            <div class="text-right w-50">
              <img src="<?= base_url('assets/images/bg/work.svg') ?>" class="img-fluid w-100">
            </div>
          </div>
          <?php if($d->role == 'EDITOR'): ?>
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div data-toggle="collapse" data-target="#collapseFeatured" aria-expanded="true" class="panel-title text-muted border-0 rounded list-group-item pl-0">
                  <b class="d-block">Fast Created & Manage</b>
                </div>
              </div>
              
              <div id="collapseFeatured" class="panel-collapse collapse show">
                <div class="panel-body">
                  <div class="d-flex justify-content-around justify-content-lg-between flex-wrap flex-lg-row">
                    <a href="<?= base_url('frontend/v1/post/judul') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-newspaper my-2 fa-3x" aria-hidden="true"></i> <br> Create Posts </a>
                    <a href="<?= base_url('frontend/v1/halaman/halamanstatis/add') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-pager my-2 fa-3x" aria-hidden="true"></i> <br> Create Pages </a>
                    <a href="<?= base_url('frontend/v1/album/new_album') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-images my-2 fa-3x" aria-hidden="true"></i> <br> Create Albums </a>
                    <a href="<?= base_url('frontend/v1/banner/new_banner') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="fas fa-image my-2 fa-3x" aria-hidden="true"></i> <br> Create Banners </a>
                    <a id="module" href="<?= base_url('frontend/v1/users/komentar') ?>" class="btn border text-primary btn-default mt-3 p-3"> <i class="far fa-comment my-2 fa-3x" aria-hidden="true"></i> <br> Manage Comments </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>