<?php
$d = $this->users->detail_user(encrypt_url($this->session->userdata('email')));
$cek_verify = $d->email_verifikasi == 'Y' ? '<i class="fas text-success fa-check-circle"></i>' : '<br><span class="badge badge-warning">Belum verify</span>';
$desc = $d->deskripsi == '' ? '<button class="btn btn-default text-left text-secondary" ><i class="fas fa-plus mr-2"></i> Tambahkan deskripsi tentang kamu disini.</button>' : $d->deskripsi . "<a href='#' class='btn btn-link border rounded-circle ml-2 text-center btn-sm' data-toggle='tooltip' data-placement='right' title='Edit deskripsi'><i class='fas fa-pencil-alt' aria-hidden='true'></i></a>";
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($d->id_user_portal)->photo_pic) . '';
?>
<div class="card border-0 shadow-none animated fadeIn">
  <div class="card-body p-0 p-md-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 text-center">
          <img src="<?= $photo ?>" class="img-fluid rounded shadow">
          <a href='#' data-toggle="tooltip" data-placement="left" title="Ubah Photo" class='btn btn-link border rounded-circle text-center btn-sm mt-3'><i class='fas fa-pencil-alt' aria-hidden='true'></i></a>
        </div>
        <div class="col-md-9">
          <a href="<?= base_url('frontend/v1/users/edit/' . encrypt_url($d->id_user_portal)); ?>" class="btn btn-sm btn-light border float-right mt-1"><i class="fas fa-cog mr-2" aria-hidden="true"></i> Edit Profile</a>
          <h3 class="font-weight-bold"><?= $this->session->userdata('nama_lengkap'); ?></h3>
          <span class="text-secondary">@<?= $this->session->userdata('nama_panggilan'); ?> <span class="mx-1"> &bull;</span> <small>Bergabung pada: <?= longdate_indo($d->tanggal_bergabung); ?></small></span>
          <hr>
          <?= $desc; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer bg-white p-4">
    <span class="text-secondary d-inline-block mt-2">
      <?= $this->session->userdata('email') . " " . $cek_verify; ?>
    </span>
    <a href="<?= base_url('frontend/v1/post/judul') ?>" class="btn border float-right btn-default p-3"> <i class="fas fa-pencil-alt mr-2" aria-hidden="true"></i> Buat postingan baru. </a>
  </div>
</div>
</div>