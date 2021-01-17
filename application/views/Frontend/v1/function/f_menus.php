<?php  
$d = $this->mf_users->detail_user(encrypt_url($this->session->userdata('email')));
?>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	<a class="dropdown-item bg-white my-1 rounded py-2 px-2" href="<?php echo base_url("frontend/v1/users/akun/".$this->session->userdata('nama_panggilan').'/'.encrypt_url($this->session->userdata('nohp'))) ?>"><i class="far fa-user mr-2"></i> Profile</a>
	<?php if($d->email_verifikasi == 'Y'): ?>
	<a class="dropdown-item bg-white my-1 rounded py-2 px-2" href="<?= base_url('frontend/v1/post/judul') ?>"><i class="fas fa-newspaper mr-2" aria-hidden="true"></i> Buat Postingan</a>
	<a class="dropdown-item  bg-white my-1 rounded py-2 px-2" href="<?= base_url('frontend/v1/halaman/halamanstatis/add') ?>"><i class="fas fa-pager mr-2" aria-hidden="true"></i> Buat Halaman</a>
	<?php endif; ?>
	<a class="dropdown-item  bg-white my-1 rounded py-2 px-2" href="<?= base_url('frontend/v1/users/edit/'.encrypt_url($this->session->userdata('id'))); ?>"><i class="fas fa-cog mr-2" aria-hidden="true"></i> Pengaturan akun</a>
	<div class="dropdown-divider"></div>
	<a class="dropdown-item  bg-white my-1 rounded py-2 px-2" href="<?php echo base_url('frontend/v1/users/logout') ?>"><i class="fas fa-sign-out-alt mr-2"></i>  Logout</a>
</div>
