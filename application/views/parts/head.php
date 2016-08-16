<!doctype html ng-app>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="<?php echo asset_url().'bower/jquery-ui/themes/base/jquery-ui.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'css/app.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'css/foundation-icons.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'bower/fullcalendar/dist/fullcalendar.css'; ?>">

    <script src="<?php echo asset_url().'bower/jquery/dist/jquery.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-ui/jquery-ui.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/moment/moment.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/parsleyjs/dist/parsley.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/fullcalendar/dist/fullcalendar.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/datatables.net/js/jquery.datatables.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/datatables.net-zf/js/dataTables.foundation.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-mask-plugin/dist/jquery.mask.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/js/foundation.accordion.js'; ?>"></script>
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
      <li><a href="<?php echo site_url().'/home'; ?>">Home</a></li>
      <li><a href="#">Username</a></li>
      <?php
        if($this->ion_auth->is_admin()){
          echo '<li><a href="'.site_url().'/login/admin'.'">Admin Panel</a></li>';
        }
      ?>
      <li><a href="<?php echo site_url().'/login/logout'; ?>">Log out</a></li>
    </ul>
  </div>

</div>

<div class="full-width console">
  <div class="large-2 medium-3 columns fullHeight-col">

      <ul class="vertical menu" data-accordion-menu>
        <li><h4 class="text-center navigation_head">Classmat co., ltd.</h4></li>
        <li><a href="<?php echo site_url().'/home'; ?>">Dashboard</a></li>
        <?php
          if($this->ion_auth->in_group('Sales')){
        ?>
        <li><a href="<?php echo site_url().'/rental'; ?>">งานเช่า</a></li>
        <?php
          }
        ?>

        <li><a href="<?php echo site_url().'/Partner'; ?>">Partner</a></li>

        <?php
          if($this->ion_auth->in_group('Store')){
        ?>
        <li><a href="#">สินค้าคงคลัง</a>
            <ul class="vertical menu nested">
              <li><a href="<?php echo site_url().'/Inventory/Inventory/inv_flow'; ?>">รายการเคลื่อนไหวสินค้าคงคลัง</a></li>
              <li><a href="<?php echo site_url().'/Inventory/Inventory'; ?>">เบิก/รับสินค้าคงคลัง</a></li>
              <li><a href="<?php echo site_url().'/Product'; ?>">สินค้า</a></li>
              <li><a href="<?php echo site_url().'/Inventory/Warehouse'; ?>">คลังสินค้า</a></li>
              <li></li>
              <li></li>
            </ul>
        </li>
        <?php
          }
        ?>

        <?php
          if($this->ion_auth->in_group('HR')){
        ?>
        <li><a href="#">HR</a>
          <ul class="vertical menu nested">
            <li><a href="#">บันทึกเวลา</a>
              <ul class="vertical menu nested">
                <li><a href="">เปิดกะ</a></li>
                <li><a href="<?php echo site_url().'/HR/Attendance'; ?>">บันทึกลงเวลา</a></li>
                <li><a href="">บันทึกล่วงเวลา</a></li>
                <li><a href="<?php echo site_url().'/HR/Leave'; ?>">บันทึกลา</a></li>
                <li><a href="<?php echo site_url().'/HR/Holiday'; ?>">วันหยุดประจำปี</a></li>
              </ul>
            </li>
            <li><a href="#">พนักงาน</a>
              <ul class="vertical menu nested">
                <li><a href="<?php echo site_url().'/HR/Employee'; ?>">พนักงาน</a></li>
                <li><a href="<?php echo site_url().'/HR/Dept'; ?>">แผนก</a></li>
                <li><a href="<?php echo site_url().'/HR/Position'; ?>">ตำแหน่ง</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
          }
        ?>

      </ul>

    
  </div>

  <div class="large-10 medium-9 columns">

