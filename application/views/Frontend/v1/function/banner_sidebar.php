<!-- Banner vertikal -->
<!-- <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_vertical_home') ?>">
    <span class="content-placeholder" style="width: 100%; height: 430px;"></span>
    <span class="content-placeholder my-2" style="width: 80%; height: 20px;"></span>
    <span class="content-placeholder" style="width: 40%; height: 20px;"></span>
 </div>  -->

 <a id="xbanner" data-lightbox="BannerAside" data-title="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>" href="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>"> 
<!-- <a target="_blank" href="https://overlapflintsidenote.com/fb7we0cvq?key=ec30481941997aa65fc88a7f28d03fa5"> -->
<img src="<?= files('file_banner/'.$this->mf_beranda->get_banner('BANNER', 'Aside')[4]); ?>" class="rounded img-fluid w-100 my-3 rounded border" style="max-height:460px; object-fit:cover;" alt="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>"> 
<h6 class="font-weight-bold"><?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?></h6></a>
<span class="text-secondary small">Posted by  <?= strtolower($this->mf_beranda->get_banner('BANNER', 'Aside')[3]); ?></span>
