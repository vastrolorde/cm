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
      <li><a class="hollow button" href="<?php echo site_url('/HR/Position/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
      <li>
        <input id="search" type="text" name="search" placeholder="Search">
      </li>
      <li><button id="submitsearch" type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>


<div class="row">
  <h1 class="text-center">แผนผังโครงสร้างองค์การ</h1>
  <div class="large-12 columns" id="chart_div">
    <!-- Code Here -->
  </div>
</div>

<table>

  <thead>
    <tr>
      <th>#</th>
      <th>รหัสตำแหน่ง</th>
      <th>ชื่อตำแหน่ง</th>
      <th>แผนก</th>
      <th>ผู้บังคับบัญชา</th>
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
            <td>'.$key->position_name.'</td>
            <td>'.$key->dept_name.'</td>
            <td>'.$key->position_manager.'</td>
            <td><a href="'.site_url("HR/Position/data/".$key->id).'">Edit</a></td>
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

<div class="row">
  <div class="large-12 columns">
      <span class="text-center"><?php echo $pagination; ?></span>
  </div>
</div>

  </div>
</div>