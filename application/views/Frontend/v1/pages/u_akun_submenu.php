<h5 class="px-3 py-4 border-bottom border-light">
	<a id="btn-add" href="<?= base_url('frontend/v1/submenu/add') ?>" title="Buat submenu baru" data-toggle="tooltip" class="btn btn-sm btn-primary shadow rounded-circle rounded-circle float-right"><i class="fas fa-plus"></i></a>
Submenu 
</h5>
<div class="table-responsive px-3 pb-3">
	<table class="table table-condensed display" id="table-submenu">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center"></th>
				<th>Nama submenu</th>
				<th>Link</th>
				<th>Aktif</th>
				<th>Urutan</th>
			</tr>
		</thead>
	</table>
</div>
<!-- Modal Add-->
<div class="modal" id="addSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <?= form_open(base_url('frontend/v1/submenu/save'), ['id' => 'f_submenu', 'autocomplete' => 'off']) ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">	
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama submenu</label>
            <input type="text" data-validation="required" class="form-control" name="nama_sub" id="recipient-name">
          </div>
          <div class="form-group small">
          	Apakah ini link halaman statis ?, jika iya anda dapat mencentang checkbox dan langsung memcopy & paste token halaman pada <b>form_link</b>
          	<div class="custom-control custom-checkbox">
			  <input type="checkbox" name="module" value="27" class="custom-control-input" id="customCheck1">
			  <label class="custom-control-label" for="customCheck1">Ya, halaman statis</label>
			</div>
          </div>	
          <div class="form-group">
            <label for="recipient-link" class="col-form-label">Link</label>
            <input type="text" data-validation="required" class="form-control" name="link_sub" id="recipient-link">
          </div>
          <div class="form-group">
          	<label for="recipient-mainmenu" class="col-form-label">Mainmenu</label>
	            <select name="mainmenu" data-validation="required" id="recipient-mainmenu" class="form-control">
	            	<option value="">-- Pilih Mainmenu --</option>
	            	<?php foreach ($data_mainmenu as $m): ?>
	            		<option value="<?= $m->id_menu ?>"><?= ucwords($m->nama_menu) ?></option>
	            	<?php endforeach; ?>
	            </select>
          </div>
          <div class="form-group">
	            <div class="small text-secondary float-right my-1">*) Pilih apabila submenu bercabang</div>
          	<label for="recipient-parentsub" class="col-form-label">Parent</label>
	            <select name="parentsub" data-validation-optional="true" id="recipient-parentsub" class="form-control">
	            	<option value="0">-- Pilih parent submenu --</option>
	            	<?php foreach ($data_submenu as $s): ?>
	            		<option value="<?= $s->idsub ?>"><?= ucwords($s->nama_sub) ?></option>
	            	<?php endforeach; ?>
	            </select>
          </div>
          <div class="form-group">
				<div class="custom-control custom-radio">
					<input type="radio" data-validation="required" id="customRadio1" name="aktif"  value="Y" class="custom-control-input">
					<label class="custom-control-label" for="customRadio1">Active (tampilkan)</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" data-validation="required" id="customRadio2" name="aktif"  value="N" class="custom-control-input">
					<label class="custom-control-label" for="customRadio2">Unactive (jangan tampilkan)</label>
				</div>
			</div>
			<div class="form-group">
	            <label for="recipient-order" class="col-form-label">Urutan</label>
	            <select name="order" data-validation="required" id="recipient-order" class="form-control">
	            	<option value="">-- Pilih Urutan --</option>
	            	<option value="1">1</option>
	            	<option value="2">2</option>
	            	<option value="3">3</option>
	            	<option value="4">4</option>
	            	<option value="5">5</option>
	            	<option value="6">6</option>
	            	<option value="7">7</option>
	            	<option value="8">8</option>
	            	<option value="9">9</option>
	            	<option value="10">10</option>
	            </select>
	        </div>
	        <div class="form-group">
            <label for="pub_date" class="col-form-label">Jadwal Submenu</label>
            <input id="pub_date" type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" name="pub_end">
            <span class="help-block small">Atur tanggal dan waktu kapan menu akan ditampilkan, apabila tampilkan selalu silahkan abaikan <b>form_jadwal</b></span>
	      	</div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal" id="editSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <?= form_open(base_url('frontend/v1/submenu/update'), ['id' => 'f_edit_submenu', 'autocomplete' => 'off']) ?>
      <input type="hidden" name="idsub">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">	
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama submenu</label>
            <input type="text" data-validation="required" class="form-control" name="e_nama_sub" id="recipient-name">
          </div>
          <div class="form-group">
          	Apakah ini link halaman statis ?, jika iya anda dapat mencentang checkbox dan langsung memcopy & paste token halaman pada <b>form_link</b>
          	<div class="custom-control custom-checkbox">
			  <input type="checkbox" name="e_module" value="27" class="custom-control-input" id="editCustomCheck1">
			  <label class="custom-control-label" for="editCustomCheck1">Ya, halaman statis</label>
			</div>
          </div>	
          <div class="form-group">
            <label for="recipient-link" class="col-form-label">Link</label>
            <input type="text" data-validation="required" class="form-control" name="e_link_sub" id="recipient-link">
          </div>
          <div class="form-group">
          	<label for="recipient-mainmenu" class="col-form-label">Mainmenu</label>
	            <select name="e_mainmenu" data-validation="required" id="recipient-mainmenu" class="form-control">
	            	<option value="">-- Pilih Mainmenu --</option>
	            	<?php foreach ($data_mainmenu as $m): ?>
	            		<option value="<?= $m->id_menu ?>"><?= ucwords($m->nama_menu) ?></option>
	            	<?php endforeach; ?>
	            </select>
          </div>
          <div class="form-group">
	            <div class="small text-secondary float-right my-1">*) Pilih apabila submenu bercabang</div>
          	<label for="recipient-parentsub" class="col-form-label">Parent</label>
	            <select name="e_parentsub" data-validation-optional="true" id="recipient-parentsub" class="form-control">
	            	<option value="0">-- Pilih parent submenu --</option>
	            	<?php foreach ($data_submenu as $s): ?>
	            		<option value="<?= $s->idsub ?>"><?= ucwords($s->nama_sub) ?></option>
	            	<?php endforeach; ?>
	            </select>
          </div>
          <div class="form-group">
				<div class="custom-control custom-radio">
					<input type="radio" data-validation="required" id="y" name="e_aktif"  value="Y" class="custom-control-input">
					<label class="custom-control-label" for="y">Active (tampilkan)</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" data-validation="required" id="n" name="e_aktif"  value="N" class="custom-control-input">
					<label class="custom-control-label" for="n">Unactive (jangan tampilkan)</label>
				</div>
			</div>
			<div class="form-group">
	            <label for="recipient-order" class="col-form-label">Urutan</label>
	            <select name="e_order" data-validation="required" id="recipient-order" class="form-control">
	            	<option value="">-- Pilih Urutan --</option>
	            	<option value="1">1</option>
	            	<option value="2">2</option>
	            	<option value="3">3</option>
	            	<option value="4">4</option>
	            	<option value="5">5</option>
	            	<option value="6">6</option>
	            	<option value="7">7</option>
	            	<option value="8">8</option>
	            	<option value="9">9</option>
	            	<option value="10">10</option>
	            </select>
	        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<link rel="stylesheet" href="<?= base_url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script src="<?= base_url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script>
  $(document).ready(function() {
  $('#pub_date').datepicker({
  	startDate: '-3d'
  });
  /*Datepicker*/
	/*Tooltips*/
	$('[data-toggle="tooltip"]').tooltip();
	var table4 = $("#table-submenu").DataTable({
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
			"url": _uri + '/frontend/v1/submenu/get_all_submenu',
			"type": "POST",
		},
		"columnDefs": [{
			"targets": [0, 1, 4, 5],
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

	$("a#btn-add").unbind().bind('click', function(e) {
		e.preventDefault();
		$("#addSub").modal('show');
	});

	$.validate({
		form: '#f_submenu',
        lang: 'en',
        showErrorDialogs: true,
        modules : 'security, html5',
        onError: function($form) {
        	notif({
				msg: "Validation form invalid",
				type: "error",
				position: "center",
				/*offset: -10,*/
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
                      $('button[type="submit"]').html('Loading ...').prop('disabled', true);
                  },
                  success: function(s) {
                  	if(s === true) {
	                  	notif({
							msg: "Success, submenu berhasil ditambahkan",
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
					$('button[type="submit"]').html('Simpan').prop('disabled', false);
					$("#addSub").modal('hide');
					table4.ajax.reload();
                  }
              });
              return false; /*Will stop the submission of the form*/
        }
    });

	$(document).on("click", "a#btn-edit-submenu", function(e) {
		e.preventDefault();
		let id = $(this).attr('data-id');
		$("#editSub").modal('show');
		$.getJSON(_uri + '/frontend/v1/submenu/detail', {id:id}, function(res) {
			$("[name='idsub']").val(id);
			$("[name='e_nama_sub']").val(res.nama_sub);
			if(res.fid_module == '27') {
				$("[name='e_module']").prop("checked", true);
				var get_token = res.link_sub.split("/");
				var token = get_token['1'];
				$("[name='e_link_sub']").val(token);
			} else {
				$("[name='e_module']").prop("checked", false);
				$("[name='e_link_sub']").val(res.link_sub);
			}
			$("[name='e_mainmenu']").val(res.idmain);
			var parentsub = res.fid_idsub != null ? res.fid_idsub : 0;
			$("[name='e_parentsub']").val(parentsub);
			if(res.aktif == 'Y') {
				$("#y").prop("checked", true);
				$("#n").prop("checked", false);
			} else {
				$("#n").prop("checked", true);
				$("#y").prop("checked", false);
			}
			$("[name='e_order']").val(res.order);
			$.validate({
				form: '#f_edit_submenu',
		        lang: 'en',
		        showErrorDialogs: true,
		        modules : 'security, html5',
		        onError: function($form) {
		        	notif({
						msg: "Validation form invalid",
						type: "error",
						position: "center",
						/*offset: -10,*/
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
                      $('button[type="submit"]').html('Loading ...').prop('disabled', true);
                  },
                  success: function(s) {
                  	if(s === true) {
	                  	notif({
							msg: "Success, submenu updated",
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
					$('button[type="submit"]').html('Simpan Perubahan').prop('disabled', false);
					$("#editSub").modal('hide');
					table4.ajax.reload();
                  }
              });
              return false; /*Will stop the submission of the form*/
		        }
		    });
		});
	});

	$(document).on("click", "a#btn-hapus-submenu", function(e) {
		e.preventDefault();
		let id = $(this).attr('data-id');
		notif_confirm({
			'position': "bottom",
			'offset': 30,
			'textaccept': 'Yakin',
			'textcancel': 'Batal',
			'fullscreen': true,
			'message': 'Apakah anda yakin akan menghapus submenu tersebut?',
			'callback': function(choice) {
				if (choice) {
					$.post(_uri + '/frontend/v1/submenu/hapus', {
						id: id
					}, function(response) {
						if (response == true) {
							table4.ajax.reload();
							notif({
								bgcolor: "#000",
								color: "#fff",
								'msg': 'Submenu berhasil dihapus',
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
  });
</script>