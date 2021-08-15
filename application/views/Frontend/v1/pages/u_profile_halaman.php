<?php
$by = $public_profile->id_user_portal;
$namalengkap = decrypt_url($public_profile->nama_lengkap);
$namapanggilan = decrypt_url($public_profile->nama_panggilan);
$tanggal_bergabung = longdate_indo($public_profile->tanggal_bergabung);
$desc = $public_profile->deskripsi != '' ? $public_profile->deskripsi : '<span class="text-muted">Belum ada deskripsi</span>';
$online = $public_profile->online == 'ON' ? '<span class="text-success"><sup> &bull; </sup></span>' : '<span class="text-secondary"><sup> &bull; </sup></span>';
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($public_profile->id_user_portal)->photo_pic) . '';

$link_profile_public =
  base_url("user/" . decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan) . "/" . encrypt_url($by));
?>
<section class="my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-md-5 my-2">
        <div class="container">
          <div class="row mb-4">
            <?php if (encrypt_url($public_profile->id_user_portal) == $this->uri->segment(3)) : ?>
              <div class="col-md-2 text-center pl-md-0">
                <img style="object-fit:cover;" width="90" height="90" src="<?= $photo ?>" class="rounded-circle border shadow-sm p-2">
              </div>
              <div class="col-md-10 px-md-0 mt-2">

                <h4 class="font-weight-bold"><?= $namalengkap ?> <?= $online ?></h4>
                
                <a data-toggle="tooltip" data-placement="top" title="Profile @<?= $namalengkap ?>" href="<?= $link_profile_public ?>" class="btn btn-info btn-sm rounded float-right"> Back to profile</a>
                
                <h5 class="mb-0 text-primary font-weight-bold">Halaman /  <small class="text-muted">Beberapa halaman yang telah dibuat "<?= $namalengkap ?>".</small>
                </h5>
                
              </div>
            <?php else : ?>
              <div class="col-md-1 text-left pl-md-0 pr-3">
                <img src="<?= base_url('assets/images/nophoto.jpg') ?>" class="img-fluid rounded-circle">
              </div>
              <div class="col-md-11 px-md-0 mt-2">
                <h4 class="font-weight-bold">Tidak Didefinisikan</h4>
                <h5 class="mb-3 text-muted">Halaman</h5>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="row grid">
          <?php if ($halaman->num_rows() > 0) : ?>
            <?php foreach ($halaman->result() as $h) : ?>
              <?php
              if ($h->publish == 'Y') :
                $target = base_url('page/'. $h->slug);
              else :
                $target = '#';
              endif;
              ?>
              <div class="col-md-3 mb-4">
                <a href="<?= $target ?>">
                  <div class="item">
                    <div class="card <?= $h->publish == 'N' ? "bg-light text-white" : ""; ?> border-light">
                      <div class="card-body">
                        <h5 class="card-title text-dark"><?= $h->title; ?></h5>
                        <?php
                        if ($h->file !== NULL) :
                          echo "<span class='badge badge-primary'>{$h->filename}</span>";
                        endif;
                        ?>
                        <p class="card-text text-secondary font-weight-light">
                          <small>
                            <span class="float-right">
                              <i class="fas fa-eye mr-2"></i> <?= $h->views; ?>
                            </span>
                            <i class="fas fa-calendar mr-2"></i>
                            <?= mediumdate_indo($h->tgl_created); ?>
                          </small>
                        </p>

                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <div class="col-md-12">
              <div class="card border-light bg-transparent">
                <div class="card-body text-center">
                  <img src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/empty-halaman.svg') ?>" class="img-fluid mx-auto d-block my-2">
                  <h5 class="card-title">Belum ada halaman</h5>
                  <p class="card-text">Sepertinya "<?= decrypt_url($public_profile->nama_lengkap) ?>" belum membuat satupun halaman </p>
                </div>
              </div>
            </div>
          <?php endif;  ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .card:hover {
    border: 1px solid lightgreen !important;
    transition: all .3s ease;
  }
</style>
