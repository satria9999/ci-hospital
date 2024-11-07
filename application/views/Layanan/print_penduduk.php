<style>
.line-title{
border: 1;
border-style: inset;
border-top: 1px solid #0000;
}
</style>
<head>
<title><?php echo $title; ?></title>
</head>
<link href="<?php echo base_url();?>assets/img/logo.jpg" rel="icon" />
    <link href="<?php echo base_url();?>assets/img/logo.jpg" rel="apple-touch-icon" />
<div class="container-fluid">
<img height="70" width="60" src="<?php echo base_url(); ?>assets/img/logo.jpg">
<hr class="line-title">
<!-- Page Heading -->
<h3 class="h3 mb-2 text-gray-800">Table Data penduduk</h3>
<p class="mb-4">Pada tabel ini di tampilkan

data Penduduk yang berada di Desa Sukaluyu</p>

<!-- DataTables -->
<div class="card mb-3">
<div class="card-body">
<div class="table-responsive">

<table border="1" class="table table-hover" id="dataTable" width="100%" cellspacing="0">

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
                    $no++;?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->nama; ?></td>
                        <td><?php echo $key->nik; ?></td>
                        <td><?php echo $key->jenis_kelamin; ?></td>
                        <td><?php echo $key->tempat_lahir; ?>, <?php echo $key->tanggal_lahir; ?></td>
                        <td><?php echo $key->agama; ?></td>
                        <td><?php echo $key->pendidikan; ?></td>
                        <td><?php echo $key->pekerjaan; ?></td>
                        <td><?php echo $key->status_perkawinan; ?></td>
                        <td><?php echo $key->kewarganegaraan; ?></td>
                        <td><?php echo $key->nomor_telepon; ?></td>
                    </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>