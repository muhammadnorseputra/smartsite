<?php if(cek_internet() == true): ?>
<?php  
$key = $this->config->item('NEWS_KEY'); // TOKEN
$source = 'id';
$limit = 6;
$url = 'https://newsapi.org/v2/top-headlines?country='.$source.'&apiKey='.$key;
$data = api_client($url);
?>
<div class="rounded">
	<div class="bg-danger text-white px-2 rounded-left float-left">TOP Headline</div>
	<div class="headline-ticker px-3">
		<div>
			<?php  
				foreach($data['articles'] as $a):
			?>
				<div class="text-truncate"><a href="<?= base_url('leave?go='.encrypt_url($a["url"])) ?>"><?= $a['title'] ?></a></div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php else: ?>
	<?php $this->load->view('msg/lose-connection'); ?>
<?php endif; ?>