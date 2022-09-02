<h5 class="px-3 py-4 m-0 border-bottom border-light animated fadeIn">Tabel Komentar</h5>
<div class="table-responsive px-3 py-3">
	<table class="table table-condensed table-borderless table-striped display" id="table-komentar">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>ID</th>
				<th>Nama</th>
				<th>Komentar</th>
				<th>Aktif</th>
				<th></th>
			</tr>
		</thead>
	</table>
</div>
<!-- Modal Balas-->
<div class="modal" id="reply-komentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <?= form_open(base_url('frontend/v1/komentar/reply'), ['id' => 'reply-komentar-user', 'autocomplete' => 'off'], [
      	'id_berita' => '', 'id_parent' => '', 'id_user' => '']) ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Balas Komentar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
          	<b>Reply To</b> <br>
          	<div class="nama_lengkap"></div>
          </div>	
          <div class="form-group">
          	<b>Pada Post</b> <br>
          	<div class="berita"></div>
          </div>
          <div class="form-group">
          	<b>Comment</b> <br>
          	<button id="block-komentar" id_komentar="0" class="btn btn-sm btn-warning rounded-pill float-right">Block Komentar</button>
          	<div class="comment"></div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label font-weight-bold">
            Balasan <br>
			<span class="small text-secondary">History (<span id="maxlength">350</span> characters left)</span></label>
            <textarea data-validation="length,required" data-validation-length="min5" class="form-control form-control-lg" name="isi" rows="6" id="message-text" placeholder="Please insert your comments here..."></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script>
	/*Tooltips*/
	$('[data-toggle="tooltip"]').tooltip();
	var table5 = $("#table-komentar").DataTable({
		"processing": true,
		"serverSide": true,
		"paging": true,
		"ordering": true,
		"info": true,
		"searching": true,
		"pagingType": "full_numbers",
		"responsive": true,
		"datatype": "json",
		/*"scrollY": "200px",
		 "scrollCollapse": true,*/
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"order": [],
		"ajax": {
			"url": _uri + '/frontend/v1/komentar/get_all_komentar',
			"type": "POST",
		},
		"columnDefs": [{
			"targets": [0, 1, 4,5],
			"orderable": false,
			"className": "text-center"
		}, {
			"targets": [2],
			"orderable": true,
			"width" : '30%'
		}, {
			"targets": [3],
			"orderable": false,
		}],
		"language": {
			"lengthMenu": "_MENU_ Data per halaman",
			"zeroRecords": "Belum ada halaman",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "Belum ada halaman",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Pencarian",
			"processing": "<img src='" + _uri + "/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg' />"
		}
	});
	$(document).on("click", "button#hapus-komentar", function(event) {
		event.preventDefault(); 
		let id_komentar = $(this).attr('id_komentar');
		notif_confirm({
			'position': "bottom",
			'offset': 30,
			'textaccept': 'Yakin',
			'textcancel': 'Batal',
			'fullscreen': true,
			'message': 'Apakah anda yakin akan menghapus komentar tersebut?',
			'callback': function(choice) {
				if (choice) {
					$.post(_uri + '/frontend/v1/komentar/hapus', {
						id: id_komentar
					}, function(response) {
						if (response == true) {
						table5.ajax.reload();
							notif({
								bgcolor: "#000",
								color: "#fff",
								'msg': 'Komentar Berhasil Dihapus',
								'position': 'bottom',
								'timeout': 3000
							})
						}
					}, 'json');
				} else {
					notif({
						'type': 'error',
						'msg': 'Dibatalkan',
						'position': 'bottom',
						'timeout': 1000
					})
				}
			}
		});
	});
	
	$(document).on("click", "button#block-komentar", function(e) {
		e.preventDefault();
		let id = $(this).attr('id_komentar');
		let sts = $(this).attr('status');
		if(sts === 'Y') {
			$.post(`${_uri}/frontend/v1/komentar/block`, {id: id, status: 'N'}, function(res) {
				console.log('Block =>', res);
				table5.ajax.reload();
				$("i", this).toggleClass(`far fa-eye-slash`);
			});
		} else {
			$.post(`${_uri}/frontend/v1/komentar/block`, {id: id, status: 'Y'}, function(res) {
				console.log('Block =>', res);
				table5.ajax.reload();
				$("i", this).toggleClass(`far fa-eye`);
			});
		}
	});

	$(document).on("click", "button#balas-komentar", function(e) {
		e.preventDefault();
		$("#reply-komentar").modal('show');
		let id_berita = $(this).attr('id_berita');
		let id_parent = $(this).attr('id_parent');
		let id_user = $(this).attr('id_user');
		$.getJSON(`${_uri}/frontend/v1/komentar/detail`, {id_b: id_berita, id_p: id_parent, id_u: id_user}, function(res) {
			/*console.log(res);*/
			$("#block-komentar").attr('id_komentar', id_parent);
			$(".nama_lengkap").text(res.user);
			$(".berita").text(res.judul);
			$(".comment").text(res.isi);
			$("[name='id_berita']").val(id_berita);
			$("[name='id_parent']").val(id_parent);
			$("[name='id_user']").val(id_user);
			$.validate({
				form: '#reply-komentar-user',
		        lang: 'en',
		        showErrorDialogs: true,
		        modules : 'security, html5',
		        onError: function($form) {
		        	notif({
						msg: "Reply comments invalid",
						type: "error",
						position: "center",
						/*offset: -10,*/
					});
		        },
		        onModulesLoaded: function() {
		            $('#message-text').restrictLength($('#maxlength'));
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
                      $('button[type="submit"]').html('Loading ...').prop('disabled', true);
                  },
                  success: function(s) {
	                if(s === true) {
		                  	notif({
								msg: "Success, Your Reply Is Sended",
								type: "success",
								position: "center",
								/*offset: -10,*/
							});
	                  	} else {
	                  		notif({
								msg: "Gagal, terjadi kesalahan saat memproses data",
								type: "warning",
								position: "center",
								/*offset: -10,*/
							});
	                  	}
						$('button[type="submit"]').html('Kirim').prop('disabled', false);
						$("#reply-komentar").modal('hide');
						table5.ajax.reload();
	                  }
	              });
	              return false; /*Will stop the submission of the form*/
		        }
		    });
		});
	});
</script>