<a data-aos="zoom-out-down" data-aos-once="true" id="banner" data-lightbox="BannerAside" data-title="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>" href="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>">
                        <img src="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>" class="rounded img-fluid mx-auto d-block mb-3">
                    <h6 class="font-weight-bold"><?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?></h6></a>
                    <span class="text-secondary small">Posted by</span> <?= ucwords($this->mf_beranda->get_banner('BANNER', 'Aside')[3]); ?>