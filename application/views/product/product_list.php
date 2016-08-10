<div class="row">
  <div class="large-12 columns">

<div class="top-bar sub-top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php echo $title;?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><a class="hollow button" href="<?php echo site_url('/product/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
    </ul>
  </div>
</div>

<table id="datatable">
  <thead>
    <tr>
      <th>#</th>
      <th>รหัส Product</th>
      <th>ชื่อ Product</th>
      <th>Family</th>
      <th>ประเภท Product</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
  <?php
    $i = 1;

    if($result != null){
    foreach ($result as $key){
      echo '
    <tr>
      <td>'.$i.'</td>
      <td>'.$key->product_id.'</td>
      <td>'.$key->product_name.'</td>
      <td>'.$key->product_family.'</td>
      <td>'.$key->product_type.'</td>
      <td><a href="'.site_url("product/data/".$key->product_id).'">Edit</a></td>
    </tr>
      ';

      $i++;

      }
    }else{
      echo '
        <tr>
          <td colspan="6"> No Data </td>
        </tr>
      ';
    }

  ?>
  </tbody>
</table>

  </div>
</div>
