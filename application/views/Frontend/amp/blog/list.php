<section class="py3 px3">
	<div class="h3 bold">Blog</div>
</section>
<section class="px3 pb3">
	<?php 
		foreach($blogList as $b):
	?>
		<div class="flex justify-start items-center align-center mb3">
			<span class="mt1">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
				  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
				</svg>
			</span>
			<span class="ml3">
				<a href="<?= base_url("amp/blog/{$b->nama_kategori}") ?>" class="text-decoration-none ampstart-accent">
				<h1 class="h3 caps"><?= $b->nama_kategori ?></h1>
				</a>
			</span>
		</div>
	<?php endforeach; ?>
</section>