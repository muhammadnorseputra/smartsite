<div class="separator">
    <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-images text-secondary mr-2"></i> album photo</span>
</div>
<div class="overflow-hidden rounded-lg my-4 border-0 shadow-none">
    
    <?php
    $kolom = 2;
    $i = 1;
    foreach ($mf_album as $album):
    if(($i) % $kolom==1) {
    echo '<div class="d-flex justify-content-between align-items-center">';
        }
        ?>
        <div class="w-100 rounded m-1">
            <a href="<?= base_url('album/'.encrypt_url($album->id_album_foto)) ?>">
                <?php if(!empty($a->gambar)): ?>
                <img data-toggle="tooltip" title="<?= $album->judul ?>" data-src="<?= base_url('files/file_album/'.$album->gambar) ?>" class="img-fluid lazy rounded shadow-sm border " alt="<?= url_title($album->judul, '-', true) ?>">
                <?php else: ?>
                <img data-toggle="tooltip" title="<?= $album->judul ?>" data-src="data:image/jpeg;base64,<?= base64_encode( $album->gambar_blob ); ?>" class="img-fluid lazy rounded shadow-sm border " alt="<?= url_title($album->judul, '-', true) ?>">
                <?php endif; ?>
            </a>
        </div>
        <?php if(($i) % $kolom==0) {
    echo '</div>';
    } ?>
    <?php $i++; endforeach; ?>
    <!-- <div class="small text-info position-absolute mx-auto mt-1">Directed by BinaInfo</div> -->
</div>