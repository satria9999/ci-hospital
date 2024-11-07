<!-- ########## START: MAIN PANEL ########## -->
<?= $this->session->flashdata('message'); ?>
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Data Table</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Data Layanan Spesialis Rumah Sakit</h5>
        <p>Data-data Layanan Spesialis Rumah Sakit</p>
        <br>
        <a href="<?php echo site_url('Dashboard/form_layanan'); ?>">
  <button class="btn btn-outline-primary" style="width: 150px; ">
    <i class="fa fa-plus mg-r-10"></i> Tambah Layanan
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
        <h6 class="card-body-title">Tabel Layanan Spesialis Rumah Sakit</h6>
        <p class="mg-b-20 mg-sm-b-30">Data Layanan Spesialis Rumah Sakit</p>
        <div class="table-container" style="overflow-x: auto;">
        <table id="table" class="table table-striped table-bordered" style="font-size: 90%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Layanan</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Lokasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($jantung as $key) {
                    $no++;?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->nama_layanan; ?></td>
                        <td><?php echo $key->nama_rumahsakit; ?></td>
                        <td><?php echo $key->lokasi; ?></td>
                        <td>
                       
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('Layanan/edit_jantung/'. $key->id_layanan); ?>"><i class="icon ion-edit"></i> Edit</a>
                                        <button class="dropdown-item deleteButton" data-id="<?php echo $key->id_layanan; ?>"> <i class="icon ion-trash-a"></i> Hapus Data</button>
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
    var id_layanan = $(this).data('id');

    // Tampilkan konfirmasi alert menggunakan JavaScript
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Layanan/delete/'); ?>' + id_layanan,
        dataType: 'json',
        success: function(response) {
            if (confirm(response.message)) {
                // Jika dikonfirmasi, panggil fungsi untuk menghapus data
                deleteData(id_layanan);
            }
        }
    });
});

    // Fungsi untuk menghapus data setelah konfirmasi
    function deleteData(id_layanan) {
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Layanan/aksi_hapus_layanan/'); ?>' + id_layanan,
        success: function() {
            alert('Data Layanan Berhasil Dihapus');
            // Lakukan apa pun setelah data dihapus
            location.reload();
        }
    });
}

</script>
<!-- ########## END: MAIN PANEL ########## -->