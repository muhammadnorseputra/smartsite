<table class="table table-responsive table-condensed">
  <thead>
    <th>Name</th>
    <th>Ip</th>
    <th>Type</th>
    <th>Block</th>
    <th></th>
  </thead>
  <tbody>
    <?php 
      foreach($datas as $d):
        $status = ($d->block == 'n') ? '<span class="label label-default">No</span>' : '<span class="label label-danger">Ya</span>' ;
    ?>
      <tr>
        <td><?= $d->name ?></td>
        <td><?= $d->ip ?></td>
        <td><?= $d->type ?></td>
        <td><?= $status ?></td>
        <td width="30">
          <button id="edit" ajax-src="<?= base_url('backend/c_pengaturan/akseslogin_edit/'.$d->id_access_logregistered) ?>" ajax-id="<?= $d->id_access_logregistered ?>" type="button" title="edit" class="btn btn-sm btn-link col-teal m-t--10"><i class="material-icons font-14">edit</i></button>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>


<script>
$("button#edit").unbind().bind('click', function(evt) {
  evt.preventDefault();
  var self = $(this);
  var Url  = self.attr('ajax-src');
  // var Id   = self.attr('ajax-id');
  $.confirm({
    title: 'Edit',
    animation: 'fade',
    closeAnimation: 'fade',
    columnClass: 'm',
    animateFromElement: false,
    theme: 'material',
    closeIcon: true,
    content: function () {
        var self = this;
        return $.ajax({
            url: Url,
            dataType: 'html',
            method: 'post'
        }).done(function (response) {
            self.setContent(response);
        }).fail(function(){
            self.setContent('Something went wrong.');
        });
    },
    buttons: {
      ok: {
        isHidden: true // initially not hidden
      },
      Simpan: {
        btnClass: 'btn btn-sm btn-link',
        keys: ['Esc'],
        action: function () {
          var $form = $("#frm_hakakses_update");
          var ac = $form.attr('action');
          $.post(ac, $form.serialize(), function(response) {
            alert(response);
            location.reload();
          }, 'json');
        }
      }
    }
  });
});
</script>