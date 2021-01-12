<?php
$count_v = $post_detail->views;
$count = $count_v + 1;
$this->post->update_count_post(decrypt_url($this->uri->segment(6)), $count);
$by = $post_detail->created_by;
if ($by == 'admin') {
	$namalengkap = $this->mf_users->get_namalengkap($post_detail->created_by);
	$namapanggilan = $by;
	$photo = base_url('assets/images/users/' . $this->mf_users->get_gravatar($by));
	$link_profile_public = 'javascript:void(0);';
} else {
	$namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));;
	$namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
	$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic) . '';
	$link_profile_public = base_url("frontend/v1/users/profile/@" . decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan) . "/" . encrypt_url($by));
}
$btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('id'), $post_detail->id_berita) == 'on' ? 'btn-bookmark' : '';
$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('id'), $post_detail->id_berita) == 'on' ? 'fas text-primary' : 'far';
$btn_like = $this->mf_beranda->get_status_like($this->session->userdata('id'), $post_detail->id_berita) == true ? 'btn-like' : '';
$status_like = $this->mf_beranda->get_status_like($this->session->userdata('id'), $post_detail->id_berita) == true ? 'fas text-danger' : 'far';
if(empty($post_detail->img)):
$img = '<img class="img-fluid card-img-top rounded-0" src="data:image/jpeg;base64,'.base64_encode( $post_detail->img_blob ).'"/>';
else:
$img = '<img class="img-fluid card-img-top rounded-0" src="'.$post_detail->path.'">';
endif;
?>
<section>
	<div class="container">
		<div class="row mt-4">
			<div class="col-md-7 mt-5 mb-md-5 offset-md-1">
				<div class="card border border-light rounded bg-white">
					<div class="card-body">
						<img data-src="<?= $photo; ?>" width="60" height="60" class="float-left mr-3 lazy rounded shadow-sm">
						<h5 class="card-title"><a href="<?= $link_profile_public ?>"><?= $namalengkap ?></a></h5>
						<p class="card-text">
							<span class="badge badge-default px-0 text-muted">@<?= ucwords($namapanggilan); ?> &#8226;  <?php echo longdate_indo($post_detail->tgl_posting); ?></span></p>
						</div>
						<?= $img ?>
						<div class="card-body">
							<h1 class="font-weight-bold display-5"><?php echo $post_detail->judul; ?></h1>
							<?php
							$tags = $post_detail->tags;
							$pecah = explode(',', $tags);
							if (count($pecah) > 0) {
								$tag = '';
								for ($i = 0; $i < count($pecah); ++$i) {
									$tag .= '<a href="' . base_url('frontend/v1/post_list/tags?q=' . $pecah[$i]) . '" class="btn btn-sm btn-outline-dark mr-2 mb-1">#' . $pecah[$i] . '</a>';
								}
							}
							?>
							<p>
								<?= $tag; ?>
							</p>
							<p class="card-text font-weight-normal"><?php echo nl2br($post_detail->content); ?></p>
							
						</div>
						<div class="card-footer bg-white py-0 px-0 border-light">
							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Dilihat" class="btn btn-transparent border-right border-light rounded-0 p-3 float-left"><i class="far fa-eye mr-2"></i> <?= $count; ?> </button>
							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Share This" id="btn-share" data-row-id="<?= $post_detail->id_berita; ?>" class="btn btn-transparent border-right border-light float-left rounded-0 p-3"><i class="fas fa-share-alt mr-2"></i> <span class="share_count"><?= $post_detail->share_count; ?></span></button>
							<button type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-secondary rounded-0 p-3 <?= $btn_like ?>" title="Suka / Tidak suka" data-id-berita="<?= $post_detail->id_berita ?>" data-id-user="<?= $this->session->userdata('id') ?>"><i class="<?= $status_like ?> fa-heart mr-2"></i> <span class="count_like"><?= $post_detail->like_count ?></span> </button>
							<button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-left border-light rounded-0 pt-3 pb-3 pr-4 pl-4 float-right <?= $btn_bookmark ?>" title="Simpan Postingan" data-id-berita="<?= $post_detail->id_berita ?>" data-id-user="<?= $this->session->userdata('id') ?>"><i class="<?= $status_bookmark ?> fa-bookmark"></i> </button>
						</div>
					</div>
					<?php if($post_detail->komentar_status == 0): ?>
					<div class="card border-top-0 rounded-0 border-light bg-white">
						<div class="card-body p-0" style="max-height: 480px; overflow-y: auto;">
							<div id="tracking">
								<div class="tracking-list">
								</div>
							</div>
							
						</div>
					</div>
					<div class="card border-light border-top-0 rounded-0 bg-white">
						<div class="card-body">
							
							<?php if ($this->session->userdata('online') == 'ON') { ?>
							<h5 class="card-title"><i class="far fa-comment-alt mr-2"></i> Post Komentar</h5>
							<?= form_open(base_url('frontend/v1/post/send_komentar'), ['id' => 'f_komentar', 'class' => $post_detail->id_berita]) ?>
							<div class="form-group">
								<textarea class="form-control" name="isi_komentar" id="exampleFormControlTextarea1"></textarea>
							</div>
							<button type="submit" class="btn btn-light btn-outline-primary">Kirim</button>
							<?= form_close() ?>
							<?php } else { ?>
							<p class="text-center"><b>Login Dulu, Ya!</b></p>
							<p class=" text-center text-muted">Mau ikutan diskusi? Untuk ikutan diskusi kamu harus punya identitas, maka dari itu login dulu.</p>
							<a href="<?php echo base_url('frontend/v1/users/login?msg=logindulu') ?>" class="btn btn-dark btn-md btn-block"><i class="fas fa-lock mr-3"></i> Login</a>
							<?php } ?>
						</div>
					</div>
					<?php else: ?>
					<div class="alert alert-warning text-center font-italic my-3" role="alert">
						Diskusi publik tidak diinjinkan.
					</div>
					<?php endif; ?>
				</div>
				<div class="col-md-3 my-5">
					<div id="sidebar" class="sidebar">
						<div class="mx-auto my-auto">
							<h5 class="mb-3 font-weight-bold text-dark title-sidebar"><span class="font-weight-bold"><i class="fas fa-quote-left fa-pull-left text-danger mr-2"></i>Berita Selanjutnya</span></h5>
							<?php
							$by = $berita_selanjutnya->created_by;
							$id = encrypt_url($berita_selanjutnya->id_berita);
							$postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($by))));
							$judul = strtolower($berita_selanjutnya->judul);
							$posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
							if ($by == 'admin') {
							$namapanggilan = $by;
							} else {
							$namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
							}
							if(empty($berita_selanjutnya->img)):
							$img = '<img class="figure-img img-fluid rounded lazy mx-auto text-center d-block border-light" src="'.base_url("bower_components/SVG-Loaders/svg-loaders/oval.svg").'" data-src="data:image/jpeg;base64,'.base64_encode( $berita_selanjutnya->img_blob ).'"/>';
							else:
							$img = '<img class="figure-img img-fluid rounded lazy mx-auto text-center d-block border-light" src="'.base_url("bower_components/SVG-Loaders/svg-loaders/oval.svg").'" data-src="'.$berita_selanjutnya->path.'">';
							endif;
							?>
							<figure class="figure d-block mt-3 mt-md-0">
								<a href="<?= $posturl ?>" class="text-link">
									<span class="rippler rippler-img rippler-bs-danger">
										<?= $img ?>
									</span>
									<figcaption class="figure-caption">
									<?= $berita_selanjutnya->judul; ?>
								</a>
								</figcaption>
							</figure>

                            
                                
                        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>