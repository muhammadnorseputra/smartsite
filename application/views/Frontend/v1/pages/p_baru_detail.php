<?php $id_berita = $this->uri->segment(5) ?>
<section>
	<div class="container-fluid">
		<?= form_open_multipart(base_url('frontend/v1/post/update_post/1'), ['id' => 'f_post', 'data-id' => $post->id_berita]) ?>
		<div class="row mt-md-5 py-3 border-bottom">
			<div class="col-md-9">
				<div class="input-group">
				  <div class="input-group-prepend">
				    <button type="button" id="batal" class="btn btn-danger">
							<span class="fas fa-times-circle"></span>
						</button>
				  </div>
				  <div class="input-group-prepend">
				    <label  class="input-group-text" for="judul">Judul</label>
				  </div>
				  <input type="text" id="judul" name="judul" value="<?= $post->judul ?>" class="form-control" aria-label="judul">
				</div>
			</div>
			<div class="col-md-3 mt-md-0 mt-2">
				<button type="submit" class="btn btn-outline-primary"><i class="far fa-share-square mr-2"></i>Submit</button>
					<button type="button" id="draf" data-id="<?php echo $post->id_berita ?>" class="btn btn-secondary">
						<span class="fas fa-hourglass-end mr-2"></span>As Draf
					</button>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-9 py-3">
				<div class="form-group">
					<label for="content">Content <span class="badge badge-pill badge-light p-2">#<?= $this->postlist->get_namakategori($post->fid_kategori) ?></span></label>

					<div class="col-12 col-md-8 offset-md-2 px-0">
						
					<textarea class="form-control" name="content" id="content" rows="3"><?= $post->content ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3 border-left py-3 p-md-0">
				<div id="accordionExample" class="accordion">
					<?php if($post->type !== 'SLIDE'): ?>
					<!-- Accordion item 1 -->
					<div class="card rounded-0 p-0">
						<div class="card-header">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Photo utama</a>
							</h6>
						</div>
						<div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show border-0">
							<div class="card-body">
								<?php if (!empty($post->img_blob)) : ?>
									<img id="single-photo" src="data:image/jpeg;base64,<?= base64_encode($post->img_blob) ?>" alt="photo_berita" class="img-fluid border rounded shadow-sm">
									<button id="upload-img" type="button" class="btn btn-block btn-outline-danger my-2 d-block"><i class="fas fa-upload mr-2"></i>Ganti gambar</button>
									<input type="file" id="FileUpload" class="d-none" />
								<?php else : ?>
									<img id="single-photo" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/undraw_folder_x4ft.svg') ?>" class="img-fluid mx-auto d-block" alt="noimage">
									<p class="text-center text-nowrap my-2" id="FilePath">Gambar tidak ditemukan ?</p>
									<button id="upload-img" type="button" class="btn btn-outline-danger my-2 d-block mx-auto"><i class="fas fa-upload mr-2"></i>Upload</button>
									<input type="file" id="FileUpload" class="d-none" />
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if($post->type === 'SLIDE'): ?>
					<!-- Accordion item 3 -->
					<div class="card rounded-0 p-0">
						<div class="card-header shadow-sm border-0 d-flex justify-content-between align-items-center">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="false" aria-controls="collapseTree" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Photo terkait</a>
							</h6>
							<button type="button" data-toggle="modal" data-target="#uploadPhoto" id="upload" class="btn btn-sm btn-outline-primary rounded-circle"><i class="fas fa-plus"></i></button>
						</div>
						<div id="collapseTree" aria-labelledby="headingTree" data-parent="#accordionExample" class="collapse show">
								<div class="row no-gutters" id="list_photo_terkait"></div>
						</div>
					</div>
					<?php endif ?>
					<?php if($post->type === 'BERITA'): ?>
					<!-- Accordion item 4 -->
					<div class="card rounded-0 p-0">
						<div class="card-header shadow-sm border-0 d-flex justify-content-between align-items-center">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Seo</a>
							</h6>
						</div>
						<div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample" class="collapse p-3 show">
								<div class="form-group">
								  <label for="keywords" class="control-label">Keywords</label>
								  <textarea class="form-control" id="keywords" name="keywords" aria-label="Keywords" row="4"><?= $post->keywords ?></textarea>
								</div>
								<hr>
								<div class="form-group">
								  <label for="description" class="control-label">Description</label>
								  <textarea id="description" class="form-control" name="description" aria-label="Description" row="4"><?= $post->deskripsi ?></textarea>
								</div>
						</div>
					</div>
					<?php endif ?>
					<!-- Accordion item 2 -->
					<div class="card rounded-0 p-0">
						<div class="card-header shadow-sm border-0">
							<h6 class="mb-0 font-weight-bold">
								<a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="d-block position-relative text-dark text-uppercase collapsible-link py-2">Tags / Label</a>
							</h6>
						</div>
						<div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse show">
							<div class="card-body">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</section>
<!-- Modal -->
<div class="modal" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?= form_open_multipart(base_url('frontend/v1/post/upload_single_photo_terkait/'.$id_berita), ['class' => 'dropzone']) ?>
      <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2-materialize.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/dropzone/min/dropzone.min.css') ?>">
<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('files/tinymce/tinymce.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/dropzone/min/dropzone.min.js'); ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script src="<?= base_url('template/v1/js_userportal/p_baru_detail.js') ?>"></script>