<?php if(cek_internet() == true): ?>
<?php  
// ID Channel Youtube
$chanelId = $this->config->item('YOUTUBE_CHANNELID'); //ID chanel youtube
$key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
$urlChannel = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&id='. $chanelId .'&key='.$key.'';
$data  	  = api_client($urlChannel);
$title    = $data['items'][0]['snippet']['title'];
$desc     = $data['items'][0]['snippet']['description'];
$thumb    = $data['items'][0]['snippet']['thumbnails']['medium']['url'];

// Video lastest
$playlistId = 'UUFDRHqqNeuYql8O7y5sHgmw'; // ID playlist
$urlPlaylist = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$playlistId.'&key='.$key.'&maxResults=1';
$playlist  	  = api_client($urlPlaylist);
$videoID		= $playlist['items'][0]['snippet']['resourceId']['videoId'];
$title_video    = $playlist['items'][0]['snippet']['title'];
$desc_video     = $playlist['items'][0]['snippet']['description'];
$thumb_video    = $playlist['items'][0]['snippet']['thumbnails']['medium']['url'];
$publish_video    = $playlist['items'][0]['snippet']['publishedAt'];
?>
<div class="g-ytsubscribe mt-md-0 mt-4" data-channelid="<?= $chanelId ?>" data-layout="full" data-count="default"></div>
<div class="my-2 border-0">
	<?php if(!empty($data) && !empty($playlist)): ?>
	<a href="<?= $videoID ?>" id="btn-view-video" title="<?= $title_video ?>" class="position-relative">
		<img src="<?= $thumb_video ?>" alt="<?= $title_video ?>" class="img-fluid border border-secondary w-100 rounded mb-3">
		<div class="text-center position-absolute text-dark w-100 h-100 mt--5" style="left: 0;top: 0;">
			<i class="far fa-play-circle fa-4x"></i>
		</div>
	</a>
	<p class="small text-muted mb-2"><i class="fas fa-calendar-alt mr-2"></i><?= longdate_indo(substr($publish_video, 0, 10)) ?></p>
	<div class="pl-3 border-left border-light">
		<a href="<?= $videoID ?>" id="btn-view-video" title="<?= $title_video ?>">
			<h6><?= $title_video ?></h6>
		</a>
		<p class="small text-muted">
			<?= $desc_video  ?>
		</p>	
	</div>
	<?php endif; ?>
</div>
<?php else: ?>
	<?php $this->load->view('msg/lose-connection'); ?>
<?php endif; ?>