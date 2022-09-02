$("#btnLogout").unbind().bind('click', function (e) {
	e.preventDefault();
	var self = $(this);
	var ses_name = self.attr('data-usrname');
	var ses_touri = self.attr('data-href');

	swal({
		title: ses_name,
		html: true,
		text: "<b>Apakah anda yakin akan mengakhiri sesi sekarang ?</b>",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Keluar",
		cancelButtonText: "Batal",
		animation: "pop",
		showLoaderOnConfirm: false,
		closeOnConfirm: true,
		closeOnCancel: true
	}, function (isConfirm) {
		if (isConfirm) {
			jQuery.ajax({
				url: ses_touri,
				method: 'POST',
				dataType: 'json',
				beforSend: function () {
					NProgress.start();
				},
				success: function (response) {
					window.location.replace(response.redirect_to);
				},
				complete: function () {
					NProgress.done();
				}
			});
		} else {
			return false;
		}
	});

});
