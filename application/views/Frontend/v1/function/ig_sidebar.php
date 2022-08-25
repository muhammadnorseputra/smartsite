<div class="separator">
    <span class="separator-text text-uppercase font-weight-bold"><i class="fab fa-instagram text-secondary mr-2"></i> Instagram</span>
</div>
<?php  
$url = 'https://v1.nocodeapi.com/isputraaaaaa/instagram/AdsRdHqRFEiKsDYG?limit=4';
$json = api_client($url);
?>
<div class="container-fluid">
<div class="row">
<?php 
foreach ($json['data'] as $d):
	if($d['media_type'] === 'IMAGE'):
		$media = $d['media_url'];
	else:
		$media = $d['thumbnail_url'];
	endif;
?>
	<div class="col-6 w-100 h-50 overflow-hidden">
		<img src="<?= $media ?>" alt="<?= $d['permalink'] ?>" class="w-100">
	</div>
<?php endforeach; ?>
</div>
</div>