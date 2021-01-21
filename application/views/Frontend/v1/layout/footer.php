<section class="bg-white mt-4">
	<div class="container-fluid">
		<div class="row border-top">
			<div class="col-md-12">
				<div class="d-block p-4">
					<div class="container text-center w-50">
						<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="140"/>'; ?>
						<br>
						<div class="text-muted mt-3">&copy; <?php echo date('Y') ?> Bkppd kab. Balangan</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- jQuery -->
<script src="<?= base_url('template/v1/prod/vendor-min.js'); ?>"></script>
<script src="<?= base_url('template/v1/prod/app-min.js'); ?>"></script>

</body>

</html>