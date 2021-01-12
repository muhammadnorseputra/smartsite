<div class="block-header row">
	<div class="col-md-6">
		<h2>
			<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">subject</i>
			Submenu
			<small>Submenu - Menu Utama</small>
		</h2>
	</div>

	<div class="col-md-6">
		<div class="input-group">
			<div class='form-line'>
				<input type='text' class='form-control' placeholder='Masukan nama submenu..' id='search' name='search'>
			</div>
			<span class="input-group-addon">
				<button class='btn btn-link btn-sm btn-circle waves-effect m-t--5' type='submit' onclick='cariData()'>
					<i class='glyphicon glyphicon-search'></i>
				</button>
			</span>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalEdit" tabindex="2" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open('backend/module/c_submenu/updatesubmenu', array('id' => 'FormUpdateSubMenu')) ?>
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><em class="material-icons pull-left m-l--5 m-r-10">edit</em> Edit Submenu</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="editidsub" name="editidsub">
				<div class="row clearfix">
					<div class="col-sm-12">
						<label for="editsubmenu">Submenu </label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" id="editsubmenu" name="editsubmenu">
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<label for="editidmainmenu" class="col-sm-2 control-label">Menuutama</label>
					<div class="form-group">
						<div class="col-sm-12">
							<select class="form-control show-tick" id="editidmainmenu" name="editidmainmenu" data-size="6" data-live-search="true">
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix m-t-25">
					<label for="editnamamodule" class="col-sm-2 control-label">Module</label>
					<div class="form-group">
						<div class="col-sm-12">
							<select class="form-control show-tick" id="editnamamodule" name="editnamamodule" data-size="5" data-live-search="true">
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="editlinksub" class="col-sm-2 control-label">Link </label>
						<div class="col-sm-9">
							<div class="form-line">
								<input type="text" class="form-control" id="editlinksub" name="editlinksub">
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="editordersub" class="col-sm-2 control-label">Order </label>
						<div class="col-sm-2">
							<div class="form-line">
								<input type="number" class="form-control" id="editordersub" min="0" max="10" value="1" name="editordersub">
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="editaktifsub" class="col-sm-2 control-label">Aktif </label>
						<div class="col-sm-9">
							<input name="editaktifsub" value="N" type="radio" id="editaktifsub7" class="radio-col-red with-gap">
							<label for="editaktifsub7">DISABLED</label>
							<input name="editaktifsub" value="Y" type="radio" id="editaktifsub8" class="radio-col-green  with-gap">
							<label for="editaktifsub8">ACTIVE</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-rounded waves-effect">UPDATE</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div id="MsgBoxes"></div>
		<div class="card card-shadow m-t-15">
			<div class="header">
				<h2>
					Form Tambah Submenu <small>Add Submenu</small>
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" role="button" data-toggle="collapse" data-target="#FormSubMenu" aria-expanded="false" aria-controls="false">
							<i class="material-icons">keyboard_arrow_down</i>
						</a>
					</li>
				</ul>
			</div>
			<?= form_open('backend/module/c_submenu/savesubmenu', array('class' => 'collapse in', 'id' => 'FormSubMenu')) ?>
			<div class="body body-submenu">
				<label for="submenu"><span class="col-orange">*</span> Mainmenu </label>
				<div class="form-group">
					<select class="form-control show-tick" name="submainmenu" title="Pilih Menuutama" data-size="5" data-live-search="true"></select>
				</div>
				<label for="submenu"><span class="col-orange">*</span> Module </label>
				<div class="form-group">
					<select class="form-control show-tick" title="Pilih module" name="modulesubmenu" data-size="5" data-live-search="true">
					</select>
				</div>
				<label for="submenu">Submenu </label>
				<div class="form-group m-b-10">
					<div class="form-line">
						<input type="text" class="form-control" id="submenu" name="submenu" placeholder="Masukan Judul Submenu">
					</div>
				</div>
				<label for="linksub">Link </label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" class="form-control" id="linksub" name="linksub" placeholder="Masukan Link">
					</div>
				</div>
				<div class="row clearfix">
					<div class="form-group">
						<label for="order" class="col-sm-3 control-label">Order </label>
						<div class="col-sm-4">
							<div class="form-line">
								<input type="number" class="form-control" id="order" min="0" max="10" value="1" name="ordersub">
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix m-t-15">
					<div class="form-group">
						<label for="order" class="col-sm-3 control-label">Aktif </label>
						<div class="col-sm-9">
							<!-- <input name="aktifsub" value="N" type="radio" id="radio_7" class="radio-col-red">
							<label for="radio_7">DISABLED</label>
							<input name="aktifsub" value="Y" type="radio" id="radio_8" class="radio-col-green">
							<label for="radio_8">ACTIVE</label> -->
							<div class="switch">
								<label>
									<input type="hidden" name="aktifsub" value="N" checked>
									<input type="checkbox" name="aktifsub" value="Y"><span class="lever switch-col-indigo"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn waves-effect btn-sm btn-primary pull-right">
					SIMPAN
				</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card m-t-15 card-shadow">
			<div class="header" style="padding-bottom:0;">
				<div class="row">
					<div class="col-md-5">
						<button class="btn btn-link btn-sm waves-effect waves-float m-b-15" name="multipel_hapus" id="multipel_hapus" data-toggle="tooltip" title="Multipel Hapus Data!"><em class="glyphicon glyphicon-trash"></em> Hapus</button>
						<button class="btn btn-link btn-sm waves-effect waves-float m-l-15 m-b-15" onclick='reset()'><i class='glyphicon glyphicon-repeat'></i> Reload</button>
					</div>
					<div class="col-md-7">

					</div>
				</div>
			</div>
			<div class="body" style="padding:0;">
				<div class="table-responsive">
					<table class="table table-hover" id="myTable">
						<thead>
							<tr>
								<th width="25"></th>
								<th width="20">No</th>
								<th width="20">#</th>
								<th width="150">Nama Submenu</th>
								<th>Link</th>
								<th width="50">Aktif</th>
								<th width="130">Aksi</th>
							</tr>
						</thead>
						<tbody id="myData"></tbody>
					</table>
					<div class="m-t--10 p-l-10 p-r-10">
						<a class="waves-effect pull-left m-t-30 m-b-5 m-r-10" onclick="loadData(1)" data-toggle="tooltip" title="Reload"><em class="glyphicon glyphicon-repeat"></em></a>
						<span class="text-default font-12 pull-left m-t-30">Total Data: <b id="per"></b> dari <b id="total" class="badge m-t--1"></b> baris</span>
						<nav class="pull-right" id="pagging"></nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
