<h4 class="px-3 py-3 border-bottom border-light animated fadeIn">Postingan Disimpan</h4>
<section class="my-3 mx-3">
	<div class="container">
			<div class="row">
				
	<table class="table table-hover table-condensed">
		<tbody>
	<?php 
	$no = 1;
	foreach ($datas as $data):
		$id = encrypt_url($data->id_berita);
	    $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($data->created_by))));
	    $judul = strtolower($data->judul);
	    $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
	    echo '
	    	<tr>
	    		<td>'.$no.'</td>
	    		<td><a href="'.$posturl.'">'.$data->judul.'</a></td>
	    	</tr>
	     ';
	$no++;
	endforeach;
	?>
	</tbody>
	</table>
			</div>
	</div>
</section>