<a href="#" id="btnUploadData">
	<i class="glyphicon glyphicon-export"></i>
	Upload Data Excel
</a>
|
<a href="#" id="emptyTable_HasilVerifikasi">
	<i class="glyphicon glyphicon-trash m-r-5"></i> Kosongkan Table
</a>
|
<a href="#" id="backupTable_HasilVerifikasi" data-req="<?= sha1(date('dmY')); ?>">
	<i class="glyphicon glyphicon-oil m-r-5"></i> Backup SQL
</a>

<center>
	<div class="myBar label-center" style="display:none;"></div>
</center>
<table class="display table table-bordered table-striped table-condensed table-hover" id="tbl-hasilverifikasi">
	<thead>
		<th>NOMOR PESERTA</th>
		<th>NIK</th>
		<th>NAMA</th>
		<th>JENKEL</th>
		<th>JABATAN</th>
		<th>PENDIDIKAN</th>
		<th></th>
	</thead>
	<tbody>
</table>

<style>
.no-close .ui-dialog-titlebar-close {
	display: none;
}
</style>
<script>
	
function reloadTabs() {
	$("#tabs").tabs('load', 1);
}

$(document).ready(function () {


	let dataTable = $('table#tbl-hasilverifikasi').DataTable({
		processing: true,
		serverSide: true,
		order: [
			[1, 'desc']
		],
		responsive: true,
		scrollY: 450,
      	dom: 'Bftplri',
		  buttons: [
        {
          extend: 'copy',
          text: 'Copy Ke Clipboard'
        },
        {
          extend: 'excel',
          text: 'Exports to excel'
        },
        'print'
      	],
		ajax: {
			url: '<?= base_url('cpns/informasi/ajaxList_hasilverifikasi '); ?>',
			type: 'POST'
		},
		columnDefs: [{
			"targets": [0, 1, 2, 3, 4, 5],
			"orderable": true
		}, {
			"targets": [6],
			"className": "dt-center",
			"orderable": false,
			"width": "15%"
		}],
		language: {
			search: "Pencarian: ",
			processing: "<img src='<?= base_url('assets/images/loader/rolling-2.gif'); ?>'>",
			paginate: {
				previous: "Sebelumnya",
				next: "Selanjutnya"
			},
			emptyTable: "No matching records found, please filter this data"
		}
	});

	function reloadTable() {
		dataTable.ajax.reload();
	}

	$("a#backupTable_HasilVerifikasi").unbind().bind('click', function(event) {
		event.preventDefault();
		var req = $(this).attr('data-req');
		$.showIndicator();
		$.post('<?= base_url('cpns/informasi/backup_sql_table_verifikasi'); ?>', {req: req}, function (response) {
			alert(response);
		}, 'json').done(() => {
			$.hideIndicator(); // hide the indicator
		});
	});

	$("a#emptyTable_HasilVerifikasi").unbind().bind('click', function (event) {
		event.preventDefault();
		$.confirm('Apa anda yakin akan menghapus seluruh data?', 'Empty Table!', function () {
			// let tbl = $("#tbl-hasilverifikasi");
			$.post('<?= base_url('cpns/informasi/doEmptyTable_HasilVerifikasi'); ?>',
				function (response) {
					reloadTable();
					showNotification(response.type, response.msg, 'bottom', 'center', 'animated fadeIn',
						'animated bounceOutDown');
				}, 'json').then(() => {
				});
		});
	});

	$("a#btnUploadData").unbind().bind('click', function (event) {
		event.preventDefault();
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator(); // hide the indicator
			window.open("<?= base_url('cpns/informasi/uploadDataHasilVerifikasi/'); ?>", '_blank', 'width=400,height=500,left=520,top=80, scrollbars=yes, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no', true);
		}, 1000);
	});
	
	$("#tbl-hasilverifikasi").on('click', "button#hapus-verifikasi", function(event) {
		event.preventDefault();
		var nama = $(this).attr('data-nama');
		var nik  = $(this).attr('data-id');
		var $dialog = $('<div></div>')
				.html("Apakah anda yakin akan menghapus hasil verifikasi peserta <b>"+ nama +"</b> ("+ nik +")")
				.dialog({
					autoOpen: false,
					modal: true,
					width: 500,
					title: 'Message!',
					resizable: false,
					draggable: false,
					dialogClass: "no-close",
					buttons: [
					{
						text: "Ya, hapus hasil verifikasi",
						click: function() {
							$.post('<?= base_url('cpns/informasi/hapus_hasil_verifikasi'); ?>', {
								id: nik
							}, function (result) {
								reloadTable();
							}, 'json');
							$( this ).dialog( "close" );
						}	
					},
					{
						text: "Batal",
						click: function() {
								$( this ).dialog( "close" );
						}
					},
				]
			});
		$dialog.dialog('open');
	});
	
	$("#tbl-hasilverifikasi").on('click', "button#detail-verifikasi", function(event) {
		event.preventDefault();
		let self = $(this);
		let id   = self.attr('data-id');
		let $href = '<?= base_url('cpns/informasi/detail_verifikasi'); ?>';

		var dialog = $(`
		<div style="display:none" class="loading">
			<img src="<?= base_url('assets/images/loader/rolling-2.gif'); ?>">
		</div>`).appendTo('body');
		// open the dialog
		dialog.dialog({
			// add a close listener to prevent adding multiple divs to the document
			close: function (event, ui) {
				// remove div with all data and events
				dialog.remove();
			},
			modal: true,
			width: '800px',
			dialogClass: "no-close",
			title: 'Detail Verifikasi',
			resizable: false,
			draggable: false,
			position: {
				my: "center",
				at: "top",
				of: window
			},
			buttons: [
				{
					text: "Tutup",
					click: function () {
						$(this).dialog("close");
					}
				}
			]
		});
		dialog.css({height:"500px", overflow:"auto"});
		// load remote content
		dialog.load(
			$href, {id: id}, // omit this param object to issue a GET request instead a POST request, otherwise you may provide post parameters within the object
			function (responseText, textStatus, XMLHttpRequest) {
				// remove the loading class
				dialog.removeClass('loading');
			}
		);
		//prevent the browser to follow the link
		return false;


		// alert();
	});
});

</script>
