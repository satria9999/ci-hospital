<!-- ########## START: MAIN PANEL ########## -->
<?= $this->session->flashdata('message'); ?>
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Data Table</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Data Ambulance Rumah Sakit</h5>
        <p>Data-data Ambulance Rumah Sakit</p>
        <br>
        <a href="<?php echo site_url('Dashboard/form_ambulance'); ?>">
  <button class="btn btn-outline-primary" style="width: 170px; ">
    <i class="fa fa-plus mg-r-10"></i> Tambah Ambulance
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
        <h6 class="card-body-title">Tabel Ambulance Rumah Sakit</h6>
        <p class="mg-b-20 mg-sm-b-30">Data Ambulance Rumah Sakit</p>
        <div class="table-container" style="overflow-x: auto;">
        <table id="table" class="table table-striped table-bordered" style="font-size: 90%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Nomor Telepon</th>
                    <th>Hotline</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($ambulance as $key) {
                    $no++;?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->nama_rumahsakit;  ?></td>
                        <td><?php echo $key->nomor_telepon; ?></td>
                        <td>
                        <!-- <?php 
                            $button_class = ($key->hotline == 1) ? 'btn-success' : 'btn-danger'; 
                            $status_text = ($key->hotline == 1) ? 'Tersedia' : 'Tidak Tersedia'; 
                        ?> -->
                        <button class="btn btn-sm status-toggle <?php echo $button_class; ?>" data-id="<?php echo $key->id_ambulance; ?>" data-status="<?php echo $key->hotline; ?>">
                            <?php echo $status_text; ?>
                        </button>
                    </td>
                        <td>
                       
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('Ambulance/edit_data/'. $key->id_ambulance); ?>"><i class="icon ion-edit"></i> Edit</a>
                                        <button class="dropdown-item deleteButton" data-id="<?php echo $key->id_ambulance; ?>"> <i class="icon ion-trash-a"></i> Hapus Data</button>
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
    var id_ambulance = $(this).data('id');

    // Tampilkan konfirmasi alert menggunakan JavaScript
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Ambulance/delete/'); ?>' + id_ambulance,
        dataType: 'json',
        success: function(response) {
            if (confirm(response.message)) {
                // Jika dikonfirmasi, panggil fungsi untuk menghapus data
                deleteData(id_ambulance);
            }
        }
    });
});

    // Fungsi untuk menghapus data setelah konfirmasi
    function deleteData(id_ambulance) {
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Ambulance/aksi_hapus_ambulance/'); ?>' + id_ambulance,
        success: function() {
            alert('Data Ambulance Berhasil Dihapus');
            // Lakukan apa pun setelah data dihapus
            location.reload();
        }
    });
}

</script>
<script>
$(document).ready(function(){
    $('.status-toggle').click(function(){
        var button = $(this); // Simpan konteks tombol sebelumnya

        var id_ambulance = button.data('id');
        var current_status = button.data('status');

        var confirmMessage = (current_status == 1) ? 'Apakah Anda yakin ingin menonaktifkan?' : 'Apakah Anda yakin ingin mengaktifkan?';

        if(confirm(confirmMessage)){
            $.ajax({
                url: '<?php echo base_url("Ambulance/change_status"); ?>',
                type: 'POST',
                data: { id_ambulance: id_ambulance, new_status: !current_status },
                success: function(response){
                    if(response == 'success'){
                        var new_status = !current_status;
                        var new_button_class = new_status ? 'btn-success' : 'btn-danger';
                        var new_status_text = new_status ? 'Tersedia' : 'Tidak Tersedia';

                        // Ubah kelas dan teks tombol
                        button.removeClass('btn-success btn-danger').addClass(new_button_class).data('status', new_status).text(new_status_text);
                    } else {
                        alert('Gagal mengubah status.');
                    }
                },
                error: function(){
                    alert('Terjadi kesalahan dalam permintaan.');
                }
            });
        }
    });
});
</script>
    
<!-- ########## END: MAIN PANEL ########## -->
