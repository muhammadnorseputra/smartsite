<!-- Modal -->
<?php  
$cookie = get_cookie('cookie_vote');
if(empty($cookie) || $cookie !== '1') {
?>
<div class="modal fade" id="modalVote" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?= form_open(base_url('frontend/v1/saran/votes')); ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Poling</h5>
      </div>
      <div class="modal-body">
        <?php $poling_q = $mf_poling_pertanyaan; ?>
        <label for="q" class="text-light small">Pertanyaan</label>
        <div id="q" class="text-uppercase mb-3 font-weight-bold"><?= $poling_q->label ?> ?</div>
        <label class="text-light small">Pilih jawaban</label>
        <div class="list-group radio-list-group">
          <?php
          $poling_j = $mf_poling_jawaban;
          foreach ($poling_j->result() as $j):
          ?>
          <div class="list-group-item d-flex justify-content-between align-items-center">
            <label>
              <input type="radio" name="vote" value="<?= encrypt_url($j->id_poling) ?>" aria-label="true"> 
              <span class="list-group-item-text font-weight-bold text-dark"><i class="far fa-check-circle mr-3"></i> <?= $j->label ?></span>
            </label>
            <div class="badge badge-info"><?= $j->value ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-block">Vote!</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<?php } ?>