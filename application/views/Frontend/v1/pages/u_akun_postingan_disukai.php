<h4 class="px-3 py-3 border-bottom border-light animated fadeIn">Postingan Disukai</h4>
<section class="my-3 mx-3">
	<div class="container">
			<div class="row">
	<?php 
	/*var_dump($datas);*/
	foreach ($datas as $data) {
		$id = encrypt_url($data->id_berita);
	    $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($data->created_by))));
	    $judul = strtolower($data->judul);
	    $slug = $data->slug;
	    $posturl = base_url("blog/{$slug}");

		echo '<div class="col-md-3 mb-3 pb-3 border-bottom">
		<a href="'.$posturl.'">';
		if(!empty($data->img_blob)):
			echo '<img style="object-fit: cover; height:110px;" class="img-fluid img-thumbnail" src="data:image/jpeg;base64,'.base64_encode( $data->img_blob ).'"/>';
		else:
			echo '<img style="object-fit: cover; height:110px;" class="img-fluid img-thumbnail" src="'.$data->path.'">';
		endif;
		echo "<div>".word_limiter($data->judul, 5)."</div>";
		echo '</a></div>'; 
	}
	
	?>
			</div>
	</div>
</section>