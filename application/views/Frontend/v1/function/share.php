<?php
$by = $detail->created_by;  
if ($by == 'admin') {
    $namalengkap = $this->mf_users->get_namalengkap($by);
    $namapanggilan = $by;
} else {
    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
    $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
}

$id = encrypt_url($detail->id_berita);
$postby = strtolower($namalengkap);
$judul = strtolower($detail->judul);
$posturl = "post/{$postby}/{$id}/" . url_title($judul) . '';

if($detail->type === 'YOUTUBE'):
    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$detail->content.'&key='.$key;
    $yt     = api_client($url);
    $imgSrc = $yt['items'][0]['snippet']['thumbnails']['medium']['url'];
endif;
if($detail->type === 'LINK'):
    $url = $detail->content;
    $linker = getSiteOG($url);
    $imgSrc = $linker['image'];
    // var_dump($linker);
endif;
$url_sumber = base_url('beranda');
$sumber = parse_url($url_sumber, PHP_URL_HOST);
?>
<div class="conteiner bg-light shadow rounded m-3">
    <div class="row">
        <div class="col-12 col-md-6 order-last order-md-first">
            <div class="p-2">
                <div class="text-muted small ml-md-0 mb-2 text-center text-md-left"><?= $sumber ?></div> 
                <b class="small text-dark text-left d-block"> <?= word_limiter($detail->judul, 8); ?> </b>
            </div>
        </div>
        <div class="col-12 col-md-6">
        <?php
        if($detail->type === 'BERITA'):
            if(!empty($detail->img)):
                $img = '<img class="img-fluid rounded-right" src="'.base_url('files/file_berita/'.$detail->img).'">';
            else:
                $img = '<img class="img-fluid rounded-right" src="data:image/jpeg;base64,'.base64_encode( $detail->img_blob ).'"/>';
            endif;
        else:
            $img = '<img class="img-fluid rounded-left" src="'.$imgSrc.'">';
        endif; 
        echo $img;
        ?>
        </div>
    </div>
</div>
<div id="share" class="mx-auto text-center"></div>
<script>
    var data_count = <?= $detail->share_count; ?>;
    $("#share").jsSocials({
        url: "<?= base_url($posturl) ?>",
        shares: ["email", "twitter", "facebook", "whatsapp", 'telegram'],
        text: "<?= ucwords($detail->judul) ?>",
        showLabel: false,
        showCount: true,
        showCount: "inside",
        shareIn: "popup",
        on: {
            click: function(e) {
                data_count++;
                $.post('<?= base_url('frontend/v1/beranda/share_count_saved/' . $detail->id_berita); ?>', {
                    count: data_count
                }, function(result) {
                    console.log(result);
                }, 'json');
            },
        }
    });
</script>