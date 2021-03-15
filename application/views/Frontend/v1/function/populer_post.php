<div class="separator d-none d-md-block mt-5">
                        <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-heart text-secondary mr-2"></i> Populer Post</span>
                    </div>
                    <div class="list-group border-0 shadow-none p-0 d-none d-md-block">
                        <?php
                        $nolist = 1;
                        foreach ($mf_berita_populer as $b) :
                        $id = encrypt_url($b->id_berita);
                        $postby = strtolower(url_title($this->mf_users->get_namalengkap($b->created_by)));
                        $judul = strtolower($b->judul);
                        $posturl = base_url("post/{$postby}/{$id}/" . url_title($judul) . '');
                        if(!empty($b->img)):
                        $img = '<img class="rounded align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="'.$b->path.'" alt="'.$b->judul.'">';
                        else:
                        $img = '<img class="rounded align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
                        endif;
                        ?>
                        <a  href="<?= $posturl; ?>" class="bg-transparent list-group-item list-group-item-action border-0 px-3  m-0">
                            <div class="media m-0">
                                <?= $img ?>
                                <div class="media-body">
                                    <span class="font-weight-lighter text-primary"><?= character_limiter($b->judul, 30); ?></span>
                                    <small class="d-block mt-2 align-middle text-left font-weight-bold">
                                    <i class="far fa-thumbs-up"></i> <?= $b->like_count ?> Likes </small>
                                    </small>
                                </div>
                            </div>
                            
                            <br>
                            
                        </a>
                        <?php $nolist++; endforeach; ?>
                    </div>