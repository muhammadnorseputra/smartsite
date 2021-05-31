<?php if(cek_internet() == true): ?>
<?php  
$key = $this->config->item('NEWS_KEY'); // TOKEN
$source = 'id';
$limit = 6;
$url = 'https://newsapi.org/v2/top-headlines?country='.$source.'&apiKey='.$key;
$data = api_client($url);
?>
<div class="rounded">
	<div class="bg-danger text-white px-2 rounded-left float-left">
		<span class="d-none d-md-block">
			TOP Headline
		</span>
		<span class="d-block d-md-none"><i class="fas fa-newspaper"></i></span>
	</div>
	<div class="headline-ticker px-2">
		<div>
			<?php  
				foreach($data['articles'] as $a):
			?>
				<div class="text-truncate"><a href="<?= base_url('leave?go='.encrypt_url($a["url"])) ?>"><?= $a['title'] ?></a></div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="float-right mt--5">
		<div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-danger bg-white btn-up btn-sm"><i class="fas fa-angle-up"></i></button>
          <button type="button" class="btn btn-danger bg-white btn-toggle btn-sm">&nbsp;</button>
          <button type="button" class="btn btn-danger bg-white btn-down btn-sm"><i class="fas fa-angle-down"></i></button>
        </div>
	</div>
</div>
<?php else: ?>
	<?php $this->load->view('msg/lose-connection'); ?>
<?php endif; ?>