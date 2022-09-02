<?php  
$status = ($check_verify->email_verifikasi == 'Y') ? 'Email Verify' : 'Email Not Verify';
$desc = ($check_verify->email_verifikasi == 'Y') ? 'Email '.decrypt_url($check_verify->nama_lengkap).' sudah terverifikasi.' : 'Email Not Verify';
?>

<?php if($check_verify->email_verifikasi == 'Y'): ?>
<section class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 mt-lg-5 mt-md-5">
				<div class="card shadow">
                    <div class="card-header text-center bg-white border-bottom-0">
                        <h1>#<?php echo $status ?></h1>
                        <p class="font-weight-light"><?php echo $desc ?></p>
                    </div>
                    <div class="card-body text-center bg-white">
                        <div class="text-success mb-5">
                            <i class="far fa-7x fa-check-circle"></i>
                        </div>
                        <p>
                            akun kamu sudah terverifikasi, silahkan login dengan akun yang sudah kamu daftarkan.
                        </p>
                        <a href="<?php echo base_url('frontend/v1/users/login') ?>" class="btn btn-block btn-primary"><i class="fas fa-lock mr-3"></i> Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>