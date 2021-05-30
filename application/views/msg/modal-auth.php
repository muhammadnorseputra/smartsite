<!-- modal notice sigin-->
<div class="modal" id="noticeSigin" tabindex="-1" role="dialog" aria-labelledby="noticeSiginTitle" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content border-0 shadow-lg p-0">
			<div class="modal-header border-light">
				<h6 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-lock"></i> Authentication</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6 p-0 my-auto d-none d-md-block">
							<img src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/undraw_access_account_99n5.svg') ?>" alt="" class="d-block align-middle img-fluid mx-auto my-auto">
						</div>
						<div class="col-md-6">
							<h3>Login dulu ya</h3>
							<p class="text-muted">
								Kamu harus login dahulu sebelum menggunakan fitur :
							</p>
							<ul class="list-unstyled">
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Like or Dislike
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Simpan Postingan
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Membuat Halaman
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Membuat Postingan
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Ikut diskusi publik
								</li>
							</ul>
							<button type="button" class="btn btn-primary btn-block" data-dismiss="modal">OKE</button>
							<p class="d-block mx-auto text-center my-3">
								Belum punya akun? <a href="<?= base_url('daftar') ?>">daftar disini.</a>
							</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>