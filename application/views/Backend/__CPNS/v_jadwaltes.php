<div class="row  m-b-10 border-bottom m-t--15">
  <div class="col-md-8 p-t-10">
    <span class="text-mutted help-block">Silahkan download template format isian data jadwal tes, sesuaikan dengan format yang ada, dilarang merobah ataupun menambah kolom maupun baris yang berlatar belakang hitam!</span>
    <a href="#" id="templateTable">
      <i class="glyphicon glyphicon-cloud-download m-r-5"></i> Download Template
    </a>
    |
    <a href="#" id="emptyTable"> 
      <i class="glyphicon glyphicon-trash m-r-5"></i> Kosongkan Table
    </a>
    |
    <a href="#" id="backupTable_jadwaltes" data-req="<?= sha1(date('dmY')); ?>">
      <i class="glyphicon glyphicon-oil m-r-5"></i> Backup SQL
    </a>
  </div>
  <div class="col-md-4 bg-indigo p-t-15 p-b-15">
    <?= form_open_multipart(base_url('cpns/informasi/imports_peserta_jadwaltes'), ['id' => 'import_form']); ?>
    <div class="form-group">
      <label for="#file"><i class="glyphicon glyphicon-import"></i> Import Data Excel</label>
      <div class="form-line">
        <input type="file" name="file" id="file" required accept=".xls, .xlsx" />
        <small class="bg-red p-t-5 p-b-5 text-center help-block">file excel yang di izinkan format .xls atau .xlsx</small>
      </div>
    </div>
    <button type="submit" class="btn btn-rounded bg-yellow btn-link waves-effect m-t--25"><i class="glyphicon glyphicon-export m-r-5"></i> Upload data</button>
    <?= form_close(); ?>
  </div>
</div>
<table class="display table table-bordered table-striped table-condensed table-hover" id="tbl-jadwaltes">
  <thead>
    <th>NOMOR PESERTA</th>
    <th>NIK</th>
    <th>NAMA</th>
    <th>LOKASI TES</th>
    <th>TANGGAL TES</th>
    <th>WAKTU TES</th>
    <th>RUANGAN TES</th>
  </thead>
  <tbody>
  </table>
  <script src="<?= base_url('assets/plugins/blockUI/jquery.blockUI.js'); ?>"></script>
  <script>
  $(document).ready(function() {
  let dataTable = $('table#tbl-jadwaltes').DataTable({
        processing: true,
        serverSide: true,
        order: [
          [1, 'desc']
        ],
        responsive: true,
  scrollY: 350,
  scrollX: false,
  dom: 'B<"clear">ft<"right"p>r<"left"l>i',
  buttons: [
  {
  extend: 'pdf',
  className: 'btn-sm waves-effect',
  title: 'JADWAL TES PESERTA CPNS',
  pageSize: 'legal',
  orientation: 'portrait',
  download: 'open'
  },
  {
  extend: 'copy',
  text: 'Copy Ke Clipboard'
  },
  {
  extend: 'excel',
  text: 'Exports to excel'
  },
  'print'
  ],
        ajax: {
  url: '<?= base_url('cpns/informasi/ajaxList_jadwaltes'); ?>',
  type: 'POST'
  },
  columnDefs: [{
  "targets": [0,1,2,3,4,5,6],
  "orderable": true
  }
  ],
  language: {
  search: "Pencarian: ",
  processing: "<img src='<?= base_url('assets/images/loader/rolling-2.gif'); ?>'>",
  paginate: {
  previous: "Sebelumnya",
  next: "Selanjutnya"
  },
  emptyTable: "No matching records found, please filter this data"
  }
  });
  
  $('#import_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
  url: $(this).attr('action'),
  method:"POST",
  data:new FormData(this),
  contentType:false,
  cache:false,
  processData:false,
  error: function(XMLHttpRequest, textStatus, errorThrown) {
  alert(textStatus + ' duplicate entry data.');
  },
  beforeSend: function() {
  $.blockUI({
  message: '<img src="<?= base_url('assets/images/loader/rolling-2.gif'); ?>"> <h4> Importing Excel Proses</h4>',
  css: {
  border: 'none',
  padding: '15px',
  backgroundColor: '#fff',
  '-webkit-border-radius': '10px',
  '-moz-border-radius': '10px',
  opacity: 1,
  color: '#000'
  }
  });
  },
  success:function(data){
  $('#file').val('');
  dataTable.ajax.reload();
  $.confirm(data, 'Success');
  },
  complete: function() {
  $.unblockUI();
  }
  })
  });
  $("#backupTable_jadwaltes").unbind().bind('click', function(event) {
  event.preventDefault();
  var req = $(this).attr('data-req');
  $.showIndicator();
  $.post('<?= base_url('cpns/informasi/backup_sql_table_jadwaltes'); ?>', {req: req}, function (response) {
  alert(response);
  }, 'json').done(() => {
  $.hideIndicator(); // hide the indicator
  });
  });
  $("#emptyTable").unbind().bind('click', function(event) {
  event.preventDefault();
  $.confirm('Apa anda yakin akan menghapus seluruh data?', 'Empty Table!', function () {
  $.showPreloader('Mohon tunggu, mencoba mengkosongkan table');
  
  $.post('<?= base_url('cpns/informasi/doEmptyTable'); ?>', function(response) {
  showNotification(response.type, response.msg, 'bottom', 'center', 'animated fadeIn', 'animated bounceOutDown');
  }, 'json')
  .done(() => {
  $.hidePreloader();// hide the indicator
  dataTable.ajax.reload();
  });
  
  });
  });
  $("#templateTable").unbind().bind('click', function(event) {
  event.preventDefault();
  $.showIndicator();
  setTimeout(function () {
  $.hideIndicator();// hide the indicator
  window.open("<?= base_url('cpns/informasi/downloadTemplate/'); ?>", '_blank', 'width=400,height=500,left=520,top=80, scrollbars=yes, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no',  true);
  }, 2500);
  });
  });
  </script>