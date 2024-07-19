<?php $this->load->view('Frontend/v1/function/poling_vote') ?>
<div class="alert alert-warning alert-dismissible fade show rounded-0 border-0 mb-0 d-md-none d-lg-none" role="alert">
    <strong>Halo Pengunjung, </strong> Mari bantu kami untuk meningkatkan pelayanan <a href="//www.bkpsdm-skm.balangankab.go.id/survei?card=bkpsdm_balangan" class="btn btn-sm btn-warning">Isi Survei Sekarang</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if ($this->session->userdata('user_portal_log')['id'] == '') : ?>
    <div class="bg-primary text-white rounded-xl border p-2 d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center pl-2">
                <div><b>Helo Pengunjung</b>, Selamat Datang Di Website Resmi Badan Kepegawaian dan Pengembangan Sumber Daya Manusia.</div>
            </div>
        </div>
    </div>
    <!-- Slider -->
    <section>
        <div class="container AppGrafisContainer">
            <div class="row no-gutters AppGrafis mt-3">

            </div>
        </div>
    </section>
    <!-- Counter jumlah pegawai -->
    <section>
        <div class="container">
            <div class="row no-gutters border rounded" id="countpeg_container">

            </div>
        </div>
    </section>

<?php endif; ?>

<?php $my = $this->session->userdata('user_portal_log')['id'] != '' ? 'mt-3' : 'my-4' ?>
<section class="<?= $my ?>" id="content-page">
    <div class="container">
        
    </div>
</section>