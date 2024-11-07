<div class="sl-logo">
    <img src="<?= base_url(); ?>assets/img/logo_remove.png" alt="Logo Green Hospital" class="wd-40">  
    <a href="<?php echo base_url('Dashboard/Dashboard');?>">Green Hospital</a>
</div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->
      
<label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="<?php echo base_url('Dashboard/Dashboard');?>" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-folder-outline tx-20"></i> 
            <span class="menu-item-label">Data Slider Image</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item" ><a href="<?php echo base_url('Dashboard/lihat_sliderimage');?>" class="nav-link">Input Slider Image</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-folder-outline tx-20"></i> 
            <span class="menu-item-label">Data Rumah Sakit</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item" ><a href="<?php echo base_url('Dashboard/lihat_rs');?>" class="nav-link">Tabel Rumah Sakit</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-folder-outline tx-20"></i> 
            <span class="menu-item-label">Data Dokter</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item" ><a href="<?php echo base_url('Dashboard/lihat_dokter');?>" class="nav-link">Tabel Dokter</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Layanan Rumah Sakit</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="<?php echo base_url('Dashboard/lihat_layanan');?>" class="nav-link"> Data Layanan</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Dashboard/lihat_jantung');?>" class="nav-link"> Data Spesialis Jantung</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon fa fa-automobile tx-20"></i>
            <span class="menu-item-label">Data Ambulance</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="<?php echo base_url('Dashboard/lihat_ambulance');?>" class="nav-link"> Tabel Ambulamce</a></li>
        </ul>
                
      
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->