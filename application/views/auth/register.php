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

    <title>Register</title>
    <link href="<?php echo base_url();?>assets/img/logo_remove.png" rel="icon" />
    <link href="<?php echo base_url();?>assets/img/logo_remove.png" rel="apple-touch-icon" />

    <!-- vendor css -->
    <link href="<?php echo base_url();?>assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/lib/select2/css/select2.min.css" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/starlight.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

      <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-30 bg-white">
      <div class="logo-container tx-center ">
                <img src="<?= base_url(); ?>assets/img/logo_remove.png" alt="Logo" width="160">
            </div>
            <div class="signin-logo tx-center tx-20 tx-bold tx-inverse">Green Hospital Management</div>
        <div class="tx-center mg-b-10">Aplikasi Management Rumah Sakit</div>
        <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
        <div class="form-group">
    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo set_value('nama'); ?>" placeholder="Enter your username">
    <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
</div>
        <div class="form-group">
          <input type="email" name="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>" placeholder="Enter your email">
    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
</div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" id="password" value="<?php echo set_value('password'); ?>" placeholder="Enter your password">
    <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
</div>
        <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
        <button type="submit" class="btn btn-info btn-block">Sign Up</button>

        <div class="mg-t-40 tx-center">Already have an account? <a href="<?php echo base_url('Auth');?>" class="tx-info">Sign In</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->
</form>

    <script src="<?php echo base_url();?>assets/lib/jquery/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/lib/popper.js/popper.js"></script>
    <script src="<?php echo base_url();?>assets/lib/bootstrap/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/lib/select2/js/select2.min.js"></script>
    <script>
      $(function(){
        'use strict';

        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>

  </body>
</html>
