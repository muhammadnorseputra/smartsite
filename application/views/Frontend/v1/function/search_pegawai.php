<div class="px-3 pt-2 bg-white rounded border">
<div class="separator">
    <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-user-alt text-secondary mr-2"></i> Search PNS</span>
</div>
<form class="form-horizontal" id="caripegawai" method="GET" action="<?= base_url('frontend/v1/pegawai/detail') ?>">
    <div class="typeahead__container form-group text-left">
        <!-- <label for="js-nipnama" class="text-muted pb-2 small">Search Pegawai</label>  -->
        <div class="typeahead__field">
            <div class="typeahead__query">
                <input class="js-nipnama rounded" id="js-nipnama" name="filter[query]" placeholder="Masukan NIP" maxlength="18" autocomplete="off">
            </div>
            <!-- <div class="typeahead__button">
                <button type="submit">
                <i class="typeahead__search-icon"></i> Detail
                </button>
            </div> -->
        </div>
    </div>
</form>
</div>
<div class="devider-line" style="height:25px;"></div>