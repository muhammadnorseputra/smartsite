<div class="block-header row m-b-15">
	<div class="col-md-4">
		<h2>
		<i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">layers</i> Halaman
		<small>Buat Halaman Statis</small>

	</h2>
	</div>
	<div class="col-md-8">
		<a href="<?= site_url('backend/module/c_halaman/tambah?module='.$this->madmin->getmodulebycontroller('c_halaman').'&user='.$this->session->userdata('user_access')); ?>" class="btn btn-sm btn-link waves-effect waves-float pull-right"><em class="material-icons font-18 pull-left m-r-5">add</em> Buat halaman </a>
	</div>
</div>

<div class="clearfix">
<?php $this->view('msg/flashdata') ?>

  <div class="card card-shadow">
    <div class="header">
			<div class="row m-b--20">
	            <div class="col-md-5">
	            <?= form_open('backend/module/c_halaman/list_halaman', array('id' => 'FormSearchHalaman')) ?>

	              <label for="">Filter:</label>
	              <div class="input-group">
		                <div class="form-line">
		                    <input type="text" class="form-control" name="search_halaman" id="search" placeholder="Search halaman">
		                </div>
						<div class="input-group-addon">
						<button type="submit" class="btn btn-link m-t--10 m-l-10 btn-circle waves-circle waves-effect waves-ripple waves-deep-purple">
	                	<i class="glyphicon glyphicon-search"></i> 
	                	</button>
						</div>
	                	
	                
	              </div>
	              <?= form_close(); ?>
	            </div>
	            <div class="col-md-7 col-xs-12">
	              
	            </div>
			</div>

      

      <!-- <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4"></div>
      </div> -->

    </div>
    <div class="body" style="padding:0;">
      
    <div class="table-responsive" id="MyHalamanScroll">
      <table class="table table-hover">
        <thead>
          <tr>
              <th width="75%" class="text-center">Title</th>
              <th>File</th>
              <th width="100" class="text-center">Views</th>
              <th width="50">Publish</th>
          </tr>
        </thead>
          <tbody id="MyHalaman"></tbody>
        
      </table>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="edit-halaman" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
		<?= form_open_multipart('backend/module/c_halaman/update', array('id' => 'FormEditHalaman')) ?>
    <input type="hidden" name="idhalaman">
				<div class="modal-content z-depth-5">
						<div class="modal-header">
								<h4 class="modal-title" id="defaultModalLabel"><button type="button" class="close pull-right" data-dismiss="modal"
					 aria-label="Close"><span aria-hidden="true">&times;</span></button> EDIT HALAMAN</h4>
						</div>
						<div class="modal-body border-bottom border-top">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Title</label>
						<div class="form-line">
						  <input type="text" name="title" class="form-control">
						</div>
					  </div>
					  <div class="form-group">
						<label>Publish</label>
						<div class="row">
						  <div class="col-md-12">
							<input name="publish" value="Y" type="radio" id="radio1" class="with-gap radio-col-green">
							<label for="radio1">Ya</label>
			
							<input name="publish" value="N" type="radio" id="radio2" class="with-gap radio-col-red">
							<label for="radio2">Tidak</label>
						  </div>
						</div>
					  </div>
					<span class="btn-view-file d-block"></span>
					<div class="clearfix m-b-10"></div>
					<button type="button" class="btn btn-warning btn-sm btn-hapus-file"> Hapus File</button>
					<button type="button" class="btn btn-primary btn-sm btn-preview-file m-l-5"> Lihat Lampiran</button> 
					  <div class="form-group m-t-10">
					  <label class="label-file"></label>
						  <input type="file" name="inputfile" class="form-control col-teal">
						
					  </div>
					<hr>
					<div class="form-group">
						
						<button type="button" onclick="window.open('<?= base_url("backend/module/c_halaman/openeditor/") ?>' + this.value, '_blank');" class="btn bg-indigo waves-effect btn-block">
							<i class="material-icons">edit</i>
							<span>OPEN EDITOR CONTENT</span>
						</button>
					  </div>
					  
				</div>
			</div>		
						</div>
						<div class="modal-footer">
							<div id="message" class="pull-left m-t-10"></div>
							<button type="submit" class="btn btn-link btn-rounded waves-effect">  Update Halaman</button>
						</div>
				</div>
		<?= form_close(); ?>
		</div>
</div>

<div class="modal fade" id="preview_file" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content z-depth-5">
						<div class="modal-body">
							<iframe id="preview_file_halaman" frameborder="1" width="100%" height="400"></iframe>
						</div>
				</div>
		</div>
</div>