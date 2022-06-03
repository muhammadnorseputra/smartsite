<div class="container">
<div class="row no-gutters">        
<?php  
$mf_banner_home = $this->mf_beranda->list_banner('BANNER', 'Aside', 0, 8)->result();
?>
<div class="col-12">
    <div class="row grafis-app-slick">
        <?php 
            $no=1; 
            foreach($mf_banner_home as $b): 
            $by = $b->upload_by;
            if($by == 'admin') {
                $link_profile_public = 'javascript:void(0);';
                $namalengkap = $this->mf_users->get_namalengkap($by);
                $namapanggilan = $by;
                $gravatar = base_url('assets/images/users/'.$this->mf_users->get_gravatar($by));
            } else {
                $link_profile_public = 
                base_url("user/".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
                $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                $gravatar = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic).'';
            }
        ?>
        <div class="px-3">
                <div class="card bg-light text-white rounded-lg mb-2">
                    <img class="card-img lazy" height="340" style="object-fit:cover;" alt="<?= $no ?>" data-src="<?= files('file_banner/'.$b->gambar) ?>" src="<?= base_url('template/v1/img/loader/lazyload.gif') ?>">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <div class="main-body align-self-end">
                            <a href="<?= $b->path ?>" id="xbanner-<?= $no ?>" data-title="<?= $b->judul ?>" data-lightbox="BannerAside" style="text-shadow: 0.3px 1px white;">
                                <span class="badge p-2 badge-pill badge-warning">
                                    <i class="fas fa-search mr-2"></i> Perbesar
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                    <span class="mr-2">
                        <img style="object-fit:cover; object-position:top;" src="<?= $gravatar ?>" alt="Photo Userportal" width="23" height="23" class="rounded-circle border-primary bg-white">
                    </span>
                    <span class="small text-secondary mt-1">
                        <?= ucwords($namapanggilan) ?>
                    </span>
                </div>            
                <?= $b->judul ?>
        </div>
        <?php $no++; endforeach; ?>
    </div> 
</div>
</div>
</div>