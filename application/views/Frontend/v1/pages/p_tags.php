<section class="post-list mt-5 mb-4">
	<div class="container">
		<div class="row">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 mt-5">
				<div class="row grid" data-target=".item">
					<?php
					$count = $posts_by_tag->num_rows();
					if ($count > 0) {
						$s = 1;
						foreach ($posts_by_tag->result() as $posts) :
							$id = encrypt_url($posts->id_berita);
							$postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($posts->created_by))));
							$judul = strtolower($posts->judul);
							$posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
							$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $posts->id_berita) == 'on' ? 'fas' : 'far';
					if(empty($row->img)):
                    $img = '<img class="img-card-top img-fluid border-0" src="data:image/jpeg;base64,'.base64_encode( $posts->img_blob ).'"/>';
	                else:
	                    $img = '<img class="img-card-top img-fluid border-0" src="'.$posts->path.'">';
	                endif;
	                $duration = ($s == 3 ? 1 : 3);
					?>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<div class="item" data-aos-duration="<?= $duration ?>00" data-aos-once="true" data-aos="fade-up" data-aos-delay="50">
							<div class="card mb-3 border-0">
								<a href="<?php echo $posturl; ?>">
									<span class="rippler rippler-img rippler-bs-primary">
										<?php echo $img ?>
									</span>
								</a>
								<div class="card-body">
									<a href="#" class="float-right text-muted"><i onclick="bookmark_toggle(this)" class="<?= $status_bookmark ?> fa-bookmark" data-id-berita="<?= $posts->id_berita ?>" data-id-user="<?= $this->session->userdata('user_portal_log')['id'] ?>"></i></a>
									<h6 class="font-weight-light"><a href="<?php echo $posturl; ?>"><?php echo character_limiter($posts->judul, 30); ?></h6></a>
									<p>
										#<?php echo url_title($_GET['q']); ?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php
					$s++;
					endforeach;
					} else {
					?>
					.
					<div class="col-12">
						<div class="d-block text-center font-weight-bold">
							<img src="<?= base_url('template/v1/img/humaaans.png'); ?>" alt="croods" class="img-fluid rounded mx-auto">
							<h3>Oppss! belum ada postingan disini.</h3>
							<p class="font-weight-light text-secondary">Sepertinya ini kesalahan dari kami yang masih kekurangan konten buat kalian.</p>
						</div>
					</div>
					<?php
					}  ?>
				</div>
				<div class="card shadow-none border-0 bg-transparent">
	              <div class="card-body p-0 overflow-auto">
	                <div class="d-flex flex-nowrap justify-content-start align-items-center">
	                <?php
	                foreach ($tags->result() as $tag) :
	                  $active = $tag->nama_tag;
	                ?>
	                  <a href="<?= base_url('frontend/v1/post_list/tags?q=' . $active); ?>" class="btn rounded-pill my-1 text-nowrap mx-2 px-3 btn-sm btn-outline-secondary ml-auto"><?= $tag->nama_tag; ?></a>
	                <?php endforeach; ?>
	                </div>
	              </div>
	            </div>
			</div>
			<div class="col-12 col-md-3 col-lg-3 mt-5">
				<div class="post-list-view">
					<div class="list-group mb-3 shadow-sm" style="overflow-y: auto; overflow-x: hidden; max-height: 645px;">
						<?php
						foreach ($kategoris->result() as $kategori) :
						$post_list_url = base_url('frontend/v1/post_list/views/' . encrypt_url($kategori->id_kategori) . '/' . url_title($kategori->nama_kategori) . '?order=desc');
						?>
						<a href="<?php echo $post_list_url; ?>" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
							#<?php echo trim($kategori->nama_kategori); ?>
							<span class="badge badge-primary px-3 badge-pill"><?= $this->mf_beranda->count_kategori_berita($kategori->id_kategori); ?></span>
						</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>