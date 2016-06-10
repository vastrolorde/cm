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
      <li><a class="hollow button" href="<?php echo site_url('/partner/create'); ?>">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
      <li>
        <input id="search" type="text" name="search" placeholder="Search">
      </li>
      <li><button id="submitsearch" type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>

<table>

  <thead>
    <tr>
      <th>#</th>
      <th>รหัส Partner</th>
      <th>ชื่อPartner</th>
      <th>ประเภท Partner</th>
      <th>ประเภทธุรกิจของ Partner</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
  
  <?php
    $i = 1;
    foreach ($result as $key){

      $a = json_decode($key->Type);

      if (!is_null($a)) {
        if(in_array('customer',$a) && in_array('supplier',$a)) {
          $Type = "Partner";
        }elseif (in_array('supplier',$a) || in_array('customer',$a)) {
          if (in_array('customer',$a)) {
            $Type = "customer";
          }elseif (in_array('supplier',$a)) {
            $Type = "supplier";
          }
        }
      }else{
        $Type = "Not Set";
      }



      echo '
    <tr>
      <td>'.$i.'</td>
      <td>'.$key->id.'</td>
      <td>'.$key->partner_name.'</td>
      <td>'.$Type.'</td>
      <td>'.$key->Sector.'</td>
      <td><a href="'.site_url("partner/data/".$key->id).'">Edit</a></td>
    </tr>
      ';

      $i++;

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
