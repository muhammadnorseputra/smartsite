<div class="separator">
    <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-images text-secondary mr-2"></i> album photo</span>
</div>
<div class="rounded-lg my-4 border-0 shadow-none">
    <div class="album-slick">
        <?php
        foreach ($mf_album as $album):
        ?>
            <div>
                <a href="<?= base_url('album/'.encrypt_url($album->id_album_foto)) ?>">
                    <?php if(!empty($a->gambar)): ?>
                    <img src="<?= base_url('files/file_album/'.$album->gambar) ?>" class="w-100 rounded shadow-sm border " alt="<?= url_title($album->judul, '-', true) ?>">
                    <?php else: ?>
                    <img src="<?= img_blob($album->gambar_blob) ?>" class="w-100 rounded shadow-sm border" alt="<?= url_title($album->judul, '-', true) ?>">
                    <?php endif; ?>
                    <div class="text-secondary text-center badge-light p-2 rounded mt-2"><?= $this->album->jml_photo_in_album($album->id_album_foto) ?> Photo</div> 
                    <p class="text-muted mt-3"><?= $album->judul ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- <div class="small text-info position-absolute mx-auto mt-1">Directed by BinaInfo</div> -->
</div>
