  $(document).ready(function() {
      $.validate({
          form: '#f_login',
          lang: 'en',
          showErrorDialogs: true,
          modules: 'toggleDisabled, security, html5, sanitize',
          disabledFormFilter: 'form.toggle-disabled',
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
                      $('button[type="submit"]').html(`<i class="fas fa-lock mr-2"></i> Log In`);
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
                      $('button[type="submit"]').html('Loading ...');
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
          placement: 'center',
          overlay: true,
          type: 'success',
          icon: false,
          onLoad: function(el) {
              if (response.valid == true) {
                  el.find(".content_inner").html(response.pesan);
              } else {
                  error_msg(response);
              }
              $('button[type="submit"]').html(`<i class="fas fa-lock mr-2"></i> Log In`);
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
              $('button[type="submit"]').html(`<i class="fas fa-lock mr-2"></i> Log In`);
          }
      });
  }

  function error_msg(msg) {
      $('#content2').notifyModal({
          duration: 3500,
          placement: 'center',
          overlay: true,
          type: 'danger',
          icon: false,
          onLoad: function(el) {
              el.find(".content_inner").html(msg.pesan);
          },
          onClose: function(el) {
              $('button[type="submit"]').html(`<i class="fas fa-lock mr-2"></i> Log In`);
              window.location.href = msg.redirect;
          }
      });
  }

  $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
          input.attr("type", "text");
      } else {
          input.attr("type", "password");
      }
  });