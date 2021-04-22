<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/hero') ?>
<section class="content-home mb-3 py-5 hero">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <!-- Banenr slide horizontal -->
             <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_horizontal_home') ?>">
                <span class="content-placeholder my-3" style="width: 100%; height: 230px;"></span>
             </div>   

            <!-- Counter jumlah pegawai -->
            <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/count_peg') ?>">
                    <div class="col-md-4 mt-4 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
                    <div class="col-md-4 mt-4 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
                    <div class="col-md-4 mt-4 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
            </div>
            </div>
            <div class="col-md-4">
                <!-- Banner vertikal -->
                <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_vertical_home') ?>">
                <span class="content-placeholder" style="width: 100%; height: 430px;"></span>
                <span class="content-placeholder my-2" style="width: 80%; height: 20px;"></span>
                <span class="content-placeholder" style="width: 40%; height: 20px;"></span>
             </div>  
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $my = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-4 pt-md-5' : 'my-4' ?>

<section class="mb-5 <?= $my ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 order-first order-md-last">
                    <?php $this->load->view('Frontend/v1/function/album_sidebar'); ?>
                    <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                
                <div class="row">
                    <div class="col-12">
                        <div class="separator">
                            <span class="separator-text text-uppercase font-weight-bold"><span class="font-weight-bold"><i class="fa fa-quote-left text-secondary mr-2"></i>Postingan Terbaru</span></span>
                        </div>
                    </div>
                </div>
                <div id="load_data"></div>
                <div id="load_data_message"></div>
                <div class="text-center">
                    <button id="load_more" class="btn-block btn btn-primary rounded-lg px-4"><i class="fas fa-newspaper mr-2"></i> Load more berita</button>
                </div>

                <div class="separator">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-leaf text-secondary mr-2"></i>Digital Goverment</span>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        
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
            <div class="col-md-2 order-first order-md-last">
                    
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