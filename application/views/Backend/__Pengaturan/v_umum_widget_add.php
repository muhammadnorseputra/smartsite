<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-4/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>">

<div class="container">
  <div class="row">
    <h6 class="title-widget-popup">Manajemen Widget</h6>
  </div>
</div>

<div class="container">
<div class="row">
    <div class="col-md-12">
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
             <i class="fa fa-sm fa-plus"></i> Tambahkan widget baru
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <?= form_open('backend/c_pengaturan/doAddWidgetToDb', array('id' => 'formAddWidget')) ?>
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title_widgets" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title widgets">
              </div>
              <div class="form-group">
                <label for="content">Content HTML</label>
                <textarea class="form-control" name="content_widgets" id="content" rows="5"></textarea>
                <small id="content" class="form-text text-muted">Jika statis widget, biarkan kosong pada kontent</small>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" name="show_widgets" type="radio" name="gridRadios" id="gridRadios1" value="N">
                  <label class="form-check-label" for="gridRadios1">
                    OFF
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" name="show_widgets" type="radio" name="gridRadios" id="gridRadios2" value="Y">
                  <label class="form-check-label" for="gridRadios2">
                    ON
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/blockUI/jquery.blockUI.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-notify/notify.min.js') ?>"></script>

<style>
h6.title-widget-popup {
  position: relative;
  display: block;
  width:100%;
  padding:15px 15px;
  top:0;
  left:0;
  color:#000;
  background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
  text-align: left;
  text-transform: uppercase;
  margin-bottom:20px;
  font-weight: bold;
}
</style>

<script>
  $("form#formAddWidget").on('submit', function(event) {
    event.preventDefault();
    var $form = $(this);
    var $data = $form.serialize();
    var $action = $form.attr('action');
    var $method = $form.attr('method');

    $.post($action, $data, function(response) {
      setTimeout(() => {
        $.notify(response.msg, {
          className: response.type,
          position: 'right bottom'
        });
        if(response.type != 'error') {
          $form[0].reset();
        }
      }, 2000);
    }, 'json').then(() => {
      $.blockUI({ 
          message: '<img src="<?= base_url('assets/images/loader/rolling.svg') ?>"> Mohon tunggu',
          css: { 
            border: 'none', 
            padding: '15px', 
            width: 'auto', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
    }).done(() => {
      setTimeout(() => {
        $.unblockUI();
        window.opener.loadTabsWidget();
      }, 2000);
      // window.opener.location.reload();
    }) ;
  });
</script>