<section class="bg-gradient-light py-3 mb-3 mb-md-5">
    <div class="container">
        <div class="row">
             <div class="col-12 py-md-5">
                <?php  
                    $sumber = 'https://data.covid19.go.id/public/api/prov.json';
                    $url    = api_client($sumber);
                    $data   = $url['list_data']['11'];
                    // var_dump($data);
                ?>
                <h3 class="text-muted">Data Sebaran Kasus Covid-19 Wilayah "<?= $data['key'] ?>"</h3>
                <div class="d-flex justify-content-between align-content-center text-center text-md-left">
                    <div class="w-100 border-right border-secondary">
                        <h3 class="text-info"><?= nominal($data['jumlah_kasus']) ?></h3>
                        <b>Jumlah Kasus</b>
                    </div>
                    <div class="w-100 border-right border-secondary ml-md-5">
                        <h3 class="text-success"><?= nominal($data['jumlah_sembuh']) ?></h3>
                        <b>Jumlah Sembuh</b>
                    </div>
                    <div class="w-100 border-right border-secondary ml-md-5">
                        <h3 class="text-danger"><?= nominal($data['jumlah_meninggal']) ?></h3>
                        <b>Jumlah Meninggal</b>
                    </div>
                    <div class="w-100 ml-md-5">
                        <h3 class="text-warning"><?= nominal($data['jumlah_dirawat']) ?></h3>
                        <b>Jumlah Dirawat</b>
                    </div>
                </div>
                <div class="small text-muted mt-4">Sumber: <a target="_blank" href="https://data.covid19.go.id">https://data.covid19.go.id</a> atau <a target="_blank" href="https://covid19.go.id/peta-sebaran-covid19">https://covid19.go.id/peta-sebaran-covid19</a></div>
                <div class="sr-only">
                    API: https://data.covid19.go.id/public/api/prov.json
                </div>
            </div>
        </div>
    </div>
</section>