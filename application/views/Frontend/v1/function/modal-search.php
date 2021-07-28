<!-- Modal Search -->
<div class="modal bd-example-modal-lg" id="mpostseacrh" tabindex="-1" role="dialog" aria-labelledby="mpostseacrhLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content border-0 shadow-lg">
			<div class="modal-body">
				<?= form_open(base_url('frontend/v1/post/search'), ['id' => 'form_post_search','class' => 'form-inline']); ?>
				<div class="input-group mx-auto w-100">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-search"></i></div>
					</div>
					<input type="text" name="q" class="form-control form-control-lg" id="search" placeholder="Masukan kata kunci, lalu tekan enter atau cari">
					<div class="input-group-append">
					<button type="submit" class="btn btn-outline-info">Cari</button>
					</div>
				</div>
				<?= form_close() ?>
				<hr>
				<div id="recent-words"></div>
				<div id="search-result" style="max-height:450px; overflow-y: auto; overflow-x:hidden;">
		            	<div class="pl-3 pl-md-0 rounded d-flex justify-content-around align-items-center">
		            		<div class="d-none d-md-block">
		            			<i class="fas fa-search fa-2x"></i>
		            		</div>
		            		<div class="py-3">
								<h5>Silahkan masukan katakunci !</h5>
				            	<p class="text-muted pl-3 border-left border-warning">
				            		Silahkan masukan keywords pencarian, dengan memasukan judul atau label
				            	</p>
		            		</div>
		            	</div>
				</div>
			</div>
		</div>
	</div>
</div>