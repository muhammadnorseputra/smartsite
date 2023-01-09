<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<div class="alert alert-warning alert-dismissible fade show rounded-0 border-0 mb-0 d-md-none d-lg-none" role="alert">
  <strong>Halo Pengunjung, </strong> Mari bantu kami untuk meningkatkan pelayanan <a href="//www.bkpsdm-skm.balangankab.go.id/survei?card=bkpsdm_balangan" class="btn btn-sm btn-warning">Isi Survei Sekarang</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<div class="bg-primary text-white rounded-xl border p-2">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center pl-3">
            <div><b>Helo Pengunjung</b>, Selamat Datang Di Website Resmi Badan Kepegawaian dan Pengembangan Sumber Daya Manusia.</div>
        </div>
    </div>
</div>
<!-- Slider -->
<?php $this->load->view('Frontend/v1/function/slider_banner') ?>
<!-- <section class="bg-white py-md-5"> -->
    <!-- <img class="trinket trinket-13 d-none d-sm-block d-lg-block d-xl-block" src="<?= base_url('assets/images/bg/trinket_5.png') ?>" alt="Portal BKPSDM Kabupaten Balangan">
    <img class="trinket trinket-4" src="<?= base_url('assets/images/bg/trinket_7.png') ?>" alt="Portal BKPSDM Kabupaten Balangan"> -->
    <!-- <div class="container"> -->
        <!-- <div class="row">
            <div class="col-12">
                <div class="separator">
                    <span class="separator-text text-capitalize font-weight-bold"><span class="font-weight-bold"><i class="fab fa-medapps text-secondary mr-2"></i>Yang Baru Dari Kami</span></span>
                </div>
            </div>
        </div>  -->
        <!-- <div class="row">
            <div class="col-12 app-slick">
                <div>
                    <div class="d-flex align-items-center py-5 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-4 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/illustration_hero_banner.svg') ?>" alt="GPR (Government Public Relation)">
                        </div>
                        <div class="col-12 col-md-8 p-3 border-left">
                            <h3>SKM (Survei Kepuasan Masyarakat)</h3>
                            <p>
                                Survei Kepuasan Masyarakat (SKM) adalah data dan informasi tentang tingkat kepuasan masyarakat yang diperoleh dari hasil pengukuran secara kuantitatif dan kualitatif atas pendapat masyarakat dalam memperoleh pelayanan dari aparatur penyelenggara pelayanan publik dengan membandingkan antara harapan dan kebutuhannya.
                            </p>
                            <a href="<?= base_url('skm') ?>" class="btn btn-lg btn-info">Isi Survei Sekarang <i class="fas fa-vote-yea ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center py-5 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-4 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/gpr.svg') ?>" alt="GPR (Government Public Relation)">
                        </div>
                        <div class="col-12 col-md-8 p-3 border-left">
                            <h3>GPR (Government Public Relation)</h3>
                            <p>
                                Merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <span class="badge badge-light" title="Official Site BKPPD Balangan"> web.bkppd-balangankab.info</span> dan informasi statistik pegawai bersumber pada aplikasi SILKa (Sistem Informasi Layanan Kepegawaian) Daerah Balangan.
                            </p>
                            <a href="<?= base_url('widget-gpr-bkppdblg') ?>" class="btn btn-lg btn-warning">Pasang Widget Sekarang <i class="fas fa-tools ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center py-5 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-4 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/report.svg') ?>" alt="Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?>">
                        </div>
                        <div class="col-12 col-md-8 p-3 border-left">
                            <h3>Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?></h3>
                            <p>
                                Kini website telah tersedia grafik Pegawai Negeri Sipil yang terintegrasi dengan SILKa Online (Sistem Informasi Layanan Kepegawaian) Daerah Kabupaten Balangan, silahkan lihat pada laman grafik.
                            </p>
                            <a href="<?= base_url('api/grafik') ?>" class="btn btn-lg btn-secondary">Lihat Grafik <i class="fas fa-chart-line ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- </div> -->
   
<!-- </section> -->

<?php endif; ?>

<?php $my = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-3 mt-md-4 pt-md-5' : 'my-4' ?>
<section class="<?= $my ?>" id="content-page">
    <div class="container">
        <!-- <div class="bg-light my-3 py-1"></div> -->
        <div class="row d-flex justify-content-between flex-column flex-lg-row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 order-last order-md-last mt-3 mt-md-0">
                <div id="sidebar">
                
                <!-- <a href="https://www.buymeacoffee.com/putrabungsu6"><img src="https://img.buymeacoffee.com/button-api/?text=Donasi coffee untuk dev&emoji=&slug=putrabungsu6&button_colour=FFDD00&font_colour=000000&font_family=Inter&outline_colour=000000&coffee_colour=ffffff" class="w-100"></a>
 -->
<!--                 <a rel="noreferrer, nofollow, noarchive" href="https://www.nihbuatjajan.com/putra" class="btn btn-success py-3 mb-3 btn-block" target="_blank">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fas fa-hand-holding-usd mr-3 fa-2x"></i>
                    <span>
                        Dukungan Untuk Penulis <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>
 -->
    <!--             <a href="<?= base_url('koran-online'); ?>" class="btn btn-outline-light btn-light py-3 my-3 btn-block">
                <div class="d-flex justify-content-between align-items-center text-primary">
                    <i class="fas fa-newspaper mr-3 fa-2x"></i>
                    <span>
                        Baca Koran Online Hari Ini <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>
 -->
                <!-- <a href="<?= base_url('sponsor'); ?>" class="btn btn-outline-light btn-light py-3 my-3 btn-block">
                <div class="d-flex justify-content-between align-items-center text-danger">
                    <i class="fas fa-leaf mr-3 fa-2x"></i>
                    <span>
                        Sponsor <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>  -->

                

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
                <?php $this->load->view('Frontend/v1/function/poling'); ?>
                <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7" id="main-content">
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
                <div class="mb-3 d-flex justify-content-between align-items-center flex-row flex-nowrap">
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
                
                <div id="load_data"></div>
                <div id="load_data_message"></div>
                <div class="text-center mb-md-4">
                    <button id="load_more" class="btn mt-3 py-2 btn-outline-primary rounded-pill px-4"><i class="fas fa-newspaper mr-3"></i> Berita Lainnya</button>
                </div>
            </div>
        </div>
    </div>
</section>