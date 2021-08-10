<div class="block-header row m-b-15">
  <h2>
    <i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">comment</i> Manajemen Komentar
		<small>#_Module Komentar</small>
	</h2> 
</div>

<div class="clearfix">
  <div class="card card-shadow">
    <div class="body">
      
      <table class="table table-responsive table-hover table-condensed " id="tbl-komentar">
        <thead>
          <th>NO</th>
          <th>GRAVATAR</th>
          <th>REPLY ID</th>
          <th>NAMA LENGKAP</th>
          <th>ON BERITA</th>
          <th>AKSI</th>
        </thead> 
        <tbody>
      </table>
    </div>
  </div>
</div>

<!-- Default Size -->
<div class="modal fade modal-fixed-footer" id="modal-detail-komentar" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-detail-komentar">Detail Komentar </h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-rounded waves-effect" data-dismiss="modal">BATAL</button>
            </div>
        </div>
    </div>
</div>