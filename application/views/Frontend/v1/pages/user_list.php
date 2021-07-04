
<section class="pt-md-5">
	<div class="container">
		<div class="row mt-lg-5 mt-md-5">
			<table class="table table-borderless table-condensed table-striped table-light">
				<thead>
					<tr>
						<th>Detail</th>
						<th>Photo</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($userlist as $u): ?>
					<?php  
						$role = $u->role === 'EDITOR' ? '<span class="badge badge-primary">EDITOR</span>' : '<span class="badge badge-light">TAMU</span>'; 
						$online = $u->online === 'ON' ? '<span class="text-success animated fadeIn infinite"> Online</span> ' : '<span class="text-secondary"> Offline</span>';
					?>
						<tr>
							<td>
								<div class="small text-muted">Tanggal Bergabung</div> 
								<?= longdate_indo($u->tanggal_bergabung) ?>
								<br>
								<div class="small text-muted">Nama</div> 
								<?= decrypt_url($u->nama_lengkap) ?>
								<div class="small text-muted">Status</div> 
								<?= $online ?>

							</td>
							<td><img width="90" src="<?= img_blob($u->photo_pic) ?>" alt="<?= $u->nama_lengkap ?>"></td>
						</tr>
						<tr>
							
							<td colspan="2">
								<a href="<?= base_url('user/'.decrypt_url($u->nama_panggilan).'/'.encrypt_url($u->id_user_portal)) ?>" class="btn btn-outline-light btn-sm btn-block mt-2">View profile</a>
							</td>
						</tr>
		        	<?php $no++; endforeach; ?>
				</tbody>
			</table>
			
			<!-- <div class="col-12 col-md-3 mb-3">
				<div class="card">
                    <div class="card-body bg-white text-center rounded px-0">
                    	
                        <img class="w-25 h-25 rounded" src="<?= img_blob($u->photo_pic) ?>" alt="<?= $u->nama_lengkap ?>">
                        <br> <?= $online ?>
                        <a href="<?= base_url('user/'.decrypt_url($u->nama_panggilan).'/'.encrypt_url($u->id_user_portal)) ?>" class="btn btn-outline-light btn-sm mx-auto mt-2">Profile</a>
                        <div class="border-top border-light my-2 py-2"><?= decrypt_url($u->nama_lengkap) ?></div> <?= $role ?> 
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>