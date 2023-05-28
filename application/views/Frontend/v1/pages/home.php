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
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 order-last order-md-last mt-3 mr-md-5">
                <div id="sidebar">        
                    <?php $this->load->view('Frontend/v1/function/poling'); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 offset-md-3 mt-3" id="main-content">
                <div id="load_data"></div>
                <div id="load_data_message"></div>
                <div class="text-center mb-md-4">
                    <button id="load_more" class="btn mt-3 py-2 btn-outline-primary rounded-pill px-4"><i class="fas fa-newspaper mr-3"></i> Berita Lainnya</button>
                </div>
            </div>
        </div>
    </div>
</section>