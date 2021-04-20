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
                        $img = '<img class="rounded align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="files/file_berita/'.$b->img.'" alt="'.$b->judul.'">';
                        else:
                        $img = '<img class="rounded align-self-start lazy pull-left mr-4 w-25 shadow-sm" data-src="data:image/jpeg;base64,'.base64_encode( $b->img_blob ).'"/>';
                        endif;
                        ?>
                        <a  href="<?= $posturl; ?>" class="list-group-item list-group-item-action px-3 border-0">
                            <div class="media">
                                <?= $img ?>
                                <div class="media-body">
                                    <span class="font-weight-lighter text-primary"><?= character_limiter($b->judul, 35); ?></span>
                                    <div class="mt-2 align-middle text-left small text-secondary d-flex justify-content-between">
                                    <span>
                                        <i class="far fa-thumbs-up mr-2"></i> <?= $b->like_count ?> Likes
                                    </span>
                                    <span>
                                        <i class="fas fa-share mr-2"></i> <?= $b->share_count ?> Share   
                                    </span>
                                    <span>
                                        <i class="fas fa-eye mr-2"></i> <?= $b->views ?> Views   
                                    </span>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            
                        </a>
                        <?php $nolist++; endforeach; ?>
                    </div>