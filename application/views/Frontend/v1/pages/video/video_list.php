<?php  
$playlistId = 'UUFDRHqqNeuYql8O7y5sHgmw'; // ID playlist
$chanelId = $this->config->item('YOUTUBE_CHANNELID'); //ID chanel youtube
$key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
?>
<section class="hero py-5">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-md-center align-items-start flex-lg-row  flex-md-row flex-column">
			<div class="d-none d-md-block d-lg-block">	
				<h3 class="font-weight-bold text-responsive">Videos</h3>
				<p class="text-muted small">Resources <a href="www.youtube.com"> www.youtube.com</a></p>
			</div>
			<div>
				<div class="g-ytsubscribe" data-channelid="<?= $chanelId ?>" data-layout="full" data-count="default"></div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--6">
	<div class="container">
		<div class="row">
			<?php  
				// Playlsit
				$urlPlaylist = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$playlistId.'&key='.$key;
				$playlist  	  = api_client($urlPlaylist);

				foreach($playlist['items'] as $v):
				$videoID		= $v['snippet']['resourceId']['videoId'];
				$title_video    = $v['snippet']['title'];
				$desc_video     = $v['snippet']['description'];
				$thumb_video    = $v['snippet']['thumbnails']['medium']['url'];
				$publish_video    = $v['snippet']['publishedAt'];
			?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4">
					<a href="<?= $videoID ?>" id="btn-view-video" title="<?= $title_video ?>" class="position-relative">
						<img src="<?= $thumb_video ?>" alt="<?= $title_video ?>" class="img-fluid w-100 shadow-sm rounded mb-3">
					</a>
					<div class="small text-light mb-3">Upload: <?= longdate_indo(substr($publish_video, 0, 10)) ?></div>
					<a href="<?= $videoID ?>" id="btn-view-video" title="<?= $title_video ?>">
						<h6><?= $title_video ?></h6>
					</a>
					<p class="small text-muted">
						<?= $desc_video  ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<script src="https://apis.google.com/js/platform.js" async defer></script>
