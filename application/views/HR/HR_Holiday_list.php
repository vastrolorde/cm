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
      <li><a class="hollow button" href="<?php echo site_url('/HR/Holiday/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="<?php echo site_url('/HR/Holiday/org_chart'); ?>">พิมพ์</a></li>
  </div>
</div>


<div class="row">
  <div class="large-12 columns" id="chart_div">
    <!-- Code Here -->
  </div>
</div>

<table id="datatable">

  <thead>
    <tr>
      <th>วันที่</th>
      <th>วันหยุด</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
  
  <?php
    
    if($result != null){
      foreach ($result as $key){

        echo '
          <tr>
            <td>'.$key->hol_date.'</td>
            <td><b>'.$key->hol_name.'</b></td>
            <td><b>'.$key->hol_remark.'</b></td>
            <td><a href="'.site_url("HR/Holiday/data/".$key->id).'">Edit</a></td>
          </tr>
            ';

      }
    }else{
      echo '
        <tr>
          <td colspan="3"> No Data </td>
        </tr>
      ';
    }

  ?>
  </tbody>
</table>

  </div>
</div>
