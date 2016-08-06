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

    <script src="<?php echo asset_url().'bower/jquery/dist/jquery.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-ui/jquery-ui.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/datatables.net/js/jquery.datatables.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/datatables.net-zf/js/dataTables.foundation.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-mask-plugin/dist/jquery.mask.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/js/foundation.accordion.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/moment/moment.js'; ?>"></script>
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
      <li><a href="<?php echo site_url().'/login/admin'; ?>">Admin Panel</a></li>
      <li><a href="<?php echo site_url().'/login/logout'; ?>">Log out</a></li>
    </ul>
  </div>

</div>

<div class="full-width console">
  <div class="large-2 medium-3 columns">

      <ul class="vertical menu" data-accordion-menu>
        <li><a href="<?php echo site_url(); ?>">Users</a></li>
        <li><a href="<?php echo site_url(); ?>">Groups</a></li>
        <li><a href="<?php echo site_url(); ?>">Authorization</a></li>
      </ul>

    
  </div>

  <div class="large-10 medium-9 columns">

