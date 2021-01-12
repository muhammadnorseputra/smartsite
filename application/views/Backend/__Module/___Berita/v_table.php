<div class="block-header row m-b-15">
	<div class="col-md-6">
		<h2>
			<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">library_books</i> Berita
			<small>#_Module Berita</small>
		</h2>
	</div>
	<div class="col-md-6">
		<a href="<?= base_url('backend/module/c_berita/add?module=' . $this->madmin->getmodulebycontroller('c_berita') . '&user=' . $this->session->userdata('user_access')) ?>" class="btn btn-sm btn-link waves-effect waves-float pull-right"><em class="material-icons font-16 pull-left m-r-5">add</em> Buat Berita Baru</a>
	</div>
</div>
<div class="alert alert-message alert-message-info" role="alert">
	<i class="material-icons">info</i>
	<b>Anda dapat membuat berita baru.</b>
	<p>Click tombol buat berita, untuk membuat berita baru</p>

</div>
<div class="clearfix">
	<div class="card card-shadow">
		<div class="header">

			<h2>Table berita</h2>
		</div>
		<div class="body">

			<?php $this->view('msg/flashdata') ?>

			<table class="table table-responsive table-hover table-condensed" id="tbl-berita">
				<thead>
					<th>NO</th>
					<!-- <th>ID</th> -->
					<th>JUDUL</th>
					<th>TGL. POSTING</th>
					<th>DILIHAT</th>
					<th>AKSI</th>
				</thead>
				<tbody>
			</table>

		</div>
	</div>
</div>
