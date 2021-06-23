<section class="survei">
	<div class="py-3 px-2 bg-dark bg-gradient text-center">
		<h3 class="text-light">Pilih Kartu Responden</h3>
	</div>
	<div class="container">
		<div class="row justify-content-md-center my-5 gap-5 text-center">
			<div class="col col-lg-4">
				<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-person-badge text-success" viewBox="0 0 16 16">
					<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
				</svg>
				<h3 class="my-4 fw-bold">ASN Balangan</h3>
				<p class="text-muted">Aparatur Sipil Negara Yang Bekerja Dalam Daerah Kabupaten Balangan </p>
				<a href="<?= base_url('survei?card=asn_balangan') ?>" class="btn btn-success btn-lg px-4 shadow">
					Lanjutkan
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
					</svg>
					</a>
			</div>
			<div class="col col-lg-4">
				<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-person-badge-fill text-secondary" viewBox="0 0 16 16">
					<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
				</svg>
				<h3 class="my-4 fw-bold">NON ASN Balangan</h3>
				<p class="text-muted">Bukan Termasuk Aparatur Sipil Negara Dalam Daerah Kabupaten Balangan</p>
				<a href="<?= base_url('survei?card=non_asn_balangan') ?>" class="btn btn-block btn-secondary btn-lg px-4 shadow">
					Lanjutkan
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
					</svg>
					</a>
			</div>
		</div>
	</div>

</section>