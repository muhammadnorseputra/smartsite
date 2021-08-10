<h4 class="px-3 py-4 m-0 border-bottom border-light animated fadeIn">Tabel Galeri <a href="<?php echo base_url('frontend/v1/album/new_album') ?>" title="Buat Album Baru" data-toggle="tooltip" class="btn btn-sm btn-primary rounded-circle border-0 shadow float-right"><i class="fas fa-plus"></i></a></h4>
<div class="table-responsive animated fadeIn">
	<table data-id="<?= $username ?>" class="table table-borderless table-condensed display" id="table-postingan">
		<thead class="thead-light">
			<tr>
				<!-- <th class="text-center">No</th> -->
				<th class="text-center" width="30">#</th>
				<th class="text-center">Album</th>
				<th>Keterangan</th>
				<th class="text-center"><i class="fas fa-images"></i></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1; 
				if($fotos->num_rows() > 0):
				foreach($fotos->result() as $foto): 
			?>

			<tr>
				<!-- <td class="text-center font-weight-bold"><?= $no ?></td> -->
				<td class="text-center">
					<?php 
						if($foto->upload_by === $username):
					?>
					<div class="dropdown dropright">
					  <button id="dLabel" class="btn btn-lg border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fas fa-ellipsis-h p-2"></i>
					  </button>
						<div class="dropdown-menu" aria-labelledby="dLabel">
					    <a class="dropdown-item text-muted rounded-pill" href="#"><i class="fas fa-edit mr-2"></i> Edit</a>
						<a class="dropdown-item text-muted rounded-pill" href="<?= base_url('frontend/v1/album/hapus_album/'.encrypt_url($foto->id_album_foto)) ?>"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
					  </div>
					</div>
				<?php endif; ?>
				</td>
				<td class="text-center w-25"><img class="rounded img-fluid" src="<?= base_url('files/file_album/'.$foto->gambar) ?>" alt="<?= $foto->keterangan ?>"><br>
					<div class="py-1 mt-2 border-top font-weight-bold">
					<?php if($this->album->jml_photo_in_album($foto->id_album_foto) > 0): ?>
						<span class="text-success"><?= $this->album->jml_photo_in_album($foto->id_album_foto) ?></span> Photo 
					<?php else: ?>
						<span class="text-muted">Belum ada Photo</span> 
					<?php endif; ?>
					</div>
				</td>
				<td>
					<table class="table table-borderless table-sm bg-transparent table-condensed display">
						<tr>
							<td width="120">Judul</td>
							<td><b><?= $foto->judul ?></b></td>
						</tr>
						<tr>
							<td>Published</td>
							<td><b><?= $foto->publish === 'Y' ? '<i class="fas fa-check-circle text-success"></i>' : 'Tidak'; ?></b> </td>
						</tr>
						<tr>
							<td>Publish at</td>
							<td><small><?= date_indo(substr($foto->upload_at,0,10)) ?></small></td>
						</tr>
						<tr>
							<td>Deskripsi</td>
							<td><?= $foto->keterangan ?></td>
						</tr>
						<tr>
							<td>Published by</td>
							<td><b><?= $foto->upload_by ?></b></td>
						</tr>
					</table>
				</td>
				<td>
					<div class="d-flex justify-content-center align-items-center">	
						<div>
							
						<a href="<?= base_url('frontend/v1/album/open/'.encrypt_url($foto->id_album_foto)) ?>" class="btn btn-sm btn-primary my-auto" data-toggle="tooltip" title="Open Album"><i class="fas fa-folder-open"></i></a>
						</div>
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
	/*Tooltips*/
	$('[data-toggle="tooltip"]').tooltip();
</script>