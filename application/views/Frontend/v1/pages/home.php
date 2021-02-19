<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<!-- <section class="my-5">
    <div class="container">
        <div class="lazy my-md-5" data-loader="ajax" data-src="beranda/slider">
            <img class="d-block mx-auto my-5 py-5" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/tail-spin.svg'); ?>" alt="">
        </div>
    </div>
</section> -->
<section style="background-color: #003ECB; background-size: cover; background-position: right top; background-image: url('<?= base_url('assets/images/bg/bg-light.svg') ?>')">
    <div class="container">
        <div class="row py-md-5">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 pb-5 py-md-5">
                <p class="lead text-warning text-center text-md-left pt-md-3 mb-md-5">Hallo <i class="fas fa-grin-hearts"></i> pengunjung</p>
                <div class="display-2 text-white font-weight-bold text-center text-md-left"><span id="halojs"></span></div>
                <!-- Static halo -->
                <p class="lead text-white intro-website text-center text-md-left mt-md-2">Website Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</p>
                <!-- Dinamic mengunakan typed.js -->
                <!--                 <p class="halo_bkppd"><span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> <span>Update informasi resmi seputar layanan kepegawaian serta artikel terkait lainya langsung dari website kami.</span> <span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> </p>
                <span id="typed" class="lead text-secondary intro-website"></span>
                -->
                <p class="mt-3 text-center text-md-left">
                    <button type="button" onclick="explore()" class="btn shadow btn-warning rounded py-3 px-4 text-uppercase">
                    Update Informasi <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <a target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn py-3 btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn  py-3 btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Our Instagram" data-username="<?= $mf_beranda->ig; ?>">
                        <i class="fab fa-instagram"></i>
                    </a>
                </p>
                
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 my-3 pt-5 my-md-5 py-md-5 order-first order-md-last">
                <div class="d-flex align-items-center">
                    <div>
                    <img class="img-fluid rounded d-none d-md-block" src="<?= base_url('assets/images/bg/bg-home.svg') ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="statistik mb-5">
    <div class="container py-5 bg-white mt--9 shadow-lg" style="border-radius: 10px;">
        <div class="row no-gutters">
            <?php
            $local = '192.168.1.4';
            $online = 'http://silka.bkppd-balangankab.info';
            $status = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? $online : $local;
            $host = $status;
            ?>
            <?php
            $arr = [
            'jml_asn' => api_curl_get($host.'/api/get_grap/asn'),
            'jml_pns' => api_curl_get($host.'/api/get_grap/pns'),
            'jml_ptt' => api_curl_get($host.'/api/get_grap/nonpns')
            ]
            ?>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card bg-transparent border-0 rounded">
                    <div class="card-body">
                        <i class="fas fa-users bg-info p-4 rounded float-right fa-3x text-white d-inline-block mt-1"></i>
                        <h3 id="count_jml" data-from="0" data-to="<?= $arr['jml_asn'] ?>"
                        data-speed="3000" data-refresh-interval="50" class="display-4 "><?= $arr['jml_asn'] ?></h3>
                        <b class="text-secondary">Jumlah ASN Kab. Balangan</b>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="card bg-transparent my-md-0 my-4 border-0 rounded-0 big-card">
                    <div class="card-body align-middle">
                        <i class="fas fa-user-tie bg-light p-4 float-right fa-3x d-inline-block mt-1 text-white rounded"></i>
                        <h3 id="count_jml" data-from="0" data-to="<?= $arr['jml_pns'] ?>"
                        data-speed="3000" data-refresh-interval="50" class="display-4 "><?= $arr['jml_pns'] ?></h3>
                        <b class="text-secondary">Jumlah PNS + CPNS</b>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="card bg-transparent rounded border-0">
                    <div class="card-body">
                        <i class="far bg-success p-4 fa-user-circle float-right fa-3x d-inline-block mt-1 text-white rounded"></i>
                        <h3 id="count_jml" data-from="0" data-to="<?= $arr['jml_ptt'] ?>"
                        data-speed="3000" data-refresh-interval="50" class="display-4 "><?= $arr['jml_ptt'] ?></h3>
                        <b class="text-secondary">Jumlah NON PNS</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $my2 = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-5 pt-md-5' : '' ?>
<section class="content-home <?= $my2 ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 order-first order-md-last">
                
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
                <div class="sidebar">
                    <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-user-tie text-secondary mr-2"></i>Profile PNS</span>
                    </div>
                    <div class="card border-0 rounded shadow-sm bg-white my-4">
                        <div class="card-body">
                            <form class="form-horizontal" id="caripegawai" method="GET" action="<?= base_url('frontend/v1/pegawai/detail') ?>">
                                <div class="typeahead__container form-group">
                                    <label for="js-nipnama" class="text-secondary small">Masukan NIP, kemudian pilih detail untuk melihat profile pegawai</label>
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
                    <div class="separator">
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
                                    <img data-toggle="tooltip" title="<?= $album->judul ?>" data-src="data:image/jpeg;base64,<?= base64_encode( $album->gambar_blob ); ?>" class="img-fluid lazy rounded" alt="<?= url_title($album->judul, '-', true) ?>">
                                </a>
                            </div>
                            <?php if(($i) % $kolom==0) {
                        echo '</div>';
                        } ?>
                        <?php $i++; endforeach; ?>
                        <!-- <div class="small text-info position-absolute mx-auto mt-1">Directed by BinaInfo</div> -->
                    </div>
                    <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-bullhorn text-secondary mr-2"></i> Poster</span>
                    </div>
                    <a id="banner" data-lightbox="BannerAside" data-title="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?>" href="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>">
                        <img src="<?= $this->mf_beranda->get_banner('BANNER', 'Aside')[0]; ?>" class="rounded img-fluid mx-auto d-block mb-3 shadow">
                    <h6 class="font-weight-bold"><?= $this->mf_beranda->get_banner('BANNER', 'Aside')[1]; ?></h6></a>
                    <span class="text-secondary small">Posted by</span> <?= ucwords($this->mf_beranda->get_banner('BANNER', 'Aside')[3]); ?>
                    
                    <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-heart text-secondary mr-2"></i> Populer Post</span>
                    </div>
                    <div class="list-group border-0 shadow-none p-0 d-none d-md-block">
                        <?php
                        $nolist = 1;
                        foreach ($mf_berita_populer as $b) :
                        $id = encrypt_url($b->id_berita);
                        $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($b->created_by))));
                        $judul = strtolower($b->judul);
                        $posturl = base_url("post/@{$postby}/{$id}/" . url_title($judul) . '');
                        if(empty($b->img)):
                        $img = '<img class="rounded align-self-center lazy pull-left mr-2 w-25 shadow" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
                        else:
                        $img = '<img class="rounded align-self-center lazy pull-left mr-2 w-25 shadow" data-src="'.$b->path.'" alt="'.$b->judul.'">';
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
                    <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-leaf text-secondary mr-2"></i> Digital Goverment</span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between justify-content-md-start align-items-center mt-4">
                    
                    <div>
                        <a target="_blank" data-toggle="tooltip" href="http://silka.bkppd-balangankab.info/" title="aplikasi sistem informasi layanan kepegawaian balangan">
                            <?php echo '<img src="'.base_url('assets/images/logo-silka.png').'" width="140"/>'; ?>
                        </a>
                    </div>
                    <div class="mx-md-5">
                        <a target="_blank" data-toggle="tooltip" href="https://eprilaku.bkppd-balangankab.info/" title="aplikasi e-prilaku balangan">
                            <?php echo '<img src="'.base_url('assets/images/logo-eprilaku.png').'" width="80"/>'; ?>
                        </a>
                    </div>
                    <div>
                        <a target="_blank" data-toggle="tooltip" href="https://ekinerja.bkppd-balangankab.info/" title="aplikasi e-kinerja balangan">
                            <?php echo '<img src="'.base_url('assets/images/logo-ekinerja.png').'" width="160"/>'; ?>
                        </a>
                    </div>
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
                        <button id="load_more" class="rounded-pill btn btn-primary rounded-pill px-4"><i class="fas fa-newspaper mr-2"></i> Load more berita</button>
                     </div>
            </div>
            <div class="col-md-2 order-last">
                <div class="d-flex flex-column justify-content-center">
                        <div class="w-100 my-2 my-md-0"></div>
                        <a class="btn btn-info my-sm-0 d-block py-3" href="<?= base_url('kotak_saran'); ?>">
                            <i class="fas fa-box fa-2x"></i> <br> Kotak Saran
                        </a>
                        <div class="w-100 my-2"></div>
                        <a class="btn btn-success my-sm-0 d-block py-3" href="<?= base_url('survey'); ?>">
                            <i class="fas fa-check-circle fa-2x"></i> <br> Survey IKM
                        </a>
                        <div class="w-100 my-2"></div>
                        <a class="btn btn-outline-light disabled my-sm-0 d-block py-3" href="#">
                            <i class="fab fa-buromobelexperte fa-2x"></i> <br> lainya
                        </a>
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