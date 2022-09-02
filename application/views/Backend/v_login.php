<?= doctype('html5'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <?= meta('X-UA-Compatible', 'IE=Edge; charset=utf-8', 'equiv'); ?>
    <?= meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'); ?>
    <title><?= $titlebar; ?></title>
    <!-- Favicon-->
    <?= link_tag('assets/images/favicon2.png', 'shortcut icon', 'image/x-icon'); ?>

    <!-- Link Tags -->
    <?php
    foreach ($autoload_css as $css):
        echo link_tag($css);
    endforeach;
    ?> 
    <style>
    @media (min-width: 160px) and (max-width: 600px) {
	.login-page .card {
		border: 0px;
        box-shadow: none;
    }
    .login-page .card .header img {
        top: 0;
    }
        img {
            display: none;
        }
    }
    </style>
</head>

<body class="login-page">
<!--<div id="particles-js"></div>-->
<audio src="<?= site_url('assets/audio/ukulele-BGM.mp3'); ?>" autoplay="true" hidden="true" loop="true" id="BgmLogin">
<p>If you are reading this, it is because your browser does not support the audio element.</p>
</audio>
        <div class="card loginBoxes">
            <?php
                $gtmsg = $_GET['message'];
                if ($gtmsg == 'unset') {
                    ?>
            <div class="alert bg-greadient-redpurple alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Session anda habis. Silahkan login kembali !!!
            </div>
            <?php
                } elseif ($gtmsg == 'sign-out') {
                    ?>    
            <div class="alert bg-greadient-greywhite alert-dismissible" role="alert">
                <button type="button" class="close col-black" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="col-blue">Anda telah keluar dari sistem, terimakasih.</span>
            </div>
            <?php
                } ?>
            <div class="header text-center">
            <img src="<?php echo site_url('assets/images/logo.png'); ?>" alt="logo" class="img-rounded" width="70">
            <!-- <div class="logo" id="title-app"> 
                <a href="javascript:void(location.reload());" class="col-green">
                    <?= $title; ?>
                </a>  
            </div> -->

            <h3>BKPPD KAB. BALANGAN</h3>
            <span>Masuk sebagai, <b><?= $this->madmin->getNamaAkses($this->uri->segment(3)); ?></b> (<?= $os; ?>)</span>
            
            <!-- <div id="tagline">
                <b><?= $tagline; ?></b>
            </div>  -->
            
                <!--<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Contact Administrator?">
                    <span class="text-center"><em class="material-icons pull-right m-r-5">info_outline</em> </span>
                </a>-->
            </div>
			<div class="login-box">
            <div class="body">
                <!-- <form id="sign_in" method="POST"> -->
                <?= form_open('login/cek', array('id' => 'sign_in', 'autocomplete' => 'off')); ?>
                    <div id="msg"></div>
                    <div class="row clearfix body-login">
                        <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon" >
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username" placeholder="Username" id="usr">
                                        <!-- <label for="usr" class="form-label">Username</label> -->
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" placeholder="Password" id="pwd">
                                        <!-- <label for="pwd" class="form-label">Password</label> -->
                                    </div>
                                    <span class="input-group-addon">
                                        <a href="javascript:void(0)" toggle="#pwd" class="glyphicon glyphicon-eye-open icon toggle-password">
                                        </a>
                                    </span>
                                </div>
                        </div>
                    </div>
                    
                   
                    <div class="input-group">
                        <span class="input-group-addon">
                            <a href="javascript:void(0)" class="waves-effect waves-effect" onclick="repeat()" data-toggle="tooltip" data-placement="left" title="Acak Validasi">
                            <i class="glyphicon glyphicon-repeat"></i>
                            </a>
                        </span>
                        <div class="pull-left m-t-10 m-r-15">
                            <span id="angak_pertama"></span>  
                                <b class="text-danger m-l-15 m-r-15" id="plus">+</b>  
                            <span id="angak_kedua"></span> 
                                <b class="text-danger" id="samadengan"> = </b>
                            <input type="hidden" name="validasi_hidden">
                        </div>
                        <div class="pull-right">
                        <ul class="list-unstyled" id="user_sesi">
                        <?php foreach ($lastlogon as $v): ?>
                            <li class="pull-right" data-toggle="tooltip" title="<?= strtoupper($v->nama_lengkap).', '.date_indo(substr($v->sesi_logout, 0, 10)); ?> : <?= substr($v->sesi_logout, 10, 6); ?>" data-placement="right"> 
                                 
                                <img src="<?= site_url('assets/images/users/'.$v->gravatar); ?>" class="radius-full m-t-15" alt="<?= $v->nama_lengkap; ?>" width="48" height="48">
                            </li><br>
                        <?php endforeach; ?>
                        </ul>
                        </div>
                        <div class="form-line" style="width:90px;">
                            <input type="text" class="form-control" name="validasi">
                        </div>
                        <div id="helpBlock" class="help-block font-12 pull-left">Masukan hasil dari penjumlahan diatas,<br> untuk melanjutkan login anda pada aplikasi.</div> 
                        
                    </div>                    
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <a href="<?php echo base_url('beranda'); ?>" class="btn p-8 btn-block btn-rounded btn-link waves-effect">&larr; Beranda</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                           <button type="submit" style="padding:10px 15px" class="btn btn-block btn-rounded waves-effect waves-light pull-right btn-success  waves-float" id="login" type="button"><em class="glyphicon glyphicon-send m-r-10"></em> MASUK</button> 
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <div class="text-center login-footer">&copy; Pemerintah Kabupaten Balangan Tahun <?php echo date('Y') ?> &bull; Badan Kepegawaian Pendidikan dan Pelatihan Daerah</div>
    <?php
    foreach ($autoload_javascript as $script):
        echo script_tag($script);
    endforeach;
    $this->load->view($sidejs);
    ?> 
</body>

</html>