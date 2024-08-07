<?php  
  $pagedetail = $detail->row();
?>
<article class="recipe-article">
  <header>
    <a href="<?= base_url("amp/page") ?>" class="text-decoration-none">
      <span class="ampstart-subtitle block px3 pt2 mb2 caps">Pages</span>
    </a>
    <h1 class="h3 mb1 px3 bold ampstart-title-sm"><?= $pagedetail->title ?></h1>
  </header>
  <section>
    <?php
    if(!empty($pagedetail->file)):
    $path = !empty($pagedetail->filename) ? $pagedetail->filename : '';
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    ?>
      <?php
      if($ext === 'pdf'):
      ?>
    <object width="100%" height="300" layout="responsive" class="rounded mb3" data="data:application/pdf;base64,<?= base64_encode($pagedetail->file) ?>" type="application/pdf"></object>
      <?php else: ?>
      <div class="ampstart-image-contain">
      <amp-img
      src="<?= img_blob($pagedetail->file) ?>"
      width="1280"
      height="453"
      layout="responsive"
      alt="<?= $title ?>"
      class="my3 rounded ampstart-card"
    ></amp-img>
    </div>
      <?php endif; ?>
    <?php endif; ?>
  </section>
  <section class="px3 py3 line-height-4">
    <?= $pagedetail->content ?>
    <div class="flex justify-between items-center mt3">
      <div class="flex justify-start">
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
          </svg>
        </span>
        <span class="ml2">
          <?= nominal($pagedetail->views)  ?>
        </span>
      </div>
    </div>
  </section>
  <section class="pb4 px3">
    <a href="<?= base_url("page/{$slug}") ?>" class="ampstart-accent">
      Lihat versi non-AMP
    </a>
  </section>
</article>