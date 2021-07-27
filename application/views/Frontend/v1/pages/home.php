<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/slider3') ?>
<section class="content-home">
    <div class="container">
        <div class="row">
            <div class="d-flex align-items-center border bg-light shadow-sm py-4 px-md-5 px-0" style="border-radius:15px;">
                <div class="col-12 col-md-4 d-none d-md-block d-lg-block">
                    <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/hero-img.png') ?>" alt="Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?>">
                </div>
                <div class="col-12 col-md-8">
                    <h1>Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?></h1>
                    <p>
                        Kini website telah tersedia grafik Pegawai Negeri Sipil yang terintegrasi dengan SILKa Online (Sistem Informasi Layanan Kepegawaian) Daerah Kabupaten Balangan, silahkan lihat pada laman grafik.
                    </p>
                    <a href="<?= base_url('api/grafik') ?>" class="btn btn-primary">Lihat Grafik</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $my = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-3 mt-md-5 pt-md-5' : 'my-4' ?>
<section class="<?= $my ?>" id="content-page">
    <div class="container">
        <!-- <div class="bg-light my-3 py-1"></div> -->
        <div class="row d-flex justify-content-around">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 order-last order-md-last mt-4 mt-md-0">
                <div id="sidebar">
                <a href="<?= base_url('koran-online'); ?>" class="btn btn-outline-light btn-light py-3 mb-3 btn-block">
                <div class="d-flex justify-content-between align-items-center text-primary">
                    <i class="fas fa-newspaper mr-3 fa-2x"></i>
                    <span>
                        Baca Koran Online Hari Ini <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>
                <?php $this->load->view('Frontend/v1/function/search_pegawai'); ?>
                <?php $this->load->view('Frontend/v1/function/poling'); ?>
                <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
                <?php $this->load->view('Frontend/v1/function/banner_sidebar'); ?>
                <?php $this->load->view('Frontend/v1/function/album_sidebar'); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7" id="main-content">
                <!-- Banenr slide horizontal -->
                <!-- <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_horizontal_home') ?>">
                    <span class="content-placeholder my-3" style="width: 100%; height: 230px;"></span>
                    <span class="content-placeholder" style="width: 40%; height: 20px;"></span>
                </div>  -->
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="separator">
                            <span class="separator-text text-uppercase font-weight-bold"><span class="font-weight-bold"><i class="fa fa-quote-left text-secondary mr-2"></i>Postingan Terbaru</span></span>
                        </div>
                    </div>
                </div> -->
                <div style="overflow-x: auto;" class="d-flex justify-content-between align-items-center flex-row flex-nowrap mb-3">
                    <?php foreach($mf_banner_home->result() as $b): ?>
                    <div class="mx-3 flex-grow-1">
                        <a href="<?= $b->path ?>" id="xbanner" data-title="<?= $b->judul ?>" data-lightbox="BannerAside">
                        <img class="lazy rounded-circle border shadow-sm" width="110" height="110" style="object-fit:cover;" data-src="<?= files('file_banner/'.$b->gambar) ?>">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div  style="overflow-x: auto;" class="d-flex justify-content-between align-items-center mb-3 flex-row flex-nowrap">
                    <?php
                    $sort = $this->input->get('sort');
                    $type = $this->input->get('type');
                    $dataSort = ['newest','populer'];
                    $dataType = ['all', 'berita', 'slide', 'youtube', 'link'];
                    ?>
                    <div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-light text-muted dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= isset($sort) ? ucwords($sort) : 'Newest'; ?>
                            </button>
                            <div class="dropdown-menu">
                                <h6 class="dropdown-header small">Sorting post</h6>
                                <?php
                                for($x=0; $x<count($dataSort); $x++):
                                $active = $dataSort[$x] === $sort ? 'active disabled' : '';
                                $url = empty($type) ? '?sort='.$dataSort[$x] : '?sort='.$dataSort[$x].'&type='.$type;
                                $sortTitle = ucwords($dataSort[$x]);
                                ?>
                                <a class="dropdown-item <?= $active ?>" href="<?= $url ?>"><?= $sortTitle; ?></a>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <?php
                            for($x=0; $x<count($dataType); $x++):
                            $active_item = ($dataType[$x] === $type) ? 'active disabled' : '';
                            $active = ($x==0) && empty($type) ? 'active disabled' : $active_item;
                            $url = empty($sort) ? '?type='.$dataType[$x] : '?sort='.$sort.'&type='.$dataType[$x];
                            $typeTitle = ucwords($dataType[$x]);
                            ?>
                            <a href="<?= $url ?>" class="btn btn-outline-light text-muted <?= $active ?>"><?= $typeTitle ?></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                
                <div id="load_data"></div>
                <div id="load_data_message"></div>
                <div class="text-center mb-md-4">
                    <button id="load_more" class="btn p-2 btn-outline-primary btn-block rounded-lg px-4"><i class="fas fa-newspaper mr-3"></i> Berita Sebelumnya</button>
                </div>
            </div>
        </div>
    </div>
</section>