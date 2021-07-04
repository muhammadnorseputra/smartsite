<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/slider2') ?>
<section class="content-home hero py-md-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->load->view('Frontend/v1/function/count_peg_home'); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $my = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-4 pt-md-5' : 'my-4' ?>
<section class="mb-5 <?= $my ?>">
    <div class="container">
        <div class="bg-light my-3 py-1"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 order-last order-md-last mt-md-0 mt-4">
                <?php $this->load->view('Frontend/v1/function/search_pegawai'); ?>
                <?php $this->load->view('Frontend/v1/function/youtube_sidebar'); ?>
                <?php $this->load->view('Frontend/v1/function/poling'); ?>
                <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
                <?php $this->load->view('Frontend/v1/function/banner_sidebar'); ?>
                <?php $this->load->view('Frontend/v1/function/album_sidebar'); ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <?php
                    $sort = $this->input->get('sort');
                    $type = $this->input->get('type');
                    $dataSort = ['newest','populer'];
                    $dataType = ['all', 'berita', 'youtube', 'link'];
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
                            <!-- <button type="button" class="btn btn-secondary">Left</button> -->
                            
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
                <div class="text-center">
                    <button id="load_more" class="btn p-2 btn-primary btn-block rounded-lg px-4"><i class="fas fa-newspaper mr-2"></i> Loadmore</button>
                </div>
                <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                style="display:block"
                data-ad-format="fluid"
                data-ad-layout-key="-f9+4v+7r-fc+65"
                data-ad-client="ca-pub-1099792537777374"
                data-ad-slot="5769488115"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script> -->
            </div>
        </div>
    </div>
</section>