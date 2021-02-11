<section class="mt-4 bg-white">
	<div class="container">
		<div class="row text-center py-3">
			<div class="col-md-8 d-flex align-items-center justify-content-start">
				<div class="text-center">
					<div class="text-muted small">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="text-center text-md-right">
					<a target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
						<i class="fab fa-facebook"></i>
					</a>
					<a target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Me On Instagram" data-username="<?= $mf_beranda->ig; ?>">
						<i class="fab fa-instagram"></i>
					</a>
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