<style>
.no-close .ui-dialog-titlebar-close {
	display: none;
}
</style>
<script>
  listKategori();
  function listKategori()
  {
    jQuery.get('<?= site_url("backend/module/c_kategori/show") ?>', function(result){
      jQuery('#show').html(result.data);
    }, 'json');
  } 

  listTags();
  function listTags()
  {
    jQuery.get('<?= site_url("backend/module/c_kategori/show_tags") ?>', function(result){
      jQuery('#list-tags').html(result.data);
    }, 'json');
  } 

  function edit(idkategori)
  {
    jQuery("#ModalEdit").modal('show');
    jQuery.get('<?= site_url("backend/module/c_kategori/edit/") ?>'+idkategori, function(result){
      jQuery("[name='idkategori']").val(result[0].id_kategori);
      jQuery("[name='namakategori']").val(result[0].nama_kategori);
      
      var rN = jQuery("#radio_9");
      var rY = jQuery("#radio_10");

      if(result[0].aktif == 'Y')
      {
        rY.prop("checked", true);
        rN.prop("checked", false);

      }
      else 
      {
        rY.prop("checked", false);
        rN.prop("checked", true);
      }

      //alert(result.data.nama_kategori);
    }, 'json');
  }

  jQuery("#formUpdateKategori").on('submit', function(event){
    event.preventDefault();
    var Form = jQuery(this),
        Controls = Form.serialize(),
        Url = Form.attr('action');
    
    jQuery.post(Url,Controls, function(result){
      jQuery("#ModalEdit").modal('hide');
      listKategori();
      showNotification('bg-black', 'Success Update Data', 'bottom', 'right', '', '');      
    });
  });

  function del(idkategori)
  {
    var $dialog = $('<div></div>')
										.html("Apakah anda yakin akan menghapus sebuah kategori")
										.dialog({
												autoOpen: false,
												modal: true,
												width: 600,
												dialogClass: "no-close",
												title: 'Message!',
												buttons: [
												{
													text: "Ok",
													click: function() {
														$.post('<?= site_url("backend/module/c_kategori/del") ?>', {id : idkategori}, function(){
                              showNotification('bg-pink', 'Data Telah Terhapus', 'bottom', 'right', '', 'animated fadeOut');
                              listKategori();
                            });
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
    
           
  }

  function del_tags(idtag)
  {
    jQuery.post('<?= site_url("backend/module/c_kategori/del_tags") ?>', {id : idtag}, function(){
                listTags();
            }, 'json');
  }

  jQuery("#formAddTags").on('submit', function(e) {
    e.preventDefault();
    var form = jQuery(this); 
    jQuery.post(form.attr('action'), form.serialize(), function(result){
      if(jQuery("[name='NamaTag']").val() != ''){
        jQuery("#list-tags").html(result.data);
        listTags();
        form[0].reset();
      }
      else 
      {
        showNotification('bg-black','Responses Server Gagal', 'bottom', 'right', '', '');
      }
    }, 'json');    
  });
  
  jQuery("#FormKategori").on('submit', function(e) {
    e.preventDefault();
    var form = jQuery(this),
        btnSave = jQuery('button[type="submit"]#add'); 
    jQuery.ajax({
      url: form.attr('action'),
      method: 'POST',
      data: form.serialize(),
      dataType: 'json',
      beforeSend: function() 
      {
        btnSave.prop('disabled', true);
        NProgress.start();
      },
      success: function(responses)
      {
        if(responses.result.type == 'success')
        {
          showNotification('bg-teal', '<b><em class="glyphicon glyphicon-ok pull-left"></em></b>'+responses.result.content, 'bottom', 'right', '', 'animated fadeOutDown');
          NProgress.done();
          form[0].reset();
          listKategori();
        }
        else if (responses.result.type == 'error')
        {
          showNotification('bg-red', responses.result.content, 'bottom', 'right', '', 'animated fadeOut');
          NProgress.done();
        }
      },
      complete: function()
      {
        NProgress.remove();
        btnSave.html('<em class="material-icons pull-left font-16 m-r-5">save</em> SIMPAN').prop('disabled', false);
      }
    });
  });

  jQuery("#formSearchKategori").on('submit', function(e){
    e.preventDefault();
    var form = jQuery(this);
    jQuery.post(form.attr('action'), form.serialize(), function(result){
      $('#show').html(result.data);
    }, 'json');
  })
</script>