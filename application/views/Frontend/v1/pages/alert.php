<section class="hero py-5">
	<div class="container py-5">
		<div class="col-md-4 offset-md-4 py-3 d-flex justify-content-center align-items-center">
			<div class="font-weight-bold text-center">
				<i class="fas fa-check-circle text-success fa-5x mb-3"></i>
				<h4 class="text-muted">Deleted</h4>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
	<div class="container">
		<div class="col-md-4 offset-md-4 bg-white rounded p-4">		
			<?php $this->load->view('msg/flashdata'); ?> <br>
			<button onclick="window.history.back(-1)" class="btn btn-danger"> Kembali <i class="fas fa-arrow-right"></i></button>
		</div>
	</div>
</section>