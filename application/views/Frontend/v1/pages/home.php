<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/slider3') ?>
<section class="content-home">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="separator">
                    <span class="separator-text text-capitalize font-weight-bold"><span class="font-weight-bold"><i class="fab fa-medapps text-secondary mr-2"></i>Yang Baru Dari Kami</span></span>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-12 app-slick">
                <div>
                    <div class="d-flex align-items-center bg-success py-4 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-3 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/illustration_hero_banner.svg') ?>" alt="GPR (Government Public Relation)">
                        </div>
                        <div class="col-12 col-md-9 text-white">
                            <h3>SKM (Survei Kepuasan Masyarakat)</h3>
                            <p>
                                Survei Kepuasan Masyarakat (SKM) adalah data dan informasi tentang tingkat kepuasan masyarakat yang diperoleh dari hasil pengukuran secara kuantitatif dan kualitatif atas pendapat masyarakat dalam memperoleh pelayanan dari aparatur penyelenggara pelayanan publik dengan membandingkan antara harapan dan kebutuhannya.
                            </p>
                            <a href="<?= base_url('skm') ?>" class="btn btn-lg btn-info">Isi Survei Sekarang <i class="fas fa-vote-yea ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center bg-info py-4 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-3 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/gpr.svg') ?>" alt="GPR (Government Public Relation)">
                        </div>
                        <div class="col-12 col-md-9 text-white">
                            <h3>GPR (Government Public Relation)</h3>
                            <p>
                                Merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <span class="badge badge-light" title="Official Site BKPPD Balangan"> web.bkppd-balangankab.info</span> dan informasi statistik pegawai bersumber pada aplikasi SILKa (Sistem Informasi Layanan Kepegawaian) Daerah Balangan.
                            </p>
                            <a href="<?= base_url('widget-gpr-bkppdblg') ?>" class="btn btn-lg btn-warning">Pasang Widget Sekarang <i class="fas fa-tools ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center bg-white py-4 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-3 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/report.svg') ?>" alt="Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?>">
                        </div>
                        <div class="col-12 col-md-9">
                            <h3>Grafik Pegawai Negeri Sipil Tahun <?= date('Y') ?></h3>
                            <p>
                                Kini website telah tersedia grafik Pegawai Negeri Sipil yang terintegrasi dengan SILKa Online (Sistem Informasi Layanan Kepegawaian) Daerah Kabupaten Balangan, silahkan lihat pada laman grafik.
                            </p>
                            <a href="<?= base_url('api/grafik') ?>" class="btn btn-lg btn-secondary">Lihat Grafik <i class="fas fa-chart-line ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="separator">
                    <span class="separator-text text-capitalize font-weight-bold"><span class="font-weight-bold"><i class="fas fa-images text-secondary mr-2"></i>Info Grafis</span></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row  grafis-app-slick">
                    <?php 
                        $no=1; 
                        foreach($mf_banner_home->result() as $b): 
                        $by = $b->upload_by;
                        if($by == 'admin') {
                            $link_profile_public = 'javascript:void(0);';
                            $namalengkap = $this->mf_users->get_namalengkap($by);
                            $namapanggilan = $by;
                            $gravatar = base_url('assets/images/users/'.$this->mf_users->get_gravatar($by));
                        } else {
                            $link_profile_public = 
                            base_url("user/".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
                            $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                            $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                            $gravatar = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic).'';
                        }
                    ?>
                    <div>
                            <div class="card bg-light text-white rounded-lg mb-2">
                                <img class="lazy card-img" height="410" style="object-fit:cover;" alt="<?= $no ?>" data-src="<?= files('file_banner/'.$b->gambar) ?>">
                                <div class="card-img-overlay d-flex flex-column justify-content-end">
                                    <div class="main-body align-self-end">
                                        <a href="<?= $b->path ?>" id="xbanner-<?= $no ?>" data-title="<?= $b->judul ?>" data-lightbox="BannerAside" style="text-shadow: 0.3px 1px white;">
                                            <span class="badge p-2 badge-pill badge-warning">
                                                <i class="fas fa-search mr-2"></i> Perbesar
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= $b->judul ?>
                            <div class="d-flex justify-content-start align-items-center">
                                <span class="mr-2">
                                    <img style="object-fit:cover; object-position:top;" src="<?= $gravatar ?>" alt="Photo Userportal" width="23" height="23" class="rounded-circle border-primary bg-white">
                                </span>
                                <span class="small text-secondary mt-1">
                                    <?= ucwords($namapanggilan) ?>
                                </span>
                            </div>
                            
                        
                    </div>
                    <?php $no++; endforeach; ?>
                    <div>
                        <a href="<?= base_url('bannerlist') ?>" class=" h-100">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="text-center font-weight-bold">
                                    <i class="fas fa-chevron-right mb-2"></i> <br>
                                    InfoGrafik Lainnya
                                </div>
                            </div>
                        </a>
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
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 order-last order-md-last mt-4 mt-md-0">
                <div id="sidebar">
                
                <a href="https://www.buymeacoffee.com/putrabungsu6"><img src="https://img.buymeacoffee.com/button-api/?text=Donasi coffee untuk dev&emoji=&slug=putrabungsu6&button_colour=FFDD00&font_colour=000000&font_family=Inter&outline_colour=000000&coffee_colour=ffffff" class="w-100"></a>

                <a href="<?= base_url('koran-online'); ?>" class="btn btn-outline-light btn-light py-3 my-3 btn-block">
                <div class="d-flex justify-content-between align-items-center text-primary">
                    <i class="fas fa-newspaper mr-3 fa-2x"></i>
                    <span>
                        Baca Koran Online Hari Ini <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </div>
                </a>

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
                <?php $this->load->view('Frontend/v1/function/search_pegawai'); ?>
                <?php $this->load->view('Frontend/v1/function/poling'); ?>
                <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
                <?php $this->load->view('Frontend/v1/function/album_sidebar'); ?>
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
                <!-- <div style="overflow-x: auto;" class="d-flex justify-content-between align-items-center flex-row flex-nowrap mb-3">
                    <?php $no=1; foreach($mf_banner_home->result() as $b): ?>
                    <div class="mx-3 flex-grow-1">
                        <a href="<?= $b->path ?>" id="xbanner-<?= $no ?>" data-title="<?= $b->judul ?>" data-lightbox="BannerAside">
                        <img class="lazy rounded-circle border shadow-sm p-1" width="110" height="110" style="object-fit:cover;" alt="<?= $no ?>" data-src="<?= files('file_banner/'.$b->gambar) ?>">
                        </a>
                    </div>
                    <?php $no++; endforeach; ?>
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
                            <a rel="noindex, nofollow" href="<?= $url ?>" class="btn bg-white btn-outline-light text-muted <?= $active ?>"><?= $typeTitle ?></a>
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
            <div class="col-1 d-none d-md-block"></div>
        </div>
    </div>
</section>