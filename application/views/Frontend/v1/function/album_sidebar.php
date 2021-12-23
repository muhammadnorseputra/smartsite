<div class="separator d-none d-md-block">
    <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-images mr-2"></i> album photo</span>
</div>
<div class="rounded-lg my-4 border-0 shadow-none  d-none d-md-block">
    <div class="album-slick">
        <?php
        foreach ($mf_album as $album):
        ?>
            <div>
                <a href="<?= base_url('album/'.$album->slug) ?>">
                    <?php if(!empty($a->gambar)): ?>
                    <img  style="height: 250px; object-fit: cover;" src="<?= base_url('files/file_album/'.$album->gambar) ?>" class="w-100 rounded shadow-sm border " alt="<?= url_title($album->judul, '-', true) ?>">
                    <?php else: ?>
                    <img  style="height: 250px; object-fit: cover;" src="<?= img_blob($album->gambar_blob) ?>" class="w-100 rounded shadow-sm border" alt="<?= url_title($album->judul, '-', true) ?>">
                    <?php endif; ?>
                    
                </a>
                <div class="d-flex mt-3 justify-content-between align-items-center">
                <h6 class="text-primary"><?= word_limiter($album->judul, 5) ?></h6>
                <div class="badge badge-pill badge-light p-2 rounded">
                    <i class="fas fa-images mr-2"></i> <?= $this->album->jml_photo_in_album($album->id_album_foto) ?> Photo
                </div> 
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- <div class="small text-info position-absolute mx-auto mt-1">Directed by BinaInfo</div> -->
</div>
