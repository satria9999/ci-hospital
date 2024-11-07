<?php $this->load->view('header'); ?>
<?php
foreach ($layanan as $row) {
?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success" role="alert">
<?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Form Edit Layanan Rumah Sakit</h5>
                <p>Form yang digunakan untuk edit data Layanan Rumah Sakit.</p>
            </div><!-- sl-page-title -->
            <div class="col-xl-7 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-30 form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Edit Data Layanan Rumah Sakit</h6>
                    <p class="mg-b-30 tx-gray-600"></p>
                    <form action="<?php echo site_url('Layanan/update/'.$row->id_layanan)?>" method="post" enctype="multipart/form-data" >
                        <!-- Nama Lengkap -->
                            <div class="form-group">
                            <label for="id_rumahsakit_select" class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Memilih Rumah Sakit</label>
                            <select class="form-control select2-show-search" name="id_rumahsakit" id="id_rumahsakit_select" data-placeholder="Search Menggunakan Nama Rumah Sakit">
                                <?php
                                $nomor_urut = 1; // Inisialisasi variabel penomoran
                                foreach ($rumah_sakit as $key) {
                                    echo '<option value="' . $key->id_rumahsakit . '"> ' . $nomor_urut . '. ' . $key->nama_rumahsakit . '</option>';
                                    $nomor_urut++; // Inkrementasi variabel penomoran
                                }
                                ?>
                            </select>
                        </div>
                       
                    <!-- Informasi Nama dan Lokasi Rumah Sakit -->
                    <div class="form-group">
                            <label for="nama_rumahsakit" class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Nama Rumah Sakit</label>
                            <input class="form-control" type="text"  value="<?php echo $row->nama_rumahsakit;?>" name="nama_rumahsakit" id="nama_rumahsakit"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Lokasi</label>
                            <input class="form-control" type="text"  value="<?php echo $row->lokasi; ?>" name="lokasi" id="lokasi" readonly>
                        </div>

                    <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger"></span>
                                Layanan:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="radio" name="nama_layanan" value="UGD" id="UGD">
                                <label for="UGD">UGD</label>
                                <input type="radio" name="nama_layanan" value="IGD" id="IGD">
                                <label for="IGD">IGD</label>
                                <input type="radio" name="nama_layanan" value="Jantung" id="Jantung">
                                <label for="Jantung">Jantung</label>
                            </div>
                        </div>
                        <div class="row row-xs mg-t-30">
                            <div class="col-sm-8 mg-l-auto">
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info mg-r-5">Submit Form</button>
                                    <a href="<?php echo base_url('Dashboard/lihat_layanan'); ?>" type="button" class="btn btn-secondary">Cancel</a>
                                </div><!-- form-layout-footer -->
                            </div><!-- col-8 -->
                        </div>
                    </form>
                </div><!-- card -->
            </div><!-- col-6 -->
            <?php } ?>

            <script>
      'use strict';

$('.select2').select2({
  minimumResultsForSearch: Infinity
});

// Select2 by showing the search
$('.select2-show-search').select2({
  minimumResultsForSearch: ''
});

// Select2 with tagging support
$('.select2-tag').select2({
  tags: true,
  tokenSeparators: [',', ' ']
});
</script>
<script>
    var selectElement = document.getElementById("id_rumahsakit_select");
    var namaElement = document.getElementById("nama_rumahsakit");
    var lokasiElement = document.getElementById("lokasi");

    selectElement.addEventListener("change", function() {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var id_rumahsakit = selectedOption.value;

        // Mengirim permintaan AJAX ke server untuk mendapatkan data nama
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                namaElement.value = data.nama_rumahsakit;
                lokasiElement.value = data.lokasi;
            }
        };
        xhr.open("GET", "<?php echo site_url('Rumah_Sakit/get_nama'); ?>?id=" + id_rumahsakit, true);
        xhr.send();
    });
</script>