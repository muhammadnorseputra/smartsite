<?php
$count_v = $post_detail->views;
$count = $count_v + 1;
$this->post->update_count_post(decrypt_url($this->uri->segment(3)), $count);
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
	$link_profile_public = base_url("user/" . decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan) . "/" . encrypt_url($by));
}
$btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == 'on' ? 'btn-bookmark' : '';
$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == 'on' ? 'fas text-primary' : 'far';
$btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == true ? 'btn-like' : '';
$status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == true ? 'fas text-danger' : 'far';
if(!empty($post_detail->img)):
$img = '<img class="img-fluid card-img-top rounded lazy" data-src="'.base_url('files/file_berita/'.$post_detail->img).'">';
else:
$img = '<img class="img-fluid card-img-top rounded lazy" data-src="data:image/jpeg;base64,'.base64_encode( $post_detail->img_blob ).'"/>';
endif;
?>
<?php
$tags = $post_detail->tags;
$pecah = explode(',', $tags);
if (count($pecah) > 0) {
	$tag = '';
	for ($i = 0; $i < count($pecah); ++$i) {
		$tag .= '<a href="' . base_url('tag/' . $pecah[$i]) . '" class="btn btn-sm btn-outline-light mr-2">#' . $pecah[$i] . '</a>';
	}
}
?>

<section class="pt-md-5 mt-md-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mb-md-5 pb-md-5 px-0 mx-md-0 mx-3">
				<div class="card rounded-lg shadow-none bg-white rounded border-0">
					<div class="card bg-transparent border-0 p-md-3 p-0">
						<div class="card-body px-0 px-md-2">
							<img data-src="<?= $photo; ?>" width="60" height="60" class="float-left mr-md-4 mr-3 lazy rounded shadow-sm">
							<h5 class="card-title"><a href="<?= $link_profile_public ?>"><?= $namalengkap ?></a></h5>
							<p class="card-text">
								<span class="badge badge-default px-0 text-light">Posted by <?= ucwords($namapanggilan); ?> &#8226;  <?php echo longdate_indo($post_detail->tgl_posting); ?></span>
							</p>
							</div>
						</div>
						<div class="px-0 px-md-4">
							<?= $img ?>
						</div>
						<div class="card-body px-0 px-md-4">
							<h2 class="font-weight-bold text-responsive"><?php echo $post_detail->judul; ?></h2>
							<p class="card-text font-weight-normal"><?php echo $post_detail->content; ?></p>
							<?= $tag; ?>
						</div>
						<div class="card-footer bg-transparent p-2 border-top rounded-lg d-flex justify-content-around">
							<div class="w-100">
								<button type="button" data-toggle="tooltip" data-placement="bottom" title="Dilihat" class="btn btn-transparent border-0 rounded p-2 w-100"><i class="far fa-eye mr-2"></i> <?= $count; ?> </button>
							</div>
							<div class="w-100">
								<button type="button" data-toggle="tooltip" data-placement="bottom" title="Share This" id="btn-share" data-row-id="<?= $post_detail->id_berita; ?>" class="btn btn-transparent border-0 rounded p-2 w-100 text-success"><i class="fas fa-share-alt mr-2"></i> <span class="share_count"><?= $post_detail->share_count; ?></span></button>
							</div>
							<div class="w-100">
								<button type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-0 rounded p-2 w-100 text-danger <?= $btn_like ?>" title="Suka / Tidak suka" data-id-berita="<?= $post_detail->id_berita ?>" data-id-user="<?= $this->session->userdata('user_portal_log')['id'] ?>"><i class="<?= $status_like ?> fa-heart mr-2"></i> <span class="count_like"><?= $post_detail->like_count ?></span> </button>
							</div>
							<div class="w-100">
								<button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-0 rounded p-2 w-100 text-info <?= $btn_bookmark ?>" title="Simpan Postingan" data-id-berita="<?= $post_detail->id_berita ?>" data-id-user="<?= $this->session->userdata('user_portal_log')['id'] ?>"><i class="<?= $status_bookmark ?> fa-bookmark"></i> </button>
							</div>
						</div>
					</div>
					<?php if($post_detail->komentar_status == 0): ?>
					<div class="card my-4 border-0 bg-white">
						<div class="card-body" style="max-height: 480px; overflow-y: auto;">
							<div id="tracking">
								<div class="tracking-list">
								</div>
							</div>
							
						</div>
					</div>
					<div class="card border-top-light bg-white">
						<div class="card-body p-5">
							
							<?php if ($this->session->userdata('user_portal_log')['online'] == 'ON') { ?>
							<b class="reply_username float-right"></b>
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
							<a href="<?php echo base_url('login_web') ?>" class="btn btn-dark btn-md btn-block"><i class="fas fa-lock mr-3"></i> Login</a>
							<?php } ?>
						</div>
					</div>
					<?php else: ?>
					<div class="alert alert-warning text-center font-italic text-uppercase my-3" role="alert">
						Komentar di non aktifkan
					</div>
					<?php endif; ?>
					<div class="mt-md-5 mt-3">
						<div class="separator">
							<span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-quote-left fa-pull-left mr-2"></i>Berita Selanjutnya</span>
						</div>
						<div class="d-flex justify-content-between flex-lg-row flex-column">
							<?php
							foreach ($berita_selanjutnya->result() as $b):
							$by = $b->created_by;
							$id = encrypt_url($b->id_berita);
							$postby = strtolower(url_title($this->mf_users->get_namalengkap(trim($by))));
							$judul = strtolower($b->judul);
							$posturl = base_url("post/{$postby}/{$id}/" . url_title($judul) . '');
							if ($by == 'admin') {
							$namapanggilan = $by;
							} else {
							$namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
							}
							if(!empty($b->img)):
							$img = '<img class="img-fluid rounded lazy p-0 m-0" src="'.base_url("bower_components/SVG-Loaders/svg-loaders/oval.svg").'" data-src="'.base_url('files/file_berita/'.$b->img).'">';
							else:
							$img = '<img class="img-fluid rounded lazy p-0 m-0" src="'.base_url("bower_components/SVG-Loaders/svg-loaders/oval.svg").'" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
							endif;
							?>
							<?php if($berita_selanjutnya->num_rows() > 0): ?>
							<a href="<?= $posturl ?>" class="text-link">
								<div class="media">
									<span class="rippler rippler-img rippler-bs-danger mr-3 w-25">
										<?= $img ?>
									</span>
									<div class="media-body px-2">
										<p class="mb-0"><?= word_limiter($b->judul, 4); ?></p>
										<span class="text-muted small">
											<?= word_limiter($b->content, 6) ?>
										</span>
									</div>
								</div>
							</a>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-none d-md-block">
					<div class="card bg-white rounded border-light">
						<div class="card-body p-0">
                    		<?php $this->load->view('Frontend/v1/function/populer_post'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>