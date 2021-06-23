<footer class="bg-light">
	<div class="container border-top">
		<div class="row">
			<p class="text-center text-muted py-4">
				&copy; <?= date('Y') ?> Survei IKM BKPPD Kab. Balangan
			</p>
		</div>
	</div>
</footer>
<a href="#top" id="btn-top" class="btn btn-lg btn-danger rounded">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
</svg>
</a>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/skm.js') ?>"></script>
<?php if($this->uri->segment(1) === 'survei'): ?>
<script src="<?= base_url('bower_components/jquery-form-validator/form-validator/jquery.form-validator.min.js') ?>"></script>
<script src="<?= base_url('assets/js/skm_validation_non_asn.js') ?>"></script>
<?php endif; ?>
</body>
</html>