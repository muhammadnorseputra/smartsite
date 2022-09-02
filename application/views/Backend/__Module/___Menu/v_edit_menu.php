
<!-- <?php var_dump($x); ?> -->

<div class="card card-shadow m-t-15">
	<div class="header">
		<h2 class="card-title">EIDT MENU # <?= $this->menu->getnamamenu($id) ?></h2>
		<div class="clearfix"></div>
	</div>
	<div class="body">
  <?= form_open('backend/module/c_menu/proses_update_menu', array('id' => 'FormUpdateMenu')); ?>
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="row clearfix">
    <div class="col-lg-6">
        
        <label for="nama_menu">Nama Menu</label>
        <div class="form-group">
          <div class="form-line">
            <input type="text" id="nama_menu" name="nama_menu" class="form-control" value="<?= $x->nama_menu ?>">
          </div>
        </div>

        <label for="link">Link</label>
        <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">link</i>
								</span>
								<div class="form-line">
									<input type="text" class="form-control" id="linkmenu" name="linkmenu" value="<?= $x->link ?>">
								</div>
								<span class="input-group-addon">
									<?php if($x->link == '#') { ?> 
                    <input type="checkbox" checked id="md_checkbox_sub" class="filled-in chk-col-red">
                  <?php } else { ?>
                    <input type="checkbox" id="md_checkbox_sub" class="filled-in chk-col-red">
                  <?php } ?>                    
                  <label for="md_checkbox_sub">Submenu</label>
								</span>
							</div>
        <div class="row">
          <div class="col-md-6">
          <label>Status Menu</label>
            <div class="form-group">
              <?php if($x->sts == 'BACKEND') { ?> 
                <input name="sts" value="FRONTEND" type="radio" id="radio_sts30" class="with-gap radio-col-cyan" />
                <label for="radio_sts30">FRONTEND</label>
                <input name="sts" checked value="BACKEND" type="radio" id="radio_sts31" class="with-gap radio-col-pink" />
                <label for="radio_sts31">BACKEND</label>
              <?php } else { ?>
                <input name="sts" checked value="FRONTEND" type="radio" id="radio_sts30" class="with-gap radio-col-cyan" />
                <label for="radio_sts30">FRONTEND</label>
                <input name="sts" value="BACKEND" type="radio" id="radio_sts31" class="with-gap radio-col-pink" />
                <label for="radio_sts31">BACKEND</label>
              <?php } ?>
            </div>
          </div>

          <div class="col-md-6">
          <label>Aktif</label>
          <?php if($x->aktif == 'Y') { ?>
            <div class="form-group">
              <div class="switch">
                <label>DISABLED <input name="aktif" type="hidden" value="N"> <input name="aktif" type="checkbox" checked value="Y"> <span class="lever"></span> ENABLE</label>
              </div>
            </div>
          <?php } else { ?>
            <div class="form-group">
              <div class="switch">
              <label>DISABLED <input name="aktif" type="hidden" checked value="N"> <input name="aktif" type="checkbox" value="Y"> <span class="lever"></span> ENABLE</label>
              </div>
            </div>
          <?php } ?>  
          </div>
        </div>
        <div class="row">
			<div class="col-md-6">
				<label for="order">Urutan Menu</label>
				<div class="row form-group">
					<div class=" col-sm-8 m-t-5">
						<!--<div class="form-line">
						  <input type="number" class="form-control" id="order" min="0" max="10" value="1" name="ordermenu">
						</div>-->
						<div class="input-group spinner" data-trigger="spinner">
							<div class="form-line">
								<input type="text" name="ordermenu" class="form-control text-center" value="<?= $x->order ?>" data-rule="month" data-min="1" data-max="12">
							</div>
							<span class="input-group-addon">
								<a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
								<a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<label for="color">Color menu</label>
				<div class="input-group colorpicker colorpicker-element">
					<div class="form-line">
						<input type="text" name="color" class="form-control" id="color" value="<?= $x->color ?>">
					</div>
					<span class="input-group-addon">
						<i style="background-color: rgb(11, 185, 202);"></i>
					</span>
				</div>
			</div>
        </div>

        
    </div>
    <div class="col-lg-6">
        <label for="label">Pilih Label</label>
        <div class="form-group">
        <div class="form-line">
            <select name="label" id="label" title=" -- Pilih Label --" class="form-control selectpicker">
              <?php foreach($get_label as $label): ?>
                <?php if($x->fid_label == $label->id_label) { ?>
                  <option value="<?= $label->id_label ?>" selected><?= strtoupper($label->nama_label) ?></option>
                <?php } else {  ?>
                  <option value="<?= $label->id_label ?>"><?= strtoupper($label->nama_label) ?></option>
                <?php } ?>
              <?php endforeach; ?>
            </select>
        </div>
        </div>

        <label for="icons">Pilih Icons</label>
        <div class="form-group">
            <input type="hidden" name="icons" value="<?= $x->fid_icon ?>">
            <button type="button" class="waves-effect m-l-5 btn btn-sm btn-link btn-icon" data-poload="<?= base_url('backend/module/c_menu/listicons/'.$x->fid_icon) ?>">Pilih icon</button> 
            <i class="material-icons pull-left icon"><?= $x->fid_icon ?></i> 
        </div>

        <label for="module">Pilih Module</label>
        <div class="form-group">
        <div class="form-line">
            <select name="module" id="module" title="-- Pilih Module --" class="form-control">
              <?php foreach($get_module as $mod): ?>
                <?php if($x->fid_module == $mod->id_module) { ?>
                  <option value="<?= $mod->id_module ?>" selected>(<?= $mod->id_module ?>) <?= $mod->nama_module ?> </option>
                <?php } else {  ?>
                  <option value="<?= $mod->id_module ?>">(<?= $mod->id_module ?>) <?= $mod->nama_module ?> </option>
                <?php } ?>
              <?php endforeach; ?>
            </select>
        </div>
        </div>

        <label for="module">User Menu</label>
        <div class="form-group">
          <div class="form-line">
            <select name="user_menu" id="user_menu" title="-- Pilih User Menu --" class="form-control">
              
              <?php if($x->user_menu == 'Y') { ?>
                <option value="Y" selected>Tampilan Untuk User (Y)</option>
                <option value="N">Hanya Admin</option>
              <?php } else {  ?>
                <option value="Y">Tampilan Untuk User (Y)</option>
                <option value="N" selected>Hanya Admin</option>
              <?php } ?>
              
            </select>
          </div>
        </div>

        
    </div>
  </div>
  

  <button type="submit" class="btn btn-primary m-t-15 waves-effect">SIMPAN</button>
  <button type="button" class="btn btn-batal btn-warning m-t-15 waves-effect">BATAL</button>
  <?= form_close(); ?>
	</div>
</div>

<script>
$(function () {
	$('.colorpicker').colorpicker();
	$(".spinner").spinner('delay', 800);
    $('select').selectpicker({
		liveSearch: true,
		liveSearchPlaceholder: 'Masukan katakunci ...',
		showTick: true,
		size: 5
	});
});
function changeicon(icon) {
  if(icon != 'null') {
    $('i.icon').html(icon);
    $('[name="icons"]').val(icon);
  }
}

$('*[data-poload]').hover(function() {
    var e = $(this);
    e.off('hover');
    $.get(e.data('poload'), function(d) {
        e.popover({
            content: d,
            html: true,
            boundary: 'scrollParent'
        }).popover('enable');
    });
});

$(document).on('submit', '#FormUpdateMenu', function(e) {
  e.preventDefault();
  let form = $(this);
  $.post(form.attr('action'), form.serialize(), function(result) {
    /*showNotification(result.jenis, result.content, 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');*/
    $.alert({
		title: false,
		content: result.content,
		type: result.jenis,
		icon: result.icon,
		theme: 'modern',
		animationType: true,
		animateFromElement: false,
		animation: 'zoom',
		animationSpeed: 100,
		closeAnimation: 'opacity',
		onClose: function () {
			/*before the modal is hidden.*/
			window.location.href= result.goto;
		}
	});
  }, 'json');
}); 

$("#md_checkbox_sub").on("change", function() {
    let check1 = $("#md_checkbox_sub");
    if(check1[0].checked)
    {
        $("[name='linkmenu']").val('#').prop("readonly", true);
    }
    else
    {
        $("[name='linkmenu']").val('<?= $x->link ?>').prop("readonly", false).focus();
    }    
});

var btn_batal = $(document).on('click', 'button.btn-batal', function() {
    window.location.replace('<?= base_url('backend/module/c_menu?module='.$this->madmin->getmodule('MENU UTAMA').'&user='.$this->session->userdata('user_access')) ?>');
});
</script>