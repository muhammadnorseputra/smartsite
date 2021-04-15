<section class="hero py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12 py-5 text-primary text-center">
				<i class="fas fa-user-circle fa-4x my-3">	</i>
				<h1>Profile Pegawai</h1>
			</div>
		</div>
	</div>
</section>
<?php 
	$response = api_curl_get('silka.bkppd-balangankab.info/api/detail_pns/?nip='.$data['nip']);
	$r = json_decode($response);
	if(empty($data['nip']) || count($r) === 0) redirect('errors/html/error_404','refresh');
?>
<section class="mb-5 mt--8">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card pt-3 px-3 border-0 bg-white">
					<div class="alert alert-warning">
						<span class="font-weight-nomal"><i class="fa fa-info-circle mr-2"></i> Data ini ditampilkan secara realtime, berdasarkan pada aplikasi SILKa (Sistem Informasi Layanan Kepegawian) Kabupaten Balangan.</span>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td width="140" rowspan="13">
					<img class="img-thumbnail img-fluid d-none d-md-block" src="http://silka.bkppd-balangankab.info/photo/<?= $r[0]->nip ?>.jpg" alt="<?= $r[0]->nip ?>">									
								</td>
							</tr>
							<tr class="font-weight-bold">
								<td colspan="3">Informasi Pribadi</td>
							</tr>
							<tr>
								<td>NIP</td>
								<td width="20">:</td>
								<td><?= $r[0]->nip ?></td>
							</tr>
							
							<tr>
								<td>Nama Lengkap</td>
								<td width="20">:</td>
								<td><?= $r[0]->nama ?></td>
							</tr>
							<tr>
								<td>TTL</td>
								<td width="20">:</td>
								<td><?= $r[0]->ttl ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td width="20">:</td>
								<td><?= $r[0]->jenkel ?></td>
							</tr>
							<tr>
								<td>Agama</td>
								<td width="20">:</td>
								<td><?= $r[0]->agama ?></td>
							</tr>
							<tr>
								<td>Status Kawin</td>
								<td width="20">:</td>
								<td><?= $r[0]->statkaw ?></td>
							</tr>
							<tr class="font-weight-bold">
								<td colspan="3">Informasi Kepegawaian</td>
							</tr>
							<tr>
								<td>Pangkat (Golru)</td>
								<td width="20">:</td>
								<td><?= $r[0]->golru ?></td>
							</tr>
							<tr>
								<td>Unit Kerja</td>
								<td width="20">:</td>
								<td><?= $r[0]->unker ?></td>
							</tr>
							<tr>
								<td>Jabatan</td>
								<td width="20">:</td>
								<td><?= $r[0]->jab ?></td>
							</tr>
							<tr>
								<td>Pendidikan Terakhir</td>
								<td width="20">:</td>
								<td><?= $r[0]->pdk ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<?php //var_dump(json_decode($response)); ?>