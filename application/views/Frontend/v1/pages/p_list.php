<section class="pt-md-5 pt-2 bg-white border-bottom border-light">
  <div class="container pt-md-5 pb-3">
    <div class="d-flex justify-content-between align-items-center flex-lg-row flex-column">
      <div>
        <h3 class="font-weight-bold mr-md-3 pr-md-3">Post Kategori</h3>
      </div>
      <div class="d-flex justify-content-start">
        <div class="btn-group">
          <button class="btn py-3 px-3 btn-outline-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Urutkan berdasarkan?
          </button>
          <?php $desc = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'active' : ''; ?>
          <?php $asc = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'active' : ''; ?>
          <div class="dropdown-menu">
            <h6 class="dropdown-header">Urutkan berdasarkan</h6>
            <a class="dropdown-item <?= $desc; ?>" href="?order=desc">Terbaru</a>
            <a class="dropdown-item <?= $asc; ?>" href="?order=asc">Paling lama</a>
          </div>
        </div>
        <div class="ml-3">
          <div class="btn-group">
            <button class="btn py-3 px-3 btn-outline-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pilih Kategori
            </button>
            <div class="dropdown-menu dropdown-menu-right" style="overflow-y: auto; overflow-x: hidden; max-height: 300px;" aria-labelledby="dropdownMenuButton">
              <?php
              foreach ($kategoris->result() as $kategori) :
              $active = $kategori->id_kategori == $uri_id ? 'active' : '';
              $post_list_url = base_url('k/'.url_title($kategori->nama_kategori). '?order=desc');
              ?>
              <a class="dropdown-item rounded-pill my-1 py-2 <?= $active; ?>" href="<?php echo $post_list_url; ?>"><span class="badge badge-primary px-3 mr-2 badge-pill"><?= $this->mf_beranda->count_kategori_berita($kategori->id_kategori); ?></span> <?php echo trim($kategori->nama_kategori); ?> </a>
              <?php endforeach; ?>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>
<section class="post-list mb-5">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="row grid" data-target=".item">
              <?php
              $count = $posts_by_kategori->num_rows();
              if ($count > 0) {
              foreach ($posts_by_kategori->result() as $posts) :

              /*Header userpost*/
              $by = $posts->created_by;
              if ($by == 'admin') {
                $namalengkap = $this->mf_users->get_namalengkap($by);
                $gravatar = base_url('assets/images/users/' . $this->mf_users->get_gravatar($by));
              } else {
                $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                $gravatar = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic) . '';
              }

              /*Data Post Youtube*/
              if($posts->type === 'YOUTUBE'):
                  $key      = $this->config->item('YOUTUBE_KEY'); /*TOKEN goole developer*/
                  $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$posts->content.'&key='.$key;
                  $yt     = api_client($url);
                  $img = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                  $yt_desc = $yt['items'][0]['snippet']['description'];
              endif;

              /*Data Post Link*/
              if($posts->type === 'LINK'):
                  $url = $posts->content;
                  $linker = getSiteOG($url);
                  $img = $linker['image'];
              endif;

              /*Post Link Detail*/
              if($posts->type === 'YOUTUBE' || $posts->type === 'BERITA' || $posts->type === 'SLIDE'):
                  $id = encrypt_url($posts->id_berita);
                  $postby = strtolower(url_title($this->mf_users->get_namalengkap(trim($posts->created_by))));
                  $slug = strtolower($posts->slug);
                  $kategori = url_title(strtolower($this->post->kategori_byid($posts->fid_kategori)));
                  $posturl = base_url("p/".$kategori."/".$slug);
              else:
                  $posturl = base_url('leave?go='.encrypt_url($posts->content));
              endif;

              /*Button Bookmark*/
              $btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $posts->id_berita) == 'on' ? 'btn-bookmark' : '';
              $status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $posts->id_berita) == 'on' ? 'fas text-primary' : 'far';

              /*Gambar*/
              if($posts->type === 'BERITA'):
                if(!empty($posts->img)):
                  $img = '<img class="card-img-top rounded-top-lg" src="'.base_url('files/file_berita/'.$posts->img).'">';
                else:
                  $img = '<img class="card-img-top rounded-top-lg" src="data:image/jpeg;base64,'.base64_encode( $posts->img_blob ).'"/>';
                endif;
              elseif($posts->type === 'YOUTUBE' || $posts->type === 'LINK'):
                  $img = '<img class="card-img-top rounded-top-lg" src="'.$img.'" alt="'.$posts->judul.'">';
              else:
                  $img = '<img class="card-img-top rounded-top-lg" src="'.base_url('assets/images/noimage.gif').'" alt="'.$posts->judul.'">';
              endif;

              /*Content*/
              if($posts->type === 'YOUTUBE'):
                  $content = word_limiter($yt_desc,12);
              elseif($posts->type === 'LINK'):
                  $content = word_limiter($linker['description'],12);
              else:
                  $isi_berita = strip_tags($posts->content);
                  $isi = substr($isi_berita, 0, 80); 
                  $isi = substr($isi_berita, 0, strrpos($isi, ' '));
                  $content = $isi."... [".strlen($isi_berita)."+]"; /*potong per spasi kalimat*/
              endif;

              ?>
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="item">
                  <div class="card mb-3 bg-transparent border">
                    <a href="<?php echo $posturl; ?>">
                      <span class="rippler rippler-img rippler-bs-primary">
                        <?= $img ?>
                      </span>
                    </a>
                    <div class="card-body px-2">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="ml-2">
                          <img data-toggle="tooltip" title="<?= $namalengkap; ?>" data-src="<?= $gravatar ?>" width="40" height="40" class="rounded-circle align-baseline lazy">
                        </div>
                      </div>
                      <div class="py-2 pl-3 pr-2 border-left border-light ml-4">
                        <b><a href="<?php echo $posturl; ?>"><?php echo word_limiter($posts->judul, 5); ?></a></b>
                        <p class="text-muted small">
                          <?= $content ?>
                        </p>
                        <div class="d-flex justify-content-start">
                          <div class="mr-2">
                            <button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-light rounded px-2 <?= $btn_bookmark ?>" title="Simpan Postingan" data-id-berita="<?= $posts->id_berita ?>" data-id-user="<?= $this->session->userdata('user_portal_log')['id'] ?>"><i class="<?= $status_bookmark ?> fa-bookmark"></i> </button>
                          </div>
                          <div>
                            <a href="<?= $posturl ?>" class="btn btn-sm btn-outline-light bg-white py-2">Readmore</a>
                          </div>
                        </div>
                        

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              endforeach;
              echo "<div class='col-md-12 d-flex'>{$pagination}</div>";
              /*var_dump($pagination);*/
              } else {
              ?>
              
              <div class="col-12">
                <div class="d-block my-5 text-center font-weight-bold">
                  <img src="<?= base_url('template/v1/img/humaaans-2.png'); ?>" alt="croods" class="img-fluid rounded mx-auto">
                  <h3>Oppss! belum ada postingan disini.</h3>
                  <p class="font-weight-light text-secondary">Sepertinya ini kesalahan dari kami yang masih kekurangan konten.</p>
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
    </div>
  </div>
</section>