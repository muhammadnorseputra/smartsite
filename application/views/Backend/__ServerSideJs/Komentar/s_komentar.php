<style>
.no-close .ui-dialog-titlebar-close {
	display: none;
}
</style>
<script>
	
	
	$(document).ready(function () {
	var table = jQuery('#tbl-komentar').DataTable({
		processing: true,
		serverSide: true,
		order: [
			[3, 'desc']
		],
		deferRender: true,
		keys: false,
		autoWidth: false,
		select: false,
		searching: true,
		lengthChange: true,
		responsive: true,
		ajax: {
			url: '<?= base_url("backend/module/c_komentar/ajax_list") ?>',
			type: 'POST'
			/*data: function (s) {
				s.judul = jQuery("[name='search']").val()
			}*/
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
				"className": "dt-center",
				"orderable": false,
        "width": "5%"
			},
			{
				"targets": [2],
				"className": "dt-center",
				"orderable": false,
        "width": "5%"
			},
      {
				"targets": [3],
				"className": "dt-left",
				"orderable": true,
        "width": "20%"
			},
      {
				"targets": [4],
				"className": "dt-left",
				"orderable": false,
        "width": "15%"
			},
      {
				"targets": [5],
				"className": "dt-center",
				"orderable": false,
        "width": "15%"
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

  jQuery("#form_search_berita").on('submit', function(e) {
    e.preventDefault();
    let fr = jQuery(this);
    if(fr[0].search.value == '') {
      table.ajax.reload();
    } else {
      table.draw();
    }
  });

	function __init() {
	  tinymce.init({ 
	    selector: "#isi_komentar",theme: "silver", height: 300,
	    content_style: "body {padding: 10px}",
	    content_css: [
	      'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
	    ]
	  });
	} 
	
	$('#modal-detail-komentar').on('shown.bs.modal', function (e) {
		 __init();
	});


	$('table').on('click', 'button#detail', function(event) {
		event.preventDefault();
		let id = $(this).attr('data-id');
		let id_parent = $(this).attr('data-parent');
		$.get('<?= base_url("backend/module/c_komentar/detail_komentar") ?>', {id: id, parent_id: id_parent}, function(result) {
			$("#modal-detail-komentar").modal('show');
			$(".modal-body").html(result);
	
		}, 'html');
	});

	

	$('table').on('click', 'button#hapus', function(event) {
		event.preventDefault();
		let id = $(this).attr('data-id');
		var $dialog = $('<div></div>')
										.html("Apakah anda akan menghapus komentar tersebut?")
										.dialog({
												autoOpen: false,
												modal: true,
												width: 500,
												dialogClass: "no-close",
												title: 'Message!',
												buttons: [
												{
													text: "Ok",
													click: function() {
														$.get('<?= base_url("backend/module/c_komentar/hapus_komentar") ?>', {id: id}, function(result) {
																$.alert({
																	title: false,
																	content: result,
																	animateFromElement: false,
																	animation: 'none',
																	icon: 'glyphicon glyphicon-ok',
																	type: 'green',
																	buttons: {
																			Ok: function () {}
																	}
																});
																table.ajax.reload();
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
	
});
</script>