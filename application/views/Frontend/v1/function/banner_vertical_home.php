<a id="xbanner" data-lightbox="BannerAside" data-title="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>" href="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>">
<img src="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>" class="rounded img-fluid mx-auto d-block mb-3" alt="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>"> 
<h6 class="font-weight-bold"><?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?></h6></a>
<span class="text-secondary small">Posted by  <?= strtolower($this->mf_beranda->get_banner('BANNER', 'Aside')[3]); ?></span>
<script>
	$(function() {
    if (!$.cookie("notice-accepted")) {
        $("a#xbanner").click();
        $.cookie("notice-accepted", 1, {
            expires: 60 / 1440,
            path: '/'
        });
    }
});
</script>