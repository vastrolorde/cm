
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
      <li><a class="hollow button" href="<?php echo site_url('Inventory/Warehouse/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
    </ul>
  </div>
</div>

<table id="datatable">

  <thead>
    <tr>
      <th>#</th>
      <th>รหัสคลังสินค้า</th>
      <th>ชื่อคลังสินค้า</th>
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
            <td>'.$key->id.'</td>
            <td>'.$key->wh_name.'</td>
            <td><a href="'.site_url("Inventory/Warehouse/data/".$key->id).'">Edit</a></td>
          </tr>
        ';

        $i++;

      }
    }else{
      echo '
        <tr>
          <td colspan="4"> No Data </td>
        </tr>
      ';
    }

  ?>
  </tbody>
</table>

  </div>
</div>
