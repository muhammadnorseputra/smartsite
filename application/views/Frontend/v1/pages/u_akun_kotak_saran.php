<h5 class="px-3 py-4 m-0 border-bottom border-light animated fadeIn">Daftar Saran</h5>

<div class="table-responsive px-3 py-3">
	<div class="form-row align-items-center mb-3">
		<div class="col-md-4">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Kategori</div>
				</div>
				<select class="custom-select" name="category">
				  <option value="0" selected>-- Pilih Kategori --</option>
				  <?php foreach ($kategori_saran as $k):?>
				  	<option value="<?= $k->kategori ?>"><?= $k->kategori ?></option>
				  <?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<table class="table table-condensed display" id="table-saran">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Nama Lengkap</th>
				<th>Isi Saran</th>
				<th>Email</th>
				<th>Detail</th>
			</tr>
		</thead>
	</table>
</div>
<!-- Modal Balas-->
<div class="modal" id="view-saran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					By <br>
					<div class="by font-weight-bold"></div>
				</div>
				<div class="form-group">
					Email <br>
					<div class="email font-weight-bold"></div>
				</div>
				<div class="form-group">
					Saran <br>
					<div class="isi_saran font-weight-bold"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script>
	/*Tooltips*/
	$('[data-toggle="tooltip"]').tooltip();
	var table6 = $("#table-saran").DataTable({
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
			"url": _uri + '/frontend/v1/saran/get_all_saran',
			"type": "POST",
			"data" : function(e) {
				e.kategori=$("select[name='category']").val()
			}
		},
		"columnDefs": [{
			"targets": [2, 3],
			"orderable": false
		},{
			"targets": [0, 4],
			"orderable": false,
			"className": 'text-center'
		},{
			"targets": [1],
			"orderable": false,
			"width": "20%"
		}],
		"language": {
			"lengthMenu": "_MENU_ Data per saran",
			"zeroRecords": "Belum ada saran",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "Belum ada saran",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Pencarian",
			"processing": "<img src='" + _uri + "/template/v1/images/loading.gif' />"
		}
	});
	$("select[name='category']").unbind().bind("change", function(event) {
		table6.draw();
	});
	$(document).on("click", "button#detail-saran", function(e) {
		e.preventDefault();
		let id = $(this).attr('id_saran');
		$("#view-saran").modal('show');
		$.post(`${_uri}/frontend/v1/saran/detail`, {id: id}, function(res) {
			console.log('detail =>', res);
			let mail = res.email != '' ? res.email : '-';
			$(".by").text(res.nama_lengkap);
			$(".email").text(mail);
			$(".isi_saran").text(res.isi_saran);
		}, 'json');
	});
</script>