<!-- Modal Search -->
<div class="modal fade" id="mpostseacrh" tabindex="-1" role="dialog" aria-labelledby="mpostseacrhLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content border-0">
			<div class="modal-header">
		        <h5 class="modal-title" id="staticBackdropLabel">Cari Apa Disini?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			<div class="modal-body pt-0">
				<?= form_open(base_url('frontend/v1/post/search'), ['id' => 'form_post_search','class' => 'sticky-top border-bottom py-3 bg-white pr-0 mr-0']); ?>
				<div class="input-group mx-auto w-100">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-search"></i></div>
					</div>
					<input type="text" name="q" class="form-control shadow-none" id="search" placeholder="Keywords...">
					<div class="input-group-append">
					<button type="submit" class="btn btn-outline-light">Cari</button>
					</div>
				</div>
				<?= form_close() ?>
				<div id="search-result">
            		<div class="py-3 text-center">
						<h6>Silahkan masukan katakunci !</h6>
		            	<p class="text-muted small">
		            		Silahkan masukan keywords pencarian, dengan memasukan judul atau label
		            	</p>
            		</div>
				</div>
			</div>
		</div>
	</div>
</div>