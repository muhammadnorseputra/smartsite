<?php if($this->session->userdata('user_portal_log')['id'] == ''): ?>
<?php $this->load->view('Frontend/v1/function/hero') ?>
<section class="content-home hero py-md-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Counter jumlah pegawai -->
                <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/count_peg') ?>">
                    <div class="col-md-3 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
                    <div class="col-md-3 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
                    <div class="col-md-3 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
                    <div class="col-md-3 p-2">
                        <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                        <span class="content-placeholder my-3" style="width: 100%; height: 60px;"></span>
                        <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
                    </div>
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
            <div class="col-12">
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 order-last order-md-last">
                    <?php $this->load->view('Frontend/v1/function/youtube_sidebar'); ?>
                    <?php $this->load->view('Frontend/v1/function/album_sidebar'); ?>
                    <?php $this->load->view('Frontend/v1/function/populer_post'); ?>
                    <!-- Banner vertikal -->
                    <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_vertical_home') ?>">
                        <span class="content-placeholder" style="width: 100%; height: 430px;"></span>
                        <span class="content-placeholder my-2" style="width: 80%; height: 20px;"></span>
                        <span class="content-placeholder" style="width: 40%; height: 20px;"></span>
                     </div> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <!-- Banenr slide horizontal -->
                 <div class="row no-gutters lazy" data-loader="ajax" data-src="<?= base_url('frontend/v1/beranda/section/banner_horizontal_home') ?>">
                    <span class="content-placeholder my-3" style="width: 100%; height: 230px;"></span>
                 </div> 
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
            </div>
        </div>
    </div>
</section>