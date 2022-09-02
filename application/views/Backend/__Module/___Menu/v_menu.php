<div class="block-header row m-b-15">
	
	<div class="row">
		<div class="col-md-4">
			<h2>
				<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">menu</i> Manajemen Menu
				<small>#_Module Menu</small>
			</h2>
		</div>
		<div class="col-md-8">
			<button type="button" id="btn-label" class="btn btn-sm m-t-10 pull-right btn-link waves-effect waves-float m-r-20">
			  <em class="glyphicon glyphicon-pushpin m-r-1"></em> Label
			</button>

			<button type="button" id="btn-icons" class="btn  m-t-10 btn-sm pull-right btn-link waves-effect waves-float m-r-20">
			  <em class="glyphicon glyphicon-leaf m-r-1"></em> Referensi Icon
			</button>
			
			<!--     
			<button type="button" id="btn-add-menu" class="btn btn-info btn-sm waves-effect pull-right m-l-10">
			  <em class="glyphicon glyphicon-plus m-r-1"></em> Tambah Menu
			</button> 
			-->

			<button type="button" class="btn waves-float btn-sm m-t-10 pull-right btn-link waves-effect m-r-20" onclick="window.location.href='<?= base_url('backend/module/c_menu/menu_add?module='.$this->madmin->getmodule('MENU UTAMA').'&user='.$this->session->userdata('user_access')) ?>'" >
			  <em class="glyphicon glyphicon-plus m-r-1"></em> Buat menu baru
			</button>
		</div>
	</div>
	
	
	
	
	
</div>
<div class="clearfix"></div>
<section id="inner-page-loaded"></section>