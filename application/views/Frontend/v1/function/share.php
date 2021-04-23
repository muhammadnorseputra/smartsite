<div class="d-block mx-auto text-center">
    <?php echo '<img class="mx-auto d-block" src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="210"/>'; ?><br>
    <b> <?= $detail->judul; ?> </b>
    <div id="share"></div>
</div>
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
?>
<script>
    var data_count = <?= $detail->share_count; ?>;
    $("#share").jsSocials({
        url: "<?= base_url($posturl) ?>",
        shares: ["email", "twitter", "facebook", "whatsapp"],
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