<?php  
$late = $mf_berita_terakhir;
/* LINK API */
if($late->type === 'LINK'):
    $url = $late->content;
    $linker = getSiteOG($url);
    $linkImg = $linker['image'];
endif;

/* Youtube API */
if($late->type === 'YOUTUBE'):
    $key      = $this->config->item('YOUTUBE_KEY'); /*TOKEN goole developer*/
    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,status,player&id='.$late->content.'&key='.$key;
    $yt     = api_client($url);
    $yt_id     = $yt['items'][0]['id'];
    $yt_channel = $yt['items'][0]['snippet']['channelId'];
    $yt_desc = $yt['items'][0]['snippet']['description'];
    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
    $yt_player = $yt['items'][0]['player']['embedHtml'];
    $yt_sumber = $yt['items'][0]['status']['license'];
endif;

if(!empty($late->img)):
    $img = '<img style="object-fit: cover; min-height: 390px; max-height: 390px;" class="card-img rounded border lazy" data-src="'.files('file_berita/'.$late->img).'" alt="'.$late->judul.'">';
elseif($late->type === 'YOUTUBE'):
    $img = '<img style="object-fit: cover; min-height: 390px; max-height: 390px;" class="card-img rounded border lazy" data-src="'.$yt_src.'" alt="'.$late->judul.'">';
elseif($late->type === 'LINK'):
    $img = '<img style="object-fit: cover; min-height: 390px; max-height: 390px;" class="card-img rounded border lazy" data-src="'.$linkImg.'" alt="'.$late->judul.'">';
else:
    $img = '<img style="object-fit: cover; min-height: 390px;" class="card-img rounded border lazy" data-src="'.img_blob($late->img_blob).'"  alt="'.$late->judul.'"/>';
endif;

if($late->tgl_posting == date('Y-m-d')):
    $label = '<span class="badge badge-danger">New</span>';
else:
    $label = '<span class="badge badge-success">Latepost</span>';
endif;

// Profile akun yang posting
$by = $late->created_by;
if($by == 'admin') {
    $link_profile_public = 'javascript:void(0);';
    $namalengkap = $this->mf_users->get_namalengkap($by);
    $namapanggilan = $by;
    $gravatar = base_url('assets/images/users/'.$this->mf_users->get_gravatar($by));
} else {
    $link_profile_public = 
    base_url("user/".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
    $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
    $gravatar = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic).'';
}

// Post Link Detail
if($late->type === 'YOUTUBE' || $late->type === 'BERITA' || $late->type === 'SLIDE'):
    $slug = strtolower($late->slug);
    // $kategori = url_title(strtolower($this->post->kategori_byid($late->fid_kategori)));
    $posturl = prep_url(base_url("blog/".$slug), TRUE);
elseif($late->type === 'LINK'):
    $posturl = base_url('leave?go='.encrypt_url($late->content));
endif;
// Like button
$btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $late->id_berita) == true ? 'btn-like' : '';
$status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $late->id_berita) == true ? 'fas text-danger' : 'far';
$content_like = '<button aria-hidden="true" type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="p-0 m-0 btn btn-sm btn-default bg-transparent border-0 rounded-0 text-light'.$btn_like.'" title="Suka" data-id-berita="' . $late->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'.$status_like.' fa-heart text-danger mr-1"></i> <span class="count_like">'.$late->like_count.'</span> </button>';
// Comments button
$countKomentar = $this->komentar->jml_komentarbyidberita($late->id_berita);
$komentar = $countKomentar != 0 ? $countKomentar : $countKomentar;
$content_comments = '<i class="far fa-comment-alt mr-1 ml-3"></i>'.$komentar;
$content_shares = '<button aria-hidden="true" type="button" data-toggle="tooltip" title="Bagikan postingan ini" data-placement="bottom" id="btn-share" data-row-id="'.$late->id_berita. '" class="btn btn-sm btn-default bg-transparent border-0 rounded-0 p-0 m-0 text-light"><i class="fas fa-ellipsis-v"></i></button>';
?>
<div class="row mt-3">
    <div class="col-md-8">
        <div class="card bg-light text-white">
            <div class="card-img-overlay">
                <div class="d-flex justify-content-start align-items-center">
                    <span class="mr-2">
                        <img style="object-fit:cover; object-position:top;" src="<?= $gravatar ?>" alt="Photo Userportal" width="23" height="23" class="rounded-circle border-primary bg-white">
                    </span>
                    <span class="small text-secondary mt-1">
                        <?= ucwords($namapanggilan) ?>
                    </span>
                </div>
            </div>
            <?= $img ?>
            <div class="card-img-overlay d-flex flex-column justify-content-end">
                <div class="main-body">
                    <?= $label ?>
                    <h5 class="card-title">
                    <a href="<?= $posturl ?>" class="text-white" style="text-shadow: 0.3px 1px white;"><?= $late->judul ?></a>
                    </h5>
                </div>
                <div class="d-flex justify-content-between align-items-center small text-light card-text">
                    <span>
                        <?= $content_like ?> <?= $content_comments ?> <span class="text-danger mx-2">&bull;</span> <?= time_ago($late->created_at) ?>
                    </span>
                    <span>
                        <?= $content_shares ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <?php $this->load->view('Frontend/v1/function/slider4_2'); ?>
        </div>
    </div>
    <div class="col-md-4 mt-3 mt-md-0">
        <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
    </div>
</div>