<?php
$namalengkap = decrypt_url($public_profile->nama_lengkap);
$namapanggilan = decrypt_url($public_profile->nama_panggilan);
$tanggal_bergabung = longdate_indo($public_profile->tanggal_bergabung);
$desc = $public_profile->deskripsi != '' ? $public_profile->deskripsi : '<span class="text-muted">Belum ada deskripsi</span>';
$online = $public_profile->online == 'ON' ? '<span class="text-success"><sup> &bull; </sup></span>' : '<span class="text-secondary"><sup> &bull; </sup></span>';
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($public_profile->id_user_portal)->photo_pic) . '';
$profileLink = base_url("frontend/v1/users/profile/@" . decrypt_url($this->mf_users->get_userportal_namapanggilan($public_profile->id_user_portal)->nama_panggilan) . "/" . encrypt_url($public_profile->id_user_portal));
$sukaLink = base_url("frontend/v1/users/disukai/@" . decrypt_url($this->mf_users->get_userportal_namapanggilan($public_profile->id_user_portal)->nama_panggilan) . "/" . encrypt_url($public_profile->id_user_portal));
$halamanLink = base_url("frontend/v1/users/halaman/@" . decrypt_url($this->mf_users->get_userportal_namapanggilan($public_profile->id_user_portal)->nama_panggilan) . "/" . encrypt_url($public_profile->id_user_portal));
?>
<section class="my-5">
  <div class="container">
    <div class="row">
      <!-- <div class="col-md-3 mt-5">
        <div class="public_profile_menus">
          <div class="list-group bg-white border">
            <a href="<?= $profileLink ?>" class="border-0 rounded-0 my-3 list-group-item list-group-item-action <?= $this->uri->segment('4') == 'profile' ? 'bg-light' : '' ?>"><i class="fas fa-user mr-3 float-right" aria-hidden="true"></i> Profile</a>
            <a href="<?= $sukaLink ?>" class="border-0 mb-3 list-group-item list-group-item-action"><i class="fas fa-thumbs-up mr-3 float-right" aria-hidden="true"></i> Disukai</a>
            <a href="#" class="border-0 mb-3 list-group-item list-group-item-action"><i class="fas fa-newspaper mr-3 float-right" aria-hidden="true"></i> Halaman</a>
          </div>
        </div>
      </div> -->
      <div class="col-md-12 mt-5">
        <div>
          <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9">
              <!-- <img src="<?= $this->mf_beranda->get_banner('SLIDE', 'Web')[0]; ?>" class="rounded-lg img-fluid mx-auto d-block mb-4"> -->
              <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 py-3">
                  <img class="img-fluid rounded-circle" src="<?= $photo ?>">
                </div>
                <div class="col-md-10 py-3">
                  <h3 class="font-weight-bold"><?= $namalengkap ?> <?= $online ?></h3>
                  <span class="text-secondary">@<?= $namapanggilan; ?> <span class="mx-1"> &bull;</span> <small>Bergabung pada: <?= $tanggal_bergabung; ?></small></span>
                  <hr>
                  <?= $desc; ?>
                </div>
              </div>
              <div class="w-100 my-4"></div>
              <div class="row">
                <div class="col-md-4 order-2 order-md-first">
                  <div id="sidebar" class="sidebar">
                    <h5 class="my-3 font-weight-bold title-sidebar mt-md-3"><span class="font-weight-bold"><i class="fas fa-heart text-danger mr-2"></i>Paling Disukai</span></h5>
                    <div class="list-group border-0 shadow-none p-0">
                        <?php
                        $nolist = 1;
                        foreach ($mf_berita_populer as $b) :
                        $id = encrypt_url($b->id_berita);
                        $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($b->created_by))));
                        $judul = strtolower($b->judul);
                        $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
                        if(empty($b->img)):
                        $img = '<img class="rounded align-self-center lazy pull-left mr-2 w-25 shadow" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
                        else:
                        $img = '<img class="rounded align-self-center lazy pull-left mr-2 w-25 shadow" data-src="'.$b->path.'" alt="'.$b->judul.'">';
                        endif;
                        ?>
                        <a  href="<?= $posturl; ?>" class="bg-transparent list-group-item list-group-item-action border-0 px-3  m-0">
                            <div class="media m-0">
                                <?= $img ?>
                                <div class="media-body">
                                    <small class="font-weight-bold"><?= character_limiter($b->judul, 25); ?></small>
                                    <small class="d-block align-middle text-left">
                                    <i class="far fa-thumbs-up"></i> <?= $b->like_count ?> Likes </small>
                                    </small>
                                </div>
                            </div>
                            
                            <br>
                            
                        </a>
                        <?php $nolist++; endforeach; ?>
                    </div>

                  </div>
                </div>
                <div class="col-md-8 order-3 order-md-2">
                  <h5 class="my-3 font-weight-bold title-sidebar mt-md-3"><span class="font-weight-bold"><i class="fas fa-quote-left text-danger mr-2"></i>Postingan Terbaru</span></h5>
                  <div id="load_data_profile"></div>
                  <div id="load_data_message_profile"></div>
                </div>
              </div>
            </div>
            <div class="col-md-3 order-md-last order-first">
              <div id="sidebar" class="sidebar">
                <div class="my-auto mx-auto">
                  
                    <!-- <h5 class="my-3 font-weight-bold title-sidebar">Menu</h5> -->
                    <div class="list-group">
                      <h6 class="my-3 font-weight-bold  title-sidebar mt-md-3"><span class="font-weight-bold"><i class="fas fa-user text-danger mr-2"></i>Menus</span></h6>
                      <a href="<?= $profileLink ?>" class="list-group-item list-group-item-action px-2 rounded border-0 border-light bg-secondary text-white rippler rippler-default"><i class="fas fa-user float-right" aria-hidden="true"></i> Profile</a>
                      <a href="<?= $sukaLink ?>" class="list-group-item list-group-item-action px-2 rounded bg-transparent border-0 border-light bg-white rippler rippler-default my-2"><i class="fas fa-thumbs-up float-right" aria-hidden="true"></i> Disukai</a>
                      <a href="<?= $halamanLink ?>" class="list-group-item list-group-item-action px-2 rounded bg-transparent border-0 border-light bg-white rippler rippler-default"><i class="fas fa-newspaper float-right" aria-hidden="true"></i> Halaman</a>
                    </div>
                    <div class="w-100"></div>
                    <div class="list-group">
                      <h6 class="my-3 font-weight-bold title-sidebar mt-md-3"><span class="font-weight-bold"><i class="fas fa-list text-danger mr-2"></i>Kategori</span></h6>
                                <?php
                                foreach ($mf_kategori as $k) :
                                $post_list_url = base_url('frontend/v1/post_list/views/' . encrypt_url($k->id_kategori) . '/' . url_title($k->nama_kategori) . '?order=desc');
                                ?>
                                <a href="<?php echo $post_list_url ?>" class="list-group-item list-group-item-action px-2 rounded bg-transparent border-0 border-light bg-white rippler rippler-default my-1">#<?= $k->nama_kategori; ?> <span class="badge badge-dark float-right"><?= $this->mf_beranda->count_kategori_berita($k->id_kategori); ?></span> </a>
                                <?php endforeach; ?>
                            </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>

<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
  <style>
  .grid-item {
  margin-bottom: 25px;
  }
  </style>
  <script>
  $(function() {
  // get all post by user
  var limit = 4;
  var start = 0;
  var action = "inactive";
  function lazzy_loader(limit) {
  var output = "";
  for (var count = 0; count < 1; count++) {
  output += `
      <div id="loader" class="my-5 mx-auto"></div> 
  `;
  }
  $("#load_data_message_profile").html(output);
  }
  lazzy_loader(limit);
  function load_data(limit, start) {
  $.ajax({
  url: "<?= base_url('frontend/v1/post/get_all_post_by_user/' . $public_profile->id_user_portal); ?>",
  method: "POST",
  data: {
  limit: limit,
  start: start,
  },
  cache: false,
  processData: true,
  dataType: "json",
  success: function(data) {
  if (data.html == "") {
  $("#load_data_message_profile").html(
  `<div class="card border-light bg-transparent">
    <div class="card-body text-black text-center">
      <img src="data:image/png;base64,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"/>
      <h5 class="card-title">Postingan Habis!</h5>
      <p class="font-weight-light text-secondary"> Berita yang diposting telah berakhir, mungkin ini kesalahan kami yang kekurangan content _-</p>
    </div>
  </div>`
  );
  action = "active";
  } else {
  $("#load_data_profile").append(data.html);
  $("#load_data_message_profile").html("");
  action = "inactive";
  var $grid = $(".grid").imagesLoaded().progress(function() {
  $grid.masonry({
  itemSelector: '.grid-item',
  transitionDuration: '0.8s',
  });
  });
  // Tooltips
  $('[data-toggle="tooltip"]').tooltip();
  }
  },
  error: function(error) {
  alert(error);
  },
  });
  }
  if (action == "inactive") {
  action = "active";
  setTimeout(() => {
  load_data(limit, start);
  }, 1500);
  }
  $(window).scroll(function() {
  if (
  $(window).scrollTop() + $(window).height() > $("#load_data_profile").height() &&
  action == "inactive"
  ) {
  lazzy_loader(limit);
  action = "active";
  start = start + limit;
  setTimeout(function() {
  load_data(limit, start);
  }, 1000);
  }
  });
  });
  </script>
