"use strict";
// $(document).ready(function() {
//     AOS.init();
// });
"use strict";
"use strict";

$(document).ready(function () {
  var $backToTop = $(".btn-backtop");
  $backToTop.hide();
  $(window).on('scroll loaded', function () {
    if ($(this).scrollTop() > 120) {
      $backToTop.fadeIn();
    } else {
      $backToTop.fadeOut();
    }
  });
  $backToTop.on('click', function (e) {
    $("html, body").animate({
      scrollTop: 0
    }, 800);
  });
});
// $(document).ready(function () {
//   $(document).on("click", ".btn-login", function () {
//     $(this).popModal({
//       html: {
//         url: $(this).attr('data-location'),
//         method: "POST",
//         dataType: "html",
//         loadingText: `<img src="${_uri}/bower_components/SVG-Loaders/svg-loaders/oval.svg" width="20" class="d-block mx-auto my-5">`,
//         errorText: "An error has occurred",
//       },
//       showCloseBut: false,
//       onDocumentClickClose: true,
//       overflowContent: false,
//       inline: true,
//       asMenu: false,
//     });
//   });
// });
"use strict";
// $(document).ready(function () {
//   $('.btn-menus').click(function () {
//     $(this).popModal({
//       html: {
//         url: $(this).attr('data-menus'),
//         method: "POST",
//         dataType: "html",
//         loadingText: `<div class="d-block mx-auto text-center my-auto">
// 					<img src="${_uri}/bower_components/SVG-Loaders/svg-loaders/oval.svg" width="20" class="d-block mx-auto my-5">
// 					</div>`,
//       },
//       placement: 'bottomLeft',
//       asMenu: true
//     });
//   });
// });
"use strict";
"use strict";

$(document).ready(function () {
  $(document).on("click", "#btn-share", function () {
    var _id = $(this).attr("data-row-id");

    $.confirm({
      title: false,
      content: "url:" + _uri + "/frontend/v1/beranda/share_artikel/" + _id,
      columnClass: "medium",
      theme: "supervan",
      bgOpacity: 0.9,
      animateFromElement: true,
      animationSpeed: 800,
      buttons: false,
      backgroundDismiss: true,
      animation: 'none',
      closeAnimation: 'none'
    });
  });
});
"use strict";

function like_toggle(x) {
  x.classList.toggle("btn-like");
  var count_like = $(x).find('span.count_like').text();
  var like = parseInt(count_like) + 1;
  var dislike = parseInt(count_like) - 1;
  var id_user = $(x).attr('data-id-user');
  var id_berita = $(x).attr('data-id-berita');

  if (id_user != 0) {
    if (x.classList.contains('btn-like')) {
      $(x).find('i').removeClass('far').addClass('fas text-danger');
      $.post(_uri + '/frontend/v1/beranda/likes?type=like', {
        id_a: id_user,
        id_b: id_berita,
        likes: like
      }, function (response) {
        if (response == true) {
          notif({
            msg: "Postingan Disukai <i class=\"fas fa-thumbs-up ml-2\"></i>",
            type: "success",
            offset: 0,
            position: "bottom",
            bgcolor: "#333",
            color: "#eee",
            timeout: 1000,
            width: 300
          }); // count_like.text(like);

          $(x).find('span.count_like').text(like);
        }
      }, 'json');
    } else {
      $(x).find('i').removeClass('fas text-danger').addClass('far');
      $.post(_uri + '/frontend/v1/beranda/likes?type=dislike', {
        id_a: id_user,
        id_b: id_berita,
        likes: dislike
      }, function (response) {
        if (response == true) {
          notif({
            msg: "Postingan Tidak Disukai <i class=\"fas fa-thumbs-down ml-2\"></i>",
            type: "error",
            offset: 0,
            position: "bottom",
            bgcolor: "#333",
            color: "#eee",
            timeout: 1000,
            width: 300
          }); // count_like.text(dislike);

          $(x).find('span.count_like').text(dislike);
        }
      }, 'json');
    }
  } else {
    // window.location.href = _uri + "/frontend/v1/users/login?msg=logindulu";
    $("#noticeSigin").modal('show').modal('handleUpdate');
  }
}

function bookmark_toggle(x) {
  x.classList.toggle("btn-bookmark");
  var id_user = $(x).attr('data-id-user');
  var id_berita = $(x).attr('data-id-berita');

  if (id_user != 0) {
    if (x.classList.contains('btn-bookmark')) {
      $(x).find('i').removeClass('far').addClass('fas text-primary');
      $.post(_uri + '/frontend/v1/beranda/bookmark?type=on', {
        id_a: id_user,
        id_b: id_berita,
        post: 'on'
      }, function (response) {
        if (response == true) {
          notif({
            msg: "Postingan Disimpan  <i class=\"fas fa-check-circle ml-2\"></i>",
            type: "success",
            offset: 0,
            position: "bottom",
            bgcolor: "#333",
            color: "#eee",
            timeout: 1000,
            width: 300
          });
        }
      }, 'json');
    } else {
      $(x).find('i').removeClass('fas text-primary').addClass('far');
      $.post(_uri + '/frontend/v1/beranda/bookmark?type=off', {
        id_a: id_user,
        id_b: id_berita,
        post: 'off'
      }, function (response) {
        if (response == true) {
          notif({
            msg: "Postingan Tidak Disimpan",
            type: "warning",
            offset: 0,
            position: "bottom",
            bgcolor: "#333",
            color: "#eee",
            timeout: 1000,
            width: 300
          });
        }
      }, 'json');
    }
  } else {
    // window.location.href = _uri + "/frontend/v1/users/login?msg=logindulu";
    $("#noticeSigin").modal('show').modal('handleUpdate');
  }
}

function modeBaca(x) {
  x.classList.toggle('btn-dark');

  if (x.classList.contains('btn-dark')) {
    Focusable.setFocus($(".card-post"), {
      fadeDuration: 700,
      hideOnClick: false,
      hideOnESC: false,
      findOnResize: true
    });
  } else {
    Focusable.hide();
  }
}
// $(document).ready(function() {
//     $('#camera_wrap').camera({
//         //here I declared some settings, the height and the presence of the thumbnails 
//         height: '30%',
//         pagination: false,
//         thumbnails: false,
//         loader: 'bar',
//         autoAdvance: true,
//         barPosition: 'top',
//         loaderColor: 'teal',
//         loaderBgColor: '#fff',
//         alignment: 'center',
//         easing: 'easeInOutCubic', //http://jqueryui.com/demos/effect/easing.html
//         fx: 'random',
//         time: 7000,
//         transPeriod: 1300
//     });
// });
"use strict";
"use strict";

$('.collapsible-link').click(function () {
  $(this).find('i').toggleClass('fas fa-folder fas fa-folder-open');
  $(this).find('i').toggleClass('text-white text-warning');
});
"use strict";

$(document).ready(function () {
  var $el = $("#exampleFormControlTextarea1").emojioneArea({
    pickerPosition: "top",
    tonesStyle: "bullet",
    placeholder: "Masukan komentar kamu disini.",
    search: false,
    filtersPosition: "top",
    recentEmojis: false
  });
  var $online = _uriSegment[1] == 'post';
  var $local = _uriSegment[2] == 'post';
  var $url = $host ? $local : $online;

  if ($url) {
    displayComments();
  } else {
    console.log('Komentar tidak ditampilkan dikarnakan anda belum login atau bukan halaman detail berita');
  }

  function displayComments() {
    $.getJSON("".concat(_uri, "/frontend/v1/post/displayKomentar/").concat($host ? _uriSegment[4] : _uriSegment[3]), function (response) {
      $(".tracking-list").html(response);
    });
  } // Reply komentar


  $(document).on('click', '#btn-reply-comment', function () {
    var id_parent = $(this).attr('data-id-parent');
    var id_berita = $(this).attr('data-id-berita');
    var id_user_comment = $(this).attr('data-id-user-comment');
    var id_user_username = $(this).attr('data-username');
    var id_comment = $(this).attr('data-id-comment');
    $(".reply_username").attr('id', "".concat(id_comment)).attr('username', "@".concat(id_user_username.trim().toLowerCase())).html("Reply <span class=\"text-info\">@".concat(id_user_username.trim().toLowerCase(), "</span> <button onclick=\"batal()\" class=\"btn btn-sm text-danger btn-default\">x</button>"));
    $(".emojionearea-editor").html("@".concat(id_user_username.trim().toLowerCase())).focus();
  }); // Button hapus komentar

  $(document).on('click', '#btn-delete-comment', function () {
    var id = $(this).attr('data-id');
    $.getJSON(_uri + '/frontend/v1/post/deleteComment', {
      id: id
    }, function (response) {
      if (response == true) {
        displayComments();
        notif({
          msg: "Komentar dihapus <i class=\"fas fa-trash ml-3\"></input>",
          type: "info",
          position: "bottom"
        });
      }
    });
  }); // Form submit komentar

  $(document).on('submit', 'form#f_komentar', function (e) {
    e.preventDefault();
    var form = $(this);
    var method = form.attr('method');
    var action = form.attr('action');
    var id_berita = form.attr('class');
    var id_user_comment = $(".reply_username").attr('id');
    var id_user_username = $(".reply_username").attr('username'); // let isi_komentar = $("textarea").val();

    var isi_komentar = $el[0].emojioneArea.getText();

    if (isi_komentar != '') {
      $.post(action, {
        id_b: id_berita,
        id_c: id_user_comment,
        isi: isi_komentar
      }, function (response) {
        if (response == true) {
          batal();
          displayComments();
        }
      }, 'json');
    } else {
      $(".emojionearea-editor").addClass('is-invalid').focus(); // alert('Kolom Komentar Kosong');
    }
  });
});

function batal() {
  $(".emojionearea-editor").html('');
  $(".emojionearea-editor").removeClass('is-invalid').addClass('is-valid');
  $(".reply_username").attr('id', '').html('');
}
"use strict";

$(document).ready(function () {
  $('.controler-ticker').easyTicker({
    direction: 'up',
    easing: 'swing',
    speed: 'slow',
    interval: 2000,
    height: '250px',
    visible: 3,
    mousePause: true,
    controls: {
      up: '.btn-up',
      down: '.btn-down',
      toggle: '.btn-toggle',
      playText: '<i class="fas fa-play-circle"></i>',
      stopText: '<i class="fas fa-pause-circle"></i>'
    },
    callbacks: {
      before: false,
      after: false
    }
  }); // $('.headline-ticker').easyTicker({
  //     visible: 1,
  //     interval: 4000,
  //     direction: 'up',
  //     controls: {
  //         up: '.btn-up',
  //         down: '.btn-down',
  //         toggle: '.btn-toggle',
  //         playText: '<i class="fas fa-play-circle"></i>',
  //         stopText: '<i class="fas fa-pause-circle"></i>'
  //     },
  // });
});
// $(document).ready(function () {
// 	$.validate({
// 		form: '#form_daftar',
// 		lang: 'en',
// 		modules: 'toggleDisabled, date, security, html5, file, sanitize',
// 		disabledFormFilter: 'form.toggle-disabled',
// 		showErrorDialogs: true,
// 		onError: function ($form) {
// 			alert('Validation of form ' + $form.attr('id') + ' failed!');
// 		},
// 		onSuccess: function ($form) {
// 			var _action = $form.attr('action');
// 			var _method = $form.attr('method');
// 			//   var _data   = $form.serialize();
// 			$.ajax({
// 				url: _action,
// 				method: _method,
// 				data: new FormData($form),
// 				processData: false,
// 				cache: false,
// 				beforeSend: function () {
// 					$('button[type=submit]').text('Proccessing ...');
// 				},
// 				dataType: 'json',
// 				success: function (response) {
// 					if (response.valid == true) {
// 						// window.location.replace("<?= base_url('frontend/v1/daftar/') ?>");
// 						alert(response.msg);
// 						$form.get(0).reset();
// 						$('button[type=submit]').text('Submit');
// 					}
// 				},
// 				error: function (_error) {
// 					$('button[type=submit]').text('Submit');
// 					alert('error');
// 				}
// 			});
// 			return false; // Will stop the submission of the form
// 		},
// 		onModulesLoaded: function () {
// 			$('#alamat').restrictLength($('#maxlength'));
// 		}
// 	});
// 	// Callendar Event
// 	// $('#tl-container input#tl').datepicker({
// 	// 	clearBtn: true,
// 	// 	forceParse: false,
// 	// 	calendarWeeks: true,
// 	// 	autoclose: true,
// 	// 	format: 'dd/mm/yyyy',
// 	// 	todayHighlight: true,
// 	// 	toggleActive: true,
// 	// });
// 	// API 
// 	$('#nohp').mask('0000-0000-0000', {
// 		placeholder: "____   -   ____   -  ____",
// 		selectOnFocus: true
// 	});
// 	$('#tl').mask('00/00/0000', {
// 		placeholder: "__/__/____"
// 	});
// 	// Image Preview
// 	function readURL(input, $element) {
// 		if (input.files && input.files[0]) {
// 			var reader = new FileReader();
// 			reader.onload = function (e) {
// 				$($element).attr('src', e.target.result);
// 			}
// 			reader.readAsDataURL(input.files[0]); // convert to base64 string
// 		}
// 	}
// 	$("input[name='photo_pic']").change(function () {
// 		readURL(this, $('img.photo_pic'));
// 	});
// 	$("input[name='photo_ktp']").change(function () {
// 		readURL(this, $('img.photo_ktp'));
// 	});
// });
"use strict";
// $(document).ready(function() {
// function suksesLogin(response) {
//     $('#content2').notifyModal({
//         duration : 3500,
//         placement : 'centerTop',
//         overlay : true,
//         type : 'simple',
//         icon: false,
//         onLoad : function(el) {
//             el.find(".content_inner").html(response.pesan);
//         },
//         onClose : function(el) {
//             if(response.valid == true) {
//                 window.location.href = response.redirect;
//             } 
//             $form.get(0).reset();
//         }
//     });
//   }
// function errorLogin(error) {
// $('#content2').notifyModal({
//     duration : 2500,
//     placement : 'center',
//     overlay : true,
//     type : 'dark',
//     icon: false,
//     onLoad : function(el) {
//         el.find(".content_inner").html("Oppss! sepertinya ada kesalaah nih, coba reload browser kamu");
//     },
//     onClose : function(el) {}
// });
// }
// $.validate({
//     form: '#form_login',
//     lang : 'en',
//     showErrorDialogs : true,
//     modules : 'security, html5, sanitize',
//     onError : function($form) {
//         $('#content2').notifyModal({
//             duration : 2500,
//             placement : 'center',
//             overlay : true,
//             type : 'danger', //simple, dark
//             icon: false,
//             onLoad : function(el) {
//                 el.find(".content_inner").html('Validation of form failed!');
//             },
//             onClose : function(el) {
//                 $form.get(0).reset();
//             }
//         });
//     },
//     onSuccess : function($form) {
//       var _action = $form.attr('action');
//       var _method = $form.attr('method');
//       var _data   = $form.serialize();
//       $.ajax({
//         url: _action,
//         method: _method,
//         data: _data,
//         dataType: 'json',
//         success: suksesLogin,
//         error: errorLogin,
//       });
//       return false; // Will stop the submission of the form
//       $form.removeClass('toggle-disabled');
//     }
//   });
// });
"use strict";
"use strict";

$(function () {
  var h = new Date().getHours();
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();
  if (h > 3 && h < 12) $("span#halojs").text("Selamat Pagi,");
  if (h > 11 && h < 16) $("span#halojs").text("Selamat Siang,");
  if (h > 15 && h < 18) $("span#halojs").text("Selamat Sore,");
  if (h > 17 && h < 24) $("span#halojs").text("Selamat Malam,");
  if (h > 23 || h < 4) $("span#halojs").text('Sekarang Jam  ' + h + ':' + m);
});
"use strict";

function explore() {
  document.querySelector('#').scrollIntoView({
    behavior: 'smooth',
    block: "start"
  });
}

$(document).ready(function () {
  // get all berita
  var limit = 5;
  var start = 0;
  var action = "inactive";
  console.log(_uriSegment);
  var $url = $host ? _uriSegment[2] : _uriSegment[1];

  if ($url == 'beranda') {
    var load_data_message = function load_data_message() {
      $("#load_data_message").html("<div class=\"card border-0 bg-transparent shadow-none mb-5\">\n                        <div class=\"card-body text-danger text-center\">\n                        <img src=\"".concat(_uri, "/template/v1/img/humaaans-3.png\" alt=\"croods\" class=\"img-fluid rounded\">\n                            <h5 class=\"card-title\">Yahhh! abis</h5>  \n                            <p class=\"font-weight-light text-secondary\"> Berita telah berakhir.</p>\n                        </div>\n                    </div>"));
    };

    var lazzy_loader = function lazzy_loader(limit) {
      var output = "";

      for (var count = 0; count < 1; count++) {
        output += "\n                <div class=\"card border border-light bg-white shadow-sm mb-3\" style=\"border-radius:5px;\">\n                    <div class=\"card-header border-0 bg-white\" style=\"border-radius:5px;\">\n                    <p>\n                    <span class=\"content-placeholder rounded-circle float-left mr-3\" style=\"width:50px; height: 50px;\">&nbsp;</span>\n\n                    <span class=\"content-placeholder rounded-lg float-left\"\n                    style =\"width:50%; height: 50px;\"> &nbsp; </span>\n\n                    <span class =\"content-placeholder rounded-circle float-right mt-1 mr-3\"\n                    style =\"width:40px; height: 40px;\"> &nbsp; </span>\n                    </p> \n                    </div> \n                    <div class = \"card-body p-0\">\n                    <span class =\"content-placeholder rounded-0\" style=\"width:100%; height: 300px;\"> &nbsp; </span>\n                    </div> \n                    <div class =\"card-footer d-flex justify-content-bettwen p-3 bg-transparent\">\n                        <span class=\"content-placeholder rounded w-100 mr-2 p-2\"> &nbsp; </span>\n                        <span class=\"content-placeholder rounded w-100 mr-2 p-2\"> &nbsp; </span>\n                        <span class=\"content-placeholder rounded w-100 mr-2 p-2\"> &nbsp; </span>\n                        <span class=\"content-placeholder rounded w-100 p-2\"> &nbsp; </span>\n                    </div> \n                </div>\n            ";
      }

      $("#load_data_message").html(output);
      $("button#load_more").html("<div class=\"d-flex justify-content-center align-items-center\">\n        <div class=\"loader_small\" style=\"width:20px; height: 20px;\"></div>\n      </div> ").prop('disabled', true);
    };

    var load_data = function load_data(limit, start) {
      $.ajax({
        url: _uri + '/frontend/v1/beranda/get_all_berita',
        method: "POST",
        data: {
          limit: limit,
          start: start,
          type: urlParams.get('type'),
          sort: urlParams.get('sort')
        },
        cache: true,
        dataType: "json",
        success: function success(data) {
          if (data.html == "") {
            load_data_message();
            $("button#load_more").hide();
            action = "active";
          } else {
            if (data.count < 5) {
              $("button#load_more").hide();
              load_data_message();
            } else {
              $("#load_data_message").html("");
            }

            $("#load_data").append(data.html);
            $("button#load_more").html("<i class=\"fas fa-newspaper mr-2\"></i> Berita Sebelumnya").prop('disabled', false);
            action = "inactive";
            $(".lazy").lazy({
              beforeLoad: function beforeLoad(element) {
                element.addClass('beforeLoaded');
              },
              afterLoad: function afterLoad(element) {
                element.addClass('isLoaded').removeClass('lazy beforeLoaded');
              }
            });
            $(".rippler").rippler({
              effectClass: 'rippler-effect'
            }); // Tooltips

            $('[data-toggle="tooltip"]').tooltip({
              delay: 300,
              offset: '0,10px',
              padding: 10
            });
          }
        },
        error: function error(xhr) {
          alert("Error dalam meload berita, created_by tidak ditemukan.");
        }
      });
    };

    lazzy_loader(limit);

    if (action == "inactive") {
      action = "active";
      load_data(limit, start);
    } // $(window).scroll(function() {
    //     if (
    //         $(window).scrollTop() + $(window).height() > $("#load_data").height() &&
    //         action == "inactive"
    //     ) {
    //         lazzy_loader(limit);
    //         action = "active";
    //         start = start + limit;
    //         setTimeout(function() {
    //             load_data(limit, start);
    //         }, 300);
    //     }
    // });


    $("button#load_more").on("click", function (e) {
      e.preventDefault();

      if (action == "inactive") {
        lazzy_loader(limit);
        action = "active";
        start = start + limit;
        setTimeout(function () {
          load_data(limit, start); // localStorage.removeItem(`${_uri}/frontend/v1/beranda/get_all_berita`);
        }, 300);
      }
    });
  } else {
    console.log('Semua berita tidak ditampilkan, karna bukan halaman beranda');
  }
});
"use strict";
// $(function() {
//     $('h3#count_jml').countTo({
//         refreshInterval: '50',
//         formatter: function(value, options) {
//             return value.toFixed(options.decimals);
//         },
//     });
// });
"use strict";
// $(document).ready(function () {
// // Instagram
// function nFormatter(num) {
// 	if (num >= 1000000000) {
// 		return (num / 1000000000).toFixed(1).replace(/\.0$/, "") + "G";
// 	}
// 	if (num >= 1000000) {
// 		return (num / 1000000).toFixed(1).replace(/\.0$/, "") + "M";
// 	}
// 	if (num >= 1000) {
// 		return (num / 1000).toFixed(1).replace(/\.0$/, "") + "K";
// 	}
// 	return num;
// }
// var instagram_user = $("a.btn-instagram").attr("data-username");
// $.ajax({
// 	url: "https://www.instagram.com/" + instagram_user + "/?__a=1",
// 	type: "get",
// 	success: function (response) {
// 		console.log(response);
// 		// var username = response.graphql.user.username;
// 		// var profile_pic = response.graphql.user.profile_pic_url;
// 		// var followers = response.graphql.user.edge_followed_by.count;
// 		// var follow = response.graphql.user.edge_follow.count;
// 		// $("p.instagram-biograpy").html(response.graphql.user.biography);
// 		// $("a.btn-follow").attr("href", `https://www.instagram.com/${username}/`);
// 		// $("p.instagram-user").html(`<b>@${username}</b>`);
// 		// $("img.profile-pic").attr("data-src", profile_pic);
// 		// $("span.count_ig").html(followers);
// 		// $("span.count_ig_follow").html(follow);
// 	},
// });
// });
"use strict";
"use strict";

$(document).ready(function () {
  $(".lazy").lazy({
    threshold: 300,
    beforeLoad: function beforeLoad(element) {
      // var imageSrc = element.data('src');
      element.addClass('lazy');
    },
    afterLoad: function afterLoad(element) {
      // var imageSrc = element.data('src');
      element.addClass('isLoaded').removeClass('lazy');
    }
  });
});
"use strict";

lightbox.option({
  'resizeDuration': 300,
  'wrapAround': false,
  'fadeDuration': 400,
  'imageFadeDuration': 400,
  'disableScrolling': true,
  'albumLabel': "Gambar %1 dari %2"
});
"use strict";

document.onreadystatechange = function () {
  if (document.readyState !== "complete") {
    // document.querySelector("html").style.visibility = "hidden";
    document.querySelector(".page-slider").style.transition = "0";
    document.querySelector(".page-slider").style.opacity = 1;
  } else {
    document.querySelector(".page-slider").style.transition = "0.5s";
    document.querySelector(".page-slider").style.opacity = 0;
    document.querySelector(".page-slider").style.visibility = "hidden"; // document.querySelector("html").style.visibility = "visible";
  }
};
"use strict";

$(function () {
  var $grid = $('.grid').masonry({
    percentPosition: true,
    transitionDuration: '0.8s'
  }); // layout Masonry after each image loads

  $grid.imagesLoaded().progress(function () {
    $grid.masonry();
  });
});
"use strict";

$(document).ready(function () {
  // make it as accordion for smaller screens
  $(document).scroll(function () {
    if ($(document).scrollTop() > 30) {
      $("nav#navbar").css("transition", ".5s ease-in-out").addClass("bg-blur py-0");
      $("button#caripost").addClass('btn-outline-light');
    } else {
      $("button#caripost").removeClass('btn-outline-light'); // $("button#caripost").toggleClass('');

      $("nav#navbar").removeClass("bg-blur py-0");
    }
  }); // var prevScrollpos = window.pageYOffset;
  // window.onscroll = function() {
  //     var currentScrollPos = window.pageYOffset;
  //     if (prevScrollpos > currentScrollPos) {
  //         document.getElementById("navbar").style.top = "0";
  //     } else {
  //         document.getElementById("navbar").style.top = "-80px";
  //     }
  //     prevScrollpos = currentScrollPos;
  // }
});
// $(function() {
// 	window.paceOptions = {
// 	  ajax: false, // disabled
// 	  document: false, // disabled
// 	  eventLag: false, // disabled
// 	  elements: false
// 	};
// });
"use strict";
// $(document).ready(function() {
//     var rellax = new Rellax(".hero-beranda", {
//         speed: -3,
//         center: false,
//         wrapper: null,
//         round: true,
//         vertical: true,
//         horizontal: false,
//     });
// });
"use strict";
"use strict";

$(document).ready(function () {
  $(".rippler").rippler({
    effectClass: 'rippler-effect',
    effectSize: 16 // Default size (width & height)
    ,
    addElement: 'div' // e.g. 'svg'(feature)
    ,
    duration: 400
  });
});
"use strict";

// Mengijinkan cors origin dari https ke http
// if (window.location.protocol.indexOf('https') == 0) {
//     var el = document.createElement('meta')
//     el.setAttribute('http-equiv', 'Content-Security-Policy')
//     el.setAttribute('content', 'upgrade-insecure-requests')
//     document.head.append(el)
// }
// Uri Segement
var $host = window.location.origin == 'http://localhost';

if ($host) {
  var _uri = "".concat(window.location.origin, "/smartsite");

  var _silka = "http://192.168.1.4";
} else {
  var _silka = "http://silka.bkppd-balangankab.info";

  var _uri = "".concat(window.location.origin);
}

var _uriSegment = window.location.pathname.split('/');

console.log('Location Origin', _uri); // Params

var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
console.log('Params', queryString);
"use strict";

$(function () {
  $("button#caripost").on("click", function () {
    $("#mpostseacrh").modal('show');
    $("input[name='q']").focus();
  });
  $("a#caripost").on("click", function () {
    $("#mpostseacrh").modal('show');
    $("input[name='q']").focus();
  });
  $("a#mobileMenuNav").on("click", function () {
    $("#mobileMenu").modal('show');
  });
  $('#mpostseacrh').on('hidden.bs.modal', function (e) {
    $("input[name='q']").val('');
    $("#form_post_search").submit();
  });
  $("#form_post_search").on("submit", function (e) {
    e.preventDefault();

    var _this = $(this);

    var _input = _this[0].q;

    var _container = $("#search-result");

    if (_input.value == '') {
      _container.html("<div class=\"pl-3 pl-md-0 rounded d-flex justify-content-around align-items-center\">\n\t\t            \t\t<div class=\"d-none d-md-block\">\n\t\t            \t\t\t<i class=\"fas fa-search fa-2x\"></i>\n\t\t            \t\t</div>\n\t\t            \t\t<div class=\"py-3\">\n\t\t\t\t\t\t\t\t<h2>Silahkan masukan katakunci !</h2>\n\t\t\t\t            \t<p class=\"text-muted pl-3 border-left border-warning\">\n\t\t\t\t            \t\tSilahkan masukan keywords pencarian, dengan memasukan judul atau label\n\t\t\t\t            \t</p>\n\t\t            \t\t</div>\n\t\t            \t</div>\n            ");
    }

    function message(x, y) {
      notif({
        msg: "<i class='fas fa-info-circle mr-2'></i> ".concat(x),
        type: y,
        position: "bottom"
      });
    }

    function lazzy() {
      _container.html('<div id="loader" class="mx-auto my-5"></div>');
    }

    if (_input.value.length > 3) {
      $.ajax({
        url: _this[0].action,
        method: "POST",
        data: {
          q: _input.value
        },
        cache: false,
        dataType: "json",
        beforeSend: lazzy,
        timeout: 1000,
        success: function success(res) {
          _container.html(res.data);

          if (res.count != '0') {
            message("".concat(res.count, " data ditemukan"), 'success');
          }
        },
        error: function error(xhr) {
          message('error function', 'error');
        }
      });
    } else {
      message('Silahkan masukan min. 3 karakter.', 'warning');
    } // console.log(_this[0].action);

  });
});
"use strict";

$(document).ready(function () {
  $('.album-slick').slick({
    autoplay: true,
    infinite: true,
    dots: false,
    autoplaySpeed: 2000,
    fade: true,
    cssEase: 'linear',
    arrows: false,
    pauseOnHover: false,
    adaptiveHeight: true
  });
});
// $(document).ready(function() {
//     if ($(window).width() < 320) {
//         $('.sidebar').on('sticky-bottom-unreached', function() {
//             console.log("Bottom unreached");
//         });
//     } else {
//         $(".sidebar").sticky({
//             topSpacing: 30,
//             bottomSpacing: 100,
//         });
//     }
// });
"use strict";
// $(document).ready(function () {
//   $(".titleModal").titleModal({});
// });
"use strict";
"use strict";

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip({
    offset: '0,10px',
    padding: 10
  });
  $("a#item-populer-post").tooltip({
    offset: '0,10px',
    padding: 10,
    placement: "top",
    title: listdetail,
    html: true,
    container: 'body'
  });
}); // Get user details for tooltip

function listdetail() {
  var id = this.getAttribute('idp');
  var $url = this.getAttribute('urlpost');
  var tooltipText = "";
  $.ajax({
    url: $url,
    type: 'post',
    async: false,
    delay: 800,
    data: {
      id: id
    },
    beforeSend: function beforeSend() {
      tooltipText = "<img class=\"mx-auto text-center d-block p-5\" src=\"".concat(_uri, "/bower_components/SVG-Loaders/svg-loaders/oval-white.svg\">");
    },
    success: function success(response) {
      tooltipText = response;
    },
    error: function error(xhr) {
      tooltipText = xhr.responseText;
    }
  });
  return tooltipText;
}
"use strict";

$(document).ready(function () {
  $.typeahead({
    input: '.js-nipnama',
    minLength: 16,
    maxLength: 18,
    order: "asc",
    maxItem: 1,
    cache: true,
    offset: false,
    hint: true,
    searchOnFocus: true,
    dynamic: true,
    delay: 300,
    backdrop: {
      "background-color": "#000"
    },
    emptyTemplate: "Data PNS \"<b>{{query}}</b>\" tidak ditemukan ",
    debug: true,
    template: function template(item) {
      return "<div class='d-flex justify-content-start align-items-center'>\n                    <img class='rounded' src='{{photo}}' width='35' alt='{{nama}}'>\n                    <div class=\"small text-muted ml-3\">\n                        {{nama}} <br> {{nip}}\n                    </div>\n                    </div> \n                    "; // return `{{nip}} - {{nama}}`;
    },
    href: "".concat(_uri, "/frontend/v1/pegawai/detail?filter[query]={{nip}}"),
    source: {
      pegawai: {
        display: ["nip"],
        ajax: function ajax(query) {
          return {
            type: "POST",
            url: "".concat(_uri, "/frontend/v1/pegawai/search"),
            dataType: "json",
            data: {
              q: "{{query}}"
            }
          };
        }
      }
    },
    callback: {
      onClickAfter: function onClickAfter(node, a, item, event) {
        event.preventDefault();
        window.open(item.href, '_self');
      }
    }
  });
});
"use strict";

$(document).ready(function () {
  $("a#module").unbind().bind("click", function (e) {
    e.preventDefault();
    var $this = $(this);
    var $url = $this.attr('href');
    var $container = $("#containerModule");
    $("a#module").removeClass("active");
    $.ajax({
      url: $url,
      method: 'post',
      dataType: 'html',
      beforeSend: preloadModule,
      success: function success(res) {
        $container.html(res);
        $this.addClass('active');
      }
    });

    function preloadModule() {
      $container.html("<div style=\"height:50vh;\" class=\"d-flex justify-content-center align-items-center\">\n                <div class=\"loader_small\" style=\"width: 50px; height: 50px;\"></div></div>"); // $container.html(`<div class="slider"><div class="line"></div> <div class="subline inc"></div> 
      //     <div class="subline dec"></div></div>`);
    }
  });
});
"use strict";

$(document).ready(function () {
  // Image Preview
  function readURL(input, $element) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $($element).attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("input[name='photo_pic']").change(function () {
    readURL(this, $('img.photo_pic'));
  });
  $("input[name='photo_ktp']").change(function () {
    readURL(this, $('img.photo_ktp'));
  }); // Image Upload

  $(document).ready(function () {
    // Upload photo profile
    $("input[name=\"photo_pic\"]").on('change', function () {
      var name = this.files[0].name;
      var form_data = new FormData();
      var ext = name.split('.').pop().toLowerCase();

      if (jQuery.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
        alert("Invalid Image File");
      }

      var oFReader = new FileReader();
      oFReader.readAsDataURL(this.files[0]);
      var f = this.files[0];
      var fsize = f.size || f.fileSize;

      if (fsize > 2000000) {
        alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
      } else {
        form_data.append("file", this.files[0]);
        $.ajax({
          url: "".concat(_uri, "/frontend/v1/users/upload_photo?jenis=pic&id=").concat(_uriSegment[5]),
          method: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          dataType: 'json',
          processData: false,
          beforeSend: function beforeSend() {
            $('small.msg-pic').html("Sedang Memperbaharui Gambar <img src=\"".concat(_uri, "/bower_components/SVG-Loaders/svg-loaders/vtree.svg\">"));
          },
          success: function success(data) {
            $('small.msg-pic').html(data);
            console.log(_uriSegment[5]);
          }
        });
      }
    }); // Upload photo KTP

    $("input[name=\"photo_ktp\"]").on('change', function () {
      var name = this.files[0].name;
      var form_data = new FormData();
      var ext = name.split('.').pop().toLowerCase();

      if (jQuery.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
        notif({
          msg: "Invalid Image File",
          type: "error",
          position: "center"
        });
      }

      var oFReader = new FileReader();
      oFReader.readAsDataURL(this.files[0]);
      var f = this.files[0];
      var fsize = f.size || f.fileSize;

      if (fsize > 2000000) {
        notif({
          msg: "Ukuran File Gambar Terlalu Besar Maksimal 2MB",
          type: "warning",
          position: "center"
        });
      } else {
        form_data.append("file", this.files[0]);
        $.ajax({
          url: "".concat(_uri, "/frontend/v1/users/upload_photo?jenis=ktp&id=").concat(_uriSegment[5]),
          method: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          dataType: 'json',
          processData: false,
          beforeSend: function beforeSend() {
            $('small.msg-ktp').html("Sedang Memperbaharui Gambar <img src=\"".concat(_uri, "/bower_components/SVG-Loaders/svg-loaders/vtree.svg\">"));
          },
          success: function success(data) {
            $('small.msg-ktp').html(data);
          }
        });
      }
    }); //Update profile 

    $.validate({
      form: '#form_edit',
      modules: 'date, security, html5, sanitize',
      showErrorDialogs: true,
      onError: function onError($form) {
        notif({
          msg: 'Validation of form ' + $form.attr('id') + ' failed!',
          type: 'error',
          offset: -10,
          position: "center"
        });
      },
      onSuccess: function onSuccess($form) {
        var _action = $form.attr('action');

        var _method = $form.attr('method');

        var _data = $form.serialize();

        $.ajax({
          url: _action,
          method: _method,
          data: _data,
          cache: false,
          dataType: 'json',
          beforeSend: function beforeSend() {
            $('button#save').html("<img width=\"30\" height=\"30\" class=\"d-block mx-auto\" src=\"".concat(_uri, "/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg\">")).prop("disabled", true);
          },
          success: function success(response) {
            if (response.valid == true) {
              $('button#save').html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled", false);
            }

            notif({
              msg: response.msg,
              type: response.type,
              offset: -10,
              bgcolor: '#000',
              color: '#fff',
              timeout: 3000,
              position: "bottom"
            });
          },
          error: function error(_error) {
            $('button#save').html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled", false);
            notif({
              msg: "<b>Error:</b> Terjadi kesalahan pada server",
              type: "error",
              position: "center",
              offset: -10
            });
          }
        });
        return false; // Will stop the submission of the form
      },
      onModulesLoaded: function onModulesLoaded() {
        $('#alamat').restrictLength($('#maxlength'));
      }
    });
  });
});
"use strict";

$(document).ready(function () {
  $(document).on("click", "a#btn-view-video", function (e) {
    e.preventDefault();

    var _id = $(this).attr("href");

    var _title = $(this).attr("title");

    $.confirm({
      title: _title,
      content: "url:" + _uri + "/frontend/v1/beranda/yt_view_video/" + _id,
      columnClass: "col-md-10",
      theme: "supervan",
      bgOpacity: 0.9,
      animateFromElement: true,
      animationSpeed: 800,
      buttons: false,
      backgroundDismiss: true,
      animation: 'none',
      closeAnimation: 'opacity'
    });
  });
});
"use strict";

// Image Preview
function readURL(input, $element) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $($element).attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}