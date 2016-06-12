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
      <li><a class="hollow button" href="<?php echo site_url('/rental/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
      <li><input type="search" placeholder="Search"></li>
      <li><button id="submitsearch" type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>

<table>

  <thead>
    <tr>
      <th>#</th>
      <th>รหัสเช่า</th>
      <th>ชื่อลูกค้า</th>
      <th>วันเริ่มเช่า</th>
      <th>วันถึงกำหนด</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
<?php
  $i=1;

  if($result != null){

    for ($i; $i < 5; $i++) { 
      echo '
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      ';
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
