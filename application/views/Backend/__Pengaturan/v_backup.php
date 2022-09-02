<div class="block-header row m-b-15">
	<h2>
		Backup Files
		<small> Backup databases dan Files Web </small>
	</h2>
</div>

<div class="card card-shadow">
<div class="clearfix">
		<div class="col-md-6">
			<i class="material-icons font-50 pull-left m-t-15 col-grey">data_usage</i>
			<a href="<?= site_url('backend/c_pengaturan/bu_database') ?>"
				class="btn btn-md btn-success waves-effect m-l-10 m-b-10 m-t-15 btn-budb"><em class="font-16">Backup
					Database</em> <em class="material-icons pull-right m-l-15">cloud_download</em></a>
			<p class="col-grey">
				<span class="m-l-10 font-12">
					Hasil backup akan tersimpan juga pada folder <code>files/file_backup/db/</code>
				</span>
				<hr>
				* Auto Compress Rar / Zip <br>
				* Format Type mysql.sql
			</p>
		</div>

		<div class="col-md-6">
			<i class="material-icons font-50 pull-left m-t-15 col-grey">devices</i>
			<a href="<?= site_url('backend/c_pengaturan/bu_site') ?>"
				class="btn btn-md btn-primary waves-effect m-l-10 m-b-10 m-t-15"><em class="font-16">Backup Files Site</em> <em
					class="material-icons pull-right m-l-15">cloud_download</em></a>
			<p>
				<span class="m-l-10 col-grey font-12">Hasil backup akan tersimpan juga pada folder
					<code>files/file_backup/site/</code></span>
				<hr>
				* Auto Compress Rar / Zip <br>
			</p>
		</div>
	</div>

</div>
<?php $this->load->view($scriptjs) ?>
