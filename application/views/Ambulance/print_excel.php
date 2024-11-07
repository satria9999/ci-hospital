<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1" width="100%">
<thead>
<tr>
    <th>No</th>
    <th>Nama Lengkap</th>
    <th>NIK</th>
    <th>Jenis Kelamin</th>
    <th>Tempat, Tanggal Lahir</th>
    <th>Agama</th>
    <th>Pendidikan</th>
    <th>Pekerjaan</th>
    <th>Status Perkawinan</th>
    <th>Kewarganegaraan</th>
    <th>Nomor Telepon</th>
</tr>
</thead>
<tbody>
<?php
$no = 0;
foreach ($penduduk as $key) {
    $no++;
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $key->nama; ?></td>
        <td><?php echo number_format($key->nik, 0, ',', ''); ?></td>
        <td><?php echo $key->jenis_kelamin; ?></td>
        <td><?php echo $key->tempat_lahir; ?>, <?php echo $key->tanggal_lahir; ?></td>
        <td><?php echo $key->agama; ?></td>
        <td><?php echo $key->pendidikan; ?></td>
        <td><?php echo $key->pekerjaan; ?></td>
        <td><?php echo $key->status_perkawinan; ?></td>
        <td><?php echo $key->kewarganegaraan; ?></td>
        <td><?php echo number_format($key->nomor_telepon, 0, ',', ''); ?></td>
    </tr>
    <?php
}
?>
</tbody>
</table>