<div class="block-header row m-b-15">
  <h2 class="m-l-25">
  <i class="material-icons pull-left m-b-5 m-r-10 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">person</i> Informasi CPNS</h2>
  <small>Data center, informasi, pengadaan cpns kabupaten balangan tahun <?= date('Y'); ?></small>
</div>
<div id="tabs">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs tab-nav-right tab-col-teal border-bottom p-l-25" role="tablist">
    <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('cpns/informasi/intro'); ?>" data-toggle="tab" aria-expanded="false">Dasboard</a>
  </li>
  <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('cpns/informasi/hasilVerifikasi/'); ?>" data-toggle="tab" aria-expanded="false">Upload Hasil Verifikasi</a></li>
  <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('cpns/informasi/jadwalTes/'); ?>" data-toggle="tab" aria-expanded="false">Upload Jadwal Tes</a></li>
  <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('cpns/informasi/finalData/'); ?>" data-toggle="tab" aria-expanded="false">Pengumuman</a></li>
</ul>
</div>