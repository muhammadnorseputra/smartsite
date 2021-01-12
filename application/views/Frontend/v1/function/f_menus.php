
<div>
	<ul class="my-0 py-0">
		<li><a href="<?php echo base_url("frontend/v1/users/akun/".$this->session->userdata('nama_panggilan').'/'.encrypt_url($this->session->userdata('nohp'))) ?>"><i class="far fa-user mr-2"></i> Profile</a></li>
		<li><a href="<?= base_url('frontend/v1/post/judul') ?>"><i class="fas fa-pencil-alt mr-2" aria-hidden="true"></i> Buat Postingan</a></li>
		<li><a href="<?= base_url('frontend/v1/halaman/halamanstatis/add') ?>"><i class="fas fa-newspaper mr-2" aria-hidden="true"></i> Buat Halaman</a></li>
		<li><a href="<?= base_url('frontend/v1/users/edit/'.encrypt_url($this->session->userdata('id'))); ?>"><i class="fas fa-cog mr-2" aria-hidden="true"></i> Pengaturan akun</a></li>
		<li></li>
		<li><a href="<?php echo base_url('frontend/v1/users/logout') ?>"><i class="fas fa-sign-out-alt mr-2"></i>  Logout</a></li>
	</ul>
</div>	