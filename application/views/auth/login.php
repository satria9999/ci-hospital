<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Login</title>
    <link href="<?php echo base_url();?>assets/img/logo_remove.png" rel="icon" />
    <link href="<?php echo base_url();?>assets/img/logo_remove.png" rel="apple-touch-icon" />
    <!-- vendor css -->
    <link href="<?= base_url(); ?>assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/starlight.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="logo-container tx-center mg-b-10">
                <img src="<?= base_url(); ?>assets/img/logo_remove.png" alt="Logo" width="170">
            </div>
        <div class="signin-logo tx-center tx-20 tx-bold tx-inverse">Green Hospital Management</div>
        <div class="tx-center mg-b-20">Aplikasi Management Rumah Sakit</div>
        <?= $this->session->flashdata('message'); ?>
        <form action="<?php echo base_url('Auth'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" class="form-control" name="nama" placeholder="Enter your username" value="<?php echo set_value('nama'); ?>">
            <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
          </div><!-- form-group -->
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your password" value="<?php echo set_value('password'); ?>">
            <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
          </div><!-- form-group -->
          <button type="submit" class="btn btn-info btn-block" value="Login">Sign In</button>
        </form>


        <div class="mg-t-60 tx-center">Not yet a member? <a href="<?php echo base_url('register/register');?>" class="tx-info">Sign Up</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="<?php echo base_url();?>assets/lib/jquery/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/lib/popper.js/popper.js"></script>
    <script src="<?php echo base_url();?>assets/lib/bootstrap/bootstrap.js"></script>

  </body>
</html>