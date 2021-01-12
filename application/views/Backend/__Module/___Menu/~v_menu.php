<!--############# MODAL EDIT LABEL ####################################################### -->
<div class="modal fade" id="ModalEdit" tabindex="2" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<?= form_open('backend/module/c_menuutama/updatelabel', array('id' => 'FormUpdateLabelMenu')) ?>
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal"
					 aria-label="Close"><span aria-hidden="true">&times;</span></button> EDIT LABEL</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="editidlabel" id="editidlabel">
				<label for="editnamalabel">Label</label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="editnamalabel" name="editnamalabel" class="form-control" placeholder="Nama Label Menus">
					</div>
				</div>

				<div class="col-md-12 row clearfix">

					<div class="col-md-6 row clearfix">
						<label for="editorderlabel" class="control-label">Order </label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" min-length="1" max-length="10" id="editorderlabel" name="editorderlabel" class="form-control"
								 placeholder="Urutan">
							</div>
						</div>
					</div>

					<div class="col-md-6 m-l-10 row clearfix">
						<label for="editaktiflabel" class="control-label">Aktif </label>
						<br>
						<input name="editaktiflabel" value="N" type="radio" id="radio_01" class="radio-col-red">
						<label for="radio_01">DISABLED</label>

						<input name="editaktiflabel" value="Y" type="radio" id="radio_02" class="radio-col-green">
						<label for="radio_02">ACTIVE</label>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link waves-effect"> <em class="glyphicon glyphicon-ok"></em> SIMPAN</button>
			</div>

			<?= form_close() ?>
		</div>

	</div>
</div>

<!--############# MODAL REFERENSI ICON ####################################################### -->
<div class="modal fade" id="ModalRefIcon" tabindex="1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-col-light">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal"
					 aria-label="Close"><span aria-hidden="true">&times;</span></button> REFERENSI ICON</h4>
			</div>

			<div class="modal-body" id="loadIconData">

				<!-- <div class="card">
					<div class="body" id="loadIconData"> -->
				<div id="loadIcon"></div>
				<!-- </div>
				</div> -->

			</div>
			<div class="modal-footer">
				<?= form_open('backend/module/c_menuutama/saveicon', array('class' => 'form-horizontal', 'id' => 'FormIcon')) ?>
				<div class="row clearfix m-t-10">
					<div class="form-group">
						<label for="namaicon" class="col-sm-2 control-label">Nama Icon </label>
						<div class="col-sm-5">
							<div class="form-line">
								<input type="text" class="form-control" name="namaicon" placeholder="Masukan nama icon disini...">
							</div>

							<div class="MsgErrorJs m-t-5"></div>
						</div>
						<button type="submit" class="btn waves-effect btn-link pull-left">
							SIMPAN</button>
					</div>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>

<div class="block-header">
	<h2>
		<!-- <button type="button" class="btn btn-link btn-sm waves-effect pull-right m-l-10" data-toggle="popover" data-placement="left"
		 data-html="true" title="Live Pencarian" data-content="
                    <div class='form-line'>
						<input type='text' class='form-control' id='search' name='search' placeholder='Masukan Namamenu..'> 

                        <button class='btn btn-sm btn-danger m-t-5 waves-effect' type='submit'  onclick='cariData()'>
                            Cari
                        </button>

                        <button class='btn btn-xs btn-link m-t-5 waves-effect' onclick='reset()'>
                            <i class='material-icons'>loop</i>
                        </button>
					</div>">
			<em class="glyphicon glyphicon-search"></em>
		</button> -->

		<button class="btn btn-link btn-sm waves-effect pull-right m-l-10" data-toggle="collapse" data-target="#collapseExample"
		 aria-expanded="true" aria-controls="collapseExample"><em class="glyphicon glyphicon-pushpin m-r-1"></em> Label</button>

		<button class="btn btn-link btn-sm waves-effect pull-right m-l-10" data-toggle="modal" data-target="#ModalRefIcon"
		 aria-expanded="true" aria-controls="ModalRefIcon"><em class="glyphicon glyphicon-leaf m-r-1"></em> Referensi Icon</button>

		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">menu</i> Menu Utama
		<small>Menu navigasi menggunakan icon dari material design google</small>
	</h2>
</div>

<div class="collapse m-b-10" id="collapseExample" aria-expanded="true">
	<div class="well">
		<div class="row">
			<div class="col-md-4">
				<ul class="list-group m-b-0" id="listlabel" style="height:200px; overflow-y: scroll; overflow-x: hidden;"></ul>
			</div>
			<div class="col-md-6">
				<?= form_open('backend/module/c_menuutama/savelabelmenu', array('class' => 'form_horizontal', 'id' => 'FormLabelMenu')) ?>

				<label for="namalabel">LABEL</label>
				<div class="form-group">
					<input type="text" id="namalabel" name="namalabel" class="form-control no-line" placeholder="Nama Label Menus"
					 style="padding-left:10px;">
				</div>

				<div class="col-md-12 row clearfix">

					<div class="col-md-4 row clearfix">
						<label for="orderlabel" class="control-label">ORDER </label>
						<div class="form-group">
							<input type="number" min-length="1" max-length="10" id="orderlabel" name="orderlabel" class="form-control"
							 placeholder="Urutan Label" style="padding-left:10px;" value="1">

						</div>
					</div>

					<div class="col-md-6 m-l-10 row clearfix">
						<label for="aktiflabel" class="control-label">AKTIF </label>
						<br>
						<input name="aktiflabel" value="N" type="radio" id="radio_9" class="radio-col-red">
						<label for="radio_9">DISABLED</label>

						<input name="aktiflabel" value="Y" type="radio" id="radio_10" class="radio-col-green">
						<label for="radio_10">ACTIVE</label>
					</div>
				</div>

				<button type="submit" class="btn waves-effect btn-sm btn-link bg-yellow">
					<em class="glyphicon glyphicon-ok"></em> SIMPAN</button>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="card">
	<div class="header">
		<div class="row">
			<div class="col-md-7">

			<button class="btn btn-link btn-sm waves-effect" name="multipel_hapus" id="multipel_hapus"
		 data-toggle="tooltip" title="MULTI HAPUS"><em class="glyphicon glyphicon-trash"></em> Hapus</button>

			<button type="button" class="btn btn-primary btn-sm waves-effect" data-toggle="modal" data-target="#AddMenu"><em
				class="glyphicon glyphicon-plus"></em> Tambah Menu</button>
			</div>

			<div class="col-md-5 col-sm-4">
				<div class="row m-b--20">
						<div class="form-group">
							<label for="search" class="col-sm-1 m-t-10 control-label"><em class="glyphicon glyphicon-search"></em></label>
							<div class="col-sm-9">
							<div class="form-line">
									<input type="text" class="form-control" name="search" id="search" placeholder="Search Menu Utama...">
							</div>
							</div>
							<button type="submit" onclick="cariData()" class="btn waves-effect btn-sm btn-warning">
								Cari</button>
						</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="body">
		<div class="table-responsive">
			<table class="table table-hover table-condensed" id="myTable">
				<thead class="bg-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">
					<tr>
						<th width="25"></th>
						<th width="20">No</th>
						<th width="20">#</th>
						<th width="150">Label</th>
						<th width="20">Icon</th>
						<th>Menu</th>
						<th>Link</th>
						<th width="100">Status</th>
						<th>Module</th>
						<th width="50">Aktif</th>
						<th width="130">Aksi</th>
					</tr>
				</thead>
				<tbody id="myData"></tbody>

			</table>

		</div>
	</div>

	<div class="card-footer">

<div>
		<a class="waves-effect pull-left m-r-10 m-t-30 m-l-10" onclick="listmenu(1)" data-toggle="tooltip" title="Reload"><em
			 class="glyphicon glyphicon-repeat"></em></a>
		<span class="text-default font-12 pull-left m-t-30 m-l-10">Total Data: <b id="per"></b> from <b id="total" class="badge m-t--1"></b>
			rows</span>
		<nav class="pull-right" id="pagging"></nav>
	</div>		
</div>	
</div>

<!-- #END# Basic Examples -->
<div class="modal fade" id="EditMenu" role="dialog">

	<div class="modal-dialog" role="document">
		<div class="modal-content modal-col-light ">
			<?= form_open('backend/module/c_menuutama/updatemenuutama', array('id' => 'FormUpdateMenuUtama')) ?>
			<input type="hidden" name="idmenu_e">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal"
					 aria-label="Close"><span aria-hidden="true">&times;</span></button>Edit Menu</h4>

			</div>

			<div class="modal-body">

				<div class="row clearfix">
					<label for="labelmenu_e" class="col-sm-12 control-label">Label </label>
					<div class="form-group">
						<div class="col-sm-12">
							<select name="labelmenu_e" id="labelmenu_e" class="form-control" data-width="100%"></select>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<label for="namamenu_e" class="col-sm-12 control-label">Nama Menu </label>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="form-line">
								<input type="text" class="form-control" id="namamenu_e" name="namamenu_e">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<div class="col-sm-12">
						<label for="stsmenu" class="control-label">Meta </label>
					</div>
					<div class="form-group">
						<div class="col-sm-5 m-t-5">
							<input name="stsmenu" value="FRONTEND" type="radio" id="radio_sts30_e" class="with-gap radio-col-cyan" />
							<label for="radio_sts30_e">FRONTEND</label>
							<input name="stsmenu" value="BACKEND" type="radio" id="radio_sts31_e" class="with-gap radio-col-pink" />
							<label for="radio_sts31_e">BACKEND</label>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="linkmenu_p_e" class="col-sm-4 control-label">Link Utama </label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="form-line">
									<input type="text" class="form-control" id="linkmenu_e" name="linkmenu_e">
								</div>
								<span class="input-group-addon">
									<input type="checkbox" id="md_checkbox_sub_e" class="filled-in chk-col-red">
									<label for="md_checkbox_sub_e">Sub</label>
								</span>
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="form-group">
						<label for="icon_e" class="col-sm-12 control-label">Icon </label>
						<div class="col-sm-5">
							<select class="bootstrap-select form-control" data-width="100%" onchange="showicon_edit(this.value)" name="iconmenu_e"
							 id="iconmenu_e">
							</select>
						</div>
						<label for="order_e" class="col-sm-3 control-label">
							<span id="showicon_e" class="m-l--10 m-t-5 m-r-10"></span>Order </label>
						<div class="col-sm-3">
							<div class="form-line">
								<input type="number" class="form-control" min="0" max="10" value="1" name="ordermenu_e" id="order_e">
							</div>
						</div>
					</div>

				</div>

				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="radio_7_e" class="col-sm-12 control-label">Aktif </label>
						<div class="col-sm-5 m-t-5">
							<input name="aktifmenu" value="N" type="radio" id="radio_7_e" class="radio-col-red">
							<label for="radio_7_e">DISABLED</label>

							<input name="aktifmenu" value="Y" type="radio" id="radio_8_e" class="radio-col-green">
							<label for="radio_8_e">ACTIVE</label>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link waves-effect pull-right"> UPDATE </button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<div class="modal fade" id="AddMenu" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-col-light">

			<?= form_open('backend/module/c_menuutama/savemenuutama', array('class' => 'form-horizontal', 'id' => 'FormMenuUtama')) ?>
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal"
					 aria-label="Close"><span aria-hidden="true">&times;</span></button> Menu Utama</h4>

			</div>
			<div class="modal-body">

				<div id="Message"></div>

				<div class="row clearfix m-t-10">
					<div class="form-group">
						<label for="pilihlabel" class="col-sm-3 control-label">Label </label>
						<div class="col-md-9">
							<select name="labelmenu" id="pilihlabel"></select>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="namamenu" class="col-sm-3 control-label">Nama Menu </label>
						<div class="col-sm-9">
							<div class="form-line">
								<input type="text" class="form-control" id="namamenu" name="namamenu">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="stsmenu" class="col-sm-3 control-label">Meta </label>
						<div class="col-sm-5 m-t-5">
							<input name="stsmenu" value="FRONTEND" type="radio" id="radio_sts30" class="with-gap radio-col-cyan" />
							<label for="radio_sts30">FRONTEND</label>
							<input name="stsmenu" value="BACKEND" type="radio" id="radio_sts31" class="with-gap radio-col-pink" />
							<label for="radio_sts31">BACKEND</label>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-10">
					<div class="form-group">
						<label for="linkmenu_p" class="col-sm-3 control-label">Link Utama </label>
						<div class="col-sm-2">
							<div class="form-line">
								<input type="text" class="form-control" id="linkmenu_p" name="linkmenu_p" readonly>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">link</i>
								</span>
								<div class="form-line">
									<input type="text" class="form-control" id="linkmenu" name="linkmenu">
								</div>
								<span class="input-group-addon">
									<input type="checkbox" id="md_checkbox_sub" class="filled-in chk-col-red">
									<label for="md_checkbox_sub">Sub</label>
								</span>
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-10">
					<div class="form-group">
						<label for="icon" class="col-sm-3 control-label">Icon</label>
						<div class="col-sm-8">
							<select onchange="showicon(this.value)" name="iconmenu" id="iconmenu"></select>
						</div>
						<div id="showicon"></div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="order" class="col-sm-3 control-label">Order </label>
						<div class="col-sm-2">
							<div class="form-line">
								<input type="number" class="form-control" id="order" min="0" max="10" value="1" name="ordermenu">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix m-t-25">
					<div class="form-group">
						<label for="order" class="col-sm-3 control-label">Aktif </label>
						<div class="col-sm-5 m-t-5">
							<input name="aktifmenu" value="N" type="radio" id="radio_7" class="radio-col-red">
							<label for="radio_7">DISABLED</label>

							<input name="aktifmenu" value="Y" type="radio" id="radio_8" class="radio-col-green">
							<label for="radio_8">ACTIVE</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link waves-effect btn-sm pull-right"><em class="glyphicon glyphicon-ok"></em>
					SIMPAN</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>