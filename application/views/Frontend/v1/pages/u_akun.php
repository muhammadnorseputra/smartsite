<?php
$d = $this->users->detail_user(encrypt_url($this->session->userdata('email')));
$cek_verify = $d->email_verifikasi == 'Y' ? '<i class="fas text-success fa-check-circle"></i>' : '<br><span class="badge badge-warning">Belum verify</span>';
$desc = $d->deskripsi == '' ? '<button class="btn btn-default text-left text-secondary"><i class="fas fa-plus mr-2"></i> Tambahkan deskripsi tentang kamu disini.</button>' : $d->deskripsi . "<a href='#' class='btn btn-link border rounded-circle ml-2 text-center btn-sm'><i class='fas fa-pencil-alt' aria-hidden='true'></i></a>";
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($d->id_user_portal)->photo_pic) . '';
?>
<section class="my-5 pt-md-5">
  <div class="container bg-white border border-light shadow-sm rounded">
    <div class="row">
      <div class="col-md-3 no-gutters px-0 py-1">
        <div class="list-group bg-white border-0 rounded-0 py-2">
          <div class="list-group-item text-muted border-0 rounded-0 mb-2 bg-white">
            <b class="d-block">Menu Project</b>
            Halo, <?= $this->session->userdata('nama_lengkap'); ?> welcome back.
          </div>
          <a id="module" href="<?= base_url('frontend/v1/users/akunProfile'); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted bg-white">
            <i class="fas fa-user mr-3 float-right" aria-hidden="true"></i> Profile
          </a>
          <a id="module" href="<?= base_url('frontend/v1/users/post/'.encrypt_url($d->id_user_portal)); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted bg-white"><i class="fas fa-pager mr-3 float-right" aria-hidden="true"></i> Postingan</a>
          <a id="module" href="<?= base_url('frontend/v1/users/postDisukai'); ?>" class="border-0 rounded-0 mb-2 list-group-item list-group-item-action text-muted bg-white"><i class="fas fa-thumbs-up mr-3 float-right" aria-hidden="true"></i> Disukai</a>
          <a id="module" href="<?= base_url('frontend/v1/users/postDisimpan'); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted bg-white"><i class="fas fa-bookmark mr-3 float-right" aria-hidden="true"></i> Disimpan</a>
          <a id="module" href="<?= base_url('frontend/v1/users/halamanstatis/' . encrypt_url($d->id_user_portal)); ?>" class="border-0  rounded-0 mb-2 list-group-item list-group-item-action text-muted bg-white"><i class="fas fa-newspaper mr-3 float-right" aria-hidden="true"></i> Halaman</a>
          <!-- <a id="module" href="#" class="border-0  rounded-0 list-group-item list-group-item-action"><i class="fas fa-cogs mr-3 float-right" aria-hidden="true"></i> Pengaturan</a> -->
        </div>
      </div>
      <div class="col-md-9 px-md-0 border-left border-light order-first order-md-last">
        <div id="containerModule">
          <?php $this->load->view('Frontend/v1/pages/u_akun_user'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <a href="<?php echo base_url('frontend/v1/users/logout/') ?>" class="btn btn-sm btn-link btn-default mt-3"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
  </div>
</section>