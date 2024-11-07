<?php $this->load->view('header'); ?>
<?= $this->session->flashdata('message'); ?>
<div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Form Rumah Sakit</h5>
                <p>Form yang digunakan untuk input data Rumah Sakit.</p>
            </div><!-- sl-page-title -->
            <div class="col-xl-7 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-30 form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Input Data Rumah Sakit</h6>
                    <p class="mg-b-30 tx-gray-600"></p>
                    <form action="<?php echo site_url('Rumah_Sakit/add_data') ?>" method="post" enctype="multipart/form-data">
                        <!-- Nama Lengkap -->
                        <div class="form-group row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Nama Rumah Sakit:</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_rumahsakit" class="form-control" placeholder="Masukan Nama Rumah Sakit " required>
                            </div>
                        </div>
                        <!-- Lokasi -->
                        <div class="form-group row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger"></span> Lokasi:</label>
                            <div class="col-sm-8">
                                <textarea rows="2" name="lokasi" class="form-control" placeholder="Masukan Lokasi"></textarea>
                            </div>
                        </div>
                        <!-- Tombol Submit dan Cancel -->
                        <div class="form-group row mg-t-30">
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