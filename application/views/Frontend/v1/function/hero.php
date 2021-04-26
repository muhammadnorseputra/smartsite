<section class="hero-beranda" style="background-image: url('<?= $this->mf_beranda->get_banner('BANNER', 'Hero')[0]; ?>');">
    <div class="container">
        <div class="row py-md-5">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 mb-5 py-5 py-3 offset-md-2">
                <!-- <p data-aos="fade-up" data-aos-duration="600" class="lead text-white text-center text-md-left my-5 rounded"><span class="border-bottom pt-3">Hallo <i class="fas fa-grin-hearts"></i> pengunjung.</span></p> -->
                <?php $this->load->view('msg/flashdata'); ?>
                <div data-aos="fade-up" data-aos-duration="800" class="display-2 text-white font-weight-bold text-center mt-5">Selamat Datang</div>
                <!-- Static halo -->
                <p data-aos="fade-up" data-aos-duration="1000" class="lead text-white intro-website text-center mt-md-2">Website Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah</p>
                <!-- Dinamic mengunakan typed.js -->
                <!--                 <p class="halo_bkppd"><span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> <span>Update informasi resmi seputar layanan kepegawaian serta artikel terkait lainya langsung dari website kami.</span> <span>Websites Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</span> </p>
                <span id="typed" class="lead text-secondary intro-website"></span>
                -->
                <form class="form-horizontal" id="caripegawai" method="GET" action="<?= base_url('frontend/v1/pegawai/detail') ?>">
                                <div class="typeahead__container form-group text-center">
                                    <label for="js-nipnama" class="text-white  border-bottom pb-2 small">Masukan NIP, kemudian pilih detail untuk menampilkan profile pegawai</label>
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
                <p class="mt-md-5 text-center">
                    <button data-aos="fade-zoom-in" data-aos-once="true" data-aos-duration="1200" type="button" onclick="explore()" class="btn shadow-lg rounded btn-outline-white py-3 px-4 text-uppercase">
                    Update Informasi <i class="fas fa-chevron-down animated fadeInDown infinite ml-2"></i>
                    </button>
                    <a data-aos="fade-zoom-in" data-aos-once="true" data-aos-duration="1400" target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn py-3 btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a data-aos="fade-zoom-in" data-aos-once="true" data-aos-duration="1600" target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn  py-3 btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Our Instagram" data-username="<?= $mf_beranda->ig; ?>">
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
