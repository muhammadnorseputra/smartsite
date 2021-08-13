<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/slider3') ?>
<section class="content-home">
    <div class="container">
        <div class="row app-slick">
                <div>
                    <div class="d-flex align-items-center bg-success shadow-sm py-4 px-md-5 px-0" style="border-radius:15px;">
                        <div class="col-12 col-md-4 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/gpr.svg') ?>" alt="GPR (Government Public Relation)">
                        </div>
                        <div class="col-12 col-md-8 text-white">
                            <h1>GPR (Government Public Relation)</h1>
                            <p>
                                Merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <span class="badge badge-light badge-pill" title="Official Site BKPPD Balangan"> https://web.bkppd-balangankab.info/</span> dan informasi statistik pegawai bersumber pada aplikasi SILKa (Sistem Informasi Kepegawaian) Daerah Balangan <span class="badge badge-light badge-pill" title="SILKa Online">http://silka.bkppd-balangankab.info/</span>.
                            </p>
                            <a href="<?= base_url('widget-gpr-bkppdblg') ?>" class="btn btn-warning">Pasang Widget</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center bg-white shadow-sm py-4 px-md-5 px-0" style="border-radius:15px;">
                        <div class="col-12 col-md-4 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/report.svg') ?>" alt="Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <h1>Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?></h1>
                            <p>
                                Kini website telah tersedia grafik Pegawai Negeri Sipil yang terintegrasi dengan SILKa Online (Sistem Informasi Layanan Kepegawaian) Daerah Kabupaten Balangan, silahkan lihat pada laman grafik.
                            </p>
                            <a href="<?= base_url('api/grafik') ?>" class="btn btn-secondary">Lihat Grafik</a>
                        </div>
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
                
                <a rel="noreferrer, nofollow" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6"><img class="w-100" src="https://img.buymeacoffee.com/button-api/?text=Support My Developer&emoji=&slug=putrabungsu6&button_colour=40DCA5&font_colour=ffffff&font_family=Cookie&outline_colour=000000&coffee_colour=FFDD00" alt="putrabungsu6"></a>

                <a href="<?= base_url('koran-online'); ?>" class="btn btn-outline-light btn-light py-3 my-3 btn-block">
                <div class="d-flex justify-content-between align-items-center text-primary">
                    <i class="fas fa-newspaper mr-3 fa-2x"></i>
                    <span>
                        Baca Koran Online Hari Ini <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>
                

<!--                 <a rel="noreferrer" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6" class="btn btn-outline-light btn-light py-2 mb-3 btn-block">
                <div class="d-flex justify-content-between align-items-center  text-primary">
                    <span>
                        <img style="object-fit: cover;" class="rounded-circle" width="45" height="45" src="<?= assets('images/putrabungsu6.jpg') ?>" alt="putrabungsu6">
                    </span>
                    <span>
                        Buy me a coffee <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>
 -->
                <?php $this->load->view('Frontend/v1/function/search_pegawai'); ?>
                <?php $this->load->view('Frontend/v1/function/poling'); ?>
                <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
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
                <!-- <div style="overflow-x: auto;" class="d-flex justify-content-between align-items-center flex-row flex-nowrap mb-3">
                    <?php $no=1; foreach($mf_banner_home->result() as $b): ?>
                    <div class="mx-3 flex-grow-1">
                        <a href="<?= $b->path ?>" id="xbanner-<?= $no ?>" data-title="<?= $b->judul ?>" data-lightbox="BannerAside">
                        <img class="lazy rounded-circle border shadow-sm p-1" width="110" height="110" style="object-fit:cover;" alt="<?= $no ?>" data-src="<?= files('file_banner/'.$b->gambar) ?>">
                        </a>
                    </div>
                    <?php $no++; endforeach; ?>
                </div> -->
                <div class="d-flex justify-content-between align-items-center mb-3 flex-row flex-nowrap">
                    <?php
                    $sort = $this->input->get('sort');
                    $type = $this->input->get('type');
                    $dataSort = ['newest','populer'];
                    $dataType = ['all', 'berita', 'slide', 'youtube', 'link'];
                    ?>
                    <div class="d-none d-md-block d-lg-block">
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
                                <a rel="noindex, nofollow" class="dropdown-item <?= $active ?>" href="<?= $url ?>"><?= $sortTitle; ?></a>
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
                            <a rel="noindex, nofollow" href="<?= $url ?>" class="btn btn-outline-light text-muted <?= $active ?>"><?= $typeTitle ?></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                
                <div id="load_data" class="d-block w-100"></div>
                <div id="load_data_message"></div>
                <div class="text-center mb-md-4">
                    <button id="load_more" class="btn p-2 btn-outline-primary btn-block rounded-lg px-4"><i class="fas fa-newspaper mr-3"></i> Berita Sebelumnya</button>
                </div>
            </div>
        </div>
    </div>
</section>