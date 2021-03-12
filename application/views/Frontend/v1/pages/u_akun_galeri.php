<h4 class="px-3 py-3 border-bottom border-light animated fadeIn">Tabel Galeri <a href="<?php echo base_url('frontend/v1/album/new_album') ?>" title="Buat Album Baru" data-toggle="tooltip" class="btn btn-sm btn-primary rounded-circle float-right"><i class="fas fa-plus"></i></a></h4>
<div class="table-responsive p-3 my-2 animated fadeIn">
	<table data-id="<?= $id_user ?>" class="table table-condensed table-borderless table-striped display" id="table-postingan">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center" width="30"></th>
				<th class="text-center">Album</th>
				<th>Keterangan</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1; 
				if($fotos->num_rows() > 0):
				foreach($fotos->result() as $foto): 
			?>
			<tr>
				<td class="text-center"><?= $no ?></td>
				<td class="text-center">
					<?php 
						if($foto->upload_by === $id_user):
					?>
					<div class="dropdown dropright">
					  <button id="dLabel" class="btn btn-lg border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fas fa-ellipsis-h p-2"></i>
					  </button>
						<div class="dropdown-menu" aria-labelledby="dLabel">
					    <a class="dropdown-item text-muted rounded-pill" href="#"><i class="fas fa-edit mr-2"></i> Edit</a>
						<a class="dropdown-item text-muted rounded-pill" href="#"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
					  </div>
					</div>
				<?php endif; ?>
				</td>
				<td class="text-center"><img class="rounded img-fluid" src="<?= base_url('files/file_album/'.$foto->gambar) ?>" width="90" alt="<?= $foto->keterangan ?>"><br>
					<span class="badge badge-info"><?= $this->album->jml_photo_in_album($foto->id_album_foto) ?> Photo </span>
				</td>
				<td>
					Judul: <b><?= $foto->judul ?></b> <br>
					Published:  <b><?= $foto->publish === 'Y' ? 'Ya' : 'Tidak'; ?></b> <br>
					Publish at:  <b><?= date_indo($foto->upload_at) ?></b> <br>
					Deskripsi: <b><?= $foto->keterangan ?></b> <br>
					Published by: <b><?= $foto->upload_by ?></b>
				</td>
				<td>
					<div class="d-flex justify-content-center align-items-center">	
						<a href="<?= base_url('frontend/v1/album/open/'.encrypt_url($foto->id_album_foto)) ?>" class="btn btn-lg btn-primary my-auto" data-toggle="tooltip" title="Open Album"><i class="fas fa-folder-open"></i></a>
					</div>
				</td>
			</tr>
			<?php 
				$no++;
				endforeach;
				else:
			?>
			<tr>
				<td colspan="4" class="text-center">Album masih kosong, buat album dengan mengklik ikon <span class="badge badge-primary"><i class="fas fa-plus"></i></span> pojok kanan atas.</td>
			</tr>
			<?php 
				endif;
			?>
		</tbody>
	</table>
</div>
<script>
	// Tooltips
	$('[data-toggle="tooltip"]').tooltip();
</script>