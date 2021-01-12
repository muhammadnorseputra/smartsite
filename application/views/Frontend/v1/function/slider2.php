<div class="container">
    <div class="row">
    <div id="camera_wrap" class="camera_wrap camera_black_skin shadow px-1 bg-white">
        <?php
        if ($mf_banner->num_rows() > 0) {
        foreach ($mf_banner->result() as $b) :
        ?>
        <div data-src="<?= $b->path; ?>" data-portrait="false" data-link="<?= base_url('frontend/v1/banner/detail/' . encrypt_url($b->id_banner) . '/' . url_title($b->judul)); ?>">
            <div class="camera_caption fadeFromBottom">
                <button class="btn btn-sm btn-primary float-right">readmore</button>
                <b><?= strtoupper($b->judul); ?></b>
                <p><?= character_limiter($b->keterangan, 100); ?></p>
            </div>
        </div>
        <?php endforeach;
        } ?>
    </div>
    </div>
</div>