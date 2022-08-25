<div class="card card-shadow">
	<div class="header">
		<h2 class="card-title">Tambah User</h2>
	</div>
		<div class="clearfix"></div>
	<div class="body">
    <div id="message"></div>
  <?= form_open_multipart('module/c_users/add', array('id' => 'FormUsers')); ?>
  <div class="alert alert-message alert-message-info m-b-25" role="alert">
   <i class="material-icons">info</i> 
   <b>Informasi User</b> <br>Masukan informasi pribadi user
  </div>
		<div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="gravatar">Gravatar</label>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-8 col-xs-7">
				<div class="form-group">
          <img id="preview" class="img-rounded" width="110" style="display:none;">
					<input type="file" name="gravatar"  onchange="view(event)" class="form-control">
				</div>
			</div>
		</div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="nama_lengkap">Nama Lengkap</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Masukan nama lengkap">
					</div>
				</div>
			</div>
		</div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="email">Email</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="email" name="email" class="form-control" placeholder="Masukan alamat email">
					</div>
				</div>
			</div>
		</div>

    <div class="alert alert-message m-b-25 alert-message-warning" role="alert">
    <i class="material-icons">info</i> <b>Informasi Akun</b><br>
      Formulir informasi akun, jangan berikan username & password anda kepada orang lain.
    </div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="username">Username</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="username" name="username" class="form-control" placeholder="Masukan usrname">
					</div>
				</div>
			</div>
		</div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="password">Password</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<input type="password" id="password" name="password" class="form-control" placeholder="Masukan password">
					</div>
				</div>
			</div>
		</div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="level">Level</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
					<div class="form-line">
						<select name="level" id="level" class="form-control">
            <option value="0"> -- PILIH LEVEL --</option>
              <option value="ADMIN"> ADMINISTRATOR</option>
              <option value="USER"> USER</option>
            </select>
					</div>
				</div>
			</div>
		</div>

		<div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="aktif">Aktif</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<div class="form-group">
          <input name="aktif" value="Y" type="radio" id="radio3" class="radio-col-green with-gap">
          <label for="radio3">Ya</label>

          <input name="aktif" value="N" type="radio" id="radio4" class="radio-col-grey with-gap">
          <label for="radio4">Tidak</label>
				</div>
			</div>
		</div>

    <div class="alert alert-message m-b-25" role="alert">
    <i class="material-icons">info</i> <b>Informasi Hak Akses</b><br>
      Hanya admin yang dapat memberikan module hak akses bagi user, pilih list module sebelah kiri dan sebelah kanan sebagai hak user.
    </div>

    <div class="row clearfix">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				<label for="hak">&nbsp;</label>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				<!-- <div class="well">
		          <?php 
		            foreach($module as $mod):
		          ?>
		            <input type="checkbox" name="fid_token[]" id="<?= $mod->id_module ?>" class="filled-in" value="<?= $mod->token ?>">
		            <label for="<?= $mod->id_module ?>"><?= ucwords($mod->nama_module) ?></label>
		          <?php endforeach; ?>
		        </div> -->
		        <select multiple="multiple" id="my-select" name="fid_token[]">
	            <?php 
	              foreach($module as $mod):
	            ?>
	            <option id="<?= $mod->id_module ?>" value='<?= $mod->token ?>'><?= ucwords($mod->nama_module) ?></option>
	            <?php endforeach; ?>
	          </select>
			</div>
		</div>

    <div class="row clearfix m-t-25">
		<div class="col-md-offset-2 col-md-4">
			
		<button type="button" id="c_module_batal" class="btn btn-danger waves-effect waves-red waves-ripple m-t-15 ">Batal</button>

    	<button type="submit" id="c_module_simpan" class="m-r-10 btn btn-primary waves-effect waves-teal waves-ripple m-t-15 m-l-10">Buat user baru</button>
     
		</div>
	</div>
    <?= form_close(); ?>
	</div>
</div>

<script>
var view 	= function(event) {
	var output 		= document.getElementById('preview');
	output.src = URL.createObjectURL(event.target.files[0]);
	output.style.display = "block";
}

$('#my-select').multiSelect({
  selectableFooter: "<div class='bg-grey p-l-15 p-t-15 p-b-15'>Module items</div>",
  selectionFooter: "<div class='bg-grey p-l-15 p-t-15 p-b-15'>User Module items</div>",
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Pencarian Module'>",
	selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Pencarian User Module'>",
	afterInit: function(ms){
	  var that = this,
	      $selectableSearch = that.$selectableUl.prev(),
	      $selectionSearch = that.$selectionUl.prev(),
	      selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
	      selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	  that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	  .on('keydown', function(e){
	    if (e.which === 40){
	      that.$selectableUl.focus();
	      return false;
	    }
	  });

	  that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	  .on('keydown', function(e){
	    if (e.which == 40){
	      that.$selectionUl.focus();
	      return false;
	    }
	  });
	},
	afterSelect: function(){
	  this.qs1.cache();
	  this.qs2.cache();
	},
	afterDeselect: function(){
	  this.qs1.cache();
	  this.qs2.cache();
	}
});

$("#FormUsers").on('submit', function (e) {
	e.preventDefault();
	let me = $(this);

		$.ajax({
			url: me.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			beforeSend: function () {
				NProgress.start();
				NProgress.inc(0.9);
			},
			data: new FormData(this),
			success: function (result) {
				if(result.request == true){
					showNotification('bg-teal', result.content, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
					me[0].reset();
					$("#preview").css({display: 'none'});
				} else {
					showNotification('bg-pink', result.error, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
				}
			},
			complete: function () {
				NProgress.done();
			}
		});
});
</script>