<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/materialize-original/css/materialize.min.css') ?>">
<div class="row">
      
    <div class="card-panel teal">
      <h4 class="white-text"> 
        Edit Widget <br><b><?= $fromdata[0]->title ?></b>
      </h4>
    </div>
    <?= form_open('backend/c_pengaturan/doPutWidget', ['class' => 'col s12', 'id' => 'formUpdateWidget'], ['id_widget' => $fromdata[0]->id_widget ]) ?>
      <div class="row">
        <div class="input-field col s8">
          <input placeholder="Title" id="title" name="title_widget" data-length="100" value="<?= $fromdata[0]->title ?>" type="text" class="validate">
          <label for="first_name">Title Widget</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" name="content_widget" class="materialize-textarea tooltipped" data-length="500" data-position="bottom" data-delay="10" data-tooltip="Jika statis widget, biarkan kosong pada content HTML"><?= $fromdata[0]->content ?></textarea>
          <label for="textarea1">Content HTML</label>
        </div>
      </div>

      <div class="row">
        <!-- Switch -->
        <div class="col s12">
          <div class="switch">
          <p><label for="switch">Pilih <b>ON</b> apabila ditampilkan dan <b>OFF</b> disembuyikan.</label></p>
            <?php 
              $chek = ($fromdata[0]->show) == 'Y' ? 'checked' : '';
            ?>
            <label>
              Off
              <input type="hidden" name="show_widget" value="N">
              <input type="checkbox" name="show_widget" value="Y" <?= $chek ?>>
              <span class="lever"></span>
              On
            </label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col s2 offset-s8">
         <button class="waves-effect waves-light btn" type="submit">Simpan</button>
        </div>
      </div>  
      </div>
    <?= form_close() ?>
</div>

<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<!-- Compiled and minified JavaScript -->
<script src="<?= base_url('assets/plugins/materialize-original/js/materialize.min.js') ?>"></script>
<script>
  $("form#formUpdateWidget").on('submit', function(event) {
    event.preventDefault();
    var $this = $(this);
    $.post($this.attr('action'), $this.serialize(), function(response) {
      Materialize.toast(response.msg, 4000);
      if(response.type == 'OK') {
        /*window.opener.location.reload(true);*/
        window.opener.loadTabsWidget();
      }
    }, 'json');
  });
  
</script>
        