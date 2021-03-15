<?php $id = $this->uri->segment(5) ?>
<section class="hero py-5">
	<div class="container py-5">
		<div class="col-md-8 offset-md-2 py-3 d-flex justify-content-between align-items-center">
			<div>
				<span class="text-muted">Photo in album:</span>
				<h5><span class="text-primary font-weight-bold"><?= $this->album->judul_album_by_id(decrypt_url($id)) ?></span></h5>
			</div>
			<div>
				<a href="<?= base_url('frontend/v1/album/tambah_photo/'. $id) ?>" class="btn btn-primary"><i class="fas fa-image"></i> Upload Photo</a>
				<button onclick="window.history.back(-1)" class="btn btn-danger">Kembali <i class="fas fa-arrow-right"></i></button>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
<div class="container">
	<div class="col-md-8 offset-md-2 p-2">
		<?php $this->load->view('msg/flashdata'); ?>
		<table class="table table-borderless">
			<tbody>
				<?php if($photos->num_rows() > 0): ?>
				<?php foreach($photos->result() as $photo): ?>
				<tr class="bg-white rounded">
					<td width="140">
						<img class="rounded img-fluid" src="<?= base_url('files/file_galeri/thumb/'.$photo->gambar) ?>" width="120" alt="<?= $photo->keterangan ?>">
					</td>
					<td>
						<b><?= $photo->judul ?></b>
						<p>
							<?= word_limiter($photo->keterangan, 10) ?>
						</p>
						<p class="text-secondary small">
							Posted by: <?= $photo->upload_by ?> &bull; At: <?= longdate_indo($photo->tgl_publish) ?> <br>
							<?php if(!empty($photo->update_by)): ?>
							Edited last by: <?= $photo->update_by ?> &bull; At: <?= longdate_indo(substr($photo->update_at,0,10)) ?>
							<?php endif; ?>
						</p>
					</td>
					<td class="d-flex align-content-center justify-content-between">
						<a data-toggle="tooltip" title="Edit Photo" href="<?= base_url('frontend/v1/album/edit_photo/'.encrypt_url($photo->id_foto)) ?>" class="btn btn-sm btn-primary px-3 mx-2"><i class="fas fa-edit"></i></a>
						<a  data-toggle="tooltip" title="Hapus Photo" onclick="return confirm('Apakah anda yakin akan menghapus foto tersebut?')" href="<?= base_url('frontend/v1/album/hapus_photo/'.encrypt_url($photo->id_foto)) ?>" class="btn btn-sm btn-default btn-link text-danger"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php else: ?>
					<div class="text-secondary text-center">
						<img src="<?= base_url('assets/images/noimage.gif') ?>" class="w-25 my-5" alt="empty"> 
						<h5>Belum ada photo</h5>
					</div>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
</section>