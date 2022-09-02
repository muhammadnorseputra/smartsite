<script>
$(document).ready(function() {
  let container = $("section#inner-page-loaded");
  /*let containerBody = $(".content-inner")*/
  container.load('<?= base_url('backend/module/c_menu/menu_table') ?>');
  
  /*var btn_add = $("button#btn-add-menu").on('click', function(e) {
    e.preventDefault();
    container.load('<?= base_url('backend/module/c_menu/menu_add') ?>');
    $(this).prop("disabled", true);
  });*/


});
</script>