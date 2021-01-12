<div id="content2">
    <div class="content_inner"></div>
</div>
<section class="h-100">
	<div class="container">
		<div class="row bg-white mt-5">

            <div class="col-md-7 my-5 bg-white">
                <img class="img-fluid w-75 mx-auto mt-5 d-block" src="<?php echo base_url('bower_components/SVG-Loaders/svg-loaders/undraw_authentication_fsn5.svg') ?>" alt="">
                <p class="font-weight-light text-center pt-3">
                    Haii, selamat datang pada websites badan kepegawaian pendidikan dan pelatihan daerah kabupaten balangan. Ayokk bergabung bersama kami
                </p>
                <hr>
                <a href="<?= base_url('frontend/v1/daftar'); ?>" class="btn btn-light rounded-pill"> Belum punya akun? daftar disini bro <i class="far fa-smile-wink"></i></a>
                <a href="<?= base_url('frontend/v1/beranda'); ?>" class="btn btn-link"><i class="fas fa-home"></i> Kembali ke homepage </a>
            </div>
			<div class="col-md-5 my-5">
				<div class="card border-right border-0 shadow-none">
                    <div class="card-header text-center bg-white">
                        <h1>Login</h1>
                        <p class="font-weight-light">Silahkan login dengan akun terdaftar</p>
                    </div>
                    <div class="card-body pb-0" style="overflow-y: auto; height: 380px;">
                        <?php echo form_open(base_url('frontend/v1/users/login/checkAkun'), ['id' => 'form_login']); ?>
                            <input type="hidden" name="session_login" value="<?php echo encrypt_url('bkppd_balangan'.date('d')) ?>">
                          <div class="form-group">
                            <label for="InputEmail">Email address</label>
                            <input type="email" 
                                name="email"
                                data-sanitize="trim lower"
                                class="form-control" 
                                id="InputEmail" 
                                placeholder="Enter email"
                                required="required">
                          </div>
                          <div class="form-group">
                            <label for="InputPassword">Password</label>
                            <input type="password"
                                name="password" 
                                class="form-control" 
                                id="InputPassword" 
                                placeholder="Password"
                                required="required">
                          </div>
                          <p>
                                <?php 
                                $this->session->set_userdata('captcha', array(mt_rand(0,9), mt_rand(1, 9)));
                                ?>
                                    <?php 
                                     $val_1 = $this->session->userdata('captcha')[0];
                                     $val_2 = $this->session->userdata('captcha')[1];
                                    ?>
                                    Berapa hasil penjumlahan dari <b><?= $val_1 ?> + <?= $val_2 ?></b> ?
                                    (security question)
                                    <div class="row">
                                    <div class="form-group col-8">
                                    <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input class="form-control" name="captcha" data-validation="spamcheck"
                                        data-validation-captcha="<?= ($val_1 + $val_2) ?>"/>
                                    </div>
                                    </div>
                                    </div>
                                </p>
                                <button type="submit" class="py-2 btn btn-block btn-info"><i class="fas fa-lock mr-3"></i> Sign In</button>

                        <?php echo form_close(); ?>
                        
                    </div>
                    <!-- <div class="card-footer bg-white font-weight-light">
                        &copy; 2020 IT BKPPD Kab. Balangan
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(window).ready(function() {

  $.validate({
    form: '#form_login',
    lang : 'en',
    showErrorDialogs : true,
    modules : 'security, html5, sanitize',
    onError : function($form) {
        $('#content2').notifyModal({
            duration : 2500,
            placement : 'center',
            overlay : true,
            type : 'danger', //simple, dark
            icon: false,
            onLoad : function(el) {
                el.find(".content_inner").html('Validation of form failed!');
            },
            onClose : function(el) {
                $form.get(0).reset();
            }
        });
    },
    onSuccess : function($form) {
      var _action = $form.attr('action');
      var _method = $form.attr('method');
      var _data   = $form.serialize();
      $.ajax({
        url: _action,
        method: _method,
        data: _data,
        dataType: 'json',
        success: suksesLogin,
        error: errorLogin,
      });
      return false; // Will stop the submission of the form
      $form.removeClass('toggle-disabled');
    }
  });
});

  function suksesLogin(response) {
    $('#content2').notifyModal({
        duration : 3500,
        placement : 'centerTop',
        overlay : true,
        type : 'simple',
        icon: false,
        onLoad : function(el) {
            el.find(".content_inner").html(response.pesan);
        },
        onClose : function(el) {
            if(response.valid == true) {
                window.location.href = response.redirect;
            } 
            $form.get(0).reset();
        }
    });
  }

  function errorLogin(error) {
    $('#content2').notifyModal({
        duration : 2500,
        placement : 'center',
        overlay : true,
        type : 'dark',
        icon: false,
        onLoad : function(el) {
            el.find(".content_inner").html("Oppss! sepertinya ada kesalaah nih, coba reload browser kamu");
        },
        onClose : function(el) {}
    });
  }
</script>
<script src="<?php echo base_url('bower_components/jquery-form-validator/form-validator/jquery.form-validator.min.js'); ?>"></script>