<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<?php
$d = $this->users->detail_user(encrypt_url($this->session->userdata('user_portal_log')['email']));
$cek_verify = $d->email_verifikasi == 'Y' ? '<i class="fas text-success fa-check-circle"></i>' : '<br><span class="badge badge-warning">Belum verify</span>';

$desc = $d->deskripsi == '' ? '<button class="btn btn-default text-left text-secondary"><i class="fas fa-plus mr-2"></i> Tambahkan deskripsi tentang kamu disini.</button>' : $d->deskripsi;
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($d->id_user_portal)->photo_pic) . '';

if($d->role === 'EDITOR'):
    $cek_role = '<span class="badge badge-warning">Editor</span';
  elseif($d->role === 'KONTRIBUTOR'):
    $cek_role = '<span class="badge badge-info">Konstributor</span>';
  else:
    $cek_role = '<span class="badge badge-dark">Tamu</span>';
endif;
?>
<section class="hero mt-md-5">
  <div class="container py-2 py-md-5">
    <div class="col-md-8 pt-md-5">
      <div class="d-flex justify-content-start align-items-center">
        <img src="<?= $photo ?>" class="img-fluid rounded-circle shadow-sm w-10">
        <div class="ml-3 font-weight-bold text-dark">
          <h4>Halo, <?= $this->session->userdata('user_portal_log')['nama_panggilan']; ?> welcome back.</h4>
          <div class="text-white font-weight-light">
            <?= $this->session->userdata('user_portal_log')['email']." ".$cek_verify ?>
          </div>
          <!-- <div class="small text-white">Joined On: <?= longdate_indo($d->tanggal_bergabung); ?></div> -->
          <div><?= $cek_role ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<section>
<div class="container bg-white mb-4">
  <div class="row">
    <div class="col-md-3 no-gutters">
      
      <div class="list-group border-0">
        <div class="panel-group" id="accordion">
          <!-- UTAMA -->
          <div class="panel panel-default mb-2">
            <div class="panel-heading">
              <div data-toggle="collapse" data-target="#collapseOne" class="panel-title list-group-item text-muted border-0 rounded" aria-expanded="true">
                <b class="d-block">Menu</b>
              </div>
            </div>
            <div id="collapseOne" class="panel-collapse collapse show">
              <div class="panel-body">
              <a id="module" href="<?= base_url('frontend/v1/users/akunProfile'); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light">
                <i class="fas fa-tachometer-alt float-right" aria-hidden="true"></i> Dashboard
              </a>
              <?php if($d->role == 'EDITOR'): ?>
              <a id="module" href="<?= base_url('frontend/v1/users/post/'.encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-newspaper float-right" aria-hidden="true"></i> Posts</a>
              <a id="module" href="<?= base_url('frontend/v1/users/halamanstatis/' . encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-pager float-right" aria-hidden="true"></i> Pages</a>
              <a id="module" href="<?= base_url('frontend/v1/users/halamanlink/'); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-link float-right" aria-hidden="true"></i> Page Link</a>
              <a id="module" href="<?= base_url('frontend/v1/users/galeri/'); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-images float-right" aria-hidden="true"></i> Photo Gallery</a>
              <a id="module" href="<?= base_url('frontend/v1/users/banner/'); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-image float-right" aria-hidden="true"></i> Banner</a>
              <a id="module" href="<?= base_url('frontend/v1/users/submenu/'); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-leaf float-right" aria-hidden="true"></i> Submenu</a>
              <?php elseif($d->role == 'KONTRIBUTOR'): ?>
              <a id="module" href="<?= base_url('frontend/v1/users/post/'.encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-newspaper float-right" aria-hidden="true"></i> Posts</a>
              <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if($d->role == 'EDITOR'): ?>
          <!-- IKM -->
          <div class="panel panel-default mb-2">
            <div class="panel-heading">
              <div data-toggle="collapse" data-target="#collapseTwo" class="panel-title list-group-item text-muted border-0 rounded">
                <b class="d-block">IKM</b>
              </div>
            </div>
            
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
              <a id="module" href="<?= base_url('frontend/v1/users/ikm_periode/'); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-check-circle float-right" aria-hidden="true"></i> Periode</a>
               <a id="module" href="<?= base_url('frontend/v1/users/ikm_responden/'); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-user-circle float-right" aria-hidden="true"></i> Responden</a>
              </div>
            </div>
          </div>
          <!-- INTERAKSI -->
          <div class="panel panel-default mb-2">
            <div class="panel-heading">
              <div data-toggle="collapse" data-target="#collapseTree" class="panel-title list-group-item text-muted border-0 rounded">
                <b class="d-block">Interaksi</b>
              </div>
            </div>
            
            <div id="collapseTree" class="panel-collapse collapse">
              <div class="panel-body">
               <a id="module" href="<?= base_url('frontend/v1/users/komentar/'); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="far fa-comment-alt float-right" aria-hidden="true"></i> Comments</a>
               <a id="module" href="<?= base_url('frontend/v1/users/kotak_saran/'); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="fas fa-box float-right" aria-hidden="true"></i> Suggestion Box</a>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if(($d->email_verifikasi === 'Y') && ($d->role !== 'TAMU')): ?>
          <!-- LAINNYA -->
          <div class="panel panel-default mb-2">
            <div class="panel-heading">
              <div data-toggle="collapse" data-target="#collapseFour" class="panel-title list-group-item text-muted border-0 rounded">
                <b class="d-block">Lainnya</b>
              </div>
            </div>
            
            <div id="collapseFour" class="panel-collapse collapse">
              <div class="panel-body">
              <a id="module" href="<?= base_url('frontend/v1/users/postDisukai/'.encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="far fa-thumbs-up float-right" aria-hidden="true"></i> Liked</a>
              <a id="module" href="<?= base_url('frontend/v1/users/postDisimpan/'.encrypt_url($d->id_user_portal)); ?>" class="border-0  rounded mb-1 list-group-item list-group-item-action text-muted font-weight-light"><i class="far fa-bookmark float-right" aria-hidden="true"></i> Saved</a>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
       
      </div>
    </div>
    <div class="col-md-9 px-md-0 order-first order-md-last mt--7 bg-white rounded shadow">
      <div class="alert alert-warning alert-dismissible fade show mb-0 rounded-top" role="alert">
        <strong>For Userportal</strong>, mulai tanggal 10 juli 2021 kami akan terus mengupdate UI & UX Website
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="containerModule">
        <?php $this->load->view('Frontend/v1/pages/u_akun_user'); ?>
      </div>
    </div>
  </div>
</div>
</section>