<script>
list();

function list() {
	list_pertanyaan_or_jawaban('PERTANYAAN', "#myPertanyaan");
	list_pertanyaan_or_jawaban('JAWABAN', "#myJawaban");
}

function list_pertanyaan_or_jawaban(jenis, container) {
	jQuery.getJSON(
		'<?= site_url("backend/module/c_poling/list_pertanyaan_or_jawaban"); ?>', {
			jenis: jenis
		},
		function (result) {
			jQuery(container).html(result.data);
		}
	);
}

jQuery("#FormPoling").on('submit', function (e) {
	e.preventDefault();
	let form = jQuery(this);

	$.ajax({
		url: form.attr('action'),
		method: 'POST',
		data: form.serialize(),
		dataType: 'json',
		beforeSend: function () {
			$.Mprog.starts(3, '.card.mprogress', true);
		},
		success: function (result) {
			showNotification('bg-black', result.pesan, 'bottom', 'center', '', '');
	      form[0].reset();
	      /*form[0].judul.focus();*/
	      list();
	      review_pertanyaan();
	      review_jawaban();    

		},
		complete: function () {
			$.Mprog.starts(3, '.card.mprogress', false).end(true);
			$("form#FormPoling").attr('action', '<?= site_url("module/c_poling/add") ?>');
      		$("button#batal").fadeOut();
		}
	});
});

function edit(id) {
  $.getJSON('<?= site_url("backend/module/c_poling/edit") ?>', {
		id: id
	}, function (result) {
		$("form#FormPoling").attr('action', '<?= site_url("backend/module/c_poling/update") ?>');
		$("[name='judul']").val(result[0].label).focus();
		$("[name='jenispoling']").val(result[0].status);
		$("[name='idpoling']").val(id);
		let check1 = $("#radio_01_i");
		let check2 = $("#radio_02_i");
		if (result[0].aktif == 'Y') {
			check1.prop('checked', true);
			check2.prop('checked', false);
		} else {
			check1.prop('checked', false);
			check2.prop('checked', true);
    }
    $("button#batal").fadeIn();
	});
}

$("#FormPoling").on('click','#batal', function(e) {
  e.preventDefault();
  $("#FormPoling")[0].reset();
  $("#FormPoling").attr('action', '<?= site_url("module/c_poling/add") ?>');
  $(this).fadeOut();
});


function hapus(id) {
	$.getJSON('<?= site_url("backend/module/c_poling/hapus") ?>', {
		id: id
	}, function (result) {
		showNotification('bg-black', 'Success Deleted', 'bottom', 'center', '', '');
    list();
    review_pertanyaan();
    review_jawaban(); 
	});
} 

review_pertanyaan();
function review_pertanyaan() {
  jQuery.getJSON(
    '<?= site_url("backend/module/c_poling/review_p") ?>', 
    function(result) { 
			if(result.length == '') {
				jQuery("#labelPertanyaan").html("");
			} else {
      jQuery("#labelPertanyaan").html(result[0].label+" ? ");
			}
    }
  );
}

review_jawaban();
function review_jawaban() {
  jQuery.getJSON(
    '<?= site_url("backend/module/c_poling/review_j") ?>', 
    function(result) { 
      jQuery("#labelJawaban").html(result);
    }
  );
}
/*Grafik*/
jQuery(function () {
  let grafik = getMorris('donut', 'donut_chart');
});

function getMorris(type, element) {
  if (type == 'donut') {  
  jQuery.getJSON(
    '<?= site_url("backend/module/c_poling/grafik") ?>',
    function(res) {
        var result = res;
        Morris.Donut({
          element: element,
          data: result,
          colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],
          formatter: function (y) {
            return y + ' %'
          }
        });      
    }
  )    
    
  }
}

</script>