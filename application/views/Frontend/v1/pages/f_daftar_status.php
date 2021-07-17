<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
        <meta name="keywords" content="Status Registered - BKPPD BALANGAN">
        <meta name="description" content="Status Registered Userportal - BKPPD BALANGAN">
        <!-- Custome -->
        <link rel="stylesheet" href="<?= base_url('assets/css/f_daftar.css') ?>">
        <link rel="stylesheet" href="<?= base_url('bower_components/jquery-form-validator/form-validator/theme-default.min.css') ?>">
        <title>Portal - Status Registered</title>
    </head>
    <body>
<?php 
if($this->session->flashdata('msg')['valid'] == true) {
     $jhon = "Woihh, tinggal sedikit lagi nih <b>".decrypt_url( $this->session->flashdata('msg')['data']['nama_lengkap'])."</b>"; 
    $msg = $this->session->flashdata('msg')['msg'];
    $bg_status = 'bg-light';
    $icon = '';
} else {
    $jhon = "TOKEN validasi berobah, silahkan login terlebih dahulu.";
    $msg = 'Oops :)';
    $bg_status = 'bg-white';
    $icon = '<i class="fas fa-exclamation-circle fa-4x text-warning"></i>';
}
?>
<section class="<?= $bg_status ?> shadow-sm">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 py-5 text-dark text-center">
                <?= $icon ?>
				<h2 class="my-3"><?= $msg ?></h2>
				<p class="font-weight-light lead mb-3"><?= $jhon ?> </p>
                <?php  
                    if($this->session->flashdata('msg')['valid'] === false) {
                ?>
                <a href="<?= base_url('login_web?msg=sukses') ?>" class="btn btn-outline-dark"><i class="fas fa-arrow-left mr-2"></i>Kembali ke halaman login</a>
                <?php } ?>
			</div>
		</div>
	</div>
</section>
<?php if($this->session->flashdata('msg')['valid'] == false): ?>
<section class="mt-5 mb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card">
                    <div class="card-body text-center">
                        <!-- <p>
                            <?= $this->session->flashdata('notif');  ?>
                        </p>
                        
                        <h5 class="font-weight-bold"><?= decrypt_url($this->session->flashdata('msg')['data']['email']) ?></h5> -->
                        <?= form_open_multipart(base_url('frontend/v1/daftar/register_update'), 
                        ['id' => 'form_indentity'], 
                        ['emailId' => $this->session->flashdata('msg')['data']['email']]); ?>
                        <div class="my-5 d-flex justify-content-center align-items-center flex-column flex-lg-row">
                                <div class="mr-3">
                                    <img src="<?= base_url('assets/images/no-profile-picture.jpg'); ?>" alt="pic" width="140" height="140" class="rounded-circle d-block border border-secondary p-1 photo_pic mx-auto">
                                </div>
                                <div>
                                <input name="photo_pic"
                                type="file"
                                data-validation="dimension mime size"
                                data-validation-allowing="jpg,png"
                                data-validation-max-size="2M"
                                data-validation-dimension="354x472-472x710"
                                required="required">
                                
                                <span id="customFile" class="form-text text-muted small text-left">
                                Upload photo profile.<br> min: 3x4 (cm) - max: 4x6 (cm)   
                                </span>
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col text-left">
                                        <label class="font-weight-bold pb-3 pt-3 border-top">Upload Kartu Identitas
                                            <br> <span class="small text-danger">Silahkan Upload file kartu identitas anda seperti KTP/SIM/PASPORT/Sejenisnya sebagai validasi identity user.</span>
                                        </label>
                                        <img src="<?= base_url('assets/images/noimage.gif'); ?>" alt="pic" width="100%" class="photo_ktp d-block mx-auto border border-info p-1 mb-3">
                                        <input name="photo_ktp"
                                        type="file"
                                        data-validation="mime size"
                                        data-validation-allowing="jpg, png"
                                        data-validation-max-size="2M"
                                        required="required">
                                        <small id="customFile" class="form-text text-muted">
                                        Upload Kartu Identitas.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="d-block btn-block mx-auto my-3 btn btn-warning"><i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login</button>
                        <?= form_close(); ?>
                        <a href="<?= base_url('login_web') ?>" class="d-block mx-auto my-3 text-secondary btn btn-link"> Skip <i class="fas fa-arrow-right ml-2"></i></a>
                        <p class="font-weight-light small">
                            Silahkan pilih skip, jika anda ingin nanti saja melengkapinya. <br>
                            Sistem akan otomatis mengisikan secara default.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
        <script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/blockUI/jquery.blockUI.js') ?>"></script>
        <script src="<?= base_url('bower_components/jquery-form-validator/form-validator/jquery.form-validator.min.js'); ?>"></script>

        <script src="<?= base_url('assets/js/f_indentity.js') ?>"></script>
    </body>
</html>