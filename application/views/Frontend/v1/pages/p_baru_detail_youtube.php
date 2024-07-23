<section>
	<div class="container shadow-sm bg-white">
		<?= form_open(base_url('frontend/v1/post/update_post_youtube/1'), ['id' => 'f_post'], ['id_berita' => $post->id_berita]) ?>
		<div id="title" class="sr-only"><?= $post->judul ?></div>
		<div class="row">
			<div class="col-md-8 py-3">
				<div class="btn-group mr-2 mt-md-0 my-3" role="group" aria-label="button">
					<button type="button" class="btn btn-light" disabled>Kategori</button>
					<button type="button" class="btn btn-primary" disabled>#<?= $this->postlist->get_namakategori($post->fid_kategori) ?></button>
				</div>
				<div class="d-flex mb-2">
					<div class="w-100">
						<label for="judul"><b>Judul</b></label>
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
					<label for="basic-url"><b>ID Video Youtube</b></label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3"><i class="fab fa-youtube"></i></span>
						</div>
						<input type="text" class="form-control form-control-lg col-md-3" name="content" value="<?= $post->content ?>" id="basic-url" aria-describedby="basic-addon3">
						<small id="passwordHelpBlock" class="form-text d-block text-muted border-left border-danger pl-3">
							Kamu dapat memasukan ID dari video youtube, untuk mendapatkan ID tersebut silahkan buka video yang bersumber dari youtube. Contoh: <s>https://www.youtube.com/watch?v=</s><code>gvU_8LNK00E</code>
						</small>
					</div>
				</div>
				<hr>
				<div class="btn-group">
					<button type="button" onclick="window.close()" class="btn btn-light"><i class="fas fa-arrow-left"></i> Batal</button>
					<button type="submit" class="btn btn-block btn-primary"><i class="far fa-share-square mr-2"></i>Update & Publish</button>
				</div>
			</div>
			<div class="col-md-4 order-first order-md-last bg-light py-3">
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
<script defer src="<?= base_url('template/v1/js_userportal/p_baru_youtube.js') ?>" crossorigin="anonymous"></script>