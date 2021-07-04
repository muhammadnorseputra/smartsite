<div class="block-header row">
  <h2>
    <i class="material-icons pull-left m-b-5 m-r-5 font-40 col-<?= $this->madmin->aktifskin('t_skin','Y'); ?>">code</i> Referensi Icons
		<small>Jenis Referensi Icon dari Material Icons Google</small>
	</h2> 
</div>

<div class="clearfix">

  <div class="card card-border">
    <div class="header">
  <div class="row clearfix">
    <div class="col-md-8">
    <?= form_open('backend/module/c_icons/saveicon', array('class' => 'form-horizontal', 'id' => 'FormIcon')) ?>
    <div class="form-group">
      <label for="namaicon" class="col-sm-2 control-label pull-left" id="review-icon"><em class="glyphicon glyphicon-plus"></em></label>
      <div class="col-sm-8">
          <div class="form-line">
          <input type="text" class="form-control" name="namaicon" placeholder="Masukan nama icon dari materialize...">
          </div>
      </div>
      <button type="submit" class="btn btn-sm waves-effect waves-float btn-link p-t-10 p-b-10">
        Simpan <em class="glyphicon glyphicon-send"></em></button>
    </div>
  <?= form_close() ?>   
    
    </div>
    <div class="col-md-4">
      <div class="row">
        <?= form_open('backend/module/c_icons/search', array('class' => 'form-horizontal', 'id' => 'FormIcon')) ?>
        <div class="form-group">
          <label for="kataicon" class="col-sm-2 control-label"><em class="glyphicon glyphicon-search"></em></label>
          <div class="col-sm-8">
          <div class="form-line">
              <input type="text" class="form-control" name="kataicon" placeholder="Search disini...">
          </div>
          </div>
          <!-- <button type="submit" class="btn waves-effect btn-sm btn-link">
            Cari</button> -->
        </div>
      <?= form_close() ?>
      </div>     
    </div>
  
    
  </div> 

    </div>
    <div class="body" id="IconReferensi">
      <div id="IconReferensi"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
