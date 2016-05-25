<div class="row">
  <div class="large-12 column">
    
<!--  Sub Topbar -->

<div class="top-bar sub-top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php echo $title;?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><input class="button hollow success" type="submit"></li>
      <li><a class="button hollow warning" href="<?php echo site_url('/rental/create'); ?>">ยกเลิก</a></li>
      <li><a class="button hollow alert" href="<?php echo site_url('/rental/create'); ?>">ลบ</a></li>
      <li><a class="button hollow" href="<?php echo site_url('/rental/create'); ?>">พิมพ์รายงาน</a></li>
    </ul>
  </div>
</div>

<!-- Content -->

<?php echo form_open('/rental/add') ?>
<div class="row">
  <div class="large-6 columns">

<?php

  $fields = array(
    'partner' => 'partner',
    'ที่อยู่' => 'address'
  );

  foreach ($fields as $key => $value) {
    echo form_label($key).form_input($value);
  }

?>

  </div>
  <div class="large-6 columns">

<?php

  $fields = array(
    'วันที่สร้างเอกสาร' => 'create_date',
    'เอกสารอ้างอิง' => 'ref_doc'
  );

  foreach ($fields as $key => $value) {
    echo form_label($key).form_input($value);
  }

?>

  </div>
</div>


  </div>
</div>