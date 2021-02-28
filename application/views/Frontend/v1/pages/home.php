<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/hero') ?>
<section class="statistik mt--9">
    <div class="container mb-4">
            <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/count_peg') ?>">
                <img class="d-block mx-auto my-5" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/three-dots.svg'); ?>" alt="">
            </div>
    </div>
</section>
<?php endif; ?>
<?php $my = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-5 pt-md-5' : 'my-4' ?>
<section class="<?= $my ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8 align-self-center">
                <a href="<?= base_url('banner/'.$this->mf_beranda->get_banner('SLIDE', 'Web')[5].'/'.url_title($this->mf_beranda->get_banner('SLIDE', 'Web')[1])); ?>" data-toggle="tooltip" title="<?= $this->mf_beranda->get_banner('SLIDE', 'Web')[1]; ?>"><img src="<?= $this->mf_beranda->get_banner('SLIDE', 'Web')[0]; ?>" class="img-fluid rounded d-block mb-4 p-2 border" alt="<?= $this->mf_beranda->get_banner('SLIDE', 'Web')[1]; ?>"></a>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <!-- <div class="w-100 my-2 my-md-0"></div> -->
                    <a class="btn btn-info my-sm-0 w-100 py-3" href="<?= base_url('kotak_saran'); ?>">
                        <i class="fas fa-box fa-2x"></i> <br> Kotak Saran
                    </a>
                    <!-- <div class="w-100 my-2"></div> -->
                    <a class="btn btn-success my-sm-0 w-100 mx-3 py-3" href="<?= base_url('survey'); ?>">
                        <i class="fas fa-check-circle fa-2x"></i> <br> Survey IKM
                    </a>
                    <!-- <div class="w-100 my-2"></div> -->
                    <a class="btn btn-secondary disabled my-sm-0 w-100 py-3" href="#">
                        <i class="fab fa-buromobelexperte fa-2x"></i> <br> lainya
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-home mb-5">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 order-first order-md-last">
                <div>
                    <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-bullhorn text-secondary mr-2"></i> Poster</span>
                    </div>
                    <a id="banner" data-lightbox="BannerAside" data-title="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>" href="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>">
                        <img src="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>" class="rounded img-fluid mx-auto d-block mb-3 shadow">
                    <h6 class="font-weight-bold"><?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?></h6></a>
                    <span class="text-secondary small">Posted by</span> <?= ucwords($this->mf_beranda->get_banner('BANNER', 'Aside')[3]); ?>
                    <div class="separator mt-5">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-images text-secondary mr-2"></i> album photo</span>
                    </div>
                    <div class="overflow-hidden rounded-lg my-4 border-0 shadow-none">
                        
                        <?php
                        $kolom = 2;
                        $i = 1;
                        foreach ($mf_album as $album):
                        if(($i) % $kolom==1) {
                        echo '<div class="d-flex">';
                            }
                            ?>
                            <div class="w-100 rounded m-1">
                                <a href="<?= base_url('album/'.encrypt_url($album->id_album_foto)) ?>">
                                    <img data-toggle="tooltip" title="<?= $album->judul ?>" data-src="data:image/jpeg;base64,<?= base64_encode( $album->gambar_blob ); ?>" class="img-fluid lazy rounded shadow-sm border " alt="<?= url_title($album->judul, '-', true) ?>">
                                </a>
                            </div>
                            <?php if(($i) % $kolom==0) {
                        echo '</div>';
                        } ?>
                        <?php $i++; endforeach; ?>
                        <!-- <div class="small text-info position-absolute mx-auto mt-1">Directed by BinaInfo</div> -->
                    </div>
                    <div class="separator d-none d-md-block mt-5">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-heart text-secondary mr-2"></i> Populer Post</span>
                    </div>
                    <div class="list-group border-0 shadow-none p-0 d-none d-md-block">
                        <?php
                        $nolist = 1;
                        foreach ($mf_berita_populer as $b) :
                        $id = encrypt_url($b->id_berita);
                        $postby = strtolower(url_title($this->mf_users->get_namalengkap($b->created_by)));
                        $judul = strtolower($b->judul);
                        $posturl = base_url("post/{$postby}/{$id}/" . url_title($judul) . '');
                        if(empty($b->img)):
                        $img = '<img class="rounded align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
                        else:
                        $img = '<img class="rounded align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="'.$b->path.'" alt="'.$b->judul.'">';
                        endif;
                        ?>
                        <a  href="<?= $posturl; ?>" class="bg-transparent list-group-item list-group-item-action border-0 px-3  m-0">
                            <div class="media m-0">
                                <?= $img ?>
                                <div class="media-body">
                                    <span class="font-weight-lighter text-primary"><?= character_limiter($b->judul, 30); ?></span>
                                    <small class="d-block mt-2 align-middle text-left font-weight-bold">
                                    <i class="far fa-thumbs-up"></i> <?= $b->like_count ?> Likes </small>
                                    </small>
                                </div>
                            </div>
                            
                            <br>
                            
                        </a>
                        <?php $nolist++; endforeach; ?>
                    </div>
                    
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-8 col-md-11">
                        <div class="separator">
                            <span class="separator-text text-uppercase font-weight-bold"><span class="font-weight-bold"><i class="fa fa-quote-left text-primary mr-2"></i>Postingan Terbaru</span></span>
                        </div>
                    </div>
                    <div class="col-4 col-md-1">
                        <div class="float-right mt-2"><button data-toggle="tooltip" title="Search Post" id="caripost" class="btn btn-outline-primary border-0"> <i class="fas fa-search"></i></button></div>
                    </div>
                </div>
                <div id="load_data"></div>
                <div id="load_data_message"></div>
                <div class="text-center">
                    <button id="load_more" class="rounded-pill btn-block btn btn-primary rounded-pill px-4"><i class="fas fa-newspaper mr-2"></i> Load more berita</button>
                </div>
            </div>
            <div class="col-md-2 order-first order-md-last">
                    <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-leaf text-secondary mr-2"></i>Web Apps</span>
                    </div>
                    <div class="d-flex flex-column">
                        
                        <div>
                            <a target="_blank" data-toggle="tooltip" href="http://silka.bkppd-balangankab.info/" title="aplikasi sistem informasi layanan kepegawaian balangan">
                                <?php echo '<img src="'.base_url('assets/images/logo-silka.png').'" width="140"/>'; ?>
                            </a>
                        </div>
                        <div class="my-4">
                            <a target="_blank" data-toggle="tooltip" href="https://ekinerja.bkppd-balangankab.info/" title="aplikasi e-kinerja balangan">
                                <?php echo '<img src="'.base_url('assets/images/logo-ekinerja.png').'" width="160"/>'; ?>
                            </a>
                        </div>
                        <div class="mt-2 p-2">
                            <a target="_blank" data-toggle="tooltip" href="https://eprilaku.bkppd-balangankab.info/" title="aplikasi e-prilaku balangan">
                                <?php echo '<img src="'.base_url('assets/images/logo-eprilaku.png').'" width="80"/>'; ?>
                            </a>
                        </div>
                    </div>
            </div>
            <!-- <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 order-first">
                <div class="mx-auto"> -->
                    
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
                <!--  </div>
            </div> -->
            
        </div>
    </div>
</section>