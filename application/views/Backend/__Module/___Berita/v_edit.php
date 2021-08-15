
<div class="row clearfix">

<?= form_open_multipart('backend/module/c_berita/update', '', ['id_berita' => $this->uri->segment(5), 'file_old' => $e->img]) ?>
<div class="col-md-8">

					<?php $this->view('msg/flashdata') ?>
				<div class="m-t-25">
					<div id="message"></div>
					<div class="form-group">
						<label for="title">Judul</label>
						<div class="form-line">
							<input type="text" name="title_berita" id="title" class="form-control"
								placeholder="Masukan judul berita disini..." value="<?= $e->judul ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="content">Content</label>
								<textarea type="text" name="isi_berita" id="isi_berita"
									class=" form-control"><?= $e->content ?></textarea>
					</div>

          <div class="card card-border noShadow">
						<div class="header">
              <h2 class="card-title">Komentar</h2>
             <small> izinkan public memberikan komentar</small>
						</div>
						<div class="body">
             <div class="form-group">
								<div class="row">
									<div class="col-md-12">
                  <?php
                    if($e->komentar_status == '0') {
                  ?>
										<input name="sts_komentar" checked value="0" type="radio" id="radio1" class="radio-col-teal">
										<label for="radio1">PUBLIC</label>

										<input name="sts_komentar" value="1" type="radio" id="radio2" class="radio-col-orange">
										<label for="radio2">PRIVETE MEMBER</label>
                    <?php } else { ?>
                      <input name="sts_komentar" value="0" type="radio" id="radio1" class="radio-col-teal">
                      <label for="radio1">PUBLIC</label>

                      <input name="sts_komentar" checked value="1" type="radio" id="radio2" class="radio-col-orange">
                      <label for="radio2">PRIVETE MEMBER</label>
                    <?php } ?>
									</div>
								</div>
              </div>
              
						</div>
          </div>
				</div>
	</div>

	<div class="col-md-4">
	<div class="card card-border m-t-25">
						<div class="header">
							<h2 class="card-title">Publish</h2>
						</div>
						<div class="body">
            <div class="form-group">
                  <select name="kategori" id="kategori">
											<?php 
												foreach($kategori as $k):
											?>
												<option <?= $k->id_kategori == $e->fid_kategori ? 'selected' : '' ?> value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
											<?php endforeach ?>
									</select>
							</div>
							<div class="form-group">
								<label>Thumbnail Foto</label>
								<div class="text-center p-t-5 p-b-5 p-l-5 p-r-5 border-dot border-3 border-col-grey"
									id="img-edit-album">
									<img id="preview" src="<?= base_url('files/file_berita/'.$e->img) ?>" class="img-responsive">
								</div>

								<div class="form-line"><input type="file" name="gambar" class="form-control col-teal"  accept="image/*" onchange="showImg(event)"></div>
							</div>
							<div class="form-group">
								<label>Publish</label>
								<div class="row">
									<div class="col-md-12">
                  <?php
                    if($e->publish == '1') {
                  ?>
					<div class="switch">
						<label>Tidak <input name="publish" type="hidden" value="0"> <input name="publish" type="checkbox" checked value="1"> <span class="lever"></span> Ya</label>
					</div>
                  <?php } else { ?>
					<div class="switch">
						<label>Tidak <input name="publish" type="hidden" checked value="0"> <input name="publish" type="checkbox" value="1"> <span class="lever"></span> Ya</label>
					</div>
                  <?php } ?>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Headline</label>
								<div class="row">
									<div class="col-md-12">
										<input name="headline" <?= ($e->headline == '1') ? 'checked' : '' ?> value="1" type="radio" id="radio5" class="with-gap radio-col-teal">
										<label for="radio5">Ya</label>

										<input name="headline" <?= ($e->headline == '0') ? 'checked' : '' ?> value="0" type="radio" id="radio6" class="with-gap radio-col-pink">
										<label for="radio6">Tidak</label>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit"  class="btn btn-sm btn-primary waves-effect pull-right">UPDATE</button>
						</div>
					</div>

          <div class="card card-border">
						<div class="header">
							<h2 class="card-title">Kutipan Pendek Penulis</h2>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" role="button" data-toggle="collapse" data-target=".collapse-penulis"
									aria-expanded="false" aria-controls="collapseExample">
										<i class="material-icons">keyboard_arrow_down</i>
									</a>
								</li>
							</ul>
						</div>
						<div class="body collapse-penulis collapse in">
								<div class="image">
                    <img src="<?= base_url('assets/images/users/'.$this->session->userdata('gravatar')) ?>" width="48" height="48" alt="User">
                </div>
              <div class="form-group">
                <div class="form-line">
                  <textarea name="katapenulis" id="katapenulis" class="form-control" placeholder="Masukan pesan penulis, atau deskripsikan tentang penulis"><?= $e->note ?></textarea>
									</div>
              </div>
						</div>
					</div>

					<div class="card card-border">
						<div class="header">
							<h2 class="card-title">Label / Tags</h2>
						</div>
						<div class="body">
              <div class="form-group">
									<select name="tags[]" id="tags" data-value="<?= $e->tags ?>" class="form-control" multiple="multiple">
											<?php 
												foreach($tags as $t):
												$tag = $e->tags;
												$fid_tags = explode(",", $tag);
											?>
												<option <?= in_array($t->nama_tag, $fid_tags) ? 'selected' : '' ?> value="<?= $t->nama_tag ?>"><?= $t->nama_tag ?></option>
											<?php endforeach ?>
									</select>                
              </div>
						</div>
					</div>
				</div>	
			<?= form_close() ?>
</div>
