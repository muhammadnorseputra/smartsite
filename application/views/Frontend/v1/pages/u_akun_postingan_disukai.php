<h4 class="px-3 py-3 border-bottom border-light animated fadeIn">Postingan Disukai</h4>
<section class="my-3 mx-3">
	<div class="container">
			<div class="row">
				
			
	<?php 
	// var_dump($datas);
	foreach ($datas as $data) {
		$id = encrypt_url($data->id_berita);
	    $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($data->created_by))));
	    $judul = strtolower($data->judul);
	    $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');

		echo '<div class="col-md-3 mb-3 pb-3 border-bottom"><a href="'.$posturl.'">';
		if(!empty($data->img_blob)):
			echo '<img class="img-fluid img-thumbnail" src="data:image/jpeg;base64,'.base64_encode( $data->img_blob ).'"/>';
		else:
			echo '<img class="img-fluid img-thumbnail" src="'.$data->path.'">';
		endif;
		echo "<span class='small'>".$data->judul."</span>";
		echo '</a></div>'; 
	}
	
	?>
			</div>
	</div>
</section>