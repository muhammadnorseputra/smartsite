<div class="block-header row m-b-15">
	<h2>
		<button type="button" id="c_module_add" class="btn btn-sm btn-rounded btn-link pull-right waves-effect waves-white m-t-15 m-r-15"><em class="material-icons font-18 pull-left m-r-5">add</em> Tambah Module</button>

		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">extension</i> Module Web
		<small>#_Module Module</small>
	</h2>
</div>

<div class="clearfix"></div>
<section id="page-loaded"></section>

<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEdit" role="dialog">
	<div class="modal-dialog modal-md modal-vcenter" role="document">
		<div class="modal-content">
			<?= form_open('backend/module/c_module/update', ['id' => 'FormUpdate']) ?>
			<div class="modal-header">
				<h4 class="modal-title" id="smallModalLabel">
					EDIT MODULE
					<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-link waves-effect btn-rounded">Simpan Perubahan</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
