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
    $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['medium']['url'];
endif;

?>
<div class="conteiner bg-light rounded m-3">
    <div class="row">
        <div class="col-12 col-md-6">
        <?php
        if(!empty($detail->img)):
        $img = '<img class="img-fluid card-img-top" src="'.base_url('files/file_berita/'.$detail->img).'">';
        elseif($detail->type === 'YOUTUBE'):
        $img = '<img class="img-fluid card-img-top" src="'.$yt_thumb.'">';
        else:
        $img = '<img class="img-fluid card-img-top" src="data:image/jpeg;base64,'.base64_encode( $detail->img_blob ).'"/>';
        endif; 
        echo $img;
        ?>
        </div>
        <div class="col-12 col-md-6">
            <div class="text-muted small my-3 ml-3 ml-md-0"><?= base_url() ?></div> 
            <b class="small text-reset text-center text-md-left d-block"> <?= word_limiter($detail->judul, 10); ?> </b>
        </div>
    </div>
</div>
<div id="share" class="mx-auto text-center"></div>
<script>
    var data_count = <?= $detail->share_count; ?>;
    $("#share").jsSocials({
        url: "<?= base_url($posturl) ?>",
        shares: ["email", "twitter", "facebook", "whatsapp", 'telegram'],
        text: "<?= $detail->judul; ?>",
        showLabel: true,
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