<script>
$(document).ready(function() {
  let container = $("section#page-loaded");
  container.load('<?= base_url('backend/module/c_module/module_table') ?>');

  var btn_tambah = $("button#c_module_add").unbind().bind('click', function() {
    container.load('<?= base_url('backend/module/c_module/module_add') ?>' + '?id='+Math.random());
    $(this).prop("disabled", true);
  });

  var btn_batal = $(document).on('click', 'button#c_module_batal', function() {
    container.load('<?= base_url('backend/module/c_module/module_table') ?>' + '?id='+Math.random());
    $("button#c_module_add").prop("disabled", false);
  });

  var btn_edit = $(document).on('click', 'button#btn-edit', function() {
    $("#ModalEdit").modal('show');
    var x = $(this).attr('data-id');
    $("#ModalEdit .modal-body").html(`
      <center><img src="<?= base_url('assets/images/loader/search.gif') ?>"><p class="text-center m-t-20">Mohon tunggu, mencari module ID...</p> </center>
    `);
    setTimeout(() => {
      $("#ModalEdit .modal-body").load('<?= base_url('backend/module/c_module/module_edit/') ?>' + x  + '?id='+Math.random());
    }, 800);
  });

  $("#FormUpdate").on('submit', function(e) {
  e.preventDefault();
  let form = $(this);
    $.post(form.attr('action'), form.serialize(), function(result) {
      showNotification('bg-black', result, 'bottom', 'center', 'none', 'animated fadeOutDown'); 
      var tbl = $('table#tbl-module').DataTable();
      tbl.ajax.reload();
      
      $("#ModalEdit").modal('hide');
    }, 'json');
  });
  
});

</script>