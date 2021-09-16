<script type="text/javascript">
jQuery(function () {
	/*VARIABEL TABLE*/
	 	let table = jQuery('#tbl-berita').DataTable({
		processing: true,
		serverSide: true,
		deferRender: true,
		order: [
			[1, 'desc']
		],
		keys: false,
		autoWidth: false,
		select: false,
		searching: true,
		lengthChange: true,
		responsive: true,
		ajax: {
			url: '<?= base_url("backend/module/c_berita/ajax_list") ?>',
			type: 'POST',
			data: function (s) {
				s.judul = jQuery("[name='search']").val()
			}
		},
		columnDefs: [
      {
				"targets": [0],
				"className": "dt-center",
				"orderable": false,
        "width": "5%"
			},
      {
				"targets": [1],
				"className": "dt-left",
				"orderable": true,
        "width": "50%"
			},
      {
				"targets": [2],
				"className": "dt-left",
				"orderable": true
			},
			{
				"targets": [3],
				"className": "dt-center",
				"orderable": true,
        "width": "10%"
			},
      {
				"targets": [4],
				"className": "dt-center",
				"orderable": false,
        		"width": "10%"
			}
		],
		language: {
			search: "Pencarian: ",
			processing: "Mohon Tunggu, Processing...",
			paginate: {
				previous: "Sebelumnya",
				next: "Selanjutnya"
			},
			emptyTable: "No matching records found, please filter this data"
		}
	});

	/*AKSI SEARCH BERITA BERDASARKAN JUDUL*/
  jQuery("#form_search_berita").on('submit', function(e) {
    e.preventDefault();
    let fr = jQuery(this);
    if(fr[0].search.value == '') {
      table.ajax.reload();
    } else {
      table.draw();
    }
	});

	function reload() {
		table.ajax.reload(null, false);
	}

	/*AKSI HAPUS BERITA BERDASARKAN ID DAN GAMBAR*/
	$("table").on('click', '#hapus-berita', function(e) {
			e.preventDefault();
			let id 	= $(this).attr('data-id');
			let img = $(this).attr('data-gambar'); 
			let jdl = $(this).attr('data-judul');
			let conf = confirm('Apakah anda yakin akan menghapus ('+ jdl.toUpperCase() +')');
			if(conf == true) {
				$.post('<?= base_url("backend/module/c_berita/hapusberita") ?>', {id: id, gambar: img}, function(result) {
					table.ajax.reload(null, false);
					showNotification(result.type, result.content, 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');
				}, 'json');
			}
		});

		/*AKSI EDIT BERITA BERDASARKAN ID DAN GAMBAR*/
		$("table").on('click', '#edit-berita', function(e) {
			e.preventDefault();
			let id 	= $(this).attr('data-id');
			window.location.replace('<?= base_url('backend/module/c_berita/edit_berita/') ?>' + id +'<?= "?module=".$this->madmin->getmodulebycontroller('c_berita')."&user=".$this->session->userdata('user_access') ?>');
		});

});

</script>