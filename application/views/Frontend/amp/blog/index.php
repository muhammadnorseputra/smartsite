<!-- POST NEW -->
<?php
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
<section class="sm-flex justify-start px2">
	<div class="md-col-5">
	<a href="<?= $postUrl ?>" class="text-decoration-none  ampstart-image-fullpage-hero">
	<amp-img src="<?= $img ?>" width="auto" height="210" class="fit rounded-bottom" alt="<?= $postNew->judul ?>"></amp-img>
	</a>
</div>
<div class="md-col-7 px4 py2">
	<a href="<?= base_url("amp/blog/{$categoryTitle}") ?>" class="text-decoration-none">
		<span class="ampstart-subtitle ampstart-label block caps pb1 bold pt2-md">
			<?= $categoryTitle ?>
		</span>
	</a>
	<a href="<?= $postUrl ?>" class="text-decoration-none ampstart-accent">
		<h1 class="h3 bold">
			<?= ucwords(word_limiter($postNew->judul, 8)) ?>
		</h1>
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
<section class="block px2">
<amp-ad width="100vw" height="320"
     type="adsense"
     layout="responsive"     
     data-ad-client="ca-pub-1099792537777374"
     data-ad-slot="8859326512"
     data-auto-format="rspv"
     data-full-width="">
  <div overflow=""></div>
</amp-ad>	
</section>
<!-- POST BY KATEGORI -->
<?php  
foreach($postCategory->result() as $category):
	$blogPost = $this->posts->postListByCategoryId(0,5,$category->id_kategori);
?>
<span class="block h3 ampstart-label caps bold center mt3">
	<?= $category->nama_kategori ?>
	<?php if($blogPost->num_rows() > 4): ?>
	<a href="<?= base_url("amp/blog/{$category->nama_kategori}") ?>" class="text-decoration-none  ampstart-accent">
	<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-circle-fill ml3" viewBox="0 0 16 16">
	  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
	</svg>
	</a>
	<?php endif; ?>
</span>
<section class="py2 flex justify-start block flex-none" style="overflow-x:auto;">
<?php 
	foreach($blogPost->result() as $p): 
	$postUrl = base_url("amp/{$p->slug}");
	$author = decrypt_url($this->users->get_userportal_namapanggilan($p->created_by)->nama_panggilan);
	if($p->type === 'BERITA'):  
		if(!empty($p->img)):
		    $img = files('file_berita/'.$p->img);
		else:
		    $img = img_blob( $p->img_blob );
		endif;
	elseif($p->type === 'YOUTUBE'):
		$key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
	    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$p->content.'&key='.$key;
	    $yt     = api_client($url);
	    $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
	    $yt_desc = $yt['items'][0]['snippet']['description'];
	    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
	    $img = $yt_thumb;
	elseif($p->type === 'LINK'):
		$url = $p->content;
	    $linker = getSiteOG($url);
	    $img = $linker['image'];
	else:
		$img = assets('images/noimage.gif');
	endif;
?>
<div class="md-col-4 mx1">
	<a href="<?= $postUrl ?>" class="text-decoration-none ampstart-image-fullpage-hero">
		<amp-img src="<?= $img ?>" width="auto" height="210" class="fit rounded-top "></amp-img>
	</a>
	<div class="px4 py2">
		<a href="<?= $postUrl ?>" class="text-decoration-none ampstart-accent">
			<h1 class="h4 bold mt1 block"><?= ucwords($p->judul) ?></h1>
		</a>
		<address class="ampstart-byline clearfix my1 flex justify-start">
			<time
			class="ampstart-byline-pubdate ampstart-small-text block bold my1"
			datetime="<?= $post->tgl_posting ?>"
			><?= ucwords($author) ?> &bull; <?= longdate_indo($p->tgl_posting) ?> </time>
		</address>
	</div>
</div>
<?php endforeach; ?>
</section>
<?php endforeach; ?>
<section class="px4 py3">
	<a href="<?= base_url("amp/blog") ?>" class="center text-decoration-none block rounded ampstart-btn ampstart-btn-secondary">
		Loadmore
	</a>
</section>