<div class="row mt-4">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 d-none d-sm-block animated fadeIn">
        <!-- For desktop -->

        <div class="banner-caption mt-5 rellax" data-rellax-speed="2">
            <?php
            if ($mf_banner->num_rows() > 0) {
                foreach ($mf_banner->result() as $b) :
            ?>
                    <div class="rounded text-white p-0">
                        <h3 class="font-weight-bold"><?= ucwords($b->judul); ?></h3>
                        <p class="text-muted text-justify"><?= character_limiter($b->keterangan, 220); ?></p>
                        <a href="<?= base_url('frontend/v1/banner/detail/' . encrypt_url($b->id_banner) . '/' . url_title($b->judul)); ?>" class="btn btn-primary">Selengkapnya <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
            <?php endforeach;
            } ?>
        </div>

    </div>

    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 d-none d-sm-block animated fadeIn">
        <div class="slick-banner my-5 rellax" data-rellax-speed="2">
            <?php
            if ($mf_banner->num_rows() > 0) {
                foreach ($mf_banner->result() as $b) :
            ?>
                    <div class="slick-item">
                        <a href="<?= base_url('frontend/v1/banner/detail/' . encrypt_url($b->id_banner) . '/' . url_title($b->judul)); ?>" title="<?= $b->judul; ?>">
                            <span class="rippler rippler-img rippler-bs-success">

                                <img data-lazy="<?= $b->path; ?>" class="img-fluid rounded">
                                <div class="overlay"></div>
                            </span>
                        </a>
                    </div>
            <?php endforeach;
            } ?>
        </div>
    </div>
</div>
<!-- For Mobile -->
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 d-none d-sm-none">
    <div class="banner-caption">
        <?php
        if ($mf_banner->num_rows() > 0) {
            foreach ($mf_banner->result() as $b) :
        ?>
                <aside class="mb-5 text-light">
                    <h4><?= ucwords($b->judul); ?></h4>
                    <p><?= character_limiter($b->keterangan, 100); ?>...</p>
                    <a href="<?= $b->url; ?>" class="btn btn-primary">Selengkapnya &#8212;</a>
                </aside>
        <?php endforeach;
        } ?>
    </div>
</div>
<script>
    // Slick sliderjs
    $(".banner-caption").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        infinite: true,
        dots: false,
        fade: false,
        speed: 300,
        asNavFor: ".slick-banner",
        adaptiveHeight: false,
        draggable: false,
    });

    $(".slick-banner").slick({
        centerMode: true,
        infinite: true,
        dots: true,
        arrows: false,
        lazyLoad: "ondemand",
        autoplay: true,
        speed: 300,
        autoplaySpeed: 6000,
        asNavFor: ".banner-caption",
        cssEase: "ease",
        pauseOnHover: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: "40px",
                    slidesToShow: 1,
                },
            },
        ],
    });
</script>