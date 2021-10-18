<!-- Top Bar -->
<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <img class="imglogo pull-left m-l--10 m-r-10 hidden-xs hidden-sm" src="<?= site_url('assets/images/favicon2.png') ?>" alt="<?= $title ?>" width="45">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand m-t--10" href="#">
                    <?= $title ?> <span class="badge badge-danger"><?= $this->session->userdata('lvl'); ?></span>  <br>
                    <div class="font-11">Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia</div>
                </a>
                <!-- <span class="tagline"></span> -->
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <li aria-label="Logout Akun" class="hint--bottom hint--error">
                        <a href="javascript:void(0);" data-usrname="<?= $this->session->userdata('namalengkap') ?>" id="btnLogout" data-href="<?= base_url('login/logout') ?>" class="waves-effect waves-circle" data-close="true"><i class="material-icons">logout</i></a>
                    </li>
                    <?php if($this->session->userdata('lvl') == 'ADMIN') { ?>
                    <!-- #END# Tasks -->
                    <li class="pull-right hint--bottom-left" aria-label="Setting Administrator" >
                        <a href="javascript:void(0);" class="waves-effect waves-circle js-right-sidebar " data-close="true">
                            <i class="material-icons">more_vert</i>
                        </a>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->