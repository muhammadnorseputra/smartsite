const CONTAINER = $("#countpeg_container");
const URL = 'http://silka.balangankab.go.id'

function Loading(isLoading) {
    if(isLoading) {
    return `<div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>
            <div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>
            <div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>
            <div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>
                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>`;
    }
}

CONTAINER.html(Loading(true));

fetch(`${URL}/api/get_grap_all`)
.then(response => response.json())
.then((res) => {
    Loading(false);
    CONTAINER.html(`
    <div class="col-6 col-sm-6 col-md-3 rounded-left">
        <div class="card bg-transparent border-0 rounded">
            <div class="card-body text-center">
                <i class="fas fa-users pb-md-4 rounded fa-3x text-info"></i>
                <h1 id="count_jml" class="font-weight-bold" data-speed="3000">${res.asn}</h1>
                <b class="text-secondary small">Jumlah ASN Kab. Balangan</b>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-md-3">
        <div class="card bg-transparent border-0 rounded">
            <div class="card-body text-center">
                <i class="fas fa-user-tie pb-md-4 fa-3x mx-auto text-success rounded"></i>
                <h1 id="count_jml" data-speed="3000" class="font-weight-bold">${res.pns}</h1>
                <b class="text-secondary small">Jumlah PNS + CPNS</b>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-md-3 rounded-right">
        <div class="card bg-transparent rounded border-0">
            <div class="card-body text-center">
                <i class="far pb-md-4 fa-user-circle fa-3x mx-auto text-warning rounded"></i>
                <h1 id="count_jml" data-speed="3000" class="font-weight-bold">${res.nonpns}</h1>
                <b class="text-secondary small">Jumlah NON PNS (Pendataan thn. 2018)</b>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-md-3 rounded-right">
        <div class="card bg-transparent rounded border-0">
            <div class="card-body text-center">
                <i class="fas pb-md-4 fa-home fa-3x mx-auto text-secondary rounded"></i>
                <h1 id="count_jml" data-speed="3000" class="font-weight-bold">${res.pensiun}</h1>
                <b class="text-secondary small">Jumlah PNS Pensiun</b>
            </div>
        </div>
    </div>
    `);
})
.catch(error => console.error(error))