
<script type="text/javascript">  
jQuery(function() {

// SELECT LABEL
var select_label = jQuery("select#pilihlabel").select2({
    placeholder: {
        id: '-1',
        text: '-- Pilih Label Menu --'
    },
    width: '100%',
    allowClear: true,
    theme: "bootstrap",
    ajax: {
        url: '<?= base_url("backend/module/c_menuutama/labelmenu") ?>',
        type: 'POST',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                searchParm: params.term
            };
        },
        processResults: function(response) {
            return {
                results: response.items
            };
        }
    }
});

// SELECT LABEL
var select_label_edit = jQuery("select#labelmenu_e").select2({
    placeholder: {
        id: '-1',
        text: '-- Pilih Label Menu --'
    },
    width: '100%',
    allowClear: true,
    theme: "bootstrap",
    ajax: {
        url: '<?= base_url("backend/module/c_menuutama/labelmenu") ?>',
        type: 'POST',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                searchParm: params.term
            };
        },
        processResults: function(response) {
            return {
                results: response.items
            };
        }
    }
});

function formatState (state) {
  if (!state.id) {
    return state.text;
  }
  var $state = jQuery(`<span><i class='material-icons'>${state.text.toLowerCase()}</i> ${state.id} </span>`);
  return $state;
};

//SELECT ICON
var select_icon = jQuery("select#iconmenu, select#iconmenu_e").select2({
    placeholder: {
        id: '-1',
        text: '-- Pilih Icon --'
    },
    width: '100%',
    allowClear: true,
    theme: "bootstrap",
    ajax: {
        url: '<?= base_url("backend/module/c_menuutama/iconmenu") ?>',
        type: 'POST',
        dataType: 'json',
        delay: 250,
        data: function(par) {
            return {
                searchIcon: par.term
            };
        },
        processResults: function(response) {
            return {
                results: response.items
            };
        }
    },
    templateResult: formatState
    
});    

});


function reset(){ 
    listmenu(1);
    jQuery("#search").val('');
}

function cariData()
{
    var val = jQuery("[name='search']").val();
    if(val != '')
    {
        jQuery.get('<?= site_url("backend/module/c_menuutama/caridata") ?>', {katakunci: val}, function(result){
        if(result.data.length != 0){
            jQuery("#myData").html(result.data);
        }else{
            jQuery("#myData").html('<tr class="text-center"><td colspan="10">Pencarian <b>'+val+'</b> Tidak Ditemukan !</td></tr>');
        }
        }, 'json');
    }
    else
    {
        jQuery("#myData").html('<tr class="text-center"><td colspan="10">Pencarian Tidak Ditemukan !</td></tr>');
    }
}


function showicon(icon)
{
    jQuery("#showicon").html('<i class="material-icons">'+icon+'</i>');
}
function showicon_edit(icon)
{
    jQuery("#showicon_e").html('<i class="material-icons">'+icon+'</i>');
}
function editlabel(id)
{

    jQuery("#ModalEdit").modal('show');

    jQuery.get('<?= site_url("backend/module/c_menuutama/editlabel") ?>', {idlabel: id}, function(res){
        jQuery("#editidlabel").val(res.data[0].idlabel);
        jQuery("#editnamalabel").val(res.data[0].label);
        jQuery("#editorderlabel").val(res.data[0].order);
        var ak1 = jQuery("#radio_01");
        var ak2 = jQuery("#radio_02");
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
function edit(id)
{
    jQuery("#ModalEditMenu").modal('show');
}

jQuery("[name='stsmenu']").on("change", function() {
    var check1 = jQuery("#radio_sts30");
    var check2 = jQuery("#radio_sts31");

    if(check1[0].checked)
    {
        jQuery("input#linkmenu_p").val("page/");
    }
    else if(check2[0].checked)
    {
        jQuery("input#linkmenu_p").val("module/");
    }
});

jQuery("#md_checkbox_sub").on("change", function() {
    let check1 = jQuery("#md_checkbox_sub");
    if(check1[0].checked)
    {
        jQuery("[name='linkmenu']").val('#');
        jQuery("#linkmenu").prop("readonly", true);
        jQuery("#linkmenu_p").prop("disabled", true);
    }
    else
    {
        jQuery("#linkmenu").prop("readonly", false);
        jQuery("#linkmenu_p").prop("disabled", false);
        jQuery("[name='linkmenu']").val('').focus();
    }    
});

jQuery("#md_checkbox_sub_e").on("change", function() {
    let check2 = jQuery("#md_checkbox_sub_e");

    if(check2[0].checked)
    {
        jQuery("[name='linkmenu_e']").val('#');
        jQuery("#linkmenu_e").prop("readonly", true);
    }
    else
    {
        jQuery("#linkmenu_e").prop("readonly", false);
        jQuery("[name='linkmenu_e']").val('').focus();
    }    
});

listlabel();
function listlabel()
{
    jQuery.post('<?= site_url("backend/module/c_menuutama/listlabel") ?>', function(response){
        jQuery("ul#listlabel").html(response.data);
    }, 'json');
}

function listmenu(page){
    jQuery.ajax({
        url: '<?= site_url("backend/module/c_menuutama/listmenu/") ?>'+page,
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
                jQuery("#myData").html('<tr class="text-center"><td colspan="10">Data Kosong</td></tr>');
            }

        }
    });
} 


listmenu(1);
jQuery(document).on('click', '#pagging li a', function(e){
    e.preventDefault();
    var page = jQuery(this).data('ci-pagination-page');
    listmenu(page);
});

jQuery("#FormMenuUtama").on('submit', function(e){
e.preventDefault();
    var me = jQuery(this),
        controlMsg =  jQuery("#Message");
        jQuery.post(me.attr('action'), me.serialize(), function(data){
        controlMsg.fadeIn();
        controlMsg.html('<div class="alert alert-dismissible bg-'+data.message.type+'">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.message.content +
            '</div>');
        setTimeout(function(){
            controlMsg.fadeOut('slow');
        }, 2000);

        if(data.message.type == 'green')
        {
            setTimeout(function(){
                jQuery("#AddMenu").modal('hide');
            }, 1500);
            me[0].reset();
            showicon('null');
        }
        listmenu(1);
    }, 'json').then(() => {
        NProgress.start();
        NProgress.inc(0.9);
	}).done(() => {
		NProgress.done();
	});
});

jQuery("#FormLabelMenu").on('submit', function(e){
e.preventDefault();
    var me = jQuery(this);
    jQuery.post(me.attr('action'), me.serialize(), function(data){
        //swal(data.message.type, data.message.content, data.message.type);
        showNotification('bg-teal', data.message.content, 'bottom', 'right', 'animated bounceInUp', 'animated fadeOut');

        me[0].reset();
        listlabel();
        labelmenu();
    }, 'json').then(() => {
        NProgress.start();
        NProgress.inc(0.9);        
	}).done(() => {
		NProgress.done();
	});
});

jQuery("form#FormUpdateLabelMenu").on('submit', function(e) {
    e.preventDefault();
    var form = jQuery(this);
    jQuery.post(form.attr('action'), form.serialize(), function(responses) {
        //swal(responses.message.type, responses.message.content, responses.message.type);
        showNotification('bg-teal', responses.message.content, 'bottom', 'right', 'animated bounceInUp', 'animated fadeOut');
        jQuery("#ModalEdit").modal('hide');
        listlabel();
        labelmenu();
    }, 'json').then(() => {
        NProgress.start();
        NProgress.inc(0.9);
        
	}).done(() => {
		NProgress.done();
	});
});

jQuery("#FormLabel").on('submit', function(e){
e.preventDefault();
    var me = jQuery(this);
    jQuery.post(me.attr('action'), me.serialize(), function(data){
        jQuery(".MsgJs").fadeIn();
        jQuery(".MsgJs").html(data);
        setTimeout(function(){
            jQuery(".MsgJs").slideUp('slow');
        }, 2000);
        me[0].reset();
        loadIcon();
        labelmenu();
    }).then(() => {
        NProgress.start();
        NProgress.inc(0.9);
        
	}).done(() => {
		NProgress.done();
	});
});

jQuery("#FormIcon").on('submit', function(e){
e.preventDefault();
    var me = jQuery(this);
    jQuery.post(me.attr('action'), me.serialize(), function(data){
        jQuery(".MsgErrorJs").fadeIn();
        jQuery(".MsgErrorJs").html(data);
        setTimeout(function(){
            jQuery(".MsgErrorJs").slideUp('slow');
        }, 2000);

        me[0].reset();
        loadIcon();
        iconmenu();
    }).then(() => {
        NProgress.start();
        NProgress.inc(0.9);
        
	}).done(() => {
		NProgress.done();
	});
});

loadIcon();
function loadIcon()
{
    jQuery.get('/backend/module/c_menuutama/listicon', function(response){
        jQuery("#loadIcon").html(JSON.parse(response));
    });  
}

function editmenu(id) {
    jQuery("#EditMenu").modal('show');
    jQuery.getJSON(
        '<?= site_url("backend/module/c_menuutama/editmenu") ?>', 
        {idmenu: id}, 
        function(res){
        // $("select#labelmenu_e").val();
        $("select#labelmenu_e").val(res.data[0].fid_label);
        jQuery("#namamenu_e").val(res.data[0].nama_menu);
        jQuery("#linkmenu_e").val(res.data[0].link);   
        jQuery("#order_e").val(res.data[0].order);   
        jQuery("[name='iconmenu_e']").val(res.data[0].icon);  
        jQuery("#showicon_e").html(`<em class="material-icons">` + res.data[0].icon + `</em>`);
        jQuery("[name='idmenu_e']").val(id);
            
        let ak1 = jQuery("#radio_sts30_e");
        let ak2 = jQuery("#radio_sts31_e");

            if(res.data[0].sts == 'BACKEND')
            {
                ak1.prop('checked', false);
                ak2.prop('checked', true);
                jQuery("#linkmenu_p_e").val('module/');
            }
            else
            {
                ak1.prop('checked', true);
                ak2.prop('checked', false);
                jQuery("#linkmenu_p_e").val('page/');

            }

            let check2 = jQuery("#md_checkbox_sub_e");
            if(res.data[0].link == '#'){
                check2[0].checked = true; 
                jQuery("#linkmenu_e").prop('readonly', true);            
            } else {
                check2[0].checked = false;
                jQuery("#linkmenu_e").prop('readonly', false);
            }
        
            let ak3 = jQuery("#radio_7_e");
            let ak4 = jQuery("#radio_8_e");
            if(res.data[0].aktif == 'Y') {
                ak3.prop('checked', false);
                ak4.prop('checked', true);
            } else {
                ak3.prop('checked', true);
                ak4.prop('checked', false);
            }
        }
    )
}

jQuery("#FormUpdateMenuUtama").on('submit', function(e) {
    e.preventDefault();
    var form = jQuery(this);
    jQuery.post(form.attr('action'), form.serialize(), function(responses) {
        //swal(responses.message.type, responses.message.content, responses.message.type);
        showNotification('bg-teal', responses.message.content, 'bottom', 'right', 'animated bounceInUp', 'animated fadeOut');
        setTimeout(() => {
            jQuery("#EditMenu").modal('hide');
        }, 500);
        listmenu(1);
    }, 'json').then(() => {
        NProgress.start();
        NProgress.inc(0.9);
	}).done(() => {
		NProgress.done();
	});
});

function hapus(id)
{
    //alert hapus
    swal({
        title: "System Info",
        text: "Apakah anda yakin akan menghapus data tersebut ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        animation: "slide-from-bottom",
        showLoaderOnConfirm: true,
        closeOnConfirm: false
    }, function () {            
        jQuery.get('<?= site_url("backend/module/c_menuutama/hapus/") ?>'+id, function(response){        
        swal({title: "Deleted!", text: "Data Telah Terhapus", type: "success", timer: 1000, showConfirmButton: false} );
        showNotification('bg-red', 'Deleted Success', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOut');
        listmenu(1);
        }).then(() => {
        NProgress.start();
		NProgress.inc(0.9);
        
	}).done(() => {
		NProgress.done();
	});
    });
}

// jQuery(".multipel_selected_hapus").click(function() {
//     var check = jQuery(this).is(':checked');
//     if(check)
//     {
//       jQuery(this).closest('tbody tr').addClass('removeRow').css('opacity','0.6');
//     }
//     else 
//     {
//       jQuery(this).closest('tbody tr').removeClass('removeRow');
//     }
//   });

jQuery("#multipel_hapus").click(function(){
    var checkbox = jQuery(".multipel_selected_hapus:checked");
    if(checkbox.length > 0)
    {
      var checkbox_value = [];
      jQuery(checkbox).each(function(){
        checkbox_value.push(jQuery(this).val());
      });
      jQuery.ajax({
        url: '<?= site_url("backend/module/c_menuutama/multipel_hapus") ?>',
        method: 'POST',
        data: {checkbox_val: checkbox_value},
        beforeSend: function()
        {
            NProgress.start();
		    NProgress.inc(0.9);

        },
        success: function()
        {
          jQuery('.removeRow').fadeOut(1500);
            showNotification('bg-green', '<b>Success </b>Data Telah Terhapus', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOutDown'); 
        },
        complete: function()
        {
            listmenu(1);
            NProgress.done();
        }
      });
    }
    else 
    {
        showNotification('bg-red', '<b>Warning, </b>Baris Belum Dipilih', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOutDown'); 
    }
});

function hapuslistlabel(idlabel)
{
    swal({
        title: "System Info",
        text: "Apakah anda yakin akan menghapus data tersebut ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        animation: "slide-from-bottom",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
    }, function () { 
        jQuery.get('<?= site_url("backend/module/c_menuutama/hapuslabel/") ?>'+idlabel, function(){ 
            showNotification('bg-red', 'Deleted Success', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOut');       
            swal({title: "Deleted!", text: "Data Telah Terhapus", type: "success", timer: 1000, showConfirmButton: false} );
            
            listlabel();
            labelmenu();
        }).then(() => {
        NProgress.start();
		NProgress.inc(0.9);
        
	}).done(() => {
		NProgress.done();
	});      
    });
}

</script>
