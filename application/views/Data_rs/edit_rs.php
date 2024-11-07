<?php $this->load->view('header'); ?>
<?php
foreach ($rumah_sakit as $row) {
?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success" role="alert">
<?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Form Edit Rumah Sakit</h5>
                <p>Form yang digunakan untuk edit data Rumah Sakit.</p>
            </div><!-- sl-page-title -->
            <div class="col-xl-7 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-30 form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Edit Data Rumah Sakit</h6>
                    <p class="mg-b-30 tx-gray-600"></p>
                    <form action="<?php echo site_url('Rumah_Sakit/update/'.$row->id_rumahsakit)?>" method="post" enctype="multipart/form-data" >
                        <!-- Nama Lengkap -->
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Nama
                                Rumah Sakit:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="nama_rumahsakit" value="<?php echo $row->nama_rumahsakit; ?>" class="form-control" placeholder="Masukan Nama Rumah Sakit" readonly>
                            </div>
                        </div><!-- row -->
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger"></span> Lokasi:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea rows="2" name="lokasi" class="form-control" placeholder="Masukan Lokasi"><?php echo $row->lokasi; ?></textarea>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row row-xs mg-t-30">
                            <div class="col-sm-8 mg-l-auto">
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info mg-r-5">Submit Form</button>
                                    <a href="<?php echo base_url('Dashboard/lihat_rs'); ?>" type="button" class="btn btn-secondary">Cancel</a>
                                </div><!-- form-layout-footer -->
                            </div><!-- col-8 -->
                        </div>
                    </form>
                </div><!-- card -->
            </div><!-- col-6 -->
            <?php } ?>