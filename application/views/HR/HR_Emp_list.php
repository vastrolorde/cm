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
      <li><a class="hollow button" href="<?php echo site_url('/HR/Employee/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
    </ul>
  </div>
</div>

<table id="datatable">

  <thead>
    <tr>
      <th>#</th>
      <th>รหัสพนักงาน</th>
      <th>ชื่อพนักงาน</th>
      <th>ตำแหน่ง</th>
      <th>แผนก</th>
      <th>สถานะพนักงาน</th>
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
            <td>'.$key->emp_prefix.' '.$key->emp_fname.' '.$key->emp_lname.'</td>
            <td>'.$key->position_name.'</td>
            <td>'.$key->dept_name.'</td>
            <td>'.$key->emp_status.'</td>
            <td><a href="'.site_url("HR/Employee/data/".$key->id).'">Edit</a></td>
          </tr>
            ';

            $i++;

      }
    }else{
      echo '
        <tr>
          <td colspan="7"> No Data </td>
        </tr>
      ';
    }

  ?>
  </tbody>
</table>

  </div>
</div>
