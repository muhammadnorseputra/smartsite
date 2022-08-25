<div id="stickMe">
<div class="separator">
    <span class="separator-text text-uppercase font-weight-bold"><i class="fas fa-check-circle mr-2"></i> Data Poling</span>
</div>
<div class="border-0 shadow-none p-3 bg-light rounded">
	<?php $poling_q = $mf_poling_pertanyaan; ?>
	<h4 class="text-uppercase font-weight-bold small"><?= $poling_q->label ?> ?</h4>
	<?php  
		$poling_j = $mf_poling_jawaban;
		foreach ($poling_j->result() as $j):
		// var_dump($j);
		$total_vote_peropsi = $j->value;
		$total_seluruh_vote = $this->mf_beranda->total_vote_seluruhopsi();
		$persentase_vote = round(($total_vote_peropsi / $total_seluruh_vote) * 100);
		$arr_color = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger']; //array color
		if($persentase_vote <= '20'):
			$bg = $arr_color['4'];
		elseif(($persentase_vote > '20') && ($persentase_vote <= '40')):
			$bg = $arr_color['3'];
		elseif(($persentase_vote > '40') && ($persentase_vote <= '60')):
			$bg = $arr_color['2'];
		elseif(($persentase_vote > '60') && ($persentase_vote <= '80')):
			$bg = $arr_color['1'];
		elseif(($persentase_vote > '80') && ($persentase_vote <= '100')):
			$bg = $arr_color['0'];
		endif;
	?>
	<div>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" id="poll" role="progressbar" aria-label="<?= $poling_q->label ?>" style="width: <?= $persentase_vote ?>%;" aria-valuenow="<?= $total_vote_peropsi ?>" aria-valuemin="0" aria-valuemax="100"><?= $persentase_vote ?>%</div>
		</div>
		<label for="poll"><?= $j->label ?></label>
	</div>
	<?php endforeach; ?>
	<?php
	$cookie = get_cookie('cookie_vote');  
	if($cookie === '1'):
	?>
	<button type="button" disabled="" class="btn btn-outline-success btn-block text-uppercase"><i class="fas fa-check-circle mr-2"></i> Thank for you vote !</button>
	<p class="text-muted small text-center">Votes hanya dapat dilakukan 1x dalam (60 menit) <br> <b>Total Votes: <?= $total_seluruh_vote ?></b></p>
	<?php else: ?>
	<button type="button" data-toggle="modal" data-target="#modalVote" class="btn btn-primary btn-block text-uppercase"><i class="far fa-check-circle mr-2"></i> ISI POLING</button>
	<?php endif; ?>
</div>
</div>