<section class="mt-0 pt-md-5 bg-white rounded shadow-lg">
  <div class="container py-md-4">
    <div class="row pt-3">
    	<div class="col-12 col-md-4">
      	<div class="font-weight-bold display-4 mr-md-3 pr-md-3">Post by tags</div>
    	</div>
    	<div class="col-12 col-md-8">
      	<div style="overflow-x: auto;" class="d-flex flex-row flex-nowrap justify-content-start align-items-center">
	        <?php
	        foreach ($tags->result() as $tag) :
	          $active = url_title($tag->nama_tag);
	          $active_tag = $active == $this->uri->segment(2) ? 'active' : '';
	        ?>
	          <a href="<?= base_url('tag/' . $active); ?>" class="btn rounded-pill my-1 text-nowrap mx-2 p-2 btn-sm btn-outline-secondary <?= $active_tag ?>">#<?= url_title($tag->nama_tag); ?></a>
	        <?php endforeach; ?>
	        </div>
    	</div>
    </div>
  </div>
</section>
<section class="post-list mb-5">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-5">
				<div class="row grid" data-target=".item">
					<?php
					// var_dump($posts_by_tag->result()); die;
					$count = $posts_by_tag->num_rows();
					if ($count > 0) {
						$s = 1;
						foreach ($posts_by_tag->result() as $posts) :
							$id = encrypt_url($posts->id_berita);
							$postby = strtolower(url_title($this->mf_users->get_namalengkap(trim($posts->created_by))));
							$slug = strtolower($posts->slug);
              $kategori = url_title(strtolower($this->post->kategori_byid($posts->fid_kategori)));
              $posturl = base_url("p/".$kategori."/".$slug);
							$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $posts->id_berita) == 'on' ? 'fas' : 'far';
					if(!empty($posts->img_blob)):
                    	$img = '<img class="img-fluid border-0 rounded-top" src="data:image/jpeg;base64,'.base64_encode( $posts->img_blob ).'"/>';
	                else:
	                    $img = '<img class="img-fluid border-0 rounded-top" src="'.$posts->path.'">';
	                endif;
					?>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<div class="item">
							<div class="card mb-3 border p-0 bg-transparent">
								<a href="<?php echo $posturl; ?>" class="rounded-top">
									<span class="rippler rounded rippler-img rippler-bs-primary">
										<?php echo $img ?>
									</span>
								</a>
								<div class="card-body px-2">
									<a href="#" class="float-right text-muted"><i onclick="bookmark_toggle(this)" class="<?= $status_bookmark ?> fa-bookmark" data-id-berita="<?= $posts->id_berita ?>" data-id-user="<?= $this->session->userdata('user_portal_log')['id'] ?>"></i></a>
									<div class="badge badge-primary">
										#<?php echo url_title($this->uri->segment(2)); ?>
									</div>
									<h5 class="font-weight-light"><a href="<?php echo $posturl; ?>"><?php echo character_limiter($posts->judul, 30); ?></h5></a>
								</div>
								<div class="card-footer bg-transparent p-3">
									<a href="<?= $posturl ?>" class="btn btn-block btn-outline-primary">Read more</a>
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
							<h3>Oppss! belum ada postingan berdasarkan #<?= url_title($this->uri->segment(2),'-', TRUE) ?>.</h3>
							<p class="font-weight-light text-secondary">Sepertinya ini kesalahan dari kami yang masih kekurangan konten.</p>
						</div>
					</div>
					<?php
					}  ?>
				</div>
			</div>
		</div>
	</div>
</section>