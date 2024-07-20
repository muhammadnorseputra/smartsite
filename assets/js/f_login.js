$(document).ready(function () {
  $("input[name='email']").focus();
  $.validate({
    form: "#f_login",
    lang: "en",
    showErrorDialogs: true,
    modules: "toggleDisabled, security, html5, sanitize",
    disabledFormFilter: "form.toggle-disabled",
    onError: function ($form) {
      $("#content2").notifyModal({
        duration: 2500,
        placement: "center",
        overlay: true,
        type: "danger", //simple, dark
        icon: false,
        onLoad: function (el) {
          el.find(".content_inner").html("Validation of form failed!");
        },
        onClose: function (el) {
          $form.get(0).reset();
          $('button[type="submit"]').html(
            `<i class="fas fa-lock mr-2"></i> Log In`
          );
        },
      });
    },
    onSuccess: function ($form) {
      var _action = $form.attr("action");
      var _method = $form.attr("method");
      var _data = $form.serialize();
      $.ajax({
        url: _action,
        method: _method,
        data: _data,
        dataType: "json",
        beforeSend: function () {
          $('button[type="submit"]')
            .prop("disabled", true)
            .html(
              '<div class="d-flex justify-content-center align-items-center"><div style="width: 30px; height:30px;" class="loader_small"></div></div>'
            );
        },
        success: suksesLogin,
        error: errorLogin,
      });
      $form.removeClass("toggle-disabled");
      $form.get(0).reset();
      return false; // Will stop the submission of the form
    },
  });
});

function suksesLogin(response) {
  $("#content2").notifyModal({
    duration: 2800,
    placement: "centerTop",
    overlay: true,
    type: "success",
    icon: false,
    onLoad: function (el) {
      if (response.valid == true) {
        el.find(".content_inner").html(`${response.pesan}`);
      } else {
        error_msg(response);
      }
    },
    onClose: function (el) {
      if (response.valid == true) {
        window.location.href = response.redirect;
        $('button[type="submit"]')
          .prop("disabled", false)
          .html(`<i class="fas fa-lock mr-2"></i> Log In`);
      }
    },
  });
}

function errorLogin(error) {
  $("#content2").notifyModal({
    duration: 2500,
    placement: "center",
    overlay: true,
    type: "notify",
    icon: false,
    onLoad: function (el) {
      el.find(".content_inner").html(
        "Oppss! Token auth telah berubah. Silahkan login ulang."
      );
    },
    onClose: function (el) {
      $('button[type="submit"]')
        .prop("disabled", false)
        .html(`<i class="fas fa-lock mr-2"></i> Log In`);
      window.location.reload();
    },
  });
}

function error_msg(msg) {
  $("#content2").notifyModal({
    duration: 4500,
    placement: "centerTop",
    overlay: true,
    type: "alert",
    icon: true,
    onLoad: function (el) {
      el.find(".content_inner").html(msg.pesan);
    },
    onClose: function (el) {
      $('button[type="submit"]')
        .prop("disabled", false)
        .html(`<i class="fas fa-lock mr-2"></i> Log In`);
      // window.location.href = msg.redirect;
    },
  });
}

$(".toggle-password").click(function () {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
