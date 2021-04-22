<section class="hero py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12 my-5 pt-4 text-left">
				
			</div>
		</div>
	</div>
</section>
<section class="mt--9">
	<div class="container">
		<div class="row mt-lg-5 mt-md-5">
			<?php foreach ($userlist as $u): ?>
			<?php  
				$role = $u->role === 'EDITOR' ? '<span class="badge badge-primary">EDITOR</span>' : '<span class="badge badge-light">TAMU</span>'; 
				$online = $u->online === 'ON' ? '<span class="text-success animated fadeIn infinite">&bull; Online</span> ' : '<span class="text-secondary">&bull; Offline</span>';
			?>
			<div class="col-md-3">
				<div class="card border-0">
                    <div class="card-body bg-white text-center">
                    	
                        <img class="w-50 h-50 rounded-circle" src="<?= img_blob($u->photo_pic) ?>" alt="<?= $u->nama_lengkap ?>">
                        <hr>
                        <h6><?= decrypt_url($u->nama_lengkap) ?></h6> <?= $role ?> <br> <?= $online ?>
                        <hr>
                        <a href="<?= base_url('user/'.decrypt_url($u->nama_panggilan).'/'.encrypt_url($u->id_user_portal)) ?>" class="btn btn-success btn-block">Profile</a>
                    </div>
                </div>
            </div>
        	<?php endforeach; ?>
        </div>
    </div>
</section>