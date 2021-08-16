<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<section class="content-home">
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div style="overflow-x: auto;" class="d-flex flex-row flex-nowrap justify-content-start align-items-center">
                <?php
                foreach ($tags->result() as $tag) :
                ?>
                  <a href="<?= base_url('tag/' . $tag->nama_tag); ?>" class="btn btn-default rounded my-1 text-nowrap mx-2 p-2 btn-sm btn-outline-secondary"><?= ucwords(url_title($tag->nama_tag)); ?></a>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php $this->load->view('Frontend/v1/function/slider4'); ?>
        <div class="row">
            <div class="col-12">
                <div class="separator">
                    <span class="separator-text text-capitalize font-weight-bold"><span class="font-weight-bold"><i class="fab fa-medapps text-secondary mr-2"></i>Yang Baru Dari Kami</span></span>
                </div>
            </div>
        </div> 
        <div class="row">     
            <div class="col-md-12 app-slick">
                <div>
                    <div class="d-flex align-items-center bg-success py-4 px-md-5 px-0 rounded">
                        <div class="col-12 col-md-3 d-none d-md-block d-lg-block">
                            <img class="img-fluid animated-image bounce" src="<?= base_url('assets/images/bg/gpr.svg') ?>" alt="GPR (Government Public Relation)">
                        </div>
                        <div class="col-12 col-md-9 text-white">
                            <h3>GPR (Government Public Relation)</h3>
                            <p>
                                Merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <span class="badge badge-light" title="Official Site BKPPD Balangan"> web.bkppd-balangankab.info</span> dan informasi statistik pegawai bersumber pada aplikasi SILKa (Sistem Informasi Layanan Kepegawaian) Daerah Balangan.
                            </p>
                            <a href="<?= base_url('widget-gpr-bkppdblg') ?>" class="btn btn-warning">Pasang Widget Sekarang <i class="fas fa-tools ml-2"></i></a>
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
                            <a href="<?= base_url('api/grafik') ?>" class="btn btn-secondary">Lihat Grafik <i class="fas fa-chart-line ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="separator">
                    <span class="separator-text text-capitalize font-weight-bold"><span class="font-weight-bold"><i class="fas fa-images text-secondary mr-2"></i>Info Grafik</span></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div style="overflow-x: auto;" class="row">
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
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                        <a href="<?= base_url('bannerlist') ?>">
                            <div class="d-flex flex-column justify-content-center h-100">
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
<section class="my-3" id="content-page">
    <div class="container">
        <!-- <div class="bg-light my-3 py-1"></div> -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 order-last order-first order-md-last mt-4 mt-md-0">
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
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 order-last order-md-first" id="main-content">
                <!-- Banenr slide horizontal -->
                <!-- <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_horizontal_home') ?>">
                    <span class="content-placeholder my-3" style="width: 100%; height: 230px;"></span>
                    <span class="content-placeholder" style="width: 40%; height: 20px;"></span>
                </div>  -->
                <div class="row">
                    <div class="col-12">
                        <div class="separator">
                            <span class="separator-text text-capitalize font-weight-bold"><span class="font-weight-bold"><i class="fas fa-rss-square text-secondary mr-2"></i>Feeds</span></span>
                        </div>
                    </div>
                </div> 
                <!-- <div style="overflow-x: auto;" class="d-flex justify-content-between align-items-center flex-row flex-nowrap mb-3">
                    <?php $no=1; foreach($mf_banner_home->result() as $b): ?>
                    <div class="mx-3 flex-grow-1">
                        <a href="<?= $b->path ?>" id="xbanner-<?= $no ?>" data-title="<?= $b->judul ?>" data-lightbox="BannerAside">
                        <img class="lazy rounded-circle border shadow-sm p-1" width="110" height="110" style="object-fit:cover;" alt="<?= $no ?>" data-src="<?= files('file_banner/'.$b->gambar) ?>">
                        </a>
                    </div>
                    <?php $no++; endforeach; ?>
                </div> -->
                <div class="bg-white p-2 rounded-top border border-light rounded-top d-flex justify-content-between align-items-center flex-row flex-nowrap">
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
                    <div class="mx-auto mx-md-0">
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
            </div>
        </div>
    </div>
</section>