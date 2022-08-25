<div class="block-header row m-b-10">

	<h2>
	
	<i class="material-icons pull-left m-r-5 m-b-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">layers</i> Kategori
	<small>Sub Berita / Artikel / Label</small>
	</h2>
</div>

<ul class="nav nav-tabs tab-nav-right tab-col-red m-l-15" role="tablist">
	<li role="presentation" class="active"><a href="#kategori" class="m-t--15" data-toggle="tab" aria-expanded="true"> <em
	class="glyphicon glyphicon-leaf"></em> KATEGORI</a></li>
	<li role="presentation" class=""><a href="#label" class="m-t--15" data-toggle="tab" aria-expanded="true"><em
	class="glyphicon glyphicon-list"></em> LABEL / TAGS</a></li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade in active" id="kategori">
		<!-- Tabs Kategori -->
		<div class="row clearfix">
			<div class="col-md-4">
				<div class="card card-border">
					<div class="header">
						<h2>
							Panel Tambah Kategori <small>Add Kategori</small>
						</h2>
					</div>
					<?= form_open('backend/module/c_kategori/add', array('class' => 'collapse in', 'id' => 'FormKategori')) ?>
					<div class="body body-kategori">
						<label for="nama_kategori">Kategori</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Masukan Nama Kategori">
							</div>
						</div>
						<label for="aktif">Aktif</label>
						<div class="form-group">
							<input name="aktifkategori" type="radio" id="radio_aktif1" class="radio-col-red with-gap" value="N">
							<label for="radio_aktif1">DISABLED</label>
							<input name="aktifkategori" type="radio" id="radio_aktif2" class="radio-col-green with-gap" value="Y">
							<label for="radio_aktif2">ACTIVE</label>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" id="add" class="btn waves-effect btn-sm btn-primary waves-effect pull-right">SIMPAN</button>
					</div>
					<?= form_close() ?>
				</div>
			</div>
			<div class="col-md-8">
				
				<?= form_open('backend/module/c_kategori/search', ['id' => 'formSearchKategori']) ?>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
							<div class="form-line">
								<input type="text" name="cariNamaKategori" class="form-control" placeholder="Cari Katerogri Disini...">
							</div>
							<span class="input-group-addon">
								<button type="submit" class="btn btn-circle btn-link waves-effect waves-red waves-ripple">
								<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</div>
				</div>
				
				<?= form_close() ?>
				<div id="show"></div>
			</div>
			
		</div>
	</div>
	<div role="tabpanel" class="tab-pane fade in" id="label">
		<div class="row clearfix">
			<div class="col-md-4">
				<div class="card card-shadow">
					<div class="header">
						<h2>
						Panel Tambah Tags / Label <small>Add Tags</small>
						</h2>
					</div>
					<div class="body body-label collapse in">
						<?= form_open('backend/module/c_kategori/add_tags', ['id' => 'formAddTags']) ?>
						<div class="input-group">

							<div class="form-line">
								<input type="text" name="NamaTag" class="form-control" placeholder="Tambahkan Nama Label / Tags">
							</div>
							<span class="input-group-addon">
								<button type="submit" id="add_tags" class="btn btn-link btn-circle waves-effect">
								<i class="glyphicon glyphicon-plus"></i>
								</button>
							</span>
						</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card card-shadow">
					<div class="body" id="list-tags"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MODAL EDIT -->
<div class="modal fade m-t-100" id="ModalEdit" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<?= form_open('backend/module/c_kategori/update', ['id' => 'formUpdateKategori']) ?>
			<div class="modal-header">
				<h4 class="modal-title" id="smallModalLabel">
				EDIT KATEGORI
				<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</h4>
			</div>
			<div class="modal-body">
				<label for="namakategori">Nama Kategori</label>
				<div class="form-group">
					<div class="form-line">
						<input type="hidden" id="idkategori" name="idkategori" class="form-control">
						<input type="text" id="namakategori" name="namakategori" class="form-control">
					</div>
				</div>
				<label for="aktif">Aktif</label>
				<div class="form-group">
					<input name="aktif" value="N" type="radio" id="radio_9" class="radio-col-red with-gap">
					<label for="radio_9">DISABLED</label>
					<input name="aktif" value="Y" type="radio" id="radio_10" class="radio-col-green with-gap">
					<label for="radio_10">ACTIVE</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link btn-sm btn-rounded waves-effect">SIMPAN</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>