
<style type="text/css">
.removeRow {
    background:red;
    color:white;
}
</style>
<script>
$(function() {
	 
	$('select[name="submainmenu"]').on('loaded.bs.select', function (e) {
	  e.preventDefault();
	  $.getJSON(
	  '<?= site_url("backend/module/c_submenu/mainmenu") ?>',
		  function(result)
		  {
			$('select[name="submainmenu"], select[name="editidmainmenu"]').html(result).selectpicker('refresh');
		  }
		)
	});
	
	$('select[name="modulesubmenu"]').on('loaded.bs.select', function (e) {
	  e.preventDefault();
	  $.getJSON(
	  '<?= site_url("backend/module/c_submenu/allmodule") ?>',
		  function(result)
		  {
			$('select[name="modulesubmenu"], select[name="editnamamodule"]').html(result).selectpicker('refresh');
		  }
		)
	});

  $('select[name="parentsubmenu"]').on('loaded.bs.select', function (e) {
    e.preventDefault();
    $.getJSON(
    '<?= site_url("backend/module/c_submenu/parent_sub") ?>',
      function(result)
      {
      $('select[name="parentsubmenu"], [name="editparentsubmenu"]').html(result).selectpicker('refresh');
      }
    )
  });
}); 
  function reset(){ 
    loadData(1);
    jQuery("#search").val('');
  }

  function cariData()
  {
    var val = jQuery("#search").val();
    if(val != '')
    {
      jQuery.get('<?= site_url("backend/module/c_submenu/caridata") ?>', {katakunci: val}, function(result){
        if(result.data.length != 0){
          jQuery("#myData").html(result.data);
        }else{
          jQuery("#myData").html('<tr class="text-center"><td colspan="7">Pencarian <b>'+val+'</b> Tidak Ditemukan !</td></tr>');
        }
      }, 'json');
    }
    else
    {
      jQuery("#myData").html('<tr class="text-center"><td colspan="7">Pencarian Tidak Ditemukan !</td></tr>');
    }
  }
  
  function loadData(page)
  {

    jQuery.ajax({
      url: '<?= site_url("backend/module/c_submenu/loaddata/") ?>'+page,
      method: 'GET',
      dataType: 'json',
      success: function (res)
      {
        if(res.content.length != 0){

        jQuery("nav#pagging").html(res.pagination);
        jQuery("#myData").html(res.content);
        jQuery("b#per").html(res.per);
        jQuery("b#total").html(res.totalRows);
        
        }
        else
        {
          jQuery("#myData").html('<tr class="text-center"><td colspan="7">Data Kosong</td></tr>');
        }

      }
    });
  } 

  loadData(1);
  jQuery(document).on('click', '#pagging li a', function(e){
    e.preventDefault();
    var page = jQuery(this).data('ci-pagination-page');
    loadData(page);
  });

  jQuery("#FormSubMenu").on('submit', function(e){
    e.preventDefault();

    var me = jQuery(this);
    var ControlMsg = jQuery('#MsgBoxes');
    jQuery.ajax({
      method: 'POST',
      url: me.attr('action'),
      data: me.serialize(),
      dataType: 'json',
      beforeSend: function()
      {
        NProgress.start();
        NProgress.inc(0.9);
      },
      success: function(res)
      {
        if(res.msgdata == 1){
        /*  ControlMsg.html('<div class="alert bg-pink alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
              '<em class="material-icons pull-left m-r-10">warning</em> Responses Server Gagal'+
            '</div>');
        ControlMsg.fadeIn();
        setTimeout(function(){ControlMsg.fadeOut('slow')}, 2500);*/
        
        showNotification('bg-red', 'Responses Server Gagal', 'bottom', 'left', 'none', 'none');

        }else if(res.msgdata == 0){
        /*  ControlMsg.html('<div class="alert bg-green alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
              '<em class="glyphicon glyphicon-ok-sign"></em> Success Data Telah Ditambahkan'+
            '</div>');
        ControlMsg.fadeIn();
        setTimeout(function(){ControlMsg.fadeOut('slow')}, 2500);*/
        showNotification('bg-black', 'Success Data Telah Ditambahkan', 'bottom', 'left', 'none', 'animated fadeOutDown');        
        me[0].reset();
		$('[name="submainmenu"]').selectpicker('refresh');
    $('[name="modulesubmenu"]').selectpicker('refresh');
		$('[name="parentsubmenu"]').selectpicker('refresh');
        }
        
      },
      complete: function()
      {
        loadData(1);
        NProgress.done();
      }
    });
    
  });

  function edit(id)
  {
    $("#ModalEdit").modal('show');
    $.get('<?= site_url("backend/module/c_submenu/editsubmenu") ?>', {idsub: id}, function(res){
        $("#editsubmenu").val(res.data[0].nama_sub);
        if(res.data[0].fid_module == '27') {
          var url = res.data[0].link_sub.split('/');
          $("#editlinksub").val(url[1]);
        } else {
          $("#editlinksub").val(res.data[0].link_sub);
        }
        $("#editordersub").val(res.data[0].order);
        $("#editidsub").val(res.data[0].idsub);
        /*$("#editnamamodule").val(res.data[0].fid_module);
        $("[name='editidmainmenu']").val(res.data[0].idmain);*/
		$('[name="editidmainmenu"]').selectpicker('val', res.data[0].idmain);
    $('[name="editnamamodule"]').selectpicker('val', res.data[0].fid_module);
		$('[name="editparentsubmenu"]').selectpicker('val', res.data[0].fid_idsub);
        let ak1 = $("#editaktifsub7");
        let ak2 = $("#editaktifsub8");
        if(res.data[0].aktif == 'Y')
        {
            ak1.prop('checked', false);
            ak2.prop('checked', true);
        }
        else
        {
            ak1.prop('checked', true);
            ak2.prop('checked', false);
        }
    }, 'json');
  }

jQuery("form#FormUpdateSubMenu").on('submit', function(e) {
    e.preventDefault();
    var form = jQuery(this);
    jQuery.post(form.attr('action'), form.serialize(), function(responses) {
        /*swal(responses.message.type, responses.message.content, responses.message.type);*/
        showNotification(responses.message.label, responses.message.content, 'bottom', 'left', 'none', 'animated fadeOutDown');   
        jQuery("#ModalEdit").modal('hide');
      loadData(1);
    }, 'json').then(() => {
		NProgress.start();
		NProgress.inc(0.9);
	}).done(() => {
		NProgress.done();
	});
});

  jQuery(".multipel_selected_hapus").click(function() {
    var check = jQuery(this).is(':checked');
    if(check)
    {
      jQuery(this).closest('tr').addClass('removeRow');
    }
    else 
    {
      jQuery(this).closest('tr').removeClass('removeRow').css('opacity','1');
    }
  });


  jQuery("#multipel_hapus").click(function(){
    var checkbox = jQuery(".multipel_selected_hapus:checked");
    if(checkbox.length > 0)
    {
      var checkbox_value = [];
      jQuery(checkbox).each(function(){
        checkbox_value.push(jQuery(this).val());
      });
      jQuery.ajax({
        url: '<?= site_url("backend/module/c_submenu/multipel_hapus") ?>',
        method: 'POST',
        data: {checkbox_val: checkbox_value},
        beforeSend: function()
        {
            NProgress.start();
            NProgress.inc(0.9);
        },
        success: function()
        {
          jQuery("#myData").closest('tr').fadeOut(1500);
            showNotification('bg-green', '<b>Success </b>Data Telah Terhapus', 'bottom', 'left', 'none', 'animated fadeOutDown'); 
        },
        complete: function()
        {
          loadData(1);
          NProgress.done();
        }
      });
    }
    else 
    {
      showNotification('bg-red', 'Baris Balum Dipilih', 'bottom', 'right', 'animated fadeInUp', 'animated fadeOut');      
    }
  });
  
  function hapus(id)
  {
	$.confirm({
		title: 'Hapus!',
		content: 'Apakah anda yakin akan menghapus submenu tersebut ?',
    animateFromElement: false,
    animation: 'opacity',
    closeAnimation: 'none',
		buttons: {
			confirm: function () {
				$.get('<?= site_url("backend/module/c_submenu/hapus/") ?>'+id, function(response){  
					$.dialog('Submenu('+ id +') Telah Terhapus!');
			    reset();
				});
			},
			cancel: function () {}
		}
	});
  }
</script>