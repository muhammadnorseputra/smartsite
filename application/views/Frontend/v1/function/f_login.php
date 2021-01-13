<div id="content2">
  <div class="content_inner"></div>
</div>
<?php echo form_open(base_url('frontend/v1/users/login/checkAkun'), ['id' => 'formLoginNavbar', 'autocomplete' => 'off']); ?>
<input type="hidden" name="session_login" value="<?php echo encrypt_url('bkppd_balangan' . date('d')) ?>">
<div class="form-group">
  <label for="InputEmail">Email address</label>
  <input type="email" name="email" data-sanitize="trim lower" class="form-control" id="InputEmail" placeholder="Enter email" required="required">
</div>
</div>
<div class="form-group">
  <label for="InputPassword">Password</label>
  <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password" required="required">
</div>
<p>
  <?php
  $this->session->set_userdata('captcha', array(mt_rand(0, 9), mt_rand(1, 9)));
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
        <input class="form-control" name="captcha" data-validation="spamcheck" data-validation-captcha="<?= ($val_1 + $val_2) ?>" />
      </div>
    </div>
  </div>
</p>

<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-lock mr-2"></i> Sign In</button>

<?php echo form_close(); ?>
<hr>
<a href="<?= base_url('frontend/v1/daftar'); ?>" class="btn btn-success btn-block">Belum punya akun?</a>

<script>
  $(document).ready(function() {
    $.validate({
      form: '#formLoginNavbar',
      lang: 'en',
      showErrorDialogs: true,
      modules: 'security, html5, sanitize',
      onError: function($form) {
        $('#content2').notifyModal({
          duration: 2500,
          placement: 'center',
          overlay: true,
          type: 'danger', //simple, dark
          icon: false,
          onLoad: function(el) {
            el.find(".content_inner").html('Validation of form failed!');
          },
          onClose: function(el) {
            $form.get(0).reset();
            $('button[type="submit"]').html("Sign In");
          }
        });
      },
      onSuccess: function($form) {
        var _action = $form.attr('action');
        var _method = $form.attr('method');
        var _data = $form.serialize();
        $.ajax({
          url: _action,
          method: _method,
          data: _data,
          dataType: 'json',
          beforeSend: function() {
            $('button[type="submit"]').html('<img src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/oval-white.svg') ?>">');
          },
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
      duration: 1800,
      placement: 'centerTopSlide',
      overlay: true,
      type: 'dark',
      icon: false,
      onLoad: function(el) {
        el.find(".content_inner").html(response.pesan);
        $('button[type="submit"]').html("Sign In");
      },
      onClose: function(el) {
        if (response.valid == true) {
          window.location.href = response.redirect;
        }
        $form.get(0).reset();
      }
    });
  }

  function errorLogin(error) {
    $('#content2').notifyModal({
      duration: 2500,
      placement: 'center',
      overlay: true,
      type: 'dark',
      icon: false,
      onLoad: function(el) {
        el.find(".content_inner").html("Oppss! sepertinya ada kesalaah nih, coba reload browser kamu");
      },
      onClose: function(el) {
        $('button[type="submit"]').html("Sign In");
      }
    });
  }
</script>
