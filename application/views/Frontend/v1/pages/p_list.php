<section class="post-list mt-5 mb-4">
  <div class="container">
    <div class="row">
      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="row grid" data-target=".item">
              <?php
              $count = $posts_by_kategori->num_rows();
              if ($count > 0) {
              foreach ($posts_by_kategori->result() as $posts) :
              $by = $posts->created_by;
              if ($by == 'admin') {
              $namalengkap = $this->mf_users->get_namalengkap($by);
              $gravatar = base_url('assets/images/users/' . $this->mf_users->get_gravatar($by));
              } else {
              $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
              $gravatar = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic) . '';
              }
              $id = encrypt_url($posts->id_berita);
              $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($posts->created_by))));
              $judul = strtolower($posts->judul);
              $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
              $btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $posts->id_berita) == 'on' ? 'btn-bookmark' : '';
              $status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $posts->id_berita) == 'on' ? 'fas text-primary' : 'far';
              if(!empty($row->img)):
              $img = '<img class="card-img-top img-fluid rounded" src="data:image/jpeg;base64,'.base64_encode( $posts->img_blob ).'"/>';
              else:
              $img = '<img class="card-img-top img-fluid rounded" src="'.$posts->path.'">';
              endif;
              ?>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="item">
                  <div class="card mb-3 border-0 bg-transparent">
                    <a href="<?php echo $posturl; ?>" class="mb-3 shadow-sm bg-dark">
                      <span class="rippler rippler-img rippler-bs-primary">
                        <?= $img ?>
                      </span>
                    </a>
                    <div class="card-body border-bottom">
                      <button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent rounded px-2 py-0 float-right <?= $btn_bookmark ?>" title="Simpan Postingan" data-id-berita="<?= $posts->id_berita ?>" data-id-user="<?= $this->session->userdata('user_portal_log')['id'] ?>"><i class="<?= $status_bookmark ?> fa-bookmark"></i> </button>
                      <p>
                        <span class="font-weight-bold d-inline-block mt-1"><?php echo $namalengkap; ?></span>
                        <img data-src="<?= $gravatar ?>" width="30" height="30" class="float-left mr-2 rounded-circle align-baseline lazy">
                      </p>
                      <h6><a href="<?php echo $posturl; ?>"><?php echo character_limiter($posts->judul, 50); ?></h6></a>
                      <p class="badge badge-pill p-2 bg-white border">
                        #<?php echo url_title($posts->nama_kategori); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              endforeach;
              echo "<div class='col-md-12 d-flex'>{$pagination}</div>";
              // var_dump($pagination);
              } else {
              ?>
              
              <div class="col-12">
                <div class="d-block my-5 text-center font-weight-bold">
                  <img src="<?= base_url('template/v1/img/humaaans-2.png'); ?>" alt="croods" class="img-fluid rounded mx-auto">
                  <h3>Oppss! belum ada postingan disini.</h3>
                  <p class="font-weight-light text-secondary">Sepertinya ini kesalahan dari kami yang masih kekurangan
                  konten buat kalian.</p>
                </div>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="col-12">
            
            
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3 col-lg-3 mt-5">
        
        <div class="post-list-view">
          <div class="card shadow-sm mb-3">
          <div class="card-body p-0 bg-info rounded">
            <div class="btn-group border-right border-primary">
              <button class="btn py-3 px-3 btn-outline-default btn-sm dropdown-toggle text-white" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Order by
              </button>
              <?php $desc = $_GET['order'] == 'desc' ? 'active' : ''; ?>
              <?php $asc = $_GET['order'] == 'asc' ? 'active' : ''; ?>
              <div class="dropdown-menu">
                <h6 class="dropdown-header">Urutkan berdasarkan</h6>
                <a class="dropdown-item <?= $desc; ?>" href="?order=desc">Terbaru</a>
                <a class="dropdown-item <?= $asc; ?>" href="?order=asc">Paling lama</a>
              </div>
            </div>
          </div>
        </div>
          <div class="list-group mb-3 shadow-sm" style="overflow-y: auto; overflow-x: hidden; max-height: 400px;">
            <?php
            foreach ($kategoris->result() as $kategori) :
            $active = $kategori->id_kategori == $uri_id ? 'active' : '';
            $post_list_url = base_url('frontend/v1/post_list/views/' . encrypt_url($kategori->id_kategori) . '/' . url_title($kategori->nama_kategori) . '?order=desc');
            ?>
            <a href="<?php echo $post_list_url; ?>" class="list-group-item d-flex justify-content-between align-items-center bg-white list-group-item-action <?= $active; ?>">
              #<?php echo trim($kategori->nama_kategori); ?>
              <span class="badge badge-primary px-3 badge-pill"><?= $this->mf_beranda->count_kategori_berita($kategori->id_kategori); ?></span>
            </a>
            <?php endforeach; ?>
          </div>
          <div class="card shadow-none border-0 bg-transparent">
            <div class="card-body p-0 overflow-auto">
              <div class="d-flex flex-nowrap justify-content-start align-items-center">
                <?php
                foreach ($tags->result() as $tag) :
                $active = $tag->nama_tag;
                ?>
                <a href="<?= base_url('frontend/v1/post_list/tags?q=' . $active); ?>" class="btn rounded-pill my-1 text-nowrap mx-2 px-3 btn-sm btn-outline-secondary ml-auto"><?= $tag->nama_tag; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>