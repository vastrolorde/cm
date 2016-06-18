<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="<?php echo asset_url().'bower/jquery-ui/themes/base/jquery-ui.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'css/app.css'; ?>">

    <script src="<?php echo asset_url().'bower/jquery/dist/jquery.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-ui/jquery-ui.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/js/foundation.accordion.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/moment/moment.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-mask-plugin/dist/jquery.mask.js'; ?>"></script>
    <?php
      if(isset($mask)){
        echo $mask;
      }
    ?>

  </head>
  <body>
 
<div class="top-bar">

  <div class="top-bar-left">
    <ul class="menu">
      <li class="menu-text">Classmat co., ltd.</li>
    </ul>
  </div>

  <div class="top-bar-right">
    <ul class="menu">
      <li><a href="#">Username</a></li>
      <li><a href="#">Settings</a></li>
      <li><a href="#">Log out</a></li>
    </ul>
  </div>

</div>

<div class="row full-width">
  <div class="medium-3 columns">

      <ul class="vertical menu" data-accordion-menu>
        <li><a href="<?php echo site_url(); ?>">Dashboard</a></li>
        <li><a href="<?php echo site_url().'/rental'; ?>">งานเช่า</a></li>
        <li><a href="<?php echo site_url().'/Partner'; ?>">Partner</a></li>
        <li><a href="#">สินค้าคงคลัง</a>
            <ul class="vertical menu nested">
              <li><a href="<?php echo site_url().'/Inventory/Inventory'; ?>">รายการเคลื่อนไหวสินค้าคงคลัง</a></li>
              <li><a href="<?php echo site_url().'/Product'; ?>">สินค้า</a></li>
              <li><a href="<?php echo site_url().'/Inventory/Warehouse'; ?>">คลังสินค้า</a></li>
              <li></li>
              <li></li>
            </ul>
        </li>
        <li><a href="#">HR</a>
          <ul class="vertical menu nested">
            <li><a href="<?php echo site_url().'/HR/Employee'; ?>">พนักงาน</a></li>
            <li><a href="<?php echo site_url().'/HR/Dept'; ?>">แผนก</a></li>
            <li><a href="<?php echo site_url().'/HR/Position'; ?>">ตำแหน่ง</a></li>
          </ul>
        </li>
      </ul>

    
  </div>

  <div class="medium-9 columns">

