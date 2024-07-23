<section>
	<div class="container bg-white pt-3">
		<?= form_open(base_url('frontend/v1/post/update_post_link/1'), ['id' => 'f_post'], ['id_berita' => $post->id_berita]) ?>
		<div id="title" class="sr-only"><?= $post->judul ?></div>
		<div class="row">
			<div class="col-md-12">
				<div class="btn-group mr-2 mt-md-0 mt-3" role="group" aria-label="button">
					<button type="button" class="btn btn-dark" disabled>Kategori</button>
					<button type="button" class="btn btn-default">#<?= $this->postlist->get_namakategori($post->fid_kategori) ?></button>
				</div>
				<div class="btn-group float-right">
					<button type="submit" class="btn btn-outline-primary"><i class="far fa-share-square mr-2"></i>Simpan perubahan</button>
					<button class="btn btn-danger" type="button" onclick="window.close()"><i class="fas fa-close"></i></button>
				</div>
				<div class="d-flex my-3">
					<div class="w-100">
						<label for="judul">Judul</label>
						<input type="text" id="judul" name="judul" value="<?= $post->judul ?>" class="form-control form-control-lg">
					</div>
				</div>
				<div class="form-group">
					<select name="tags[]" id="tags" class="form-control" multiple="multiple" readonly>
						<?php
						foreach ($tags as $t) :
							$tag = $post->tags;
							$fid_tags = explode(",", $tag);
						?>
							<option <?= in_array($t->nama_tag, $fid_tags) ? 'selected' : '' ?> value="<?= $t->nama_tag ?>"><?= $t->nama_tag ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="basic-url">PASTE URL <span class="text-light mx-2">|</span> <i class="fas fa-trash text-danger" id="trash" data-toggle="tooltip" title="Kosongkan URL"></i></label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3"><i class="fas fa-link"></i></span>
						</div>
						<input type="text" class="form-control form-control-lg" name="content" value="<?= $post->content ?>" id="basic-url" aria-describedby="basic-addon3">
					</div>
				</div>
			</div>
		</div>
		<div class="row bg-primary">
			<div class="col-md-6 offset-md-3 py-4">
				<div id="preview"></div>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</section>
<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2-materialize.css') ?>">
<script defer src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>" crossorigin="anonymous"></script>
<script defer src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>" crossorigin="anonymous"></script>
<script defer src="<?= base_url('template/v1/js/route.js') ?>" crossorigin="anonymous"></script>
<script defer src="<?= base_url('template/v1/js_userportal/p_baru_link.js') ?>" crossorigin="anonymous"></script>