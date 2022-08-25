<?php
$local = 'http://silka.balangankab.go.id';
$online = 'http://silka.balangankab.go.id';
$status = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? $online : $local;
$host = $status;
?>
<?php
$arr = [
'jml_asn' => api_curl_get($host.'/api/get_grap/asn'),
'jml_pns' => api_curl_get($host.'/api/get_grap/pns'),
'jml_ptt' => api_curl_get($host.'/api/get_grap/nonpns'),
'jml_pensiun' => api_curl_get($host.'/api/get_grap/pensiun')
]
?>
<div class="col-6 col-sm-6 col-md-3 rounded-left">
    <div data-aos="zoom-out-down" data-aos-once="true" class="card bg-transparent border-0 rounded">
        <div class="card-body text-center">
            <i class="fas fa-users pb-md-4 rounded fa-3x text-info"></i>
            <h1 id="count_jml"  class="font-weight-bold" data-from="0" data-to="<?= $arr['jml_asn'] ?>"
            data-speed="3000"><?= nominal($arr['jml_asn']) ?></h1>
            <b class="text-secondary small">Jumlah ASN Kab. Balangan</b>
        </div>
    </div>
</div>
<div class="col-6 col-sm-6 col-md-3">
    <div data-aos="zoom-out-down" data-aos-once="true" class="card bg-transparent border-0 rounded">
        <div class="card-body text-center">
            <i class="fas fa-user-tie pb-md-4 fa-3x mx-auto text-success rounded"></i>
            <h1 id="count_jml" data-from="0" data-to="<?= $arr['jml_pns'] ?>"
            data-speed="3000" class="font-weight-bold"><?= nominal($arr['jml_pns']) ?></h1>
            <b class="text-secondary small">Jumlah PNS + CPNS</b>
        </div>
    </div>
</div>
<div class="col-6 col-sm-6 col-md-3 rounded-right">
    <div data-aos="zoom-out-down" data-aos-once="true" class="card bg-transparent rounded border-0">
        <div class="card-body text-center">
            <i class="far pb-md-4 fa-user-circle fa-3x mx-auto text-warning rounded"></i>
            <h1 id="count_jml" data-from="0" data-to="<?= $arr['jml_ptt'] ?>"
            data-speed="3000" class="font-weight-bold"><?= nominal($arr['jml_ptt']) ?></h1>
            <b class="text-secondary small">Jumlah NON PNS (Pendataan thn. 2018)</b>
        </div>
    </div>
</div>
<div class="col-6 col-sm-6 col-md-3 rounded-right">
    <div data-aos="zoom-out-down" data-aos-once="true" class="card bg-transparent rounded border-0">
        <div class="card-body text-center">
            <i class="fas pb-md-4 fa-house-user fa-3x mx-auto text-secondary rounded"></i>
            <h1 id="count_jml" data-from="0" data-to="<?= $arr['jml_pensiun'] ?>"
            data-speed="3000" class="font-weight-bold"><?= nominal($arr['jml_pensiun']) ?></h1>
            <b class="text-secondary small">Jumlah PNS Pensiun pada tahun <?= date('Y') ?></b>
        </div>
    </div>
</div>
<!-- <div class="col-12 text-md-right text-center mb-3 mb-md-0">
    <a href="<?= base_url('api/grafik') ?>" class="btn btn-sm btn-outline-secondary shadow-sm">Info Grafik Pegawai Lainnya <i class="fas fa-arrow-right ml-4"></i></a>
</div> -->