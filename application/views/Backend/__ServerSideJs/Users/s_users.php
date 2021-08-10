<script>
$(document).ready(function() {
  let container = $("section#page-loaded");
  container.load('<?= base_url('backend/module/c_users/users_table') ?>');

  var btn_tambah = $("button#c_users_add").unbind().bind('click', function() {
    container.load('<?= base_url('backend/module/c_users/users_add') ?>');
    $(this).prop("disabled", true);
  });

  var btn_batal = $(document).on('click', 'button#c_module_batal', function() {
    container.load('<?= base_url('backend/module/c_users/users_table') ?>');
    $("button#c_users_add").prop("disabled", false);
  });

  var btn_user_module = $(document).on('click', 'a#user_module', function() {
    let id = $(this).attr('data-id');
    container.load('<?= base_url('backend/module/c_users/edit_user_module/') ?>' + id);
  });

});
</script>