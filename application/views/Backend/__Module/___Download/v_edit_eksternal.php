<div class="row">
	<div class="col-md-6">
		<object type="application/pdf" data=" <?= $formdata[0]->link ?>?#zoom=0&scrollbar=0&toolbar=0&navpanes=0"
			width="100%" height="500"></object>
	</div>
	<div class="col-md-6">
		<form>
			<div class="form-group">
				<label for="judul">Judul</label>
				<input type="text" class="form-control" id="judul" aria-describedby="false"
					placeholder="Judul" value="<?= $formdata[0]->judul ?>">
				<!-- <small id="judul" class="form-text text-muted"></small> -->
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Paste link</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $formdata[0]->link ?></textarea>
      </div>
      <div class="form-group">
        <label for="publish">Publish</label>
        <?php if($formdata[0]->publish == 'Y') { ?>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="publish" id="inlineRadio1" value="Y" checked>
          <label class="form-check-label" for="inlineRadio1">Ya</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="publish" id="inlineRadio2" value="N">
          <label class="form-check-label" for="inlineRadio2">Tidak</label>
        </div>
        <?php } else { ?>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="publish" id="inlineRadio1" value="Y" >
          <label class="form-check-label" for="inlineRadio1">Ya</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="publish" id="inlineRadio2" value="N" checked>
          <label class="form-check-label" for="inlineRadio2">Tidak</label>
        </div>
        <?php } ?>
      </div>
      
      <div class="form-group">
        <label for="publishDate">Dipublish pada</label><br>
        <?= longdate_indo(substr($formdata[0]->tgl_publish,0,10)) ?>
      </div>
		</form>
	</div>
</div>