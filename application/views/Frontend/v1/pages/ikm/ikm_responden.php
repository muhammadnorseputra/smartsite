<h5 class="px-3 py-4 border-bottom border-light">
IKM - Responden
</h5>
<div class="container">
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-filter"></i></span>
		</div>
		<div class="input-group-prepend">
			<label class="input-group-text" for="filter-year"><i class="fas fa-layer-group"></i></label>
		</div>
		<select class="custom-select" id="filter-year" name="f_year">
			<option selected value="">Pilih Tahun</option>
			<?php foreach($ikm_tahun as $t): ?>
			<option value="<?= $t->tahun ?>"><?= $t->tahun ?></option>
			<?php endforeach; ?>
		</select>
		<div class="input-group-prepend">
			<label class="input-group-text" for="filter-periode"><i class="fas fa-clipboard-list"></i></label>
		</div>
		<select class="custom-select" id="filter-periode" name="f_periode">
			<option selected value="">Pilih Periode</option>
			<?php foreach($ikm_periode as $p): ?>
			<option value="<?= $p->id ?>"><?= mediumdate_indo($p->tgl_mulai) ?> - <?= mediumdate_indo($p->tgl_selesai) ?></option>
			<?php endforeach; ?>
		</select>
		<div class="input-group-prepend">
			<label class="input-group-text" for="filter-form"><i class="far fa-clipboard"></i></label>
		</div>
		<select class="custom-select" id="filter-form" name="f_form">
			<option selected value="">Pilih Form</option>
			<?php foreach($ikm_form as $f): ?>
			<option value="<?= $f->card_responden ?>"><?= $f->card_responden ?></option>
			<?php endforeach; ?>
		</select>	
	</div>
	<div class="col-6 offset-3">
		<div class="input-daterange input-group my-2" id="datepicker">
			<div class="input-group-prepend">
				<label class="input-group-text" for="filter-form"><i class="far fa-calendar-alt"></i></label>
			</div>
			<input type="text" class="input-sm form-control" placeholder="From" size="5" name="start" />
			<input type="text" class="input-sm form-control" placeholder="To" size="5" name="end" />
			<span class="input-group-addon"></span>
		</div>
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-sm table-condensed table-bordered table-striped display" id="table-responden">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th>NIP/NIK</th>
					<th>Nama</th>
					<th>Umur</th>
					<th>JK</th>
					<th>Pendidikan</th>
					<th>Pekerjaan</th>
					<th>Form</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.css') ?>">
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script>
	/*Date Range*/
	$('.input-daterange').datepicker({
		    todayBtn: "linked",
		    format: "yyyy-mm-dd",
    		clearBtn: true
	});
	/*Tooltips*/
	$('[data-toggle="tooltip"]').tooltip();
	var tableResponden = $("#table-responden").DataTable({
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
			"url": _uri + '/frontend/v1/ikm/ajax_responden',
			"type": "POST",
			"data": function(q) {
					q.filter_tahun = $("select[name='f_year']").val(),
					q.filter_periode = $("select[name='f_periode']").val(),
					q.filter_form = $("select[name='f_form']").val(),
					q.filter_start = $("input[name='start']").val(),
					q.filter_end = $("input[name='end']").val()
			},
		},
		"columnDefs": [{
			"targets": [0],
			"orderable": false,
			"className": "text-center"
		}, {
			"targets": [1],
			"orderable": true,
		}, {
			"targets": [2],
			"orderable": true,
		}, {
			"targets": [3],
			"orderable": false,
			"className": "text-center"
		}, {
			"targets": [4],
			"orderable": false,
			"className": "text-center"
		}, {
			"targets": [5],
			"orderable": false,
		}, {
			"targets": [6],
			"orderable": false,
		}, {
			"targets": [7],
			"orderable": false,
		}],
		"language": {
			"lengthMenu": "_MENU_ Data per halaman",
			"zeroRecords": "Belum Ada Responden",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "Belum Ada Responden",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Pencarian",
			"processing": "<img src='" + _uri + "/template/v1/images/loading.gif' />"
		}
	});
	$("select[name='f_year'],select[name='f_periode'],select[name='f_form']").on('change', function(e) {
		e.preventDefault();
		tableResponden.draw();
	});
	$("input[name='start'],input[name='end']").on('blur', function(e) {
		e.preventDefault();
		tableResponden.draw();
	});
</script>