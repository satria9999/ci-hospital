<!-- ########## START: MAIN PANEL ########## -->
<?= $this->session->flashdata('message'); ?>
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Data Table</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Data Dokter</h5>
        <p>Data-data Dokter</p>
        <br>
        <a href="<?php echo site_url('Dashboard/form_dokter'); ?>">
  <button class="btn btn-outline-primary" style="width: 140px; ">
    <i class="fa fa-plus mg-r-10"></i> Tambah Dokter
  </button></a>
        <!-- <a href="<?php echo site_url('Rumah_Sakit/export_pdf'); ?>">
  <button class="btn btn-outline-success" style="width: 120px; ">
    <i class="fa fa-download mg-r-10"></i> PDF
  </button></a>
  <a href="<?php echo site_url('Rumah_Sakit/export_excelall'); ?>" <button class="btn btn-outline-success" style="width: 120px; ">
    <i class="fa fa-download mg-r-10"></i> EXCEL
  </button>
</a> -->

    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Tabel Rumah Sakit</h6>
        <p class="mg-b-20 mg-sm-b-30">Data Rumah Sakit</p>
        <div class="table-container" style="overflow-x: auto;">
        <table id="table" class="table table-striped table-bordered" style="font-size: 90%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomer Regsistrasi Dokter</th>
                    <th>Nama Dokter</th>
                    <th>Spesialis</th>
                    <th>gender</th>
                    <th>Praktek</th>
                    <th>Bertugas di</th>
                    <th>Lokasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($dokter as $key) {
                    $no++;?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->nomer_dokter; ?></td>
                        <td><?php echo $key->nama_dokter; ?></td>
                        <td><?php echo $key->spesialis; ?></td>
                        <td><?php echo $key->gender; ?></td>
                        <td><?php echo date('H:i', strtotime($key->waktu_mulai)); ?> - <?php echo date('H:i', strtotime($key->waktu_selesai)); ?></td>
                        <td><?php echo $key->nama_rumahsakit; ?></td>
                        <td><?php echo $key->lokasi; ?></td>
                        <td>
                       
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('Dokter/edit_data/'. $key->nomer_dokter); ?>"><i class="icon ion-edit"></i> Edit</a>
                                        <button class="dropdown-item deleteButton" data-id="<?php echo $key->nomer_dokter; ?>"> <i class="icon ion-trash-a"></i> Hapus Data</button>
                                    </div>
                                </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div><!-- table-container -->
    </div><!-- card -->
</div><!-- card -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#table').DataTable({
            
        });
    } );
</script>
<script>
    // Tambahkan script AJAX untuk menampilkan konfirmasi
    $(document).on('click', '.deleteButton', function() {
    var nomer_dokter = $(this).data('id');

    // Tampilkan konfirmasi alert menggunakan JavaScript
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Dokter/delete/'); ?>' + nomer_dokter,
        dataType: 'json',
        success: function(response) {
            if (confirm(response.message)) {
                // Jika dikonfirmasi, panggil fungsi untuk menghapus data
                deleteData(nomer_dokter);
            }
        }
    });
});

    // Fungsi untuk menghapus data setelah konfirmasi
    function deleteData(nomer_dokter) {
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Dokter/aksi_hapus_dokter/'); ?>' + nomer_dokter,
        success: function() {
            alert('Data Dokter Berhasil Dihapus');
            // Lakukan apa pun setelah data dihapus
            location.reload();
        }
    });
}

</script>
    
<!-- ########## END: MAIN PANEL ########## -->
