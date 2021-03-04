<?php
$local = '192.168.1.4';
$online = 'http://silka.bkppd-balangankab.info';
$status = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? $online : $local;
$host = $status;
?>
<?php
$arr = [
'jml_asn' => api_curl_get($host.'/api/get_grap/asn'),
'jml_pns' => api_curl_get($host.'/api/get_grap/pns'),
'jml_ptt' => api_curl_get($host.'/api/get_grap/nonpns')
]
?>
<div class="col-xs-12 col-sm-12 col-md-4 rounded-left">
    <div class="card bg-transparent border-0 rounded">
        <div class="card-body">
            <i class="fas fa-users p-4 rounded fa-3x text-info mx-auto"></i>
            <h3 id="count_jml"  data-from="0" data-to="<?= $arr['jml_asn'] ?>"
            data-speed="3000" data-refresh-interval="50" class="display-4 "><?= $arr['jml_asn'] ?></h3>
            <b class="text-secondary">Jumlah ASN Kab. Balangan</b>
        </div>
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-4 ">
    <div class="card bg-transparent my-md-0 my-4 border-0 rounded-0 big-card">
        <div class="card-body"  align-middle">
            <i class="fas fa-user-tie p-4 fa-3x mx-auto text-danger rounded"></i>
            <h3 id="count_jml" data-from="0" data-to="<?= $arr['jml_pns'] ?>"
            data-speed="3000" data-refresh-interval="50" class="display-4 "><?= $arr['jml_pns'] ?></h3>
            <b class="text-secondary">Jumlah PNS + CPNS</b>
        </div>
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-4  rounded-right">
    <div class="card bg-transparent rounded border-0">
        <div class="card-body">
            <i class="far p-4 fa-user-circle fa-3x mx-auto text-success rounded"></i>
            <h3 id="count_jml" data-from="0" data-to="<?= $arr['jml_ptt'] ?>"
            data-speed="3000" data-refresh-interval="50" class="display-4 "><?= $arr['jml_ptt'] ?></h3>
            <b class="text-secondary">Jumlah NON PNS</b>
        </div>
    </div>
</div>