<div class="separator d-flex justify-content-between align-items-center">
    <div>
        <span class="separator-text text-uppercase font-weight-bold">
            <i class="fas fa-heart mr-2"></i> Populer Post
        </span>
    </div>
    <div class="mt--4">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-outline-none bg-white btn-up btn-sm"><i class="fas fa-angle-up"></i></button>
          <button type="button" class="btn btn-outline-none bg-white btn-toggle btn-sm">&nbsp;</button>
          <button type="button" class="btn btn-outline-none bg-white btn-down btn-sm"><i class="fas fa-angle-down"></i></button>
        </div>
    </div>
</div>
<div class="list-group border-0 shadow-sm p-0 mb-3 mt--5 rounded controler-ticker">
    <div>
    <?php
    $nolist = 1;
    foreach ($mf_berita_populer as $b) :
    // Data Post Youtube
    
    if($b->type === 'YOUTUBE' && cek_internet() === true):
        $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
        $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$b->content.'&key='.$key;
        $yt     = api_client($url);
        $img = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
    endif;

    // Data Post Link
    if($b->type === 'LINK' && cek_internet() === true):
        $url = $b->content;
        $linker = getSiteOG($url);
        $img = $linker['image'];
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
            $img = '<img style="max-height:80px; object-fit: cover;" class="rounded border align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="'.files('file_berita/'.$b->img).'" alt="'.$b->tgl_posting.'">';
        elseif(!empty($b->img_blob)):
            $img = '<img style="max-height:80px; object-fit: cover;" class="rounded border align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'" alt="'.$b->tgl_posting.'"/>';
        else:
            $img = '<img style="max-height:80px; object-fit: cover;" class="rounded border align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="'.base_url('assets/images/noimage.gif').'" alt="'.$b->tgl_posting.'">';
        endif;
    elseif($b->type === 'YOUTUBE' || $b->type === 'LINK'):
        $img = '<img style="max-height:80px; object-fit: cover;" class="rounded border align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="'.$img.'" alt="'.$b->tgl_posting.'">';
    else:
        $img = '<img style="max-height:80px; object-fit: cover;" class="rounded border align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="'.base_url('assets/images/noimage.gif').'" alt="'.$b->tgl_posting.'">';
    endif;
    ?>
        <?php if(cek_internet() == true): ?>
        <a  href="<?= $posturl; ?>" class="list-group-item list-group-item-action px-3 border-0">
        <div class="media">
            <?= $img ?>
            <div class="media-body">
                <h6 class="font-weight-lighter text-primary"><?= character_limiter($b->judul, 35); ?></h6>
                <div class="mt-2 align-middle text-left small text-secondary d-flex justify-content-between">
                    <span>
                        <i class="far fa-thumbs-up mr-2"></i> <?= $b->like_count ?>
                    </span>
                    <span>
                        <i class="fas fa-share mr-2"></i> <?= $b->share_count ?>
                    </span>
                    <span>
                        <i class="fas fa-eye mr-2"></i> <?= nominal($b->views) ?>
                    </span>
                </div>
            </div>
        </div>
    </a>
    <?php else: ?>  
        <?php $this->load->view('msg/lose-connection'); ?>
    <?php endif; ?>

    <?php $nolist++; endforeach; ?>
    </div>
</div>
