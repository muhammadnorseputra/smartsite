<div class="block-header row">
  <h2 class="m-l-25">
    <i class="material-icons pull-left m-b-5 m-r-10 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">settings</i> Pengaturan Umum</h2> 
</div>

<div id="tabs" class="row m-b-15 m-t--15">
  <!-- Nav tabs -->
    <ul class="nav nav-tabs tab-nav-right tab-col-teal border-bottom p-l-25" role="tablist">
      <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('backend/c_pengaturan/identitas/') ?>" data-toggle="tab" aria-expanded="false">Identitas</a>
      </li>
      <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('backend/c_pengaturan/maintenance/') ?>" data-toggle="tab" aria-expanded="false">Maintenance</a></li>
        <li role="presentation"><a style="padding-bottom:5px;" href="<?= base_url('backend/c_pengaturan/widget/') ?>" data-toggle="tab" aria-expanded="false">Widget</a></li>
    </ul>
</div>
