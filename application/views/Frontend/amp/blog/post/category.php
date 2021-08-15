<?php  
$p = $postCategory->result();
$p_num = $postCategory->num_rows();
$categoryTitle = $this->uri->segment(3);
?>
<section class="py3 px3">
	<div class="h3 bold">Blog: <?= ucwords($categoryTitle) ?> (<?= $p_num ?>)</div>
</section>
<!-- POST NEW -->
<?php
if($p_num > 0):
foreach($p as $postNew):
if($postNew->type === 'BERITA'):  
	$isi_berita = strip_tags($postNew->content); // membuat paragraf pada isi berita dan mengabaikan tag html
    $isi = substr($isi_berita, 0, 150); // ambil sebanyak 80 karakter
    $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
	if(!empty($postNew->img)):
	    $img = files('file_berita/'.$postNew->img);
	else:
	    $img = img_blob( $postNew->img_blob );
	endif;
elseif($postNew->type === 'YOUTUBE'):
	$key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$postNew->content.'&key='.$key;
    $yt     = api_client($url);
    $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
    $yt_desc = $yt['items'][0]['snippet']['description'];
    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
    $img = $yt_thumb;
    $isi = word_limiter($yt_desc,12);
elseif($postNew->type === 'LINK'):
	$url = $postNew->content;
    $linker = getSiteOG($url);
    $img = $linker['image'];
    $isi = word_limiter($linker['description'],12);
else:
	$img = assets('images/noimage.gif');
	$isi = '...';
endif;
$postUrl = base_url("amp/{$postNew->slug}");
$author = decrypt_url($this->users->get_userportal_namapanggilan($postNew->created_by)->nama_panggilan);
$photo = img_blob($this->users->get_userportal_byid($postNew->created_by)->photo_pic);
$categoryTitle = $this->posts->kategori_byid($postNew->fid_kategori);
?>
<section class="sm-flex justify-start px2 py2">
	<div class="md-col-5 pt1">
	<a href="<?= $postUrl ?>" class="text-decoration-none  ampstart-image-fullpage-hero">
	<amp-img src="<?= $img ?>" width="auto" height="110" class="fit rounded-bottom" alt="<?= $postNew->judul ?>"></amp-img>
	</a>
</div>
<div class="md-col-7 px4">
	<a href="<?= $postUrl ?>" class="text-decoration-none ampstart-accent">
		<span class="h3 bold">
			<?= ucwords(word_limiter($postNew->judul, 8)) ?>
		</span>
	</a>
	<address class="ampstart-byline clearfix my1 flex justify-start">
		<amp-img
			src="<?= $photo ?>"
			width="35"
			height="35"
			class="circle"
		alt="<?= $author ?>"></amp-img>
		<time
		class="ampstart-byline-pubdate ampstart-small-text block bold my1 ml2"
		datetime="<?= $post->tgl_posting ?>"
		><?= ucwords($author) ?> &bull; <?= longdate_indo($postNew->tgl_posting) ?> </time>
	</address>
	<p class="ampstart-small-md">
		<?= $isi ?>
	</p>
</div>
</section>
<!-- END POST NEW -->
<?php endforeach; ?>
<?php else: ?>
<section class="py4 center">
	<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
	  <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
	  <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
	</svg>
	<div class="h3 bold">Postingan Belum Ada</div>
</section>
<?php endif; ?>