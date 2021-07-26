<?php
// Update count view
$count_v = $post_detail->views;
$count = $count_v + 1;
$this->post->update_count_post(decrypt_url($this->uri->segment(3)), $count);
// Profile postinger
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
// Youtube Data
if($post_detail->type === 'YOUTUBE'):
$key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
$url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,status,player&id='.$post_detail->content.'&key='.$key;
$yt     = api_client($url);
$yt_id     = $yt['items'][0]['id'];
$yt_channel = $yt['items'][0]['snippet']['channelId'];
$yt_desc = $yt['items'][0]['snippet']['description'];
$yt_src = $yt['items'][0]['snippet']['channelTitle'];
$yt_player = $yt['items'][0]['player']['embedHtml'];
$yt_sumber = $yt['items'][0]['status']['license'];
endif;
$btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == 'on' ? 'btn-bookmark' : '';
$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == 'on' ? 'fas text-primary' : 'far';
$btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == true ? 'btn-like' : '';
$status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $post_detail->id_berita) == true ? 'fas text-danger' : 'far';
if(!empty($post_detail->img)):
$img = '<img style="object-fit: contain; max-height:350px;" class="w-100 rounded lazy" data-src="'.base_url('files/file_berita/'.$post_detail->img).'">';
elseif($post_detail->type === 'YOUTUBE'):
$img = $yt_player;
else:
$img = '<img style="object-fit: contain; max-height:350px;" class="w-100 rounded lazy" data-src="'.img_blob($post_detail->img_blob).'"/>';
endif;
// Image Carosel
$photo_slide = $this->post->photo_terkait($post_detail->id_berita);
// Content
if($post_detail->type === 'YOUTUBE'):
$content = nl2br($yt_desc);
else:
$content = $post_detail->content;
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
			<div class="col-md-8 mb-5 pb-md-5 px-3 px-md-0" id="main-content">
				<div class="card rounded-lg shadow-none bg-white rounded border-0">
					<div class="card bg-transparent border-0 px-md-2 pt-md-0 p-0">
						<div class="card-body px-0 px-md-2 pt-md-0">
							<img data-src="<?= $photo; ?>" width="60" height="60" class="float-left mr-md-4 mr-3 lazy rounded shadow-sm">
							<h5 class="card-title"><a href="<?= $link_profile_public ?>"><?= $namalengkap ?></a></h5>
							<p class="card-text">
								<span class="badge badge-default px-0 text-light">Posted by <?= ucwords($namapanggilan); ?> &#8226;  <?php echo longdate_indo($post_detail->tgl_posting); ?></span>
							</p>
						</div>
					</div>
					<div class="px-0 media_youtube">
						<?php if($post_detail->type === 'SLIDE'): ?>
						<div id="carouselExampleIndicators" class="carousel slide shadow-lg" data-ride="carousel">
							<ol class="carousel-indicators">
								<?php foreach($photo_slide->result() as $key => $value): $active = ($key == 0) ? 'active' : ''; ?>
								<li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $active ?>"></li>
								<?php endforeach; ?>
							</ol>
							<div class="carousel-inner">
								<?php foreach($photo_slide->result() as $key => $value): $active = ($key == 0) ? 'active' : ''; ?>
								<div class="carousel-item <?= $active ?> text-center">
									<img class="img-responsive w-100 lazy" data-src="<?= img_blob($value->photo) ?>" alt="<?= $value->keterangan ?>" style="height:380px; object-fit: contain;">
									<div class="carousel-caption">
										<h5 class="d-none d-md-block"><?= ucwords(substr($value->judul, 0, strrpos($value->judul, '.'))) ?></h5>
										<p class="small d-block d-md-none"><?= ucwords(substr($value->judul, 0, strrpos($value->judul, '.'))) ?></p>
									</div>
								</div>
								<?php $i++; endforeach; ?>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<?php else: ?>
						<?= $img ?>
						<?php endif; ?>
						<?php  if($post_detail->type === 'YOUTUBE'): ?>
						<div class="pl-3 border-left border-light">
							<div class="d-flex justify-content-start align-items-start align-items-md-center">
								<div class="mr-3 text-light">
									<i class="fas fa-info-circle"></i>
								</div>
								<div class="small text-muted">
								Postingan ini merupakan <abbr title="<?= ucwords($yt_sumber) ?>">Repost</abbr> dari sumber aslinya.
							</div>
							<div class="ml-auto">
								<a href="https://www.youtube.com/watch?v=<?= $yt_id ?>?ref=bkppd_balangan" target="_blank" class="btn btn-light btn-sm">Lihat sumber asli</a>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="card-body px-0">
					<?php  if($post_detail->type === 'YOUTUBE'): ?>
					<div class="g-ytsubscribe mt-md-0 mt-4" data-channelid="<?= $yt_channel ?>" data-layout="full" data-theme="light" data-count="default"></div>
					<?php endif; ?>
					<h1 class="text-responsive"><?php echo $post_detail->judul; ?></h1>
					<ins class="adsbygoogle"
					style="display:block; text-align:center;"
					data-ad-layout="in-article"
					data-ad-format="fluid"
					data-ad-client="ca-pub-1099792537777374"
					data-ad-slot="6818392621"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
					<p class="card-text font-weight-normal"><?php echo $content; ?></p>
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
			<div>
				<div class="py-1 mb-3 bg-light"></div>
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
					$img = '<img class="img-fluid rounded lazy p-0 m-0" data-src="'.base_url('files/file_berita/'.$b->img).'">';
					else:
					$img = '<img class="img-fluid rounded lazy p-0 m-0" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
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
				<div class="py-1 bg-light"></div>
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
			<div class="card border-top-light bg-light">
				<div class="card-body">
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
					<p class="text-center text-responsive"><b>Login Dulu, Ya!</b></p>
					<p class=" text-center text-muted px-md-5 px-0">Mau ikutan diskusi? Untuk ikutan diskusi kamu harus punya identitas, maka dari itu login dulu.</p>
					<div class="d-flex justify-content-center flex-wrap-reverse">
						<div>
							<a href="<?php echo base_url('login_web') ?>" class="btn btn-dark btn-md btn-block"><i class="fas fa-lock mr-3"></i> Login</a>
						</div>
						<div class="ml-2">
							<a href="<?php echo base_url('daftar') ?>" class="btn btn-success btn-md btn-block"><i class="fas fa-user-plus mr-3"></i> Daftar</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php else: ?>
			<div class="alert alert-secondary text-muted text-center text-uppercase my-3 border-0" role="alert">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-slash-fill mr-2 mt--1" viewBox="0 0 16 16">
					<path d="M5.164 14H15c-1.5-1-2-5.902-2-7 0-.264-.02-.523-.06-.776L5.164 14zm6.288-10.617A4.988 4.988 0 0 0 8.995 2.1a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 7c0 .898-.335 4.342-1.278 6.113l9.73-9.73zM10 15a2 2 0 1 1-4 0h4zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75L.625 15.625z"/>
				</svg>
				Komentar Ditutup
			</div>
			<?php endif; ?>
			
		</div>
		<div class="col-md-4 d-none d-md-block">
			<div id="sidebar">
			<?php if(cek_internet() == true): ?>
			<div class="card border-0">
				<div class="card-body p-0">
					<?php $this->load->view('Frontend/v1/function/populer_post'); ?>
					<!--<div id="gpr-kominfo-widget-container"></div>-->
					<!-- ads -->
					<ins class="adsbygoogle"
					style="display:block"
					data-ad-client="ca-pub-1099792537777374"
					data-ad-slot="6508565159"
					data-ad-format="auto"
					data-full-width-responsive="true"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
			</div>
			<?php else: ?>
			<?php $this->load->view('msg/lose-connection'); ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</section>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!--<script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>-->