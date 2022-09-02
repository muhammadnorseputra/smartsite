<div class="block-header row m-b-15">
  <div class="col-md-4">
    <h2>
  
    <i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">person</i> Manajemen Users
    <small>#_Module Users</small>
  </h2>
  </div>
  <div class="col-md-8">
    <button type="button" id="c_users_add" class="btn btn-sm btn-primary waves-effect waves-float m-t-10 m-r-15 pull-right"><em class="material-icons font-18 pull-left m-r-5">add</em> Tambah Users</button>

  </div>
   
</div>

<div class="clearfix"></div>

<?php 
  if($this->session->flashdata('message') <> '') {
    echo '<div class="'.$this->session->flashdata('class').' alert-dismissible">
              '. $this->session->flashdata('message') .'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>';
  }
?>	
<section id="page-loaded"></section>
