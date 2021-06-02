<div class="container-fluid mt-md-5">
    <div class="row">
    <div id="camera_wrap" class="camera_wrap camera_black_skin shadow mt-md-4">
        <?php
        if ($mf_banner->num_rows() > 0) {
        foreach ($mf_banner->result() as $b):
        $link = base_url('frontend/v1/banner/detail/' . encrypt_url($b->id_banner) . '/' . url_title($b->judul));
        $link_rediract = $b->url;
        ?>
        <div data-src="<?= $b->path; ?>" data-link="<?= $link_rediract; ?>">
            <!-- <div class="camera_caption fadeFromBottom d-none d-md-block">
                <button class="btn btn-sm btn-primary float-right">readmore</button>
                <b><?= strtoupper($b->judul); ?></b>
                <p><?= character_limiter($b->keterangan, 100); ?></p>
            </div> -->
        </div>
        <?php endforeach;
        } ?>
    </div>
    </div>
</div>