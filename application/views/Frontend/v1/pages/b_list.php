<h4 class="px-3 py-4 m-0 border-bottom border-light animated fadeIn">List Banner </h4>
<?php  
foreach ($jns_banner as $j) {
?>
  <h4 class="ml-3 mt-3"><?= $j->posisi ?> <a href="<?php echo base_url('frontend/v1/banner/new_banner/'.encrypt_url($j->id_jns_banner)) ?>" class="btn btn-lg btn-primary rounded-lg float-right mr-4"><i class="fas fa-plus"></i></a></h4>  <small class="text-muted ml-3"><?= $j->jenis ?></small> <hr>
  <?php 
  foreach ($this->banner->get_list_banner($j->id_jns_banner) as $b) {
  ?>
  	<table class="table table-borderless table-hover">
  		<tbody>
	  		<tr>
	  			<td width="200"><img src="<?= $b->path ?>" alt="<?= $b->judul ?>" class="w-100"></td>
	  			<td><b><?= $b->judul ?></b> <br> <a target="_blank" href="<?= $b->url ?>"><small class="font-italic"><?= $b->url ?></small></a> <p class="small"><?= !empty($b->keterangan) ? word_limiter($b->keterangan, 10) : "Belum ada keterangan" ?></p></td>
	  			<td width="200">
	  				<div class="d-flex flex-row justify-content-around">
	  					<a href="#" class="btn btn-warning text-center">
	  						<i class="fas fa-edit"></i> <br> Edit
	  					</a>
	  					<a href="#" class="btn btn-danger text-center">
	  						<i class="fas fa-trash"></i> <br> Hapus
	  					</a>
	  				</div>
	  			</td>
	  		</tr>
  		</tbody>
  	</table>
  <?php 
	} 
  ?>
<?php
}
?>