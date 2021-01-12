<?php 
if($this->session->flashdata('msg')['valid'] == true) {
    $jhon = "Josss, selamat bergabung <b>".decrypt_url( $this->session->flashdata('msg')['data']['nama_lengkap'])."</b>"; 
    $msg = $this->session->flashdata('msg')['msg'];
    $bg_status = 'bg-primary';
} else {
    $jhon = "Oops, Sepertinya ada kesalaan broo, check email kamu yaaa.";
    $msg = 'Oops!';
    $bg_status = 'bg-danger';
}
$img_user = $this->session->flashdata('msg')['data']['photo_pic'];
?>
<section class="<?= $bg_status ?> mt-5 rellax">
	<div class="container">
		<div class="row">
			<div class="col-md-12 py-5 text-white text-center">
				<h1>#<?= $msg ?></h1>
				<p class="font-weight-light"><?= $jhon ?> </p>
			</div>
		</div>
	</div>
</section>
<?php if($this->session->flashdata('msg')['valid'] == true): ?>
<section class="mt--5 mb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card">
                    <div class="card-body text-center">
                        <img src="data:image/jpeg;base64,<?= base64_encode($img_user) ?>" class="img-fluid mx-auto d-block  shadow img-thumbnail mb-3" alt="photo_pic" width="150" height="150">
                        
                        <p>
                            <?= $this->session->flashdata('notif');  ?>
                        </p>
                        
                        <h5 class="font-weight-bold"><?= decrypt_url($this->session->flashdata('msg')['data']['email']) ?></h5>
                        <a href="https://www.gmail.com" target="_blank" class="d-block mx-auto my-3 btn btn-warning"><i class="fas fa-mail-bulk"></i> Lakukan verifikasi email</a>
                        <p class="font-weight-light">
                            Silahkan buka email kamu pada folder utama / spam, lalu cari notifikasi dari kami dan klik tombol verifikasi yang telah kami sediakan.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>