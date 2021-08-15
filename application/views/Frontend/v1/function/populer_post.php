<div class="rounded bg-white border">
<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
    <div>
        <h5 class="text-reset mb-0 pb-0">Trending</h5>
    </div>
    <div class="small">
        Lihat Lainnya <i class="fas fa-chevron-right"></i>
    </div>
</div>
<div class="px-3" style="overflow-y:auto; overflow-x:hidden; max-height:650px;">
    <?php
    $nolist = 1;
    foreach ($mf_berita_populer as $b) :
    // Data Post Youtube
    
    if($b->type === 'YOUTUBE'):
        $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
        $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$b->content.'&key='.$key;
        $yt     = api_client($url);
        $imgSrc = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
    endif;

    // Data Post Link
    if($b->type === 'LINK'):
        $url = $b->content;
        $linker = getSiteOG($url);
        $imgSrc = $linker['image'];
    endif;

    // Post Link Detail
    if($b->type === 'YOUTUBE' || $b->type === 'BERITA'):
        $id = encrypt_url($b->id_berita);
        $postby = strtolower(url_title($this->mf_users->get_namalengkap($b->created_by)));
        $judul = strtolower($b->judul);
        $slug = strtolower($b->slug);
        // $kategori = url_title(strtolower($this->post->kategori_byid($b->fid_kategori)));
        $posturl = base_url("blog/".$slug);
    else:
        $posturl = base_url('leave?go='.encrypt_url($b->content));
    endif;

    // Gambar
    if($b->type === 'BERITA'):
        if(!empty($b->img)):
            $img = '<img style="width:85px; height:95px; object-fit: cover;" class="rounded align-self-start lazy" data-src="'.files('file_berita/'.$b->img).'" alt="'.$b->tgl_posting.'">';
        elseif(!empty($b->img_blob)):
            $img = '<img style="width:85px; height:95px; object-fit: cover;" class="rounded align-self-start lazy" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'" alt="'.$b->tgl_posting.'"/>';
        else:
            $img = '<img style="width:85px; height:95px; object-fit: cover;" class="rounded align-self-start lazy" data-src="'.base_url('assets/images/noimage.gif').'" alt="'.$b->tgl_posting.'">';
        endif;
    elseif($b->type === 'YOUTUBE' || $b->type === 'LINK'):
        $img = '<img style="width:85px; height:95px; object-fit: cover;" class="rounded align-self-start lazy" data-src="'.$imgSrc.'" alt="'.$b->tgl_posting.'">';
    else:
        $img = '<img style="width:85px; height:95px; object-fit: cover;" class="rounded align-self-start lazy" data-src="'.base_url('assets/images/noimage.gif').'" alt="'.$b->tgl_posting.'">';
    endif;

    // Like button
    $btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $b->id_berita) == true ? 'btn-like' : '';
    $status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $b->id_berita) == true ? 'fas text-danger' : 'far';

    $content_tglposting = mediumdate_indo($b->tgl_posting);
    $content_jam = time_ago($b->created_at);
    $content_like = '<button aria-hidden="true" type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-default bg-transparent border-0 rounded-0 p-0 m-0 text-muted'.$btn_like.'" title="Suka" data-id-berita="' . $b->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'.$status_like.' fa-heart text-danger mr-1"></i> <span class="count_like">'.$b->like_count.'</span> </button>';
    
    $countKomentar = $this->komentar->jml_komentarbyidberita($b->id_berita);
    $komentar = $countKomentar != 0 ? $countKomentar : $countKomentar;
    $content_comments = '<i class="far fa-comment-alt mr-1 ml-3"></i>'.$komentar;

    $content_shares = '<button aria-hidden="true" type="button" data-toggle="tooltip" title="Bagikan postingan ini" data-placement="bottom" id="btn-share" data-row-id="'.$b->id_berita. '" class="btn btn-sm btn-default bg-transparent border-0 rounded-0 p-0 m-0 text-muted"><i class="fas fa-ellipsis-v"></i></button>';
    ?>
    <div class='row border-bottom border-light py-2 pr-3'>
        <div class='col-10 col-md-8'>
            <div>
              <h6><a href='<?= $posturl ?>'><?= $b->judul ?></a></h6>
              <div class='d-flex justify-content-between align-items-center small text-muted mt-1'>
                <span>
                <?= $content_like ?> <?= $content_comments ?>
                </span>
                <span>
                    <?= $content_shares ?>
                </span>
              </div>
            </div>
        </div>
        <div class='col-2 col-md-4'>
            <a href='<?= $posturl ?>'><?= $img ?></a>
        </div>
    </div>
    <?php $nolist++; endforeach; ?>
</div>
</div>