<?php
$namalengkap = decrypt_url($public_profile->nama_lengkap);
$namapanggilan = decrypt_url($public_profile->nama_panggilan);
$tanggal_bergabung = longdate_indo($public_profile->tanggal_bergabung);
$desc = $public_profile->deskripsi != '' ? $public_profile->deskripsi : '<span class="text-muted">Belum ada deskripsi</span>';
$online = $public_profile->online == 'ON' ? '<span class="text-success animated fadeIn infinite"><sup> &bull; </sup></span>' : '<span class="text-secondary"><sup> &bull; </sup></span>';
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($public_profile->id_user_portal)->photo_pic) . '';
$profileLink = base_url("user/" . decrypt_url($this->mf_users->get_userportal_namapanggilan($public_profile->id_user_portal)->nama_panggilan) . "/" . encrypt_url($public_profile->id_user_portal));
$sukaLink = base_url("disukai/" . decrypt_url($this->mf_users->get_userportal_namapanggilan($public_profile->id_user_portal)->nama_panggilan) . "/" . encrypt_url($public_profile->id_user_portal));
$halamanLink = base_url("halaman/" . decrypt_url($this->mf_users->get_userportal_namapanggilan($public_profile->id_user_portal)->nama_panggilan) . "/" . encrypt_url($public_profile->id_user_portal));
?>
<section class="my-md-4">
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
      <div class="col-md-12 mt-md-5">
        <div>
          <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9">
              <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 py-3">
                  <img class="img-fluid rounded" src="<?= $photo ?>">
                </div>
                <div class="col-md-10 py-3">
                  <h3 class="font-weight-bold"><?= $namalengkap ?> <?= $online ?></h3>
                  <span class="text-secondary"><?= $namapanggilan; ?> <span class="mx-1"> &bull;</span> <small>Bergabung pada: <?= $tanggal_bergabung; ?></small></span>
                  <hr>
                  <?= $desc; ?>
                </div>
              </div>
              <div class="w-100 my-4"></div>
              <div class="row">
                <div class="col-md-4 order-3 order-md-first">
                  <div id="sidebar">
                    <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
                  </div>
                </div>
                <div class="col-md-8 order-last order-md-2">
                  <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><span class="font-weight-bold"><i class="fa fa-quote-left text-secondary mr-2"></i>Postingan Terbaru</span></span>
                        </div>
                  <div id="load_data_profile"></div>
                  <div id="load_data_message_profile"></div>
                </div>
              </div>
            </div>
            <div class="col-md-3 order-first order-md-last">
              <div id="sidebar">
                <div class="my-auto mx-auto">
                  
                    <!-- <h5 class="my-3 font-weight-bold title-sidebar">Menu</h5> -->
                    <div class="list-group">
                      <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><span class="font-weight-bold"><i class="fa fa-user text-secondary mr-2"></i>Menus</span></span>
                        </div>
                      <a href="<?= $profileLink ?>" class="list-group-item list-group-item-action px-2 rounded border-0 border-light bg-secondary text-white rippler rippler-default"><i class="fas fa-user float-right" aria-hidden="true"></i> Profile</a>
                      <a href="<?= $sukaLink ?>" class="list-group-item list-group-item-action px-2 rounded bg-transparent border-0 border-light bg-white rippler rippler-default my-2"><i class="fas fa-thumbs-up float-right" aria-hidden="true"></i> Disukai</a>
                      <a href="<?= $halamanLink ?>" class="list-group-item list-group-item-action px-2 rounded bg-transparent border-0 border-light bg-white rippler rippler-default"><i class="fas fa-newspaper float-right" aria-hidden="true"></i> Halaman</a>
                    </div>
                    <div class="w-100"></div>
                    <div class="list-group d-none d-md-block d-lg-block">
                      <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><span class="font-weight-bold"><i class="fa fa-shapes text-secondary mr-2"></i>Kategori Terbaru</span></span>
                        </div>
                                <?php
                                foreach ($mf_kategori as $k) :
                                $post_list_url = base_url('kategori/' . encrypt_url($k->id_kategori) . '/' . url_title($k->nama_kategori) . '?order=desc');
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
                          `<div class="card border-0 bg-transparent">
                            <div class="card-body text-black text-center">
                              <h5 class="card-title">Postingan telah berakhir!</h5>
                              <p class="font-weight-light text-secondary"> Berita yang diposting telah berakhir, mungkin ini kesalahan kami yang kekurangan content.</p>
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
