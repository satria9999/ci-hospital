<?php $this->load->view('header'); ?>
<?= $this->session->flashdata('message'); ?>
<?php
foreach ($image as $row) {
?>


<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Form Edit Sliderimage</h5>
        <p>Form yang digunakan untuk edit data Sliderimage.</p>
    </div><!-- sl-page-title -->
    <div class="col-xl-7 mg-t-25 mg-xl-t-0">
        <div class="card pd-20 pd-sm-30 form-layout form-layout-4">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Edit Data Sliderimage</h6>
            <p class="mg-b-30 tx-gray-600"></p>
            <form action="<?php echo site_url('Sliderimage/update_data/'.$row->id_image)?>" method="post" enctype="multipart/form-data" >
                <!-- Nama Lengkap -->
                <div class="row row-xs">
                    <label class="col-sm-4 form-control-label">
                        <span class="tx-danger">*</span> Image:
                    </label>
                    <div class="col-sm-8">
                        <label class="custom-file" style="width: 100%;">
                            <input type="file" name="image" class="custom-file-input">
                            <span class="custom-file-control custom-file-control-inverse"></span>
                        </label>
                    </div>
                </div>
                <!-- row -->
                <div class="row row-xs mg-t-30">
                    <div class="col-sm-8 mg-l-auto">
                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5">Submit Form</button>
                            <a href="<?php echo base_url('Dashboard/lihat_sliderimage'); ?>" type="button" class="btn btn-secondary">Cancel</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- col-8 -->
                </div>
            </form>
        </div><!-- card -->
    </div><!-- col-6 -->
    <?php } ?>
</div>
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        var fileName = '';
        fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
