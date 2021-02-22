<?php
$by = $public_profile->id_user_portal;
$namalengkap = decrypt_url($public_profile->nama_lengkap);
$namapanggilan = decrypt_url($public_profile->nama_panggilan);
$tanggal_bergabung = longdate_indo($public_profile->tanggal_bergabung);
$desc = $public_profile->deskripsi != '' ? $public_profile->deskripsi : '<span class="text-muted">Belum ada deskripsi</span>';
$online = $public_profile->online == 'ON' ? '<span class="text-success"><sup> &bull; </sup></span>' : '<span class="text-secondary"><sup> &bull; </sup></span>';
$photo = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($public_profile->id_user_portal)->photo_pic) . '';

$link_profile_public =
  base_url("user/" . decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan) . "/" . encrypt_url($by));
?>

<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <div class="card bg-white">
          <div class="card-body p-0">
            <div class="card-header mb-4 py-4 bg-transparent">
              <h5 class="card-title text-success font-weight-bold">Postingan Yang Disukai</h5>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-1 offset-md-1">
                  <img src="<?= $photo ?>" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                  <h3 class="font-weight-bold"><?= $namalengkap ?> <?= $online ?> <a href="<?= $link_profile_public ?>" data-toggle="tooltip" title="Profile @<?= $namalengkap ?>" class="btn btn-sm rounded float-lg-right btn-outline-primary ml-1"> Back to profile</a></h3>

                  <span class="text-secondary">@<?= $namapanggilan; ?> <span class="mx-1"> &bull;</span> <small>Bergabung pada: <?= $tanggal_bergabung; ?></small></span>
                  <!-- <hr> -->
                  <div class="table-responsive my-3">
                    <table data-id="<?= $public_profile->id_user_portal ?>" class="table table-condensed display" id="table-dikukasi">
                      <thead>
                        <tr>
                          <th>Postingan Disukai</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/datatables2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatable/datatables-save.min.js') ?>"></script>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>
<script>

var table = $("#table-dikukasi").DataTable({
    "processing": true,
    "serverSide": true,
    "paging": true,
    "ordering": true,
    "info": false,
    "searching": true,
    "pagingType": "full_numbers",
    "responsive": true,
    "datatype": "json",
    "fixedHeader": {
      headerOffset: 0,
      header: true,
      footer: false
    },
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    "order": [0, 'desc'],
    "ajax": {
      "url": _uri+'/frontend/v1/users/get_all_disukai',
      "type": "POST",
      "data": function(q) {
        q.id_a = $("#table-dikukasi").attr('data-id')
      },
    },
    "columnDefs": [{
      "targets": [0],
      "orderable": true,
    }],
    "language": {
      "lengthMenu": "_MENU_ Data per halaman",
      "zeroRecords": "Belum ada postingan yang disukai",
      "info": "Showing page _PAGE_ of _PAGES_",
      "infoEmpty": "Belum ada postingan yang disukai",
      "infoFiltered": "(filtered from _MAX_ total records)",
      "search": "Pencarian",
      "processing": `<img src='${_uri}/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg'>`
    }
  });

</script>