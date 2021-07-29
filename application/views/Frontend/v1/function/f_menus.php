<?php  
$d = $this->mf_users->detail_user(encrypt_url($this->session->userdata('user_portal_log')['email']));
?>
<div class="dropdown-menu dropdown-menu-lg-left dropdown-menu-right" aria-labelledby="dropdownMenuButton">
	<a class="dropdown-item bg-white py-2 px-3" href="<?php echo base_url("frontend/v1/users/akun/".$this->session->userdata('user_portal_log')['nama_panggilan'].'/'.encrypt_url($this->session->userdata('user_portal_log')['nohp'])) ?>"><i class="far fa-user mr-2"></i> Profile</a>
	<a class="dropdown-item  bg-white py-2 px-3" href="<?= base_url('frontend/v1/users/edit/'.encrypt_url($this->session->userdata('user_portal_log')['id'])); ?>"><i class="fas fa-cog mr-2" aria-hidden="true"></i> Pengaturan akun</a>
	<div class="dropdown-divider"></div>
	<a class="dropdown-item  bg-white py-2 px-3" href="<?php echo base_url('frontend/v1/users/logout?urlRef='.curPageURL()) ?>"><i class="fas fa-sign-out-alt mr-2"></i>  Logout</a>
</div>