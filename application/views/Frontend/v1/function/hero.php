<section class="bg-dark">
    <div class="container">
        <div class="row py-md-5">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-5 py-md-5">
                <!-- <p data-aos="fade-up" data-aos-duration="600" class="lead text-white text-center text-md-left my-5 rounded"><span class="border-bottom pt-3">Hallo <i class="fas fa-grin-hearts"></i> pengunjung.</span></p> -->
                <?php $this->load->view('msg/flashdata'); ?>
                <p class="text-warning lead mt-md-5 mt-3">Website Resmi</p>
                <div data-aos="fade-up" data-aos-duration="300" class="display-3 text-md-left text-center text-white font-weight-bold">Selamat Datang</div>
                <!-- Static halo -->
                <h4 data-aos="fade-up" data-aos-duration="500" class="text-white intro-website text-center text-md-left mt-md-2">Badan Kepegawaian & Pengembangan Sumber Daya Manusia</h4>
                <!-- Dinamic mengunakan typed.js -->
                <!--                 <p class="halo_bkppd"><span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> <span>Update informasi resmi seputar layanan kepegawaian serta artikel terkait lainya langsung dari website kami.</span> <span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> </p>
                <span id="typed" class="lead text-secondary intro-website"></span>
                -->
                <form data-aos="fade-up" data-aos-duration="700" class="form-horizontal col-md-6 pl-0 mt-5" id="caripegawai" method="GET" action="<?= base_url('frontend/v1/pegawai/detail') ?>">
                    <div class="typeahead__container form-group text-left"><!-- 
                        <label for="js-nipnama" class="text-primary bg-white border-bottom pb-2 small">Masukan NIP, kemudian pilih detail untuk menampilkan profile pegawai</label> -->
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <input class="js-nipnama" id="js-nipnama" name="filter[query]" placeholder="Masukan Nomor Induk Pegawai" maxlength="18" autocomplete="off">
                            </div>
                            <div class="typeahead__button">
                                <button type="submit">
                                <i class="typeahead__search-icon"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="text-center text-md-left">
                    <button data-aos="fade-up" data-aos-once="true" data-aos-duration="1200" type="button" onclick="explore()" class="btn shadow-lg rounded btn-outline-light py-3 px-4 text-uppercase">
                    Update Informasi <i class="fas fa-chevron-down animated fadeInDown infinite ml-2"></i>
                    </button>
                    <a data-aos="fade-up" data-aos-once="true" data-aos-duration="1400" target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn py-3 btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a data-aos="fade-up" data-aos-once="true" data-aos-duration="1600" target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn  py-3 btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Our Instagram" data-username="<?= $mf_beranda->ig; ?>">
                        <i class="fab fa-instagram"></i>
                    </a>
                </p>
                
            </div>
            <!-- <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 align-self-center order-first py-md-5 order-md-last">
                <div class="d-flex align-items-center">
                    <div>
                    <img class="img-fluid rounded d-none d-md-block" src="<?= base_url('assets/images/logo.png') ?>">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
