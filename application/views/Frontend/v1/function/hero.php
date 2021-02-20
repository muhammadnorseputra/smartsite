<section style="background-color: #00917c; background-size: cover; background-position: right top; background-image: url('<?= base_url('assets/images/bg/bg-light.svg') ?>')">
    <div class="container">
        <div class="row py-md-5">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 pb-5 py-md-5">
                <p class="lead text-warning text-center text-md-left pt-md-3 mb-md-5">Hallo <i class="fas fa-grin-hearts"></i> pengunjung</p>
                <div class="display-2 text-white font-weight-bold text-center text-md-left"><span id="halojs"></span></div>
                <!-- Static halo -->
                <p class="lead text-white intro-website text-center text-md-left mt-md-2">Website Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</p>
                <!-- Dinamic mengunakan typed.js -->
                <!--                 <p class="halo_bkppd"><span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> <span>Update informasi resmi seputar layanan kepegawaian serta artikel terkait lainya langsung dari website kami.</span> <span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> </p>
                <span id="typed" class="lead text-secondary intro-website"></span>
                -->
                <p class="mt-5 text-center text-md-left">
                    <button type="button" onclick="explore()" class="btn shadow-lg btn-warning rounded py-3 px-4 text-uppercase">
                    Update Informasi <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <a target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn py-3 btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn  py-3 btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Our Instagram" data-username="<?= $mf_beranda->ig; ?>">
                        <i class="fab fa-instagram"></i>
                    </a>
                </p>
                
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 my-3 pt-5 my-md-5 py-md-5 order-first order-md-last">
                <div class="d-flex align-items-center">
                    <div>
                    <img class="img-fluid rounded d-none d-md-block" src="<?= base_url('assets/images/bg/bg-home.svg') ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>