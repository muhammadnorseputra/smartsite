<?php if($this->session->userdata('id') == ''): ?>
<!-- <section class="my-5">
    <div class="container">
        <div class="lazy my-md-5" data-loader="ajax" data-src="beranda/slider">
            <img class="d-block mx-auto my-5 py-5" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/tail-spin.svg'); ?>" alt="">
        </div>
    </div>
</section> -->
<section style="background-image: url(<?= base_url('assets/images/bg/bgheader.svg') ?>); background-size: cover; background-repeat: no-repeat; background-position: top right; background-clip: cover;">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mt-5 pt-5 my-md-5 py-md-5">
                <h1 class="display-3"><span id="halojs"></span></h1>
                <p class="lead text-secondary intro-website">Websites resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</p>
                <p>
                    <button type="button" onclick="explore()" class="btn shadow-sm btn-white rounded py-3 px-3">
                    Explore <i class="fas fa-arrow-down ml-2"></i>
                    </button>
                </p>
                
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 offset-md-1 my-3 pb-5 my-md-5 py-md-5">
                <div class="card border-0 shadow-lg bg-white">
                    <div class="card-body">
                        <b>Profile PNS Balangan</b>
                        <form class="form-horizontal" id="caripegawai"  method="POST" action="<?= base_url('frontend/v1/pegawai/detail') ?>">
                            <div class="typeahead__container form-group">
                                <label for="js-nipnama">Cari Pegawai</label>
                                <div class="typeahead__field">
                                    
                                    <div class="typeahead__query">
                                        <input class="js-nipnama" id="js-nipnama" name="filter[query]" placeholder="Ketik NIP" maxlength="18" autocomplete="off">
                                    </div>
                                    <div class="typeahead__button">
                                        <button type="submit">
                                        <i class="typeahead__search-icon"></i> Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-5 mt--7 statistik">
    <div class="container">
        <div class="row">
            <?php
            $local = 'http://192.168.1.4';
            $online = 'http://silka.bkppd-balangankab.info';
            $host = $local;
            ?>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card bg-success border-0 rounded shadow">
                    <div class="card-body">
                        <i class="fas fa-users float-right fa-3x d-inline-block mt-1 text-white"></i>
                        <h3 class="display-4 text-white"><?= api_curl_get($host.'/api/get_grap/asn')  ?></h3>
                        <b class="text-white">Jumlah ASN Kab. Balangan</b>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="card bg-white shadow-lg rounded border-0 my-md-0 my-4 big-card" style="transform: scale(1.2); z-index: 1;">
                    <div class="card-body align-middle">
                        <i class="fas fa-user-tie float-right fa-3x d-inline-block mt-1 text-primary-old"></i>
                        <h3 class="display-4"><?= api_curl_get($host.'/api/get_grap/pns') ?></h3>
                        <b class="text-primary-old">Jumlah PNS + CPNS</b>
                        <span class="small"><small class="py-1 px-3 bg-secondary rounded-pill text-white"><i>resource: SILKa Online</i></small></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="card bg-warning rounded shadow border-0">
                    <div class="card-body">
                        <i class="far fa-user-circle float-right fa-3x d-inline-block mt-1"></i>
                        <h3 class="display-4"><?= api_curl_get($host.'/api/get_grap/nonpns') ?></h3>
                        <b>Jumlah NON PNS</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $my2 = $this->session->userdata('id') != '' ? 'mt-5 pt-md-5' : '' ?>
<section class="content-home <?= $my2 ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 d-none d-sm-block order-last">
                
                <!-- <h5 class="font-weight-bold text-primary title-sidebar">Pilihan Redaksi</h5> -->
                <!-- <?php
                $by = $mf_berita_pilihan->created_by;
                $id = encrypt_url($mf_berita_pilihan->id_berita);
                $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($by))));
                $judul = strtolower($mf_berita_pilihan->judul);
                $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
                if ($by == 'admin') {
                $namapanggilan = $by;
                } else {
                $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                }
                ?>
                <a href="<?= $posturl; ?>">
                    <img data-src="<?= $mf_berita_pilihan->path; ?>" class="rounded img-fluid mx-auto d-block lazy mb-3 border">
                    <h5><?= $mf_berita_pilihan->judul; ?></h5>
                </a>
                <?php
                $tags = $mf_berita_pilihan->tags;
                $pecah = explode(',', $tags);
                if (count($pecah) > 0) {
                $tag = '';
                for ($i = 0; $i < count($pecah); ++$i) {
                $tag .= '<a href="' . base_url('frontend/v1/post_list/tags?q=' . url_title($pecah[$i])) . '" class="btn btn-sm border btn-default mr-2 mb-1">#' . $pecah[$i] . '</a>';
                }
                }
                echo $tag;
                ?>
                <div class="d-block">
                    <span class="text-secondary">Oleh</span> <?= ucwords($namapanggilan); ?>
                </div> -->
                <div class="mx-auto">
                    <h5 class="my-3 font-weight-bold text-dark title-sidebar mt-md-3"><span class="font-weight-bold"><i class="fas fa-heart text-danger mr-2"></i>Paling Disukai</span></h5>
                    <div class="list-group border shadow-sm">
                        <?php
                        $nolist = 1;
                        foreach ($mf_berita_populer as $b) :
                        $id = encrypt_url($b->id_berita);
                        $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($b->created_by))));
                        $judul = strtolower($b->judul);
                        $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
                        if(empty($b->img)):
                        $img = '<img class="rounded lazy pull-left w-50" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
                        else:
                        $img = '<img class="rounded align-self-center lazy pull-left w-50 mr-2 shadow-sm border-light" data-src="'.$b->path.'" alt="'.$b->judul.'">';
                        endif;
                        ?>
                        <a  href="<?= $posturl; ?>" class="list-group-item list-group-item-action border-bottom-0 py-1">
                            <div class="media m-0">
                                <?= $img ?>
                                <div class="media-body">
                                    <small class="font-weight-bold"><?= character_limiter($b->judul, 25); ?></small>
                                    <small class="d-block align-middle text-left">
                                    <i class="far fa-thumbs-up"></i> <?= $b->like_count ?> Likes </small>
                                    </small>
                                </div>
                            </div>
                            
                            <br>
                            
                        </a>
                        <?php $nolist++; endforeach; ?>
                    </div>
                    <p class="small text-secondary my-3">
                        Copyright &copy; <?= date('Y') ?> Bkppd Kab. Balangan
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <h5 class="my-3 text-dark title-sidebar mt-md-3"><span class="font-weight-bold"><i class="fa fa-quote-left fa-pull-left text-info mr-2"></i>Postingan Terbaru</span></h5>
                    </div>
                    <div class="col-6">
                        <div class="float-right mt-2"><button id="caripost" class="btn btn-outline-info"> <i class="fas fa-search mr-2"></i>cari postingan </button></div>
                    </div>
                </div>
                
                
                <div id="load_data"></div>
                <div id="load_data_message"></div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 d-none d-sm-block order-first">
                <div class="mx-auto">
                    <a id="banner" data-lightbox="BannerAside" data-title="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>" href="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>">
                        <img src="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>" class="rounded img-fluid mx-auto d-block mb-3 shadow">
                    <h6 class="font-weight-bold"><?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?></h6></a>
                    <span class="text-secondary small">Posted by</span> <?= ucwords($this->mf_beranda->get_banner('BANNER', 'Aside')[3]); ?> 
                    <!-- <div style="max-height: 600px; overflow-y: auto;">
                        <div class="list-group">
                            <li class="list-group-item disabled px-2 border-0 rounded border-light font-weight-bold text-dark title-sidebar" aria-disabled="true">Kategori Populer</li>
                            <?php
                            foreach ($mf_kategori as $k) :
                            $post_list_url = base_url('frontend/v1/post_list/views/' . encrypt_url($k->id_kategori) . '/' . url_title($k->nama_kategori) . '?order=desc');
                            ?>
                            <a href="<?php echo $post_list_url ?>" class="list-group-item list-group-item-action px-2 rounded border-light border-0 rippler rippler-default"> <i class="fas fa-arrow-right mr-2"></i> <?= $k->nama_kategori; ?> <span class="badge badge-dark float-right"><?= $this->mf_beranda->count_kategori_berita($k->id_kategori); ?></span> </a>
                            <?php endforeach; ?>
                            <li class="list-group-item text-center border-0 list-group-item list-group-item-action px-2 rounded bg-dark rippler rippler-default">
                                <a href="#"><i class="fas fa-plus mr-2"></i> Lebih banyak</a>
                            </li>
                        </div>
                    </div> -->
                    <!-- <div class="card gradient-primary">
                        <div class="card-body text-light py-5">
                            <h2 class="text-center text-light"><i class="fab fa-instagram"></i></h2>
                            <p class="text-center">
                                <img alt="" width="80" height="80" class="rounded-circle profile-pic lazy mx-auto">
                            </p>
                            <p class="text-center instagram-user"></p>
                            <p class="font-weight-light text-center">Anda dapat juga mengikuti kami, melalui instagram</p>
                            <p class="text-center mt-2 text-light">
                                <a href="#" target="_blank" class="btn btn-outline-light px-5 btn-follow"><i class="fab fa-instagram"></i> Follow</a>
                            </p>
                            <p class="text-center">
                                <i class="fas fa-user-circle mr-1"></i> <span class="count_ig mr-4"></span>
                                &#124;
                                <i class="fas fa-users ml-4"></i> <span class="count_ig_follow"></span>
                            </p>
                        </div>
                    </div> -->
                </div>
            </div>
            
        </div>
    </div>
</section>