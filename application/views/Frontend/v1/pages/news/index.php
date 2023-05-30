<?php  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$q = isset($_GET['q']) ? $_GET['q'] : '';
	$category = isset($_GET['category']) ? $_GET['category'] : 'General';
	$category_arr = ['General', 'Business', 'Entertainment', 'Health', 'Science', 'Sports', 'Technology'];
?>
<section class="hero py-5">
	<div class="container">
		<div class="col-md-10 offset-md-2">
		<div class="d-flex justify-content-between align-items-start flex-lg-row flex-column">
			<div>
				<h3 class="font-weight-bold text-responsive text-white">Top Headlines Indonesia</h3>
				<p class="text-muted small">Resources api <code>https://newsapi.org/</code></p>
			</div>
			<div>
				<form class="form-inline" method="get">
					<input type="hidden" name="category" value="<?= $category ?>">
					<input type="hidden" name="page" value="1">
					<label class="sr-only" for="search">Keywords</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-filter"></i></div>
						</div>
						<input type="text" name="q" value="<?= isset($_GET['q']) ? $_GET['q'] : ''; ?>" class="form-control form-control-lg" id="search" placeholder="In <?= $category ?>">
					</div>
					<button type="submit" class="btn btn-lg border-0 mb-2"><i class="fas fa-search"></i></button>
				</form>
			</div>
		</div>
	</div>
	</div>
</div>
</section>
<section class="mb-3 mt--6">
<div class="container">
	<div class="col-md-10 offset-md-2 mb-5 bg-white py-3 rounded shadow">
		<b class="text-dark text-uppercase mb-2 d-block">category</b>
		<div style="overflow-x: auto;" class="d-flex justify-content-between align-items-center flex-nowrap">
			<?php 
				foreach ($category_arr as $c) :
				$primary = $category == $c ? 'disabled' : ''; 
			?>
				<a href="?category=<?= $c ?>&page=<?= $page ?>&q=<?= $q ?>" class="btn btn-lg btn-primary mx-2 <?= $primary ?> flex-grow-1"><?= $c ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="container">
	<div class="row offset-md-2">
		<?php
		$key = $this->config->item('NEWS_KEY'); 
		$source = 'id';
		$limit = 6;
		$url = 'https://newsapi.org/v2/top-headlines?q='.$q.'&category='.$category.'&country='.$source.'&apiKey='.$key.'&page='.$page.'&pageSize='.$limit;
		$data = api_client($url);
		if($data['status'] === 'error'):
			echo $data['message'];
		else:
		$total = $data['totalResults'];
		foreach($data['articles'] as $a):
			$author = $a['author'] ? $a['author'] : '<s>Unauthor</s>';
		?>
		<div class="col-12 col-sm-6 col-md-4 col-lg-4">
			<a href="<?= $a['url'] ?>" target="_blank" title="<?= $a['title'] ?>" class="position-relative">
				<img data-src="<?= $a['urlToImage'] ?>" alt="<?= $a['description'] ?>" class="img-fluid w-100 shadow-sm rounded mb-3 lazy">
			</a>
			<div class="small text-muted mb-2"><?= longdate_indo(substr($a['publishedAt'], 0, 10)) ?> &bull; <?= $author ?></div>
			<a href="<?= $a['url'] ?>" target="_blank" title="<?= $a['title'] ?>">
				<h6><?= $a['title'] ?></h6>
			</a>
			<p class="small text-muted">
				<?= $a['content']  ?>
			</p>
			<p>
				<a href="<?= $a['url'] ?>" target="_blank" class="btn btn-block btn-primary shadow text-uppercase">baca selengkapnya</a>
			</p>
		</div>
		<?php endforeach; endif; ?>
	</div>
	<div class="row">
		<div class="col-12">
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center justify-content-md-end">
					<li class="page-item disabled d-none d-md-block text-muted"><a class="page-link" href="#">Halaman</a></li>
					<?php
					$count = $total / $limit;
					$totalCount =  ceil($count);
					for($i=1; $i<=$totalCount; $i++):
						$disabled = $page == $i ? 'disabled' : '';
						$active = $page == $i ? 'active' : '';
					?>
					<li class="page-item <?= $disabled ?>"><a class="page-link" href="?category=<?= $category ?>&page=<?= $i ?>&q=<?= $q ?>"><?= $i ?></a></li>
					<?php endfor; ?>
				</ul>
			</nav>
		</div>
	</div>
</div>
<section>