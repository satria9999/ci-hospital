<!DOCTYPE html>
<html lang="en">
<?php
if(!isset($_SESSION['nama'])){
redirect('Auth');
}else{ ?>
  <head>
  <?php $this->load->view('header'); ?>
  </head>
  <body>
  <!-- ########## START: LEFT PANEL ########## -->
  <?php $this->load->view('sidebar'); ?>
  <!-- ########## END: LEFT PANEL ########## -->
  <!-- ########## START: HEAD PANEL ########## -->
  <?php $this->load->view('profile'); ?>
  <!-- ########## END: HEAD PANEL ########## -->
  <!-- ########## START: RIGHT PANEL ########## -->
  <?php $this->load->view('notification'); ?>
  <!-- ########## END: RIGHT PANEL ########## -->
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
  <?php $this->load->view($content); ?>
  </div>

  <!-- ########## END: MAIN PANEL ########## -->
  <?php $this->load->view('js'); ?>
  </body>
  <?php } ?>
</html>
