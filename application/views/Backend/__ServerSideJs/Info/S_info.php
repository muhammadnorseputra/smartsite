<script>
list();
function list(search) {
	jQuery.getJSON(
		'<?= site_url("backend/module/c_info/list_info"); ?>',
		{ search: search},
		function (result) {
			jQuery("#data").html(result.data);
		}
	);
}

jQuery("#FormSearchInfo").on('submit', function(event) {
	event.preventDefault();
	var e = jQuery("[name='search']");
	if(e.val() != '') {
	list(e.val());
	} else {
		list();
	}
});

function auto_clear() {
	var e = jQuery("[name='search']");
	e.val('');
	list();
}

jQuery("#FormInfo").on('submit', function (e) {
	e.preventDefault();
	let form = jQuery(this);

	jQuery.ajax({
		url: form.attr('action'),
		method: 'POST',
		data: form.serialize(),
		dataType: 'json',
		beforeSend: function () {
			NProgress.start();
			NProgress.inc(0.9);
		},
		success: function (result) {
			showNotification('bg-teal', result.pesan, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
			form[0].reset();
			list();
		},
		complete: function () {
			NProgress.done();
      jQuery("form#FormInfo").attr('action', '<?= site_url("module/c_info/add") ?>');
			jQuery("button#batal").fadeOut();
		}
	});

});

jQuery("#FormInfo").on('click','#batal', function(e) {
  e.preventDefault();
  jQuery("#FormInfo")[0].reset();
  jQuery("#FormInfo").attr('action', '<?= site_url("module/c_info/add") ?>');
  jQuery(this).fadeOut();
});

function edit(id) {
	jQuery.getJSON('<?= site_url("backend/module/c_info/edit") ?>', {
		id: id
	}, function (result) {
		jQuery("form#FormInfo").attr('action', '<?= site_url("backend/module/c_info/update") ?>');
		jQuery("[name='idinfo']").val(result[0].id_info);
		jQuery("[name='judul']").val(result[0].judul).focus();
		jQuery("[name='informasi']").val(result[0].informasi).focus();
		let check1 = jQuery("#radio_01_i");
		let check2 = jQuery("#radio_02_i");
		if (result[0].publish == 'Y') {
			check1.prop('checked', true);
			check2.prop('checked', false);
		} else {
			check1.prop('checked', false);
			check2.prop('checked', true);
		}
    jQuery("button#batal").fadeIn();
	});
}

function hapus(id) {
	let comf = confirm('Apakah ada yakin akan menghapus info tersebut?');
	if (comf == true) {
		jQuery.getJSON('<?= site_url("backend/module/c_info/hapus") ?>', {
			id: id
		}, function (result) {
			showNotification('bg-green', 'Success Deleted', 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
			list();
		}).then(() => {
			NProgress.start();
			NProgress.inc(0.9);
		}).done(() => {
			NProgress.done();
		});
	}
} 
</script>