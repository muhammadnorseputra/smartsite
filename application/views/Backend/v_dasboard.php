

	<?php
        echo $this->session->flashdata('welcome_message');
    ?>

<!-- Widgets 1 -->
<div class="row clearfix m-t-25">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect hover-zoom-effect bg-red">
			<div class="icon bg-red">
				<i class="material-icons">playlist_add_check</i>
			</div>
			<div class="content">
				<div class="text">AGENDA</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_agenda'); ?>" data-speed="15" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect hover-zoom-effect bg-cyan">
			<div class="icon bg-cyan">
				<i class="material-icons">library_books</i>
			</div>
			<div class="content">
				<div class="text">BERITA</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_berita'); ?>" data-speed="1000" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect hover-zoom-effect bg-light-green">
			<div class="icon bg-light-green">
				<i class="material-icons">forum</i>
			</div>
			<div class="content">
				<div class="text">KOMENTAR</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_komentar'); ?>" data-speed="1000" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect hover-zoom-effect bg-orange ">
			<div class="icon bg-orange">
				<i class="material-icons">person_add</i>
			</div>
			<div class="content">
				<div class="text">JUMLAH USER</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_users'); ?>" data-speed="1000"
				 data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Widgets -->


<!-- Widgets 2 -->
<div class="row clearfix">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect hover-zoom-effect  bg-pink">
			<div class="icon bg-pink">
				<i class="material-icons">pages</i>
			</div>
			<div class="content">
				<div class="text">HALAMAN STATIS</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_halaman'); ?>" data-speed="15" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect  hover-zoom-effect bg-indigo">
			<div class="icon bg-indigo">
				<i class="material-icons">info_outline</i>
			</div>
			<div class="content">
				<div class="text">INFORMASI</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_info'); ?>" data-speed="1000" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect  hover-zoom-effect bg-teal">
			<div class="icon bg-teal">
				<i class="material-icons">photo_library</i>
			</div>
			<div class="content">
				<div class="text">GALERI FOTO</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_foto'); ?>" data-speed="1000" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-expand-effect  hover-zoom-effect bg-amber">
			<div class="icon bg-amber">
				<i class="material-icons">video_library</i>
			</div>
			<div class="content">
				<div class="text">VIDEO</div>
				<div class="number count-to" data-from="0" data-to="<?= $this->madmin->count_all_data('t_video'); ?>" data-speed="1000"
				 data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
</div>

<!-- #END# Widgets -->

<div class="row clearfix">

	<!-- Latest Social Trends -->
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="card card-border">
			<div class="header">
				<b>POLING WEBSITE</b>
			</div>
			<div class="body">
				<ul class="dashboard-stat-list">
					<li>
						#socialtrends
						<span class="pull-right">
							<i class="material-icons">trending_up</i>
						</span>
					</li>
					<li>
						#materialdesign
						<span class="pull-right">
							<i class="material-icons">trending_up</i>
						</span>
					</li>
					<li>#adminbsb</li>
					<li>#freeadmintemplate</li>
					<li>#bootstraptemplate</li>
					<li>
						#freehtmltemplate
						<span class="pull-right">
							<i class="material-icons">trending_up</i>
						</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- #END# Latest Social Trends -->
	<!-- Latest Social Trends -->
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="card card-border">
			<div class="body">
				<div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
				<ul class="dashboard-stat-list">
					<li>
						#socialtrends
						<span class="pull-right">
							<i class="material-icons">trending_up</i>
						</span>
					</li>
					<li>
						#materialdesign
						<span class="pull-right">
							<i class="material-icons">trending_up</i>
						</span>
					</li>
					<li>#adminbsb</li>
					<li>#freeadmintemplate</li>
					<li>#bootstraptemplate</li>
					<li>
						#freehtmltemplate
						<span class="pull-right">
							<i class="material-icons">trending_up</i>
						</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- #END# Latest Social Trends -->
	<!-- Answered Tickets -->
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="card card-border">
			<div class="body">
				<div class="font-bold m-b--35">ANSWERED TICKETS</div>
				<ul class="dashboard-stat-list">
					<li>
						TODAY
						<span class="pull-right"><b>12</b> <small>TICKETS</small></span>
					</li>
					<li>
						YESTERDAY
						<span class="pull-right"><b>15</b> <small>TICKETS</small></span>
					</li>
					<li>
						LAST WEEK
						<span class="pull-right"><b>90</b> <small>TICKETS</small></span>
					</li>
					<li>
						LAST MONTH
						<span class="pull-right"><b>342</b> <small>TICKETS</small></span>
					</li>
					<li>
						LAST YEAR
						<span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
					</li>
					<li>
						ALL
						<span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- #END# Answered Tickets -->
</div>
