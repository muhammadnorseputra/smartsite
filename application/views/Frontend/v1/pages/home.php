<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<div class="alert alert-warning alert-dismissible fade show rounded-0 border-0 mb-0 d-md-none d-lg-none" role="alert">
  <strong>Halo Pengunjung, </strong> Mari bantu kami untuk meningkatkan pelayanan <a href="//www.bkpsdm-skm.balangankab.go.id/survei?card=bkpsdm_balangan" class="btn btn-sm btn-warning">Isi Survei Sekarang</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<section id="content-page">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between flex-column flex-lg-row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 order-md-last mt-3 mr-lg-5">
                <div id="sidebar">        
                    <?php $this->load->view('Frontend/v1/function/poling'); ?>
                    <div class="row no-gutters mt-3" id="countpeg_container"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 offset-md-3 mt-3" id="main-content">
            <!-- Slider -->
            <div class="AppGrafisContainer">
                <div class="row no-gutters AppGrafis border-bottom mb-3"></div>
            </div>
            <div class="mb-3 offset-md-1 mr-md-5 d-flex justify-content-between align-items-center flex-row flex-nowrap bg-white">
                    <?php
                    $sort = $this->input->get('sort');
                    $type = $this->input->get('type');
                    $dataSort = ['newest','populer'];
                    $dataType = ['all', 'berita', 'slide', 'youtube', 'link'];
                    ?>
                    <div class="d-none d-md-block d-lg-block">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-default text-muted dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= isset($sort) ? ucwords($sort) : 'Newest'; ?>
                            </button>
                            <div class="dropdown-menu">
                                <h6 class="dropdown-header small">Sorting post</h6>
                                <?php
                                for($x=0; $x<count($dataSort); $x++):
                                $active = $dataSort[$x] === $sort ? 'active disabled' : '';
                                $url = empty($type) ? '?sort='.$dataSort[$x] : '?sort='.$dataSort[$x].'&type='.$type.'#load_data';
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
                            <a rel="noindex, nofollow" href="<?= $url.'#load_data' ?>" class="btn btn-outline-light text-muted <?= $active ?>"><?= $typeTitle ?></a>
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