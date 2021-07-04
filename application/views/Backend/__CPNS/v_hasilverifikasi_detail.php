<table class="table table-responsive">
<thead>
    <tr>
        <th colspan="2">
            Cek data dibawah apakah sudah sesuai dengan data pada excel.
        </th>
    </tr>
</thead>
<tbody>
    <tr>
        <td width="250">NIK</td>
        <td><?= $fromdata[0]->nik; ?></td>
    </tr>
    <tr>
        <td width="250">No. Register</td>
        <td><?= $fromdata[0]->noregister != '' ? $fromdata[0]->noregister : '-'; ?></td>
    </tr>
    <tr>
        <td width="250">No. Peserta</td>
        <td><?= $fromdata[0]->nopeserta != '' ? $fromdata[0]->nopeserta : '-'; ?></td>
    </tr>
    <tr>
        <td width="250">Nama Lengkap</td>
        <td><b><?= $fromdata[0]->nama; ?></b></td>
    </tr>
    <tr>
        <td width="250">Jenis Kelamin</td>
        <td><b><?= $fromdata[0]->jnskel; ?></b></td>
    </tr>
    <tr>
        <td width="250">Penempatan</td>
        <td><b><?= $fromdata[0]->penempatan; ?></b></td>
    </tr>
    <tr>
        <td width="250">Jabatan</td>
        <td><b><?= $fromdata[0]->jabatan; ?></b></td>
    </tr>
    <tr>
        <td width="250">Pendidikan Terakhir</td>
        <td><b><?= $fromdata[0]->pendidikan; ?></b></td>
    </tr>
    <tr>
        <td width="250">Jenis Formasi</td>
        <td><b><?= $fromdata[0]->jenisformasi; ?></b></td>
    </tr>
    <tr>
        <td width="250">Status Verifikasi</td>
        <td class="col-black" bgcolor="<?= $fromdata[0]->statusverifikasi == 'Lulus Verifikasi' ? 'lightgreen' : 'red'; ?>"><b><h4><?= $fromdata[0]->statusverifikasi; ?></h4></b></td>
    </tr>
    <tr>
        <td width="250">Alasan Verifikasi</td>
        <td><b><?= $fromdata[0]->alasanverifikasi; ?></b></td>
    </tr>
</tbody>
</table>

<table class="table table-responsive">
<thead>
    <tr>
        <th colspan="2">
            Informasi Verifikator
        </th>
    </tr>
</thead>
<tbody>
    <tr>
        <td width="150">NIP</td>
        <td></td>
    </tr>
    <tr>
        <td width="150">Nama</td>
        <td></td>
    </tr>
    <tr>
        <td width="150">Tanggal diverifikasi</td>
        <td></td>
    </tr>

</tbody>
</table>
