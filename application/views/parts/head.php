<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url().'css/app.css'; ?>">
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

<div class="row">
  <div class="medium-3 columns" data-sticky-container>
    <div class="sticky" data-sticky data-anchor="content">

      <ul class="vertical menu" data-accordion-menu>
        <li><h4>Module</h4>
          <ul class="vertical menu nested">
            <li><a href="<?php echo site_url(); ?>">Dashboard</a></li>
            <li><a href="<?php echo site_url().'/home/rental'; ?>">Rental</a></li>
            <li><a href="#">Partner</a></li>
            <li><a href="#">Product</a></li>
          </ul>
        </li>
        <li><h4>Settings</h4>
          <ul class="vertical menu nested">
            <li><a href="#">Partner Type</a></li>
            <li><a href="#">Partner Industry</a></li>
            <li><a href="#">Product Category</a></li>
            <li><a href="#">Product Attribute</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>

  <div class="medium-9 columns">

