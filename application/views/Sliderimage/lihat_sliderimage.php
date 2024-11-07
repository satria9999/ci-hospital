<!-- ########## START: MAIN PANEL ########## -->
<?= $this->session->flashdata('message'); ?>
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Data Table</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Data Slider Image Rumah Sakit</h5>
        <p>Data-data Slider Image Rumah Sakit</p>
        <br>
        <a href="<?php echo site_url('Dashboard/form_sliderimage'); ?>">
  <button class="btn btn-outline-primary" style="width: 150px; ">
    <i class="fa fa-plus mg-r-10"></i> Tambah Image
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
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($image as $key) {
                    $no++;?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                            <img src="<?php echo base_url($key->image); ?>" alt="Gambar Rumah Sakit" style="max-width: 100px;">
                            
                        </td>
                        <td>
                       
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('Sliderimage/edit_data/'. $key->id_image); ?>"><i class="icon ion-edit"></i> Edit</a>
                                        <button class="dropdown-item deleteButton" data-id="<?php echo $key->id_image; ?>"><i class="icon ion-trash-a"></i> Hapus Data</button>
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
$(document).on('click', '.deleteButton', function() {
    var id_image = $(this).data('id');
    
    // Tampilkan konfirmasi alert menggunakan JavaScript
    var confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');
    
    if (confirmation) {
        // Panggil fungsi untuk menghapus data
        deleteData(id_image);
    }
});

// Fungsi untuk menghapus data setelah konfirmasi
function deleteData(id_image) {
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Sliderimage/aksi_hapus_image/'); ?>' + id_image,
        success: function(response) {
            // Tampilkan pesan sukses (opsional)
            alert('Data berhasil dihapus');
            
            // Muat ulang halaman setelah penghapusan selesai
            location.reload();
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan (opsional)
            console.error(xhr.responseText);
            alert('Terjadi kesalahan saat menghapus data.');
        }
    });
}
</script>    
<!-- ########## END: MAIN PANEL ########## -->
