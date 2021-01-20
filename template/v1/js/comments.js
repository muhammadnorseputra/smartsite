$(document).ready(function() {

    var $el = $("#exampleFormControlTextarea1").emojioneArea({
        pickerPosition: "top",
        tonesStyle: "bullet",
        placeholder: "Masukan komentar kamu disini.",
        search: false,
        filtersPosition: "top",
        recentEmojis: false,
    });

    console.log(_uriSegment);
    if (!$.cookie('ci_session') && _uriSegment[3] == 'post' && _uriSegment[4] == 'detail') {
        displayComments();
    } else {
        console.log('Komentar tidak ditampilkan dikarnakan anda belum login atau bukan halaman detail berita');
    }

    function displayComments() {
        $.getJSON(`${_uri}/frontend/v1/post/displayKomentar/${_uriSegment[7]}`, function(response) {
            $(".tracking-list").html(response);
        });
    }

    // Reply komentar
    $(document).on('click', '#btn-reply-comment', function() {
        var id_parent = $(this).attr('data-id-parent');
        var id_berita = $(this).attr('data-id-berita');
        var id_user_comment = $(this).attr('data-id-user-comment');
        var id_user_username = $(this).attr('data-username');

        $(".emojionearea-editor").html(`<span class="text-info">@${id_user_username.trim().toLowerCase()} </span>`).focus();
    });

    // Button hapus komentar
    $(document).on('click', '#btn-delete-comment', function() {
        var id = $(this).attr('data-id');
        $.getJSON(_uri + '/frontend/v1/post/deleteComment', {
            id: id
        }, function(response) {
            if (response == true) {
                displayComments();
                notif({
                    msg: `Komentar dihapus <i class="fas fa-trash ml-3"></input>`,
                    type: "info",
                    position: "bottom",
                });
            }
        });
    });

    // Form submit komentar
    $(document).on('submit', 'form#f_komentar', function(e) {
        e.preventDefault();
        let form = $(this);
        let method = form.attr('method');
        let action = form.attr('action');
        let id_berita = form.attr('class');
        // let isi_komentar = $("textarea").val();
        var isi_komentar = $el[0].emojioneArea.getText();
        if (isi_komentar != '') {
            $.post(action, {
                id_b: id_berita,
                isi: isi_komentar
            }, function(response) {
                if (response == true) {
                    $(".emojionearea-editor").html('');
                    $(".emojionearea-editor").removeClass('is-invalid').addClass('is-valid');
                    displayComments();
                }
            }, 'json');
        } else {
            $(".emojionearea-editor").addClass('is-invalid').focus();
            // alert('Kolom Komentar Kosong');
        }
    });

});